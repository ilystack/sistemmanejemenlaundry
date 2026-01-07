<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error | Almas Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-3px);
            }

            75% {
                transform: translateX(3px);
            }
        }

        @keyframes drip {
            0% {
                transform: translateY(0);
                opacity: 1;
            }

            100% {
                transform: translateY(20px);
                opacity: 0;
            }
        }

        .shake-animation {
            animation: shake 0.5s ease-in-out infinite;
        }

        .drip-animation {
            animation: drip 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-5xl w-full flex flex-col md:flex-row items-center justify-center gap-8 md:gap-20">
        <!-- Laundry Art Illustration -->
        <div class="w-48 h-48 md:w-64 md:h-64 relative">
            <svg class="w-full h-full shake-animation" viewBox="0 0 200 200" fill="none">
                <rect x="30" y="50" width="140" height="130" rx="10" fill="#E5E7EB" stroke="#3B82F6" stroke-width="3" />
                <rect x="30" y="50" width="140" height="25" rx="10" fill="#DBEAFE" />
                <circle cx="150" cy="62" r="3" fill="#EF4444" />
                <circle cx="160" cy="62" r="3" fill="#EF4444" />
                <circle cx="100" cy="125" r="40" fill="#BFDBFE" stroke="#3B82F6" stroke-width="3" />
                <path d="M 80 105 L 120 145" stroke="#3B82F6" stroke-width="2" stroke-dasharray="5,5" />
                <path d="M 90 95 L 110 155" stroke="#3B82F6" stroke-width="2" stroke-dasharray="5,5" />
                <g transform="translate(85, 110)">
                    <path d="M 15 5 L 25 20 L 5 20 Z" fill="#EF4444" />
                    <text x="15" y="18" font-size="10" fill="white" text-anchor="middle" font-weight="bold">!</text>
                </g>
                <g class="drip-animation">
                    <circle cx="90" cy="170" r="2" fill="#3B82F6" opacity="0.6" />
                    <circle cx="110" cy="175" r="2" fill="#3B82F6" opacity="0.6" />
                </g>
            </svg>
        </div>

        <!-- Error Content -->
        <div class="text-center md:text-left">
            <!-- Error Code: Extra bold/black and tighter tracking -->
            <h1 class="text-9xl font-black text-blue-600 mb-2 tracking-tighter drop-shadow-sm">500</h1>

            <!-- Subtitle -->
            <p class="text-2xl font-extrabold text-gray-800 mb-8 uppercase tracking-wide">Server Error</p>

            <!-- Minimalist Back Button with Arrow -->
            <a href="javascript:location.reload()"
                class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-bold text-lg group transition-colors">
                <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

</body>

</html>