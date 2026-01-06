<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak | Almas Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes rise {
            0% {
                bottom: -100px;
                transform: translateX(0);
                opacity: 0;
            }

            50% {
                opacity: 0.4;
            }

            100% {
                bottom: 110vh;
                transform: translateX(100px);
                opacity: 0;
            }
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: rise 15s infinite ease-in;
        }

        .bubble:nth-child(1) {
            width: 40px;
            height: 40px;
            left: 10%;
            animation-delay: 0s;
        }

        .bubble:nth-child(2) {
            width: 60px;
            height: 60px;
            left: 20%;
            animation-delay: 2s;
        }

        .bubble:nth-child(3) {
            width: 30px;
            height: 30px;
            left: 35%;
            animation-delay: 4s;
        }

        .bubble:nth-child(4) {
            width: 50px;
            height: 50px;
            left: 50%;
            animation-delay: 0s;
        }

        .bubble:nth-child(5) {
            width: 45px;
            height: 45px;
            left: 65%;
            animation-delay: 3s;
        }

        .bubble:nth-child(6) {
            width: 35px;
            height: 35px;
            left: 80%;
            animation-delay: 5s;
        }

        .bubble:nth-child(7) {
            width: 55px;
            height: 55px;
            left: 90%;
            animation-delay: 1s;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out;
        }

        .animate-spin-slow {
            animation: spin 3s linear infinite;
        }

        .animate-pulse-slow {
            animation: pulse 2s ease-in-out infinite;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 min-h-screen flex items-center justify-center overflow-hidden relative">

    <!-- Animated bubbles background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="relative z-10 text-center px-4 sm:px-6 max-w-2xl w-full">
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-8 sm:p-12 animate-fadeInUp">

            <!-- Washing Machine Icon -->
            <div class="w-40 h-40 mx-auto mb-8 relative">
                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl shadow-lg relative">
                    <!-- Machine Door -->
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-28 h-28 bg-gradient-to-br from-purple-600 to-indigo-700 rounded-full flex items-center justify-center shadow-inner">
                        <!-- Glass Effect -->
                        <div class="w-20 h-20 bg-white/20 rounded-full animate-spin-slow backdrop-blur-sm"></div>
                        <!-- Lock Icon -->
                        <div class="absolute inset-0 flex items-center justify-center animate-pulse-slow">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>
                    <!-- Control Panel -->
                    <div class="absolute top-3 right-3 flex gap-1.5">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Error Code -->
            <div
                class="text-8xl sm:text-9xl font-black bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent mb-6">
                403
            </div>

            <!-- Title -->
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Akses Ditolak
            </h1>

            <!-- Description -->
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Maaf, mesin cuci ini terkunci! Anda tidak memiliki izin untuk mengakses halaman ini.
            </p>

            <!-- Action Button -->
            <a href="/"
                class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>

</body>

</html>