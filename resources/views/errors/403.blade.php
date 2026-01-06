<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif; background-color: #fffafa;"
    class="min-h-screen flex items-center justify-center p-4">

    <div class="text-center max-w-md">
        <div class="mb-8">
            <svg class="w-32 h-32 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <h1 class="text-6xl font-bold text-gray-900 mb-4">403</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Akses Ditolak</h2>
        <p class="text-gray-600 mb-8">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}
        </p>

        <div class="space-y-3">
            <a href="javascript:history.back()"
                class="inline-block px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                ← Kembali
            </a>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 ml-2">
                        Dashboard Admin
                    </a>
                @elseif(auth()->user()->role === 'karyawan')
                    <a href="{{ route('karyawan.dashboard') }}"
                        class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 ml-2">
                        Dashboard Karyawan
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 ml-2">
                        Dashboard
                    </a>
                @endif
            @else
                <a href="{{ route('login.choice') }}"
                    class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 ml-2">
                    Login
                </a>
            @endauth
        </div>
    </div>

</body>

</html>