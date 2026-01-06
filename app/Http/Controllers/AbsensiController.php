<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensis = \App\Models\Absensi::with(['user', 'jamKerja'])->latest()->paginate(10);
        return view('pages.absensi.index', compact('absensis'));
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
        //
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

    /**
     * Display absensi page for karyawan
     */
    public function karyawanIndex(Request $request)
    {
        $userId = auth()->id();
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        // Get all attendance dates for current month
        $attendances = \App\Models\Absensi::where('user_id', $userId)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        // Convert to array of date strings (Y-m-d format)
        $attendanceData = $attendances->map(function ($absensi) {
            return $absensi->created_at->format('Y-m-d');
        })->toArray();

        return view('pages.absensi.karyawan', compact('attendanceData'));
    }

    /**
     * Get attendance data for AJAX requests
     */
    public function getAttendanceData(Request $request)
    {
        $userId = auth()->id();
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $attendances = \App\Models\Absensi::where('user_id', $userId)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $attendanceData = $attendances->map(function ($absensi) {
            return $absensi->created_at->format('Y-m-d');
        })->toArray();

        return response()->json(['attendanceData' => $attendanceData]);
    }

    /**
     * Check if user needs to do attendance
     */
    public function check()
    {
        $userId = auth()->id();
        $today = now()->format('Y-m-d');
        $currentTime = now()->format('H:i:s');
        $currentDay = now()->locale('id')->dayName;

        // Map English day to Indonesian
        $dayMap = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];
        $hariIni = $dayMap[$currentDay] ?? $currentDay;

        // Check if there's an active jam kerja for today
        $jamKerja = \App\Models\JamKerja::where('hari', $hariIni)
            ->where('is_active', true)
            ->first();

        if (!$jamKerja) {
            return response()->json([
                'dalam_jam_kerja' => false,
                'sudah_absen' => true,
                'message' => 'Tidak ada jam kerja hari ini'
            ]);
        }

        // Check if already attended today
        $sudahAbsen = \App\Models\Absensi::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->exists();

        // Check if current time is within working hours (with tolerance)
        $jamMasukWithTolerance = date('H:i:s', strtotime($jamKerja->jam_masuk) - ($jamKerja->toleransi_menit * 60));
        $jamKeluarWithTolerance = date('H:i:s', strtotime($jamKerja->jam_keluar) + ($jamKerja->toleransi_menit * 60));

        $dalamJamKerja = $currentTime >= $jamMasukWithTolerance && $currentTime <= $jamKeluarWithTolerance;

        return response()->json([
            'dalam_jam_kerja' => $dalamJamKerja,
            'sudah_absen' => $sudahAbsen,
            'jam_kerja' => $jamKerja,
            'current_time' => $currentTime
        ]);
    }

    /**
     * Store attendance from modal
     */
    public function storeAbsensi(Request $request)
    {
        try {
            $userId = auth()->id();
            $user = auth()->user();
            $today = now()->format('Y-m-d');
            $currentTime = now()->format('H:i:s');
            $currentDay = now()->locale('id')->dayName;

            // Map English day to Indonesian
            $dayMap = [
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
                'Sunday' => 'Minggu',
            ];
            $hariIni = $dayMap[$currentDay] ?? $currentDay;

            // Get active jam kerja for today
            $jamKerja = \App\Models\JamKerja::where('hari', $hariIni)
                ->where('is_active', true)
                ->first();

            if (!$jamKerja) {
                return response()->json([
                    'success' => false,
                    'error' => 'Tidak ada jam kerja aktif untuk hari ini'
                ], 400);
            }

            // Check if already attended today
            $existingAbsensi = \App\Models\Absensi::where('user_id', $userId)
                ->whereDate('tanggal', $today)
                ->first();

            if ($existingAbsensi) {
                return response()->json([
                    'success' => false,
                    'error' => 'Anda sudah melakukan absensi hari ini'
                ], 400);
            }

            // Process and save photo
            $fotoPath = null;
            if ($request->has('foto_selfie')) {
                $fotoBase64 = $request->input('foto_selfie');
                $foto = str_replace('data:image/png;base64,', '', $fotoBase64);
                $foto = str_replace(' ', '+', $foto);
                $fotoData = base64_decode($foto);

                $fileName = 'absensi_' . $userId . '_' . time() . '.png';
                Storage::disk('public')->put('absensi/' . $fileName, $fotoData);
                $fotoPath = 'absensi/' . $fileName;
            }

            // Determine status (tepat waktu, terlambat, etc)
            $jamMasuk = $jamKerja->jam_masuk;
            $toleransi = $jamKerja->toleransi_menit;
            $batasTerlambat = date('H:i:s', strtotime($jamMasuk) + ($toleransi * 60));

            $status = 'hadir';
            $keterangan = 'Tepat waktu';

            if ($currentTime > $batasTerlambat) {
                $status = 'terlambat';
                $keterangan = 'Terlambat';
            }

            // Create absensi record
            $absensi = \App\Models\Absensi::create([
                'user_id' => $userId,
                'jam_kerja_id' => $jamKerja->id,
                'tanggal' => $today,
                'jam_absen' => $currentTime,
                'foto_selfie' => $fotoPath,
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'status' => $status,
                'keterangan' => $keterangan,
            ]);

            // Log activity
            ActivityLogger::logAbsensi('check_in', $user->name);

            return response()->json([
                'success' => true,
                'message' => 'Absensi berhasil! Status: ' . ucfirst($status),
                'data' => $absensi
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
