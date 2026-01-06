<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Terjadi Kesalahan | Almas Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes rise-steam {
            0% {
                bottom: -50px;
                opacity: 0;
                transform: scale(1);
            }
            20% {
                opacity: 0.5;
            }
            100% {
                bottom: 100vh;
                opacity: 0;
                transform: scale(2);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0) rotate(0deg); }
            25% { transform: translateX(-4px) rotate(-1deg); }
            75% { transform: translateX(4px) rotate(1deg); }
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        @keyframes sparkle {
            0%, 100% { 
                opacity: 0;
                transform: scale(0.8) rotate(0deg);
            }
            50% { 
                opacity: 1;
                transform: scale(1.2) rotate(180deg);
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

        .animate-shake {
            animation: shake 0.5s infinite;
        }

        .animate-blink {
            animation: blink 1s infinite;
        }

        .animate-sparkle {
            animation: sparkle 1.5s infinite;
        }

        .steam {
            position: absolute;
            bottom: -50px;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: rise-steam 8s infinite ease-out;
        }

        .steam:nth-child(1) { left: 15%; animation-delay: 0s; }
        .steam:nth-child(2) { left: 30%; animation-delay: 2s; }
        .steam:nth-child(3) { left: 50%; animation-delay: 1s; }
        .steam:nth-child(4) { left: 70%; animation-delay: 3s; }
        .steam:nth-child(5) { left: 85%; animation-delay: 1.5s; }
    </style>
</head>
<body class="bg-gradient-to-br from-red-600 via-red-700 to-rose-800 min-h-screen flex items-center justify-center overflow-hidden relative">
    
    <!-- Steam particles background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="steam"></div>
        <div class="steam"></div>
        <div class="steam"></div>
        <div class="steam"></div>
        <div class="steam"></div>
    </div>

    <div class="relative z-10 text-center px-4 sm:px-6 max-w-2xl w-full">
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-8 sm:p-12 animate-fadeInUp">
            
            <!-- Broken Washing Machine -->
            <div class="w-48 h-48 mx-auto mb-8 relative">
                <!-- Sparks -->
                <div class="absolute -top-4 -right-4 animate-sparkle">
                    <svg class="w-12 h-12 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 11H1v2h6v-2zm2.17-3.24L7.05 5.64 5.64 7.05l2.12 2.12 1.41-1.41zM13 1h-2v6h2V1zm5.36 6.05l-1.41-1.41-2.12 2.12 1.41 1.41 2.12-2.12zM17 11v2h6v-2h-6zm-5-2c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zm2.83 7.24l2.12 2.12 1.41-1.41-2.12-2.12-1.41 1.41zm-9.19.71l1.41 1.41 2.12-2.12-1.41-1.41-2.12 2.12zM11 23h2v-6h-2v6z"/>
                    </svg>
                </div>

                <!-- Machine Body -->
                <div class="w-44 h-44 mx-auto bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl shadow-lg relative animate-shake">
                    <!-- Warning Light -->
                    <div class="absolute top-3 right-3 w-4 h-4 bg-red-500 rounded-full animate-blink shadow-lg"></div>
                    
                    <!-- Control Panel Lights -->
                    <div class="absolute top-3 left-3 flex gap-1.5">
                        <div class="w-2 h-2 bg-red-500 rounded-full animate-blink"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                    </div>

                    <!-- Machine Display -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-24 bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center shadow-inner">
                        <!-- Error Icon -->
                        <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>

                    <!-- Bottom Panel -->
                    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
                        <div class="w-6 h-6 bg-gray-300 rounded-full"></div>
                        <div class="w-6 h-6 bg-gray-300 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Error Code -->
            <div class="text-8xl sm:text-9xl font-black bg-gradient-to-r from-red-600 to-rose-600 bg-clip-text text-transparent mb-6">
                500
            </div>

            <!-- Title -->
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Mesin Mengalami Gangguan
            </h1>

            <!-- Description -->
            <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                Ups! Sepertinya mesin cuci kami mengalami masalah teknis. Tim kami sedang memperbaikinya.
            </p>

            <!-- Info Box -->
            <div class="bg-amber-50 border-l-4 border-amber-500 rounded-lg p-4 mb-8 text-left">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                    <div>
                        <p class="font-semibold text-amber-900 mb-1">Saran untuk Anda:</p>
                        <p class="text-sm text-amber-800">Coba refresh halaman atau kembali beberapa saat lagi. Jika masalah berlanjut, hubungi tim support kami.</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="javascript:location.reload()" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-red-600 to-rose-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Refresh Halaman
                </a>
                <a href="/" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gray-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

</body>
</html>