<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalOrders = \App\Models\Order::count();
        $totalRevenue = \App\Models\Order::sum('total_harga');
        $totalCustomers = \App\Models\User::where('role', 'customer')->count();
        $totalKaryawan = \App\Models\User::where('role', 'karyawan')->count();
        $recentActivities = \App\Models\ActivityLog::latest()->take(10)->get();

        return view('pages.dashboard.admin', compact(
            'totalOrders',
            'totalRevenue',
            'totalCustomers',
            'totalKaryawan',
            'recentActivities'
        ));
    }

    public function karyawanDashboard()
    {
        $userId = auth()->id();

        $stats = [
            'orderan_hari_ini' => \App\Models\Order::whereDate('created_at', today())->count(),
            'orderan_diproses' => \App\Models\Order::where('status', 'diproses')->count(),
            'orderan_selesai' => \App\Models\Order::where('status', 'selesai')->count(),
            'absensi_bulan_ini' => \App\Models\Absensi::where('user_id', $userId)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ];

        $orders = \App\Models\Order::with(['user', 'paket', 'items'])
            ->latest()
            ->take(5)
            ->get();

        return view('pages.dashboard.karyawan', compact('stats', 'orders'));
    }

    public function customerDashboard()
    {
        return view('pages.dashboard.customer');
    }
}
