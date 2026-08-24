<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Planify') }}</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-gray-900 antialiased">

    {{-- Navbar --}}
    {{-- Skip to main content: klavye ve ekran okuyucu kullanıcıları için --}}
    <a href="#main-content"
       class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:px-4 focus:py-2 focus:bg-[#ff5528] focus:text-white focus:rounded-lg focus:font-bold focus:text-sm">
        Ana içeriğe geç
    </a>

    <nav aria-label="Ana gezinme" class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}"
                   aria-label="Planify — Ana sayfaya git"
                   class="text-2xl font-black tracking-tight text-[#1a1a1a]">
                    Plan<span class="text-[#ff5528]" aria-hidden="true">ify</span>
                </a>

                {{-- Masaüstü Menü --}}
                <ul role="list" class="hidden md:flex items-center gap-8 list-none m-0 p-0">
                    <li>
                        <a href="{{ route('home') }}"
                           aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}"
                           class="text-sm font-bold uppercase tracking-widest transition-colors
                                  {{ request()->routeIs('home') ? 'text-[#ff5528]' : 'text-gray-600 hover:text-[#ff5528]' }}">
                            Ana Sayfa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('etkinlikler.index') }}"
                           aria-current="{{ request()->routeIs('etkinlikler.*') ? 'page' : 'false' }}"
                           class="text-sm font-bold uppercase tracking-widest transition-colors
                                  {{ request()->routeIs('etkinlikler.*') ? 'text-[#ff5528]' : 'text-gray-600 hover:text-[#ff5528]' }}">
                            Etkinlikler
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                           aria-current="{{ request()->routeIs('contact') ? 'page' : 'false' }}"
                           class="text-sm font-bold uppercase tracking-widest transition-colors
                                  {{ request()->routeIs('contact') ? 'text-[#ff5528]' : 'text-gray-600 hover:text-[#ff5528]' }}">
                            İletişim
                        </a>
                    </li>
                </ul>

                {{-- Auth Alanı --}}
                <div class="flex items-center gap-4">
                    @auth
                        @if(auth()->user()->is_admin || auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                               class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 bg-gray-900 text-white text-xs font-black uppercase tracking-wider rounded-lg hover:bg-[#ff5528] transition-colors shadow-sm">
                                ⚙️ Yönetim Paneli
                            </a>
                        @endif

                        <a href="{{ route('etkinlikler.create') }}"
                           class="px-5 py-2 bg-[#ff5528] text-white text-xs font-black uppercase tracking-widest rounded-lg hover:bg-black transition-colors focus:outline-none focus:ring-2 focus:ring-[#ff5528] focus:ring-offset-2">
                            <span aria-hidden="true">+</span> Plan Ekle
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    aria-label="Hesaptan çıkış yap"
                                    class="text-sm font-bold text-gray-500 hover:text-[#ff5528] transition-colors focus:outline-none focus:ring-2 focus:ring-[#ff5528] focus:ring-offset-2 rounded">
                                Çıkış
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-sm font-bold text-gray-600 hover:text-[#ff5528] transition-colors focus:outline-none focus:ring-2 focus:ring-[#ff5528] focus:ring-offset-2 rounded px-2 py-1">
                            Giriş
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-5 py-2 bg-[#ff5528] text-white text-xs font-black uppercase tracking-widest rounded-lg hover:bg-black transition-colors focus:outline-none focus:ring-2 focus:ring-[#ff5528] focus:ring-offset-2">
                            Kayıt Ol
                        </a>
                    @endauth

                    {{-- Mobil Menü Butonu --}}
                    <button type="button"
                            id="mobile-menu-btn"
                            aria-controls="mobile-menu"
                            aria-expanded="false"
                            aria-label="Gezinme menüsünü aç"
                            class="md:hidden flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:text-[#ff5528] hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-[#ff5528]">
                        <svg aria-hidden="true" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="menu-icon-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path id="menu-icon-close" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" class="hidden"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        {{-- Mobil Menü --}}
        <div id="mobile-menu"
             role="region"
             aria-label="Mobil gezinme menüsü"
             class="hidden md:hidden border-t border-gray-100 bg-white">
            <ul role="list" class="list-none m-0 p-0 px-6 py-4 space-y-1">
                <li>
                    <a href="{{ route('home') }}"
                       aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}"
                       class="block px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-widest transition-colors
                              {{ request()->routeIs('home') ? 'bg-[#ff5528]/10 text-[#ff5528]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#ff5528]' }}">
                        Ana Sayfa
                    </a>
                </li>
                <li>
                    <a href="{{ route('etkinlikler.index') }}"
                       aria-current="{{ request()->routeIs('etkinlikler.*') ? 'page' : 'false' }}"
                       class="block px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-widest transition-colors
                              {{ request()->routeIs('etkinlikler.*') ? 'bg-[#ff5528]/10 text-[#ff5528]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#ff5528]' }}">
                        Etkinlikler
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                       aria-current="{{ request()->routeIs('contact') ? 'page' : 'false' }}"
                       class="block px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-widest transition-colors
                              {{ request()->routeIs('contact') ? 'bg-[#ff5528]/10 text-[#ff5528]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#ff5528]' }}">
                        İletişim
                    </a>
                </li>
                @auth
                    @if(auth()->user()->is_admin || auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                               class="block px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-widest text-[#ff5528] bg-[#ff5528]/10 transition-colors">
                                ⚙️ Yönetim Paneli
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('etkinlikler.create') }}"
                           class="block px-4 py-3 rounded-lg text-sm font-bold uppercase tracking-widest text-gray-600 hover:bg-gray-50 hover:text-[#ff5528] transition-colors">
                            Plan Ekle
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    {{-- Navbar boşluğu --}}
    <div class="h-16"></div>

    {{-- Flash mesajlar --}}
    @if(session('success'))
        <div role="alert" aria-live="polite" class="max-w-7xl mx-auto px-6 mt-4">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg text-sm font-bold">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div role="alert" aria-live="assertive" class="max-w-7xl mx-auto px-6 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm font-bold">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- İçerik --}}
    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer style="background-color: #0c0d0e !important; color: #ffffff !important; border-top: 1px solid #1e2022 !important;" class="pt-20 pb-12 relative overflow-hidden text-white">
        {{-- Background glow effect --}}
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#ff5528]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 pb-16 border-b border-gray-800/80">
                
                {{-- 1. Kolon: Logo, Slogan & Sosyal Medya --}}
                <div class="lg:col-span-2 space-y-6">
                    <a href="{{ route('home') }}" class="inline-block text-3xl font-black tracking-tight text-white">
                        Plan<span class="text-[#ff5528]">ify</span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-sm font-medium">
                        {{ $siteSettings['footer_about'] ?? 'Şehrin ritmini yakala, yeni deneyimler keşfet ve toplulukla buluş. En güncel konserler, tiyatrolar, atölyeler ve sosyal planlar tek bir platformda.' }}
                    </p>

                    {{-- Sosyal Medya İkonları --}}
                    <div>
                        <span class="text-xs font-black uppercase tracking-[0.2em] text-gray-500 block mb-4">Bizi Takip Edin</span>
                        <div class="flex items-center gap-3">
                            {{-- Instagram --}}
                            @if(!empty($siteSettings['social_instagram']))
                                <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"
                                   class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 hover:border-[#ff5528] hover:bg-[#ff5528] text-gray-300 hover:text-white flex items-center justify-center transition-all duration-300 group">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                            @endif

                            {{-- X / Twitter --}}
                            @if(!empty($siteSettings['social_twitter']))
                                <a href="{{ $siteSettings['social_twitter'] }}" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"
                                   class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 hover:border-[#ff5528] hover:bg-[#ff5528] text-gray-300 hover:text-white flex items-center justify-center transition-all duration-300 group">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </a>
                            @endif

                            {{-- YouTube --}}
                            @if(!empty($siteSettings['social_youtube']))
                                <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"
                                   class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 hover:border-[#ff5528] hover:bg-[#ff5528] text-gray-300 hover:text-white flex items-center justify-center transition-all duration-300 group">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </a>
                            @endif

                            {{-- LinkedIn --}}
                            @if(!empty($siteSettings['social_linkedin']))
                                <a href="{{ $siteSettings['social_linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"
                                   class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 hover:border-[#ff5528] hover:bg-[#ff5528] text-gray-300 hover:text-white flex items-center justify-center transition-all duration-300 group">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </a>
                            @endif

                            {{-- Facebook --}}
                            @if(!empty($siteSettings['social_facebook']))
                                <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                                   class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 hover:border-[#ff5528] hover:bg-[#ff5528] text-gray-300 hover:text-white flex items-center justify-center transition-all duration-300 group">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                            @endif

                            {{-- TikTok --}}
                            @if(!empty($siteSettings['social_tiktok']))
                                <a href="{{ $siteSettings['social_tiktok'] }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok"
                                   class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 hover:border-[#ff5528] hover:bg-[#ff5528] text-gray-300 hover:text-white flex items-center justify-center transition-all duration-300 group">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 2.89 3.48 2.74 1.3-.07 2.49-.87 2.98-2.06.18-.43.26-.9.26-1.37V.02h-.02z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- 2. Kolon: Hızlı Bağlantılar --}}
                <div class="space-y-4">
                    <h4 class="text-xs font-black uppercase tracking-[0.25em] text-white/90">Hızlı Menü</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium flex items-center gap-2">
                                <span class="text-[#ff5528] text-xs">›</span> Ana Sayfa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('etkinlikler.index') }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium flex items-center gap-2">
                                <span class="text-[#ff5528] text-xs">›</span> Tüm Etkinlikler
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('etkinlikler.index', ['source_type' => 'user']) }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium flex items-center gap-2">
                                <span class="text-[#ff5528] text-xs">›</span> Sosyal Rehber (Planlar)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('etkinlikler.index', ['source_type' => 'official']) }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium flex items-center gap-2">
                                <span class="text-[#ff5528] text-xs">›</span> Şehir Duyuruları
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium flex items-center gap-2">
                                <span class="text-[#ff5528] text-xs">›</span> İletişim & Destek
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('etkinlikler.create') }}" class="text-[#ff5528] hover:text-white transition-colors font-bold flex items-center gap-2">
                                <span class="text-xs">+</span> Yeni Plan Oluştur
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- 3. Kolon: Popüler Kategoriler --}}
                <div class="space-y-4">
                    <h4 class="text-xs font-black uppercase tracking-[0.25em] text-white/90">Kategoriler</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li>
                            <a href="{{ route('etkinlikler.index', ['category' => 'Konser & Canlı Müzik']) }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium">
                                🎵 Konser & Canlı Müzik
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('etkinlikler.index', ['category' => 'Tiyatro & Gösteri']) }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium">
                                🎭 Tiyatro & Gösteri
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('etkinlikler.index', ['category' => 'Sergi & Kültür-Sanat']) }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium">
                                🎨 Sergi & Sanat
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('etkinlikler.index', ['category' => 'Festival & Açık Hava']) }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium">
                                🎪 Festival & Açık Hava
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('etkinlikler.index', ['category' => 'Atölye & Workshop']) }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium">
                                💡 Atölye & Workshop
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- 4. Kolon: Bülten & İletişim --}}
                <div class="space-y-4">
                    <h4 class="text-xs font-black uppercase tracking-[0.25em] text-white/90">E-Bülten</h4>
                    <p class="text-gray-400 text-xs leading-relaxed font-medium">
                        Haftalık en popüler etkinlikler ve sürpriz duyurular gelen kutuna gelsin.
                    </p>
                    
                    <form onsubmit="event.preventDefault(); alert('Bültenimize başarıyla abone oldunuz!'); this.reset();" class="space-y-2.5">
                        <div class="relative">
                            <input type="email" placeholder="E-posta adresiniz..." required
                                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                        </div>
                        <button type="submit"
                                class="w-full bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-widest py-3 rounded-xl transition-all duration-300 shadow-lg shadow-[#ff5528]/20">
                            Abone Ol
                        </button>
                    </form>

                    <div class="pt-2 text-[11px] text-gray-500 flex flex-col gap-1">
                        <div class="flex items-center gap-1.5">
                            <span>📍</span>
                            <span class="truncate">{{ $siteSettings['contact_address'] ?? 'İstanbul, Türkiye' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span>✉️</span>
                            <a href="mailto:{{ $siteSettings['contact_email'] ?? 'destek@planify.com' }}" class="hover:text-[#ff5528] transition-colors">{{ $siteSettings['contact_email'] ?? 'destek@planify.com' }}</a>
                        </div>
                        @if(!empty($siteSettings['contact_phone']))
                            <div class="flex items-center gap-1.5">
                                <span>📞</span>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['contact_phone']) }}" class="hover:text-[#ff5528] transition-colors">{{ $siteSettings['contact_phone'] }}</a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- Alt Bar: Copyright & Yasal Linkler --}}
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-gray-500">
                <p class="font-medium">
                    © {{ date('Y') }} <span class="text-white font-bold">Planify</span>. Tüm hakları saklıdır.
                </p>

                <div class="flex flex-wrap items-center gap-6 font-medium">
                    <a href="{{ route('home') }}" class="hover:text-[#ff5528] transition-colors">Kullanım Koşulları</a>
                    <a href="{{ route('home') }}" class="hover:text-[#ff5528] transition-colors">Gizlilik Politikası</a>
                    <a href="{{ route('home') }}" class="hover:text-[#ff5528] transition-colors">Çerez Politikası</a>
                    <a href="{{ route('home') }}" class="hover:text-[#ff5528] transition-colors">KVKK</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Mobil Menü Toggle --}}
    <script>
        (function () {
            const btn  = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const iconOpen  = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');

            if (!btn || !menu) return;

            btn.addEventListener('click', function () {
                const isOpen = menu.classList.toggle('hidden');
                const expanded = !isOpen;

                btn.setAttribute('aria-expanded', String(expanded));
                btn.setAttribute('aria-label', expanded ? 'Gezinme menüsünü kapat' : 'Gezinme menüsünü aç');
                iconOpen.classList.toggle('hidden', expanded);
                iconClose.classList.toggle('hidden', !expanded);
            });

            // ESC ile menüyü kapat
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                    btn.setAttribute('aria-label', 'Gezinme menüsünü aç');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                    btn.focus();
                }
            });
        })();
    </script>

</body>
</html>
