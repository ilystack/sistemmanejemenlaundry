<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied | Almas Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full flex flex-col items-center justify-center gap-8 text-center">
        <!-- Laundry Art Illustration -->
        <div class="w-48 h-48 md:w-56 md:h-56 relative">
            <svg class="w-full h-full" viewBox="0 0 200 200" fill="none">
                <rect x="30" y="50" width="140" height="130" rx="10" fill="#E5E7EB" stroke="#3B82F6" stroke-width="3" />
                <rect x="30" y="50" width="140" height="25" rx="10" fill="#DBEAFE" />
                <circle cx="150" cy="62" r="3" fill="#EF4444" class="pulse-animation" />
                <circle cx="100" cy="125" r="40" fill="#BFDBFE" stroke="#3B82F6" stroke-width="3" />
                <g transform="translate(85, 110)">
                    <rect x="10" y="15" width="10" height="12" rx="2" fill="#3B82F6" />
                    <path d="M 12 15 L 12 10 Q 12 5 15 5 Q 18 5 18 10 L 18 15" stroke="#3B82F6" stroke-width="2"
                        fill="none" />
                    <circle cx="15" cy="21" r="1.5" fill="white" />
                </g>
                <rect x="70" y="160" width="60" height="15" rx="3" fill="#3B82F6" />
                <text x="100" y="171" font-size="10" fill="white" text-anchor="middle" font-weight="bold">LOCKED</text>
            </svg>
        </div>

        <!-- Error Content -->
        <div class="flex flex-col items-center">
            <!-- Error Code: Extra bold/black and tighter tracking -->
            <h1 class="text-8xl md:text-9xl font-black text-blue-600 mb-2 tracking-tighter drop-shadow-sm">403</h1>

            <!-- Subtitle -->
            <p class="text-xl md:text-2xl font-extrabold text-gray-800 mb-8 uppercase tracking-wide">Access Denied</p>

            <!-- Minimalist Back Button with Arrow -->
            <a href="/"
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