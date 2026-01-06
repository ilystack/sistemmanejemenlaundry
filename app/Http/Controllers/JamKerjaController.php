<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;

class JamKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jamKerjas = \App\Models\JamKerja::latest()->paginate(10);
        return view('pages.jam-kerja.index', compact('jamKerjas'));
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'toleransi_menit' => 'required|integer|min:0',
        ]);

        $jamKerja = \App\Models\JamKerja::create($validated);

        // Log activity
        ActivityLogger::log(
            'jam_kerja',
            "Shift baru ditambahkan: {$jamKerja->nama} ({$jamKerja->hari})",
            '⏰',
            'green'
        );

        return redirect()->route('jam-kerja.index')
            ->with('success', 'Shift berhasil ditambahkan');
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
        $jamKerja = \App\Models\JamKerja::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'toleransi_menit' => 'required|integer|min:0',
        ]);

        $jamKerja->update($validated);

        // Log activity
        ActivityLogger::log(
            'jam_kerja',
            "Shift diperbarui: {$jamKerja->nama} ({$jamKerja->hari})",
            '✏️',
            'amber'
        );

        return redirect()->route('jam-kerja.index')
            ->with('success', 'Shift berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jamKerja = \App\Models\JamKerja::findOrFail($id);
        $namaShift = $jamKerja->nama . ' (' . $jamKerja->hari . ')';
        $jamKerja->delete();

        // Log activity
        ActivityLogger::log(
            'jam_kerja',
            "Shift dihapus: {$namaShift}",
            '🗑️',
            'red'
        );

        return redirect()->route('jam-kerja.index')
            ->with('success', 'Shift berhasil dihapus');
    }

    public function toggle($id)
    {
        $jamKerja = \App\Models\JamKerja::findOrFail($id);
        $jamKerja->update(['is_active' => !$jamKerja->is_active]);

        // Log activity
        $status = $jamKerja->is_active ? 'diaktifkan' : 'dinonaktifkan';
        ActivityLogger::log(
            'jam_kerja',
            "Shift {$status}: {$jamKerja->nama} ({$jamKerja->hari})",
            $jamKerja->is_active ? '✅' : '⏸️',
            $jamKerja->is_active ? 'green' : 'amber'
        );

        return redirect()->back()
            ->with('success', 'Status shift berhasil diubah');
    }
}
