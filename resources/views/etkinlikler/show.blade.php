@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#fcfcfc] py-10" x-data="{ copied: false }">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Breadcrumb & Back --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium">Ana Sayfa</a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('etkinlikler.index') }}" class="text-gray-400 hover:text-[#ff5528] transition-colors font-medium">Etkinlikler</a>
                <span class="text-gray-300">/</span>
                <span class="font-bold text-gray-800 line-clamp-1 max-w-[200px] sm:max-w-md">{{ $etkinlik->title }}</span>
            </div>
            <a href="{{ route('etkinlikler.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#ff5528] transition-colors bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm hover:shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Tüm Etkinliklere Dön
            </a>
        </div>

        {{-- Main Hero / Header Card --}}
        <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-[0_15px_45px_rgba(0,0,0,0.04)] mb-10">
            {{-- Image & Badges --}}
            <div class="relative h-[340px] md:h-[460px] w-full bg-gray-900 overflow-hidden">
                <img src="{{ $etkinlik->image ? asset('storage/' . $etkinlik->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=1200' }}"
                     alt="{{ $etkinlik->title }}"
                     class="w-full h-full object-cover opacity-90 hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                {{-- Badges on Image --}}
                <div class="absolute top-6 left-6 flex flex-wrap gap-2.5 z-10">
                    {{-- Source Type --}}
                    <span class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider backdrop-blur-md shadow-lg {{ $etkinlik->source_type === 'official' ? 'bg-indigo-600/90 text-white' : 'bg-emerald-600/90 text-white' }}">
                        {{ $etkinlik->source_type === 'official' ? '🏛️ Şehir Resmi Duyurusu' : '🙋 Topluluk & Sosyal Plan' }}
                    </span>

                    {{-- Category --}}
                    @if($etkinlik->category)
                        <span class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider bg-white/90 text-gray-900 backdrop-blur-md shadow-lg">
                            🎯 {{ $etkinlik->category }}
                        </span>
                    @endif

                    {{-- Status Badge (if not approved) --}}
                    @if($etkinlik->status !== 'approved')
                        <span class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider bg-amber-500 text-white shadow-lg">
                            ⏳ İnceleniyor ({{ ucfirst($etkinlik->status) }})
                        </span>
                    @endif
                </div>

                {{-- Bottom Overlay Info --}}
                <div class="absolute bottom-6 left-6 right-6 z-10 text-white">
                    <div class="max-w-4xl">
                        <div class="flex items-center gap-3 text-xs md:text-sm font-bold tracking-widest text-[#ff5528] uppercase mb-2">
                            @if($etkinlik->city)
                                <span>📍 {{ $etkinlik->city }} {{ $etkinlik->district ? '/ ' . $etkinlik->district : '' }}</span>
                                <span>•</span>
                            @endif
                            <span>👁️ {{ number_format($etkinlik->views ?? 0) }} Görüntülenme</span>
                        </div>
                        <h1 class="text-2xl sm:text-4xl md:text-5xl font-black leading-tight tracking-tight drop-shadow-md">
                            {{ $etkinlik->title }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- Left Column: Details & Content --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Key Stats Highlight --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    {{-- Date Stat --}}
                    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[#ff5528]/10 text-[#ff5528] flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-wider text-gray-400">Tarih</p>
                            <p class="text-sm font-bold text-gray-900 mt-0.5">
                                {{ $etkinlik->date ? $etkinlik->date->translatedFormat('d F Y') : 'Tarih Belirtilmedi' }}
                            </p>
                        </div>
                    </div>

                    {{-- Time Stat --}}
                    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-wider text-gray-400">Saat</p>
                            <p class="text-sm font-bold text-gray-900 mt-0.5">
                                {{ $etkinlik->date ? $etkinlik->date->format('H:i') : '--:--' }}
                            </p>
                        </div>
                    </div>

                    {{-- Cost Stat --}}
                    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 col-span-2 sm:col-span-1">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-wider text-gray-400">Ücret</p>
                            <p class="text-sm font-bold text-emerald-600 mt-0.5">
                                {{ $etkinlik->cost ?: 'Ücretsiz' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Description & Content Card --}}
                <div class="bg-white rounded-3xl p-8 md:p-10 border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-gray-900 uppercase tracking-wide flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <span class="w-3 h-3 rounded-full bg-[#ff5528]"></span>
                        Etkinlik Hakkında
                    </h2>

                    <div class="prose max-w-none text-gray-700 leading-relaxed font-medium text-base space-y-4">
                        @if($etkinlik->content)
                            {!! nl2br(e($etkinlik->content)) !!}
                        @else
                            <p class="text-gray-400 italic">Bu etkinlik için henüz detaylı açıklama eklenmemiş.</p>
                        @endif
                    </div>
                </div>

                {{-- Location & Venue Card --}}
                <div class="bg-white rounded-3xl p-8 md:p-10 border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-gray-900 uppercase tracking-wide flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <span class="w-3 h-3 rounded-full bg-[#ff5528]"></span>
                        Konum ve Mekan Bilgisi
                    </h2>

                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-gray-900">
                                    {{ $etkinlik->location ?: 'Mekan bilgisi belirtilmedi' }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $etkinlik->district ? $etkinlik->district . ', ' : '' }}{{ $etkinlik->city ?: 'Türkiye' }}
                                </p>
                            </div>
                        </div>

                        @if($etkinlik->location || $etkinlik->city)
                            <div class="pt-4">
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(($etkinlik->location ? $etkinlik->location . ' ' : '') . ($etkinlik->district ? $etkinlik->district . ' ' : '') . ($etkinlik->city ?? '')) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-[#ff5528] text-gray-800 hover:text-white rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    Google Haritalar'da Aç
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- Right Sidebar --}}
            <div class="space-y-6">

                {{-- Action / Summary Card --}}
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-xl shadow-gray-200/50 sticky top-24">
                    <div class="mb-6">
                        <span class="text-xs font-black uppercase tracking-widest text-[#ff5528] block mb-1">Katılım & Giriş</span>
                        <div class="text-3xl font-black text-gray-900">
                            {{ $etkinlik->cost ?: 'Ücretsiz' }}
                        </div>
                    </div>

                    {{-- Meta details list --}}
                    <div class="space-y-4 py-6 border-y border-gray-100 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Kategori</span>
                            <span class="font-bold text-gray-900">{{ $etkinlik->category ?: 'Genel' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Şehir</span>
                            <span class="font-bold text-gray-900">{{ $etkinlik->city ?: 'Belirtilmedi' }}</span>
                        </div>
                        @if($etkinlik->district)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 font-medium">İlçe</span>
                                <span class="font-bold text-gray-900">{{ $etkinlik->district }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Yayınlanma</span>
                            <span class="font-bold text-gray-900">{{ $etkinlik->created_at ? $etkinlik->created_at->diffForHumans() : '-' }}</span>
                        </div>
                    </div>

                    {{-- Paylaş & Aksiyonlar --}}
                    <div class="mt-6 space-y-3">
                        {{-- Copy Link Button --}}
                        <button type="button"
                                @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2500)"
                                class="w-full py-3.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-2xl font-black text-xs uppercase tracking-widest transition flex items-center justify-center gap-2">
                            <template x-if="!copied">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    Bağlantıyı Kopyala
                                </span>
                            </template>
                            <template x-if="copied">
                                <span class="text-emerald-600 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Kopyalandı!
                                </span>
                            </template>
                        </button>

                        {{-- WhatsApp Share --}}
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($etkinlik->title . ' - ' . url()->current()) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="w-full py-3.5 px-4 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest transition flex items-center justify-center gap-2">
                            <span>WhatsApp ile Paylaş</span>
                        </a>

                        {{-- X / Twitter Share --}}
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($etkinlik->title) }}&url={{ urlencode(url()->current()) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="w-full py-3.5 px-4 bg-black hover:bg-gray-800 text-white rounded-2xl font-black text-xs uppercase tracking-widest transition flex items-center justify-center gap-2">
                            <span>X (Twitter)'da Paylaş</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        {{-- Benzer Etkinlikler Section --}}
        @if(isset($relatedEtkinlikler) && $relatedEtkinlikler->count() > 0)
            <div class="mt-20 pt-12 border-t border-gray-200">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <span class="text-[#ff5528] font-black tracking-[0.2em] uppercase text-xs block mb-1">İlgini Çekebilir</span>
                        <h2 class="text-2xl md:text-3xl font-black text-gray-900">Benzer Etkinlikler</h2>
                    </div>
                    <a href="{{ route('etkinlikler.index') }}" class="text-sm font-bold text-[#ff5528] hover:underline">
                        Hepsini Gör &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedEtkinlikler as $rel)
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col hover:shadow-xl transition-all duration-300">
                            <div class="relative h-44 overflow-hidden">
                                <img src="{{ $rel->image ? asset('storage/' . $rel->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=600' }}"
                                     alt="{{ $rel->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-3 left-3 bg-white/95 px-2.5 py-1 rounded-lg text-[10px] font-bold text-[#ff5528] uppercase tracking-wider">
                                    {{ $rel->location ?: ($rel->city ?: 'Planify') }}
                                </div>
                            </div>
                            <div class="p-5 flex flex-col flex-grow">
                                <h3 class="text-base font-bold text-gray-900 group-hover:text-[#ff5528] transition-colors line-clamp-2 mb-2">
                                    {{ $rel->title }}
                                </h3>
                                <div class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-between">
                                    <span class="text-xs font-bold text-emerald-600">{{ $rel->cost ?: 'Ücretsiz' }}</span>
                                    <a href="{{ route('etkinlikler.show', $rel->slug) }}" class="text-xs font-bold text-[#ff5528] hover:underline">
                                        İncele &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
