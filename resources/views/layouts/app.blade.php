<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Planify') }}</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
                </ul>

                {{-- Auth Alanı --}}
                <div class="flex items-center gap-4">
                    @auth
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
                @auth
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
    <footer class="bg-[#1a1a1a] text-white py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-2xl font-black mb-2">Plan<span class="text-[#ff5528]">ify</span></p>
            <p class="text-gray-500 text-sm">© {{ date('Y') }} Planify. Tüm hakları saklıdır.</p>
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
