<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JamKerja;

class JamKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        foreach ($days as $day) {
            JamKerja::updateOrCreate(
                ['hari' => $day],
                [
                    'nama' => 'Pagi',
                    'jam_masuk' => '07:00:00',
                    'jam_keluar' => '16:00:00',
                    'toleransi_menit' => 15,
                    'is_active' => true,
                ]
            );
        }
    }
}
