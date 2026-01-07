<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class UserController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function indexCustomer()
    {
        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->latest()
            ->paginate(10);
        return view('pages.customer.index', compact('customers'));
    }

    /**
     * Display a listing of karyawan.
     */
    public function indexKaryawan()
    {
        $karyawans = User::where('role', 'karyawan')
            ->latest()
            ->paginate(10);
        return view('pages.karyawan.index', compact('karyawans'));
    }

    /**
     * Store a newly created customer.
     */
    public function storeCustomer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => bcrypt($validated['password']),
            'role' => 'customer',
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()->route('user.customer.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    /**
     * Store a newly created karyawan.
     */
    public function storeKaryawan(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => bcrypt($validated['password']),
            'role' => 'karyawan',
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()->route('user.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    /**
     * Remove the specified customer.
     */
    public function destroyCustomer(string $id)
    {
        $customer = User::findOrFail($id);

        // Check if customer has orders
        $ordersCount = Order::where('user_id', $customer->id)->count();

        if ($ordersCount > 0) {
            return redirect()->route('user.customer.index')->with('error', 'Tidak dapat menghapus customer yang memiliki riwayat order!');
        }

        $customer->delete();

        return redirect()->route('user.customer.index')->with('success', 'Customer berhasil dihapus!');
    }

    /**
     * Remove the specified karyawan.
     */
    public function destroyKaryawan(string $id)
    {
        $karyawan = User::findOrFail($id);

        // Check if karyawan has absensi records
        $absensiCount = \App\Models\Absensi::where('user_id', $karyawan->id)->count();

        if ($absensiCount > 0) {
            return redirect()->route('user.karyawan.index')->with('error', 'Tidak dapat menghapus karyawan yang memiliki riwayat absensi!');
        }

        $karyawan->delete();

        return redirect()->route('user.karyawan.index')->with('success', 'Karyawan berhasil dihapus!');
    }
}
