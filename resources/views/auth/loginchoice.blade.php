<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/icon.png') }}">
    <title>Pilih Login - Almas Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.11/dist/dotlottie-wc.js" type="module"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .role-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .role-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 197, 253, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .role-card:hover::before {
            opacity: 1;
        }

        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .role-card:active {
            transform: translateY(-4px);
        }

        .icon-wrapper {
            transition: transform 0.3s ease;
        }

        .role-card:hover .icon-wrapper {
            transform: scale(1.1);
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
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
            opacity: 0;
        }

        .delay-200 {
            animation-delay: 0.2s;
            opacity: 0;
        }

        .delay-300 {
            animation-delay: 0.3s;
            opacity: 0;
        }

        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #loadingOverlay.show {
            display: flex;
            opacity: 1;
        }

        #loadingOverlay dotlottie-wc {
            width: 200px;
            height: 200px;
        }

        @media (max-width: 640px) {
            #loadingOverlay dotlottie-wc {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-b from-blue-50 to-white min-h-screen flex items-center justify-center p-4 sm:p-6"
    x-data="{ showInfoModal: false }">

    <!-- Info Button -->
    <button @click="showInfoModal = true"
        class="fixed top-4 right-4 z-50 bg-white/80 backdrop-blur-sm p-2 rounded-full shadow-lg hover:bg-white hover:scale-110 transition-all duration-300 group">
        <div class="relative">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span
                class="absolute right-full mr-2 top-1/2 -translate-y-1/2 px-2 py-1 bg-gray-900 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                Info Akun Demo
            </span>
        </div>
    </button>

    <div class="w-full max-w-4xl">
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl p-6 sm:p-8 md:p-12">
            <div class="text-center mb-8 sm:mb-12 animate-fadeInUp">
                <h1 class="text-2xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-3 sm:mb-4">
                    LOGIN SEBAGAI...
                </h1>
                <br>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                <a href="{{ route('login.admin') }}"
                    class="role-card bg-white border-2 border-gray-300 rounded-xl sm:rounded-2xl p-6 sm:p-8 flex flex-col items-center justify-center text-center hover:border-blue-500 cursor-pointer animate-fadeInUp">
                    <div
                        class="icon-wrapper w-16 h-16 sm:w-20 sm:h-20 bg-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-blue-600 uppercase tracking-wide">ADMIN</h3>
                </a>

                <a href="{{ route('login.customer') }}"
                    class="role-card bg-white border-2 border-gray-300 rounded-xl sm:rounded-2xl p-6 sm:p-8 flex flex-col items-center justify-center text-center hover:border-blue-500 cursor-pointer animate-fadeInUp">
                    <div
                        class="icon-wrapper w-16 h-16 sm:w-20 sm:h-20 bg-white border-2 border-gray-300 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gray-700" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-700 uppercase tracking-wide">CUSTOMER</h3>
                </a>

                <a href="{{ route('login.karyawan') }}"
                    class="role-card bg-white border-2 border-gray-300 rounded-xl sm:rounded-2xl p-6 sm:p-8 flex flex-col items-center justify-center text-center hover:border-blue-500 cursor-pointer animate-fadeInUp">
                    <div
                        class="icon-wrapper w-16 h-16 sm:w-20 sm:h-20 bg-gray-300 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gray-700" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-600 uppercase tracking-wide">KARYAWAN</h3>
                </a>
            </div>

            <div class="mt-8 sm:mt-12 text-center animate-fadeInUp delay-300">
                <p class="text-gray-600 font-medium">
                    Anda Customer?
                    <a href="{{ route('register') }}"
                        class="text-blue-600 hover:text-blue-700 font-bold hover:underline transition ml-1">
                        Klik untuk daftar
                    </a>
                </p>
            </div>
        </div>

        <div class="mt-8 text-center animate-fadeInUp delay-300">
            <a href="/"
                class="inline-flex items-center text-blue-700 hover:text-blue-900 font-semibold transition bg-white/60 px-6 py-3 rounded-full hover:bg-white/90 backdrop-blur-sm shadow-sm hover:shadow-md hover:scale-105 transform duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Home
            </a>
        </div>
    </div>

    <!-- Info Modal -->
    <div x-show="showInfoModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <!-- Backdrop -->
        <div x-show="showInfoModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" @click="showInfoModal = false">
        </div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="showInfoModal" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Akun Demo Responden
                    </h3>
                    <button @click="showInfoModal = false" class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-6">
                    <p class="text-gray-600 mb-4 text-sm">
                        Silakan gunakan akun berikut untuk akses sistem:
                    </p>

                    <div class="space-y-4">
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="bg-blue-600 text-white text-xs font-bold px-2 py-0.5 rounded uppercase">Admin</span>
                                <span class="text-sm text-gray-500">(Pemilik Laundry)</span>
                            </div>
                            <div class="grid grid-cols-[60px_1fr] gap-2 text-sm">
                                <span class="text-gray-500">Email:</span>
                                <span class="font-mono font-medium text-gray-900 select-all">admin@mail.com</span>
                                <span class="text-gray-500">Pass:</span>
                                <span class="font-mono font-medium text-gray-900 select-all">password</span>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="bg-gray-600 text-white text-xs font-bold px-2 py-0.5 rounded uppercase">Karyawan</span>
                                <span class="text-sm text-gray-500">(Operasional Harian)</span>
                            </div>
                            <div class="grid grid-cols-[60px_1fr] gap-2 text-sm">
                                <span class="text-gray-500">Email:</span>
                                <span class="font-mono font-medium text-gray-900 select-all">karyawan@mail.com</span>
                                <span class="text-gray-500">Pass:</span>
                                <span class="font-mono font-medium text-gray-900 select-all">password</span>
                            </div>
                        </div>

                        <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="bg-green-600 text-white text-xs font-bold px-2 py-0.5 rounded uppercase">Customer</span>
                                <span class="text-sm text-gray-500">(Pelanggan)</span>
                            </div>
                            <div class="grid grid-cols-[60px_1fr] gap-2 text-sm">
                                <span class="text-gray-500">Email:</span>
                                <span class="font-mono font-medium text-gray-900 select-all">customer@mail.com</span>
                                <span class="text-gray-500">Pass:</span>
                                <span class="font-mono font-medium text-gray-900 select-all">password</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <button @click="showInfoModal = false"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-lg transition-colors w-full sm:w-auto">
                            Tutup Info
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay">
        <dotlottie-wc src="https://lottie.host/4d0dfcd1-a0f2-4333-9db3-3a0e8a0383c6/hk6aLPbhTy.lottie" autoplay loop>
        </dotlottie-wc>
    </div>

    <script>
        (function () {
            const overlay = document.getElementById('loadingOverlay');
            const navigationType = performance.getEntriesByType('navigation')[0]?.type;
            const isForwardNav = sessionStorage.getItem('isForwardNavigation') === 'true';

            if (navigationType === 'back_forward' && !isForwardNav) {
                if (overlay) {
                    overlay.classList.remove('show');
                    overlay.style.display = 'none';
                }
            }
            sessionStorage.removeItem('isForwardNavigation');
        })();

        function showLoading() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.style.display = '';
                overlay.classList.add('show');
            }
        }

        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.classList.remove('show');
            }
        }

        // Hide loading immediately if this is a back/forward navigation
        (function () {
            const navigationType = performance.getEntriesByType('navigation')[0]?.type;
            const isForwardNav = sessionStorage.getItem('isForwardNavigation') === 'true';

            if (navigationType === 'back_forward' && !isForwardNav) {
                hideLoading();
            }

            sessionStorage.removeItem('isForwardNavigation');
        })();

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.role-card').forEach(card => {
                card.addEventListener('click', function (e) {
                    e.preventDefault();
                    sessionStorage.setItem('isForwardNavigation', 'true');
                    showLoading();
                    setTimeout(() => {
                        window.location.href = this.getAttribute('href');
                    }, 100);
                });
            });
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                hideLoading();
                sessionStorage.removeItem('isForwardNavigation');
            }
        });

        window.addEventListener('popstate', function () {
            hideLoading();
            sessionStorage.removeItem('isForwardNavigation');
        });
    </script>
</body>

</html>