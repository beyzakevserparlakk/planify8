@extends('layouts.app')

@section('content')
    {{-- HERO / SLIDER SECTION --}}
    <section class="relative h-[650px] overflow-hidden bg-black">
        @if($sliders->count() > 0)
            <div class="swiper hero-swiper h-full">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                        <div class="swiper-slide relative flex items-center">
                            <img src="{{ asset('storage/' . $slider->image) }}" 
                                 class="absolute inset-0 w-full h-full object-cover" 
                                 alt="{{ $slider->title }}">
                            <div class="absolute inset-0 bg-black/40"></div>
                            <div class="relative max-w-7xl mx-auto px-6 w-full z-10 flex justify-center">
                                <div class="max-w-3xl text-white">
                                    <h1 style="margin-top: 300px" class="text-5xl md:text-7xl font-bold mb-6 leading-tight animate-fade-up text-center">
                                        {{ $slider->title }} 
                                    </h1>
                                    @if($slider->link)
                                        <div class="mt-8">
                                            <a href="{{ $slider->link }}"
                                                class="inline-block px-10 py-4 bg-[#ff5528] text-white rounded-md text-sm font-bold tracking-widest hover:bg-white hover:text-black transition-all duration-300 uppercase">
                                                Detayları Gör
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination !bottom-10"></div>
                <div class="hero-nav-prev absolute left-6 top-1/2 -translate-y-1/2 z-20 cursor-pointer text-white/50 hover:text-[#ff5528] transition-colors hidden md:block">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                <div class="hero-nav-next absolute right-6 top-1/2 -translate-y-1/2 z-20 cursor-pointer text-white/50 hover:text-[#ff5528] transition-colors hidden md:block">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        @else
            <div class="flex items-center justify-center h-full text-white bg-gray-900">
                <h2 class="text-3xl font-bold italic">Henüz slider eklenmemiş</h2>
            </div>
        @endif
    </section>

    {{-- KAYNAK TİPİ FİLTRE BUTONLARI - Hero Altında --}}
    <section class="py-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-[#ff5528] font-black tracking-[0.2em] uppercase text-xs italic">Filtrele:</span>
                </div>
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('etkinlikler.index', array_merge(request()->except('source_type'), ['source_type' => null])) }}" 
                       class="px-8 py-4 rounded-full font-black text-sm tracking-wider uppercase transition-all duration-300 {{ !request('source_type') ? 'bg-[#ff5528] text-white shadow-xl shadow-[#ff5528]/30 scale-105' : 'bg-gray-50 text-gray-600 border-2 border-gray-200 hover:border-[#ff5528] hover:text-[#ff5528] hover:shadow-lg' }}">
                        🔥 Hepsi
                    </a>
                    <a href="{{ route('etkinlikler.index', array_merge(request()->except('source_type'), ['source_type' => 'user'])) }}" 
                       class="px-8 py-4 rounded-full font-black text-sm tracking-wider uppercase transition-all duration-300 {{ request('source_type') == 'user' ? 'bg-emerald-500 text-white shadow-xl shadow-emerald-500/30 scale-105' : 'bg-gray-50 text-gray-600 border-2 border-gray-200 hover:border-emerald-500 hover:text-emerald-500 hover:shadow-lg' }}">
                        🙋 Arkadaş Grupları
                    </a>
                    <a href="{{ route('etkinlikler.index', array_merge(request()->except('source_type'), ['source_type' => 'official'])) }}" 
                       class="px-8 py-4 rounded-full font-black text-sm tracking-wider uppercase transition-all duration-300 {{ request('source_type') == 'official' ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30 scale-105' : 'bg-gray-50 text-gray-600 border-2 border-gray-200 hover:border-indigo-600 hover:text-indigo-600 hover:shadow-lg' }}">
                        🏛️ Şehir Etkinlikleri
                    </a>
                </div>
                <div class="hidden md:block text-xs font-bold text-gray-400 uppercase tracking-widest">
                    {{ $etkinlikler->total() }} etkinlik bulundu
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const citySelect = document.getElementById('citySelect');
            if(citySelect) {
                citySelect.addEventListener('change', function() {
                    const city = this.value;
                    const districtSelect = document.getElementById('districtSelect');
                    
                    if (city) {
                        districtSelect.disabled = false;
                        districtSelect.classList.remove('opacity-50', 'cursor-not-allowed');
                    } else {
                        districtSelect.disabled = true;
                        districtSelect.classList.add('opacity-50', 'cursor-not-allowed');
                        districtSelect.value = '';
                    }
                });
            }
        });
    </script>

    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-16 flex justify-between items-end">
            <div>
                <span class="text-[#ff5528] font-bold tracking-[0.3em] uppercase text-xs mb-3 block italic" style="margin-top: 15px;">Mekanlar</span>
                <h2 class="text-4xl md:text-6xl font-black text-[#1a1a1a]"></h2>
            </div>
        </div>
    </div>

    {{-- FİLTRELEME ÇUBUĞU --}}
    <section class="relative z-30 w-full flex justify-center" style="margin-top: -60px;">
        <div class="max-w-4xl w-full px-6">
            <form action="{{ request()->url() }}" method="GET" class="w-full">
                @if(request('source_type'))
                    <input type="hidden" name="source_type" value="{{ request('source_type') }}">
                @endif
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end" x-data="{ selectedCity: '{{ request('city') }}', allDistricts: {{ json_encode($allDistricts) }}, filteredDistricts: [] }" x-init="if(selectedCity){filteredDistricts = allDistricts.filter(d => d.city.name === selectedCity)}">
                    {{-- Arama Kutusu --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-gray-500">
                            <svg class="w-4 h-4 text-[#ff5528]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Arama
                        </label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Etkinlik, mekan ara..." class="w-full bg-white border-2 border-gray-200 hover:border-[#ff5528] rounded-2xl py-4 pl-12 pr-5 text-sm font-bold focus:ring-2 focus:ring-[#ff5528] focus:border-[#ff5528] transition-all shadow-sm hover:shadow-md">
                        </div>
                    </div>
                    {{-- Şehir Seçimi --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-gray-500 ml-1">
                            <svg class="w-4 h-4 text-[#ff5528]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Şehir
                        </label>
                        <select name="city" id="citySelect" x-model="selectedCity" @change="filteredDistricts = allDistricts.filter(d => d.city.name === selectedCity)" class="w-full bg-white border-2 border-gray-200 hover:border-[#ff5528] rounded-2xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-[#ff5528] focus:border-[#ff5528] transition-all cursor-pointer shadow-sm hover:shadow-md">
                            <option value="">Tüm Şehirler</option>
                            @foreach($cities as $id => $name)
                                <option value="{{ $name }}" {{ request('city') == $name ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- İlçe Seçimi --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-gray-500 ml-1">
                            <svg class="w-4 h-4 text-[#ff5528]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            İlçe
                        </label>
                        <select name="district" id="districtSelect" class="w-full bg-white border-2 border-gray-200 hover:border-[#ff5528] rounded-2xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-[#ff5528] focus:border-[#ff5528] transition-all cursor-pointer shadow-sm hover:shadow-md {{ !request('city') ? 'opacity-50 cursor-not-allowed' : '' }}" {{ !request('city') ? 'disabled' : '' }}>
                            <option value="">Önce Şehir Seçin</option>
                            @foreach($districts as $id => $name)
                                <option value="{{ $name }}" {{ request('district') == $name ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Kategori Seçimi --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-gray-500 ml-1">
                            <svg class="w-4 h-4 text-[#ff5528]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Kategori
                        </label>
                        <select name="category" class="w-full bg-white border-2 border-gray-200 hover:border-[#ff5528] rounded-2xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-[#ff5528] focus:border-[#ff5528] transition-all cursor-pointer shadow-sm hover:shadow-md">
                            <option value="">Hepsi</option>
                            <option value="Konser" {{ request('category') == 'Konser' ? 'selected' : '' }}>Konser & Sahne</option>
                            <option value="Atölye" {{ request('category') == 'Atölye' ? 'selected' : '' }}>Atölye & Eğitim</option>
                            <option value="Sergi" {{ request('category') == 'Sergi' ? 'selected' : '' }}>Sanat & Sergi</option>
                            <option value="Gezi" {{ request('category') == 'Gezi' ? 'selected' : '' }}>Doğa & Gezi</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </section>

    {{-- ETKİNLİKLER GRID --}}
    <section class="py-24 bg-[#fcfcfc] overflow-x-hidden">
        <div class="max-w-7xl mx-auto px-6 w-full">
            @if($etkinlikler->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full min-w-0" style="width: 100%; overflow: hidden; position: relative; transform: translateZ(0);">
                    @foreach($etkinlikler as $etkinlik)
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-[0_15px_45px_rgba(0,0,0,0.03)] border border-gray-100 flex flex-col transition-all duration-500 hover:shadow-2xl">
                            {{-- Görsel --}}
                            <div class="relative h-56 overflow-hidden flex-shrink-0">
                                <img src="{{ $etkinlik->image ? asset('storage/' . $etkinlik->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=600' }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-md shadow-sm">
                                    <span class="text-[#ff5528] font-bold text-[10px] uppercase tracking-widest">{{ $etkinlik->location }}</span>
                                </div>
                                <div class="absolute top-4 right-4 {{ $etkinlik->source_type == 'official' ? 'bg-indigo-600' : 'bg-emerald-500' }} px-3 py-1 rounded-md shadow-sm">
                                    <span class="text-white font-bold text-[10px] uppercase tracking-widest">
                                        {{ $etkinlik->source_type == 'official' ? '🏛️ Şehir' : '🙋 Grup' }}
                                    </span>
                                </div>
                            </div>
                            {{-- İçerik --}}
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
                                    <a href="{{ route('etkinlikler.show', $etkinlik->slug) }}"
                                       class="bg-[#ff5528] text-white px-6 py-2 rounded-lg text-xs font-bold tracking-widest uppercase hover:bg-black transition-colors">
                                        İncele
                                    </a>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $etkinlik->date ? $etkinlik->date->format('d M') : 'Yakında' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                {{-- Sayfalama --}}
                <div class="mt-16 flex justify-center">
                    {{ $etkinlikler->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Etkinlik bulunamadı</h3>
                    <p class="text-gray-500">Filtreleri değiştirerek tekrar deneyin.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
