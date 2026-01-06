<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Log an activity
     *
     * @param string $type Type of activity (order, customer, karyawan, login, etc)
     * @param string $description Description of the activity
     * @param string $icon Icon emoji for the activity
     * @param string $color Color theme (blue, green, purple, amber, red)
     * @return void
     */
    public static function log(string $type, string $description, string $icon = '📝', string $color = 'blue'): void
    {
        ActivityLog::create([
            'type' => $type,
            'description' => $description,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()?->name ?? 'System',
            'icon' => $icon,
            'color' => $color,
        ]);
    }

    /**
     * Log order activity
     */
    public static function logOrder(string $action, string $orderNumber): void
    {
        $icons = [
            'created' => '🛒',
            'updated' => '✏️',
            'deleted' => '🗑️',
            'completed' => '✅',
            'cancelled' => '❌',
        ];

        $colors = [
            'created' => 'blue',
            'updated' => 'amber',
            'deleted' => 'red',
            'completed' => 'green',
            'cancelled' => 'red',
        ];

        $descriptions = [
            'created' => "Order baru dibuat: {$orderNumber}",
            'updated' => "Order diperbarui: {$orderNumber}",
            'deleted' => "Order dihapus: {$orderNumber}",
            'completed' => "Order selesai: {$orderNumber}",
            'cancelled' => "Order dibatalkan: {$orderNumber}",
        ];

        self::log(
            'order',
            $descriptions[$action] ?? "Order {$action}: {$orderNumber}",
            $icons[$action] ?? '📦',
            $colors[$action] ?? 'blue'
        );
    }

    /**
     * Log customer activity
     */
    public static function logCustomer(string $action, string $customerName): void
    {
        $icons = [
            'created' => '👤',
            'updated' => '✏️',
            'deleted' => '🗑️',
        ];

        $colors = [
            'created' => 'green',
            'updated' => 'amber',
            'deleted' => 'red',
        ];

        $descriptions = [
            'created' => "Customer baru ditambahkan: {$customerName}",
            'updated' => "Data customer diperbarui: {$customerName}",
            'deleted' => "Customer dihapus: {$customerName}",
        ];

        self::log(
            'customer',
            $descriptions[$action] ?? "Customer {$action}: {$customerName}",
            $icons[$action] ?? '👤',
            $colors[$action] ?? 'blue'
        );
    }

    /**
     * Log karyawan activity
     */
    public static function logKaryawan(string $action, string $karyawanName): void
    {
        $icons = [
            'created' => '👨‍💼',
            'updated' => '✏️',
            'deleted' => '🗑️',
        ];

        $colors = [
            'created' => 'green',
            'updated' => 'amber',
            'deleted' => 'red',
        ];

        $descriptions = [
            'created' => "Karyawan baru ditambahkan: {$karyawanName}",
            'updated' => "Data karyawan diperbarui: {$karyawanName}",
            'deleted' => "Karyawan dihapus: {$karyawanName}",
        ];

        self::log(
            'karyawan',
            $descriptions[$action] ?? "Karyawan {$action}: {$karyawanName}",
            $icons[$action] ?? '👨‍💼',
            $colors[$action] ?? 'blue'
        );
    }

    /**
     * Log authentication activity
     */
    public static function logAuth(string $action, string $userName = null): void
    {
        $icons = [
            'login' => '🔐',
            'logout' => '🚪',
            'register' => '📝',
        ];

        $colors = [
            'login' => 'green',
            'logout' => 'amber',
            'register' => 'blue',
        ];

        $name = $userName ?? Auth::user()?->name ?? 'User';

        $descriptions = [
            'login' => "{$name} login ke sistem",
            'logout' => "{$name} logout dari sistem",
            'register' => "{$name} mendaftar sebagai customer baru",
        ];

        self::log(
            'auth',
            $descriptions[$action] ?? "{$name} {$action}",
            $icons[$action] ?? '🔐',
            $colors[$action] ?? 'blue'
        );
    }

    /**
     * Log absensi activity
     */
    public static function logAbsensi(string $action, string $karyawanName): void
    {
        $icons = [
            'check_in' => '✅',
            'check_out' => '🚪',
        ];

        $descriptions = [
            'check_in' => "{$karyawanName} melakukan absensi masuk",
            'check_out' => "{$karyawanName} melakukan absensi keluar",
        ];

        self::log(
            'absensi',
            $descriptions[$action] ?? "{$karyawanName} absensi {$action}",
            $icons[$action] ?? '📸',
            'purple'
        );
    }

    /**
     * Log paket activity
     */
    public static function logPaket(string $action, string $paketName): void
    {
        $icons = [
            'created' => '📦',
            'updated' => '✏️',
            'deleted' => '🗑️',
        ];

        $colors = [
            'created' => 'green',
            'updated' => 'amber',
            'deleted' => 'red',
        ];

        $descriptions = [
            'created' => "Paket baru ditambahkan: {$paketName}",
            'updated' => "Paket diperbarui: {$paketName}",
            'deleted' => "Paket dihapus: {$paketName}",
        ];

        self::log(
            'paket',
            $descriptions[$action] ?? "Paket {$action}: {$paketName}",
            $icons[$action] ?? '📦',
            $colors[$action] ?? 'blue'
        );
    }
}
