<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityLog;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'type' => 'auth',
                'description' => 'Admin login ke sistem',
                'user_id' => 1,
                'user_name' => 'Admin',
                'icon' => '🔐',
                'color' => 'green',
                'created_at' => now()->subMinutes(5),
            ],
            [
                'type' => 'jam_kerja',
                'description' => 'Shift baru ditambahkan: Pagi (Senin)',
                'user_id' => 1,
                'user_name' => 'Admin',
                'icon' => '⏰',
                'color' => 'green',
                'created_at' => now()->subMinutes(10),
            ],
            [
                'type' => 'jam_kerja',
                'description' => 'Shift baru ditambahkan: Pagi (Selasa)',
                'user_id' => 1,
                'user_name' => 'Admin',
                'icon' => '⏰',
                'color' => 'green',
                'created_at' => now()->subMinutes(11),
            ],
            [
                'type' => 'jam_kerja',
                'description' => 'Shift baru ditambahkan: Pagi (Rabu)',
                'user_id' => 1,
                'user_name' => 'Admin',
                'icon' => '⏰',
                'color' => 'green',
                'created_at' => now()->subMinutes(12),
            ],
        ];

        foreach ($activities as $activity) {
            ActivityLog::create($activity);
        }
    }
}
