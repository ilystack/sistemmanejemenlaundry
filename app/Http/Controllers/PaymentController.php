<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Confirm payment via QR code scan
     */
    public function confirm($orderId, $token)
    {
        try {
            $order = Order::findOrFail($orderId);

            // Validasi token
            if ($order->payment_token !== $token) {
                return redirect()->route('login.choice')->with('error', 'Token pembayaran tidak valid!');
            }

            // Cek apakah token sudah expired (10 menit)
            if ($order->payment_token_expires_at && Carbon::now()->greaterThan($order->payment_token_expires_at)) {
                return redirect()->route('login.choice')->with('error', 'Token pembayaran sudah kadaluarsa! Silakan buat order baru.');
            }

            // Cek apakah sudah dibayar
            if ($order->payment_status === 'paid') {
                return redirect()->route('login.choice')->with('error', 'Pembayaran sudah dilakukan sebelumnya!');
            }

            // Update payment status
            DB::beginTransaction();
            try {
                $order->update([
                    'payment_status' => 'paid',
                    'payment_token' => null, // Invalidate token setelah dipakai
                    'payment_token_expires_at' => null,
                ]);

                DB::commit();

                // Redirect ke dashboard dengan success message
                if (auth()->check()) {
                    if (auth()->user()->role === 'customer') {
                        return redirect()->route('customer.dashboard')->with('success', '✅ Pembayaran berhasil! Order Anda sedang diproses.');
                    } elseif (auth()->user()->role === 'karyawan') {
                        return redirect()->route('karyawan.dashboard')->with('success', '✅ Pembayaran berhasil! Order sedang diproses.');
                    } else {
                        return redirect()->route('admin.dashboard')->with('success', '✅ Pembayaran berhasil!');
                    }
                } else {
                    return redirect()->route('login.choice')->with('success', '✅ Pembayaran berhasil! Silakan login untuk melihat order Anda.');
                }

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            return redirect()->route('login.choice')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
