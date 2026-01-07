<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Almas Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-5xl w-full flex flex-col md:flex-row items-center justify-center gap-8 md:gap-20">
        <!-- Laundry Art Illustration -->
        <div class="w-48 h-48 md:w-64 md:h-64 relative">
            <svg class="w-full h-full" viewBox="0 0 200 200" fill="none">
                <!-- Machine Body -->
                <rect x="30" y="40" width="140" height="140" rx="10" fill="#E5E7EB" stroke="#3B82F6" stroke-width="3" />
                <rect x="30" y="40" width="140" height="30" rx="10" fill="#DBEAFE" />
                <circle cx="150" cy="55" r="4" fill="#3B82F6" />
                <circle cx="160" cy="55" r="4" fill="#60A5FA" />
                <circle cx="100" cy="125" r="45" fill="#BFDBFE" stroke="#3B82F6" stroke-width="3" />
                <circle cx="100" cy="125" r="35" fill="#93C5FD" opacity="0.5" />

                <!-- Use 'float-animation' for sock -->
                <g class="float-animation">
                    <path d="M 140 30 Q 145 25 150 30 L 150 50 Q 145 55 140 50 Z" fill="#3B82F6" />
                    <circle cx="145" cy="35" r="3" fill="white" />
                </g>
                <text x="165" y="100" font-size="24" fill="#3B82F6" opacity="0.6">?</text>
            </svg>
        </div>

        <!-- Error Content -->
        <div class="text-center md:text-left">
            <!-- Error Code: Extra bold/black and tighter tracking -->
            <h1 class="text-9xl font-black text-blue-600 mb-2 tracking-tighter drop-shadow-sm">404</h1>

            <!-- Subtitle -->
            <p class="text-2xl font-extrabold text-gray-800 mb-8 uppercase tracking-wide">Page Not Found</p>

            <!-- Minimalist Back Button with Arrow -->
            <a href="javascript:history.back()"
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