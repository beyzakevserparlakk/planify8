@extends('layouts.app')

@section('content')

    {{-- 1. HERO / SLIDER SECTION - İçerikler Korundu --}}
    <section class="relative h-[650px] overflow-hidden bg-black" style="margin-top: 0ch; margin-bottom: 0%;">
        @if($sliders->count() > 0)
            <div class="swiper hero-swiper h-full">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                        <div class="swiper-slide relative flex items-center">
                            {{-- Arka Plan Görseli --}}
                            <img src="{{ asset('storage/' . $slider->image) }}" 
                                 class="absolute inset-0 w-full h-full object-cover" 
                                 alt="{{ $slider->title }}">
                            
                            {{-- Yazıların okunması için karartma --}}
                            <div class="absolute inset-0 bg-black/40"></div>

                            <div class="relative max-w-7xl mx-auto px-6 w-full z-10 flex justify-center">
                                <div class="max-w-3xl text-white">
                                    <h1 style="margin-top: 300px" class="text-5xl md:text-7xl font-bold mb-6 leading-tight animate-fade-up text-centerz-index: 10;">
                                        {{ $slider->title }} 
                                    </h1>

                                    @if($slider->link)
                                        <div class="mt-8">
                                            <a href="{{ $slider->link }}"
                                                class="inline-block px-10 py-4 bg-[#ff5528] text-white rounded-lg text-sm font-bold tracking-widest hover:bg-white hover:text-black transition-all duration-300 uppercase">
                                                Detayları Gör
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Slider Kontrolleri --}}
                <div class="swiper-pagination !bottom-10"></div>
                <div class="hero-nav-prev absolute left-6 top-1/2 -translate-y-1/2 z-20 cursor-pointer text-white/50 hover:text-[#ff5528] transition-colors hidden md:block">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                <div class="hero-nav-next absolute right-6 top-1/2 -translate-y-1/2 z-20 cursor-pointer text-white/50 hover:text-[#ff5528] transition-colors hidden md:block">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        @else
            {{-- Eğer slider yoksa senin fallback içeriğin --}}
            <div class="flex items-center justify-center h-full text-white bg-gray-900">
                <h2 class="text-3xl font-bold italic">Henüz slider eklenmemiş</h2>
            </div>
        @endif
    </section>
    
  
   {{-- ANASAYFA FİLTRE BAR - Kart Tabanlı Modern Tasarım --}}
    <section class="sticky top-0 z-50 mt-56 pt-12 border-gray-200" style="background-color: #FCFCFC">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- Kart 1: Tüm Planlar --}}
            <a href="{{ url('/etkinlikler') }}" 
               class="group relative bg-white/90 backdrop-blur-xl p-1 border border-gray-200 shadow-[0_20px_40px_rgba(0,0,0,0.08)] transition-all duration-500 hover:-translate-y-2 hover:shadow-[#ff5528]/20 hover:shadow-2xl"
               style="border-radius: 5rem; overflow: hidden;"> <div class="flex items-center justify-center w-full h-full gap-4 p-8 transition-colors duration-500 group-hover:bg-[#ff5528]/5" style="border-radius: 4.8rem;">
                    <span class="text-3xl flex-shrink-0">🔥</span>
                    <div class="flex flex-col items-center justify-center text-center">
                        <h4 class="text-lg font-black text-gray-900 leading-tight uppercase tracking-tighter">Tüm Planlar</h4>
                        <p class="text-[11px] font-bold text-[#ff5528] uppercase tracking-widest mt-1 opacity-70">Hepsini Keşfet</p>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 h-1.5 bg-[#ff5528] w-0 group-hover:w-full transition-all duration-500"></div>
            </a>

            {{-- Kart 2: Sosyal Rehber --}}
            <a href="{{ url('/etkinlikler?source_type=user') }}" 
               class="group relative bg-white/90 backdrop-blur-xl p-1 border border-gray-200 shadow-[0_20px_40px_rgba(0,0,0,0.08)] transition-all duration-500 hover:-translate-y-2 hover:shadow-emerald-500/20 hover:shadow-2xl"
               style="border-radius: 5rem; overflow: hidden;">
                <div class="flex items-center justify-center w-full h-full gap-4 p-8 transition-colors duration-500 group-hover:bg-emerald-50" style="border-radius: 4.8rem;">
                    <span class="text-3xl flex-shrink-0">🙋</span>
                    <div class="flex flex-col items-center justify-center text-center">
                        <h4 class="text-lg font-black text-gray-900 leading-tight uppercase tracking-tighter">Sosyal Rehber</h4>
                        <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-widest mt-1 opacity-70">Size Özel Planlar</p>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 h-1.5 bg-emerald-500 w-0 group-hover:w-full transition-all duration-500"></div>
            </a>

            {{-- Kart 3: Şehir Etkinlikleri --}}
            <a href="{{ url('/etkinlikler?source_type=official') }}" 
               class="group relative bg-white/90 backdrop-blur-xl p-1 border border-gray-200 shadow-[0_20px_40px_rgba(0,0,0,0.08)] transition-all duration-500 hover:-translate-y-2 hover:shadow-indigo-500/20 hover:shadow-2xl"
               style="border-radius: 5rem; overflow: hidden;">
                <div class="flex items-center justify-center w-full h-full gap-4 p-8 transition-colors duration-500 group-hover:bg-indigo-50" style="border-radius: 4.8rem;">
                    <span class="text-3xl flex-shrink-0">🏛️</span>
                    <div class="flex flex-col items-center justify-center text-center">
                        <h4 class="text-lg font-black text-gray-900 leading-tight uppercase tracking-tighter">Şehir Etkinlikleri</h4>
                        <p class="text-[11px] font-bold text-indigo-600 uppercase tracking-widest mt-1 opacity-70">Resmi Duyurular</p>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 h-1.5 bg-indigo-600 w-0 group-hover:w-full transition-all duration-500"></div>
            </a>

        </div>
    </div>
</section>
    {{-- BOŞLUK - Filtre ile Stats arası --}}
    <div class="h-32 bg-[#FCFCFC]"></div>

    {{-- 2. STATS SECTION - Temiz Beyaz Arka Plan --}}
    <section class="py-20 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
            <div class="space-y-2">
                <span class="block text-5xl font-black text-[#1a1a1a]">500+</span>
                <span class="text-[#ff5528] font-bold uppercase tracking-widest text-[10px]">Şehir Güncellemesi</span>
            </div>
            <div class="space-y-2">
                <span class="block text-5xl font-black text-[#1a1a1a]">1200+</span>
                <span class="text-[#ff5528] font-bold uppercase tracking-widest text-[10px]">Başarılı Plan</span>
            </div>
            <div class="space-y-2">
                <span class="block text-5xl font-black text-[#1a1a1a]">5k+</span>
                <span class="text-[#ff5528] font-bold uppercase tracking-widest text-[10px]">Mutlu Kullanıcı</span>
            </div>
            <div class="space-y-2">
                <span class="block text-5xl font-black text-[#1a1a1a]">24/7</span>
                <span class="text-[#ff5528] font-bold uppercase tracking-widest text-[10px]">Canlı Destek</span>
            </div>
        </div>
    </section>

    {{-- 3. FEATURED EVENTS SECTION - Tüm Döngüler Korundu --}}
    <section class="py-24 bg-[#fcfcfc]">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div>
                    <span class="text-[#ff5528] font-bold tracking-[0.3em] uppercase text-xs mb-3 block italic">// Bunlara Göz At</span>
                    <h2 class="text-4xl md:text-6xl font-black text-[#1a1a1a] leading-tight">Fikir edinebileceğin aktiviteler.</h2>
                </div>
                <div class="mt-8 md:mt-0">
                    <a href="{{ url('/etkinlikler') }}" class="inline-flex items-center gap-2 text-sm font-black tracking-widest uppercase text-[#1a1a1a] border-b-2 border-[#ff5528] pb-1 hover:text-[#ff5528] transition-all">
                        TÜM AKTİVİTELER →
                    </a>
                </div>
            </div>

            <div class="swiper featured-events-swiper !pb-20">
                <div class="swiper-wrapper">
                    {{-- Senin orjinal döngün --}}
                    @forelse($latestEtkinlikler as $etkinlik)
                        <div class="swiper-slide">
                            <div class="group bg-white rounded-3xl overflow-hidden shadow-[0_15px_45px_rgba(0,0,0,0.03)] border border-gray-100 h-[480px] flex flex-col transition-all duration-500 hover:shadow-2xl">
                                
                                {{-- Kart Görseli --}}
                                <div class="relative h-56 overflow-hidden flex-shrink-0">
                                    <img src="{{ $etkinlik->image ? asset('storage/' . $etkinlik->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=600' }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    
                                    {{-- Lokasyon Badge --}}
                                    <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-md shadow-sm">
                                        <span class="text-[#ff5528] font-bold text-[10px] uppercase tracking-widest">{{ $etkinlik->location }}</span>
                                    </div>

                                    {{-- Source Type Badge --}}
                                    <div class="absolute top-4 right-4 {{ $etkinlik->source_type == 'official' ? 'bg-indigo-600' : 'bg-emerald-500' }} px-3 py-1 rounded-md shadow-sm">
                                        <span class="text-white font-bold text-[10px] uppercase tracking-widest">
                                            {{ $etkinlik->source_type == 'official' ? '🏛️ Şehir' : '🙋 Grup' }}
                                        </span>
                                    </div>
                                </div>

                               {{-- Kart İçeriği --}}
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="text-xl font-bold text-[#1a1a1a] mb-4 group-hover:text-[#ff5528] transition-colors leading-tight line-clamp-2">
                                        {{ $etkinlik->title }}
                                    </h3>

                                    <div class="flex items-center gap-2 mb-4">
                                        <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm font-bold text-emerald-600">{{ $etkinlik->cost ?: 'Ücretsiz' }}</span>
                                    </div>

                                    <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                        {{-- Linkin sonuna #detay-alani ID'si eklendi --}}
                                        <a href="{{ url('/etkinlikler/' . $etkinlik->slug) }}#detay-alani"
                                        class="bg-[#ff5528] text-white px-6 py-2 rounded-lg text-xs font-bold tracking-widest uppercase hover:bg-black transition-colors">
                                            İncele
                                        </a>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Yakında</span>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    @empty
                        {{-- Boşsa gösterilecek alan --}}
                        <div class="text-center text-gray-400 py-20 w-full italic font-medium">Şu an aktif bir plan bulunmuyor.</div>
                    @endforelse
                </div>
                
                {{-- Sayfalama Noktaları --}}
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>

    {{-- 4. CTA SECTION - Koyu ve Modern --}}
    <section class="py-24 pb-40 bg-white text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#ff5528] opacity-10 rounded-full -mr-32 -mt-32"></div>
        
        <div class="relative max-w-4xl mx-auto px-6 text-center z-10">
            <h2 class="text-4xl md:text-6xl font-black mb-8 leading-tight text-gray-900">
                Rotayı  <span class="text-[#ff5528]">sen çiz!</span>
            </h2>
            <p class="text-gray-600 text-lg mb-12 max-w-2xl mx-auto">
                Yeni etkinlikler oluştur, arkadaşlarınla plan yap ve unutulmaz anlar yaşa.
            </p>
            <a href="{{ route('etkinlikler.create') }}"
               class="inline-block bg-[#ff5528] text-white px-12 py-5 rounded-md font-black text-sm tracking-[0.2em] uppercase hover:bg-white hover:text-black transition-all duration-300 shadow-2xl">
                Hadi Başla 
            </a>
        </div>
    </section>

    {{-- Scriptler ve Swiper Başlatma --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hero Swiper
            new Swiper('.hero-swiper', {
                loop: true,
                effect: 'fade',
                speed: 1000,
                autoplay: { delay: 6000, disableOnInteraction: false },
                pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
                navigation: { nextEl: '.hero-nav-next', prevEl: '.hero-nav-prev' },
            });

            // Etkinlikler Swiper
            new Swiper('.featured-events-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                speed: 800,
                autoplay: { delay: 5000 },
                pagination: { el: '.featured-events-swiper .swiper-pagination', clickable: true },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 }
                }
            });
        });
    </script>

    <style>
        /* Aasha Tarzı Pagination */
        .swiper-pagination-bullet { background: #d1d1d1 !important; opacity: 1 !important; }
        .swiper-pagination-bullet-active { background: #ff5528 !important; width: 25px !important; border-radius: 4px !important; }
        
        /* Animasyon */
        .animate-fade-up { animation: fadeUp 1s ease-out forwards; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

@endsection