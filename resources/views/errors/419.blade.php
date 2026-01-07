<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Session Expired | Almas Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .rotate-animation {
            animation: rotate 4s linear infinite;
            transform-origin: center;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full flex flex-col items-center justify-center gap-8 text-center">
        <!-- Laundry Art Illustration -->
        <div class="w-48 h-48 md:w-56 md:h-56 relative">
            <svg class="w-full h-full" viewBox="0 0 200 200" fill="none">
                <rect x="40" y="60" width="120" height="120" rx="8" fill="#E5E7EB" stroke="#3B82F6" stroke-width="3" />
                <circle cx="100" cy="130" r="35" fill="#BFDBFE" stroke="#3B82F6" stroke-width="3" />
                <g class="rotate-animation">
                    <circle cx="100" cy="130" r="25" fill="white" stroke="#3B82F6" stroke-width="2" />
                    <line x1="100" y1="130" x2="100" y2="110" stroke="#3B82F6" stroke-width="2"
                        stroke-linecap="round" />
                    <line x1="100" y1="130" x2="115" y2="130" stroke="#60A5FA" stroke-width="2"
                        stroke-linecap="round" />
                </g>
                <rect x="60" y="40" width="80" height="18" rx="4" fill="#3B82F6" />
                <text x="100" y="52" font-size="11" fill="white" text-anchor="middle" font-weight="bold">TIME'S
                    UP</text>
                <g transform="translate(140, 100)">
                    <path d="M 5 0 L 15 0 L 12 8 L 8 8 Z" fill="#3B82F6" />
                    <path d="M 8 8 L 12 8 L 15 16 L 5 16 Z" fill="#93C5FD" />
                    <circle cx="10" cy="12" r="1" fill="#3B82F6" />
                </g>
            </svg>
        </div>

        <!-- Error Content -->
        <div class="flex flex-col items-center">
            <!-- Error Code: Extra bold/black and tighter tracking -->
            <h1 class="text-8xl md:text-9xl font-black text-blue-600 mb-2 tracking-tighter drop-shadow-sm">419</h1>

            <!-- Subtitle -->
            <p class="text-xl md:text-2xl font-extrabold text-gray-800 mb-8 uppercase tracking-wide">Session Expired</p>

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