<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = \App\Models\Order::with(['user', 'paket'])->latest()->paginate(10);
        return view('pages.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation berbeda untuk KG vs PCS
        if ($request->tipe_paket === 'pcs') {
            $request->validate([
                'tipe_paket' => 'required|in:kg,pcs',
                'items' => 'required|array|min:1',
                'items.*.paket_id' => 'required|exists:pakets,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.harga_satuan' => 'required|numeric',
                'pickup' => 'required|in:antar_sendiri,dijemput',
                'metode_pembayaran' => 'required|in:cash,qris',
                'customer_latitude' => 'nullable|numeric',
                'customer_longitude' => 'nullable|numeric',
                'jarak_km' => 'nullable|numeric',
                'ongkir' => 'nullable|numeric',
                'total_harga' => 'required|numeric',
            ]);
        } else {
            $request->validate([
                'tipe_paket' => 'required|in:kg,pcs',
                'paket_id' => 'required|exists:pakets,id',
                'jumlah' => 'required|numeric|min:0.1',
                'pickup' => 'required|in:antar_sendiri,dijemput',
                'metode_pembayaran' => 'required|in:cash,qris',
                'customer_latitude' => 'nullable|numeric',
                'customer_longitude' => 'nullable|numeric',
                'jarak_km' => 'nullable|numeric',
                'ongkir' => 'nullable|numeric',
                'total_harga' => 'required|numeric',
            ]);
        }

        try {
            \DB::beginTransaction();

            // Get next antrian number
            $lastOrder = \App\Models\Order::latest('id')->first();
            $antrian = $lastOrder ? $lastOrder->antrian + 1 : 1;

            // Determine payment status
            $needsPayment = $request->metode_pembayaran === 'qris' ||
                ($request->metode_pembayaran === 'cash' && $request->pickup === 'dijemput');

            $paymentStatus = $needsPayment ? 'pending' : 'paid';

            // Generate payment token if needed
            $paymentToken = null;
            $paymentTokenExpiresAt = null;
            $qrCodePath = null;

            if ($needsPayment) {
                $paymentToken = \Str::random(32);
                $paymentTokenExpiresAt = now()->addMinutes(10); // Expire dalam 10 menit
            }

            // Create order (paket_id nullable untuk PCS)
            $order = \App\Models\Order::create([
                'user_id' => auth()->id(),
                'paket_id' => $request->paket_id ?? null, // Null untuk PCS
                'tipe_paket' => $request->tipe_paket,
                'jumlah' => $request->jumlah ?? 0, // 0 untuk PCS (jumlah ada di items)
                'pickup' => $request->pickup,
                'metode_pembayaran' => $request->metode_pembayaran,
                'customer_latitude' => $request->customer_latitude,
                'customer_longitude' => $request->customer_longitude,
                'jarak_km' => $request->jarak_km ?? 0,
                'ongkir' => $request->ongkir ?? 0,
                'total_harga' => $request->total_harga,
                'antrian' => $antrian,
                'status' => 'menunggu',
                'payment_status' => $paymentStatus,
                'payment_token' => $paymentToken,
                'payment_token_expires_at' => $paymentTokenExpiresAt,
            ]);

            // Create order items untuk PCS
            if ($request->tipe_paket === 'pcs' && $request->has('items')) {
                foreach ($request->items as $item) {
                    \App\Models\OrderItem::create([
                        'order_id' => $order->id,
                        'paket_id' => $item['paket_id'],
                        'quantity' => $item['quantity'],
                        'harga_satuan' => $item['harga_satuan'],
                        'subtotal' => $item['quantity'] * $item['harga_satuan'],
                    ]);
                }
            }

            // Generate QR Code if payment needed
            if ($needsPayment) {
                $paymentUrl = route('payment.confirm', [
                    'order' => $order->id,
                    'token' => $paymentToken
                ]);

                // Generate QR Code
                $qrCodeFileName = 'qr_order_' . $order->id . '_' . time() . '.svg';
                $qrCodePath = 'qrcodes/' . $qrCodeFileName;
                $fullPath = storage_path('app/public/' . $qrCodePath);

                // Create directory if not exists
                if (!file_exists(dirname($fullPath))) {
                    mkdir(dirname($fullPath), 0755, true);
                }

                // Generate QR Code using SimpleSoftwareIO (SVG format)
                \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                    ->size(300)
                    ->margin(2)
                    ->generate($paymentUrl, $fullPath);

                // Update order with QR path
                $order->update(['qr_code_path' => $qrCodePath]);
            }

            // Log activity
            $activityDesc = $request->tipe_paket === 'pcs'
                ? 'Membuat order baru #' . $order->id . ' - ' . count($request->items) . ' items (PCS)'
                : 'Membuat order baru #' . $order->id . ' - ' . ($order->paket ? $order->paket->nama : 'Paket KG');

            \App\Helpers\ActivityLogger::log(
                'order',
                'create',
                $activityDesc,
                $order->id
            );

            \DB::commit();

            // Return response
            if ($needsPayment) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order berhasil dibuat. Silakan scan QR Code untuk pembayaran.',
                    'order_id' => $order->id,
                    'qr_code_url' => asset('storage/' . $qrCodePath),
                    'payment_url' => $paymentUrl, // Tambahkan ini
                    'payment_amount' => $request->metode_pembayaran === 'qris'
                        ? $request->total_harga
                        : $request->ongkir,
                    'expires_at' => $paymentTokenExpiresAt->format('Y-m-d H:i:s'),
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Order berhasil dibuat!',
                    'order_id' => $order->id,
                ]);
            }

        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
