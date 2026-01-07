<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Service Unavailable | Almas Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        .spin-animation {
            animation: spin 3s linear infinite;
            transform-origin: center;
        }

        .blink-animation {
            animation: blink 1.5s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-5xl w-full flex flex-col md:flex-row items-center justify-center gap-8 md:gap-20">
        <!-- Laundry Art Illustration -->
        <div class="w-48 h-48 md:w-64 md:h-64 relative">
            <svg class="w-full h-full" viewBox="0 0 200 200" fill="none">
                <rect x="30" y="50" width="140" height="130" rx="10" fill="#E5E7EB" stroke="#3B82F6" stroke-width="3" />
                <rect x="30" y="50" width="140" height="25" rx="10" fill="#DBEAFE" />
                <circle cx="150" cy="62" r="3" fill="#F59E0B" class="blink-animation" />
                <circle cx="100" cy="125" r="40" fill="#BFDBFE" stroke="#3B82F6" stroke-width="3" />
                <g class="spin-animation" transform="translate(85, 110)">
                    <path d="M 20 10 L 25 5 L 27 7 L 22 12 L 18 16 L 10 24 L 6 20 L 14 12 Z" fill="#3B82F6" />
                    <circle cx="8" cy="22" r="3" fill="#60A5FA" />
                </g>
                <rect x="55" y="160" width="90" height="18" rx="4" fill="#F59E0B" />
                <text x="100" y="172" font-size="10" fill="white" text-anchor="middle"
                    font-weight="bold">MAINTENANCE</text>
                <g transform="translate(140, 90)">
                    <rect x="0" y="0" width="3" height="20" fill="#3B82F6" />
                    <circle cx="1.5" cy="22" r="2" fill="#60A5FA" />
                </g>
            </svg>
        </div>

        <!-- Error Content -->
        <div class="text-center md:text-left">
            <!-- Error Code: Extra bold/black and tighter tracking -->
            <h1 class="text-9xl font-black text-blue-600 mb-2 tracking-tighter drop-shadow-sm">503</h1>

            <!-- Subtitle -->
            <p class="text-2xl font-extrabold text-gray-800 mb-8 uppercase tracking-wide">Service Unavailable</p>

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