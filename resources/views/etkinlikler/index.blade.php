@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#fcfcfc] text-gray-900"
     x-data="{
         selectedCity: '{{ request('city', '') }}',
         allDistricts: {{ json_encode($allDistricts) }},
         get filteredDistricts() {
             if (!this.selectedCity) return [];
             return this.allDistricts.filter(d => d.city && d.city.name === this.selectedCity);
         }
     }">

    {{-- 1. DARK HERO SECTION WITH EMBEDDED SEARCH BAR --}}
    <section class="relative pt-16 pb-24 md:pt-24 md:pb-32 overflow-hidden border-b border-gray-900 text-white"
             style="background: radial-gradient(circle at 50% 20%, #1f1412 0%, #0d0e10 70%);">
        
        {{-- Ambient Glows --}}
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[#ff5528]/15 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute top-0 right-10 w-96 h-96 bg-indigo-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            
            {{-- Badge & Breadcrumb --}}
            <div class="flex flex-col items-center text-center mb-6">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-6">
                    <span class="w-2 h-2 rounded-full bg-[#ff5528] animate-pulse"></span>
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-[#ff5528]">Şehrin Ritmini Keşfet</span>
                    <span class="text-gray-600">•</span>
                    <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Ana Sayfa</a>
                        <span class="text-gray-600">/</span>
                        <span class="text-white font-bold">Etkinlikler</span>
                    </div>
                </div>

                {{-- Hero Heading --}}
                <h1 class="text-4xl sm:text-6xl md:text-7xl font-black tracking-tight leading-[1.1] text-white max-w-4xl">
                    Şehirde Hayat Var, <br class="hidden sm:inline"/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff5528] via-orange-400 to-amber-300">
                        Planını Şimdi Seç!
                    </span>
                </h1>
                
                <p class="text-gray-400 text-sm md:text-lg mt-4 max-w-2xl font-medium leading-relaxed">
                    Yüzlerce konser, tiyatro, atölye ve bağımsız sosyal buluşma tek adreste. Filtrele, keşfet ve yerini ayırt.
                </p>
            </div>

        </div>
    </section>

    {{-- 2. LIGHT CATEGORY PILLS STRIP & SOURCE TABS --}}
    <section class="bg-white border-b border-gray-200 sticky top-16 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                
                {{-- Tekli Filtreleme Butonu / Seçimi --}}
                <div class="flex items-center gap-3">
                    <form method="GET" action="{{ route('etkinlikler.index') }}" class="inline-flex items-center">
                        @foreach(request()->except(['source_type', 'page']) as $k => $v)
                            @if(is_string($v) && filled($v))
                                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                            @endif
                        @endforeach
                        <div class="relative flex items-center">
                            <span class="absolute left-3.5 text-sm pointer-events-none">⚡</span>
                            <select name="source_type"
                                    onchange="this.form.submit()"
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-black uppercase tracking-wider py-2.5 pl-9 pr-9 rounded-xl border border-gray-200 focus:border-[#ff5528] focus:bg-white outline-none transition cursor-pointer appearance-none shadow-sm">
                                <option value="" {{ !request('source_type') ? 'selected' : '' }}>🔥 Tüm Planlar</option>
                                <option value="user" {{ request('source_type') === 'user' ? 'selected' : '' }}>🙋 Sosyal Rehber (Topluluk)</option>
                                <option value="official" {{ request('source_type') === 'official' ? 'selected' : '' }}>🏛️ Şehir Etkinlikleri (Resmi)</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-400 absolute right-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </form>
                </div>

                {{-- Action / Reset & Count --}}
                <div class="flex items-center gap-4 text-xs font-bold text-gray-500">
                    @if(request()->hasAny(['search', 'city', 'district', 'category', 'source_type']))
                        <a href="{{ route('etkinlikler.index') }}" class="text-[#ff5528] hover:underline flex items-center gap-1 font-bold">
                            <span>✕ Filtreleri Sıfırla</span>
                        </a>
                        <span>•</span>
                    @endif
                    <span>Toplam <strong class="text-gray-900">{{ $etkinlikler->total() }}</strong> etkinlik listeleniyor</span>
                    
                    <a href="{{ route('etkinlikler.create') }}"
                       class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 bg-[#ff5528] hover:bg-black text-white rounded-xl transition text-xs font-black uppercase tracking-wider shadow-md shadow-[#ff5528]/20">
                        <span>+ Plan Ekle</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- 3. LIGHT EVENTS GRID (DICE / EVENTBRITE STYLE ON LIGHT CANVAS) --}}
    <main class="max-w-7xl mx-auto px-6 py-14">
        @if($etkinlikler->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($etkinlikler as $etkinlik)
                    <div class="group bg-white rounded-[2rem] overflow-hidden border border-gray-200/80 shadow-[0_10px_35px_rgba(0,0,0,0.04)] flex flex-col transition-all duration-500 hover:-translate-y-2 hover:border-[#ff5528]/40 hover:shadow-2xl">
                        
                        {{-- Görsel & Badges --}}
                        <div class="relative h-64 overflow-hidden bg-gray-100 flex-shrink-0">
                            <img src="{{ $etkinlik->image ? asset('storage/' . $etkinlik->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=800' }}"
                                 alt="{{ $etkinlik->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            {{-- Gradient Vignette --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20"></div>

                            {{-- DICE STYLE DATE BADGE (Sol Üst) --}}
                            <div class="absolute top-4 left-4 bg-white/95 text-gray-900 rounded-2xl shadow-xl overflow-hidden text-center min-w-[56px] border border-white/40 backdrop-blur-md">
                                <div class="bg-[#ff5528] text-white text-[10px] font-black uppercase tracking-wider py-1 px-2.5">
                                    {{ $etkinlik->date ? $etkinlik->date->translatedFormat('M') : 'YAK' }}
                                </div>
                                <div class="py-1.5 px-2 text-xl font-black leading-none text-gray-900">
                                    {{ $etkinlik->date ? $etkinlik->date->format('d') : '∞' }}
                                </div>
                            </div>

                            {{-- KAYNAK ROZETİ (Sağ Üst) --}}
                            <div class="absolute top-4 right-4 {{ $etkinlik->source_type === 'official' ? 'bg-indigo-600' : 'bg-emerald-600' }} text-white text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-xl shadow-lg backdrop-blur-md">
                                {{ $etkinlik->source_type === 'official' ? '🏛️ Şehir' : '🙋 Sosyal' }}
                            </div>

                            {{-- KATEGORİ ROZETİ (Sol Alt) --}}
                            @if($etkinlik->category)
                                <div class="absolute bottom-4 left-4">
                                    <span class="bg-black/75 text-white border border-white/20 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full backdrop-blur-md">
                                        {{ $etkinlik->category }}
                                    </span>
                                </div>
                            @endif

                            {{-- ÜCRET BADGE (Sağ Alt) --}}
                            <div class="absolute bottom-4 right-4">
                                <span class="bg-emerald-600 text-white text-[11px] font-black px-3 py-1 rounded-full shadow-md backdrop-blur-md">
                                    {{ $etkinlik->cost ?: 'Ücretsiz' }}
                                </span>
                            </div>
                        </div>

                        {{-- İçerik Alanı --}}
                        <div class="p-6 flex flex-col flex-grow bg-white">
                            
                            {{-- Konum & Saat --}}
                            <div class="flex items-center justify-between text-xs text-gray-500 font-medium mb-3">
                                <div class="flex items-center gap-1.5 text-gray-700">
                                    <svg class="w-4 h-4 text-[#ff5528] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    <span class="line-clamp-1 font-bold text-gray-800">{{ $etkinlik->location ?: ($etkinlik->city ?: 'Konum Belirtilmedi') }}</span>
                                </div>
                                <span class="text-gray-400 font-bold text-[11px]">{{ $etkinlik->date ? $etkinlik->date->format('H:i') : '' }}</span>
                            </div>

                            {{-- Başlık --}}
                            <h2 class="text-lg font-black text-gray-900 mb-3 group-hover:text-[#ff5528] transition-colors leading-snug line-clamp-2">
                                <a href="{{ route('etkinlikler.show', $etkinlik->slug) }}">
                                    {{ $etkinlik->title }}
                                </a>
                            </h2>

                            {{-- Açıklama Özeti --}}
                            @if($etkinlik->content)
                                <p class="text-xs text-gray-500 font-medium line-clamp-2 mb-6 leading-relaxed">
                                    {{ Str::limit(strip_tags($etkinlik->content), 95) }}
                                </p>
                            @endif

                            {{-- Alt Çizgi & Buton --}}
                            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    @if($etkinlik->city)
                                        <span class="text-[11px] font-bold text-gray-600 bg-gray-100 px-2.5 py-1 rounded-lg">
                                            📍 {{ $etkinlik->city }}
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('etkinlikler.show', $etkinlik->slug) }}"
                                   class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-gray-100 group-hover:bg-[#ff5528] text-gray-900 group-hover:text-white text-xs font-black uppercase tracking-wider rounded-xl transition-all duration-300">
                                    <span>İncele</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
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
            {{-- Boş Durum (Empty State) --}}
            <div class="bg-white rounded-3xl p-16 text-center border border-gray-200 shadow-sm max-w-2xl mx-auto my-12">
                <div class="w-20 h-20 rounded-2xl bg-[#ff5528]/10 text-[#ff5528] flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-2">Eşleşen Plan Bulunamadı</h3>
                <p class="text-gray-500 text-sm mb-8 leading-relaxed">
                    Arama kriterlerinize uygun etkinlik henüz eklenmemiş. Filtreleri temizleyebilir veya şehriniz için ilk planı siz oluşturabilirsiniz.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('etkinlikler.index') }}" class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-2xl text-xs font-black uppercase tracking-widest transition">
                        Filtreleri Temizle
                    </a>
                    <a href="{{ route('etkinlikler.create') }}" class="px-7 py-3.5 bg-[#ff5528] hover:bg-black text-white rounded-2xl text-xs font-black uppercase tracking-widest transition shadow-xl shadow-[#ff5528]/25">
                        + İlk Planı Sen Ekle
                    </a>
                </div>
            </div>
        @endif
    </main>

</div>
@endsection
