<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Order;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:500'
            ]);

            // Check if order belongs to authenticated user
            $order = Order::where('id', $validated['order_id'])
                ->where('user_id', auth()->id())
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order tidak ditemukan atau bukan milik Anda'
                ], 403);
            }

            // Check if already rated
            $existingTestimonial = Testimonial::where('order_id', $validated['order_id'])->first();
            if ($existingTestimonial) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order ini sudah dinilai sebelumnya'
                ], 400);
            }

            // Create testimonial
            $testimonial = Testimonial::create([
                'order_id' => $validated['order_id'],
                'user_id' => auth()->id(),
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
                'is_approved' => false, // Admin will approve later
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih atas penilaian Anda! Penilaian akan ditampilkan setelah disetujui admin.',
                'data' => $testimonial
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
