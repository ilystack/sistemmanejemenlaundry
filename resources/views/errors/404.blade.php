<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Almas Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
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

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-bounce-slow {
            animation: bounce 2s ease-in-out infinite;
        }

        .cloth-float {
            animation: float 4s ease-in-out infinite;
        }

        .cloth-float:nth-child(1) {
            animation-delay: 0s;
        }

        .cloth-float:nth-child(2) {
            animation-delay: 0.5s;
        }

        .cloth-float:nth-child(3) {
            animation-delay: 1s;
        }

        .cloth-float:nth-child(4) {
            animation-delay: 1.5s;
        }

        .cloth-float:nth-child(5) {
            animation-delay: 2s;
        }

        .cloth-float:nth-child(6) {
            animation-delay: 2.5s;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 min-h-screen flex items-center justify-center overflow-hidden relative">

    <!-- Floating clothes icons background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-10">
        <svg class="cloth-float absolute top-20 left-10 w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M16 21v-2l-8-5V3.5c0-.83.67-1.5 1.5-1.5S11 2.67 11 3.5V11h2V3.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V14l-8 5v2h16v-2h-8z" />
        </svg>
        <svg class="cloth-float absolute top-40 left-1/4 w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M21.6 18.2L13 11.75v-.91c1.65-.49 2.8-2.17 2.43-4.05-.26-1.31-1.3-2.4-2.61-2.7C10.54 3.57 8.5 5.3 8.5 7.5h2c0-1.1.9-2 2-2s2 .9 2 2c0 1.1-.9 2-2 2h-.5v7.68l-9.21 6.52c-.77.54-.77 1.8 0 2.34.39.27.9.27 1.28 0L12 20.5l8.93 5.54c.38.27.89.27 1.28 0 .76-.54.76-1.8-.01-2.34z" />
        </svg>
        <svg class="cloth-float absolute top-10 right-1/4 w-14 h-14 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M22 7h-9v2h9V7zm0 8h-9v2h9v-2zM5.5 4.5C5.5 3.12 6.62 2 8 2s2.5 1.12 2.5 2.5S9.38 7 8 7 5.5 5.88 5.5 4.5zM7.5 22v-7H9v7h2v-7.5c0-1.1-.9-2-2-2h-2c-1.1 0-2 .9-2 2V22h2z" />
        </svg>
        <svg class="cloth-float absolute top-60 right-10 w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M16 21v-2l-8-5V3.5c0-.83.67-1.5 1.5-1.5S11 2.67 11 3.5V11h2V3.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V14l-8 5v2h16v-2h-8z" />
        </svg>
        <svg class="cloth-float absolute bottom-20 left-1/3 w-16 h-16 text-white" fill="currentColor"
            viewBox="0 0 24 24">
            <path
                d="M21.6 18.2L13 11.75v-.91c1.65-.49 2.8-2.17 2.43-4.05-.26-1.31-1.3-2.4-2.61-2.7C10.54 3.57 8.5 5.3 8.5 7.5h2c0-1.1.9-2 2-2s2 .9 2 2c0 1.1-.9 2-2 2h-.5v7.68l-9.21 6.52c-.77.54-.77 1.8 0 2.34.39.27.9.27 1.28 0L12 20.5l8.93 5.54c.38.27.89.27 1.28 0 .76-.54.76-1.8-.01-2.34z" />
        </svg>
        <svg class="cloth-float absolute bottom-40 right-1/3 w-14 h-14 text-white" fill="currentColor"
            viewBox="0 0 24 24">
            <path
                d="M5.5 4.5C5.5 3.12 6.62 2 8 2s2.5 1.12 2.5 2.5S9.38 7 8 7 5.5 5.88 5.5 4.5zM7.5 22v-7H9v7h2v-7.5c0-1.1-.9-2-2-2h-2c-1.1 0-2 .9-2 2V22h2z" />
        </svg>
    </div>

    <div class="relative z-10 text-center px-4 sm:px-6 max-w-2xl w-full">
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-8 sm:p-12 animate-fadeInUp">

            <!-- Laundry Basket with Missing Sock -->
            <div class="w-48 h-48 mx-auto mb-8 relative">
                <!-- Missing Sock (bouncing) -->
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 animate-bounce-slow">
                    <svg class="w-20 h-20 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7.5 2C5.57 2 4 3.57 4 5.5V20c0 1.1.9 2 2 2h2c1.1 0 2-.9 2-2V5.5C10 3.57 8.43 2 6.5 2h-1zm0 2h1c.83 0 1.5.67 1.5 1.5V6H6v-.5C6 4.67 6.67 4 7.5 4z" />
                    </svg>
                </div>

                <!-- Question Marks -->
                <div class="absolute -top-2 right-8 text-4xl text-blue-600 opacity-60 animate-pulse">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" />
                    </svg>
                </div>

                <!-- Laundry Basket -->
                <div class="w-40 h-32 mx-auto mt-12 relative">
                    <div
                        class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 rounded-2xl rounded-t-lg shadow-lg relative overflow-hidden">
                        <!-- Basket holes pattern -->
                        <div class="absolute inset-0 grid grid-cols-4 gap-2 p-4">
                            <div class="w-full h-full bg-gray-400 rounded-full"></div>
                            <div class="w-full h-full bg-gray-400 rounded-full"></div>
                            <div class="w-full h-full bg-gray-400 rounded-full"></div>
                            <div class="w-full h-full bg-gray-400 rounded-full"></div>
                            <div class="w-full h-full bg-gray-400 rounded-full"></div>
                            <div class="w-full h-full bg-gray-400 rounded-full"></div>
                            <div class="w-full h-full bg-gray-400 rounded-full"></div>
                            <div class="w-full h-full bg-gray-400 rounded-full"></div>
                        </div>
                        <!-- Basket rim -->
                        <div
                            class="absolute -top-2 left-0 right-0 h-4 bg-gradient-to-b from-gray-300 to-gray-400 rounded-t-lg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Code -->
            <div
                class="text-8xl sm:text-9xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-6">
                404
            </div>

            <!-- Title -->
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Halaman Hilang!
            </h1>

            <!-- Description -->
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Seperti kaos kaki yang hilang di mesin cuci, halaman yang Anda cari tidak dapat ditemukan.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/"
                    class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Kembali ke Beranda
                </a>
                <a href="javascript:history.back()"
                    class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gray-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Halaman Sebelumnya
                </a>
            </div>
        </div>
    </div>

</body>

</html>