<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Activity Tracker') }}</title>

    {{-- Prevent dark-mode flash --}}
    <script>
        (function () {
            const t = localStorage.getItem('theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased">
    <div class="min-h-full flex">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col min-w-0">
            @include('layouts.topbar')

            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 animate-fade-in-up">
                @include('partials.flash')
                {{ $slot }}
            </main>

            <footer class="px-6 py-4 text-xs text-slate-400 dark:text-slate-600 text-center">
                Activity Tracker · {{ now()->year }} · Built with Laravel
            </footer>
        </div>
    </div>

    {{-- Toast container --}}
    <div id="toast-root" class="fixed bottom-6 right-6 z-[100] flex flex-col gap-3"></div>

    {{-- Dark mode toggle + toast helper --}}
    <script>
        // Dark mode
        function toggleTheme() {
            const root = document.documentElement;
            const isDark = root.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Toast helper — used across pages
        window.showToast = function (message, type = 'success') {
            const root = document.getElementById('toast-root');
            const colors = {
                success: 'from-emerald-500 to-green-600',
                error:   'from-rose-500 to-red-600',
                info:    'from-violet-500 to-fuchsia-600',
            };
            const icons = {
                success: 'M5 13l4 4L19 7',
                error:   'M6 18L18 6M6 6l12 12',
                info:    'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            };
            const el = document.createElement('div');
            el.className = `bg-gradient-to-r ${colors[type]} text-white px-4 py-3 rounded-xl shadow-lg
                            flex items-center gap-3 animate-slide-in-right min-w-[260px]`;
            el.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${icons[type]}" />
                </svg>
                <span class="text-sm font-medium">${message}</span>
            `;
            root.appendChild(el);
            setTimeout(() => {
                el.style.transition = 'opacity .3s, transform .3s';
                el.style.opacity = '0';
                el.style.transform = 'translateX(24px)';
                setTimeout(() => el.remove(), 300);
            }, 3200);
        };

        // Auto-show session flash as toast
        @if(session('success'))
            window.addEventListener('DOMContentLoaded', () => showToast(@js(session('success')), 'success'));
        @endif
        @if(session('error'))
            window.addEventListener('DOMContentLoaded', () => showToast(@js(session('error')), 'error'));
        @endif
    </script>

    @stack('scripts')
</body>
</html>