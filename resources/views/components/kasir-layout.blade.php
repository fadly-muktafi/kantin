@props(['header'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Kasir - {{ config('app.name', 'Kantin Sekolah') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 dark:bg-slate-900">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-white shadow-xl">
                <div class="flex flex-col h-full">
                    <div class="flex items-center justify-center h-16 bg-slate-900 border-b border-slate-700">
                        <x-application-logo class="h-10 w-auto" />
                    </div>                    <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
                        <a href="{{ route('kasir.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('kasir.dashboard') ? 'bg-gradient-to-r from-primary-600 to-amber-500 text-white shadow-lg' : 'hover:bg-slate-700/50 text-slate-200' }} transition-all duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('kasir.transactions.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('kasir.transactions.*') ? 'bg-gradient-to-r from-primary-600 to-amber-500 text-white shadow-lg' : 'hover:bg-slate-700/50 text-slate-200' }} transition-all duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Transaksi
                        </a>
                        <a href="{{ route('kasir.reports.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('kasir.reports.*') ? 'bg-gradient-to-r from-primary-600 to-amber-500 text-white shadow-lg' : 'hover:bg-slate-700/50 text-slate-200' }} transition-all duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Laporan
                        </a>
                    </nav>
                    @php
                        $kasirUser = Auth::user();
                        $nameSegments = collect(explode(' ', trim($kasirUser->name)));
                        $initials = $nameSegments->filter()->map(fn ($segment) => mb_substr($segment, 0, 1))->take(2)->implode('');
                    @endphp
                    <div class="p-4 border-t border-slate-700 bg-slate-900/70 backdrop-blur">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-primary-500 to-amber-500 flex items-center justify-center text-white font-semibold uppercase">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $kasirUser->name }}</p>
                                    <p class="text-xs text-slate-300 flex items-center gap-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-white/10 text-[11px] tracking-wide uppercase">{{ $kasirUser->role }}</span>
                                        <span class="text-slate-400">Kasir Area</span>
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center gap-2">
                                <a href="{{ route('profile.edit') }}" class="flex-1 text-center text-sm font-medium text-white/90 bg-white/10 hover:bg-white/20 rounded-xl py-2 transition-colors">
                                    Profil
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full text-center text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-amber-500 hover:from-primary-700 hover:to-amber-600 rounded-xl py-2 transition-colors">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="ml-64 flex-1 flex flex-col">
                <!-- Top Bar -->
                <header class="bg-white dark:bg-slate-800 shadow-sm sticky top-0 z-10 border-b border-gray-200 dark:border-slate-700">
                    <div class="px-6 py-4">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $header ?? 'Kasir Dashboard' }}</h2>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-6 bg-gray-50 dark:bg-slate-900">
                    @if(session('success'))
                        <div class="mb-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl shadow-sm" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl shadow-sm" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
