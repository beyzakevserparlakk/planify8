@extends('admin.layouts.app')

@section('title', 'Etkinlik Yönetimi')
@section('page_title', 'Tüm Etkinlikler')

@section('content')
<div class="space-y-6">

    {{-- Top Action & Filter Strip --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        
        {{-- Status Filter Tabs --}}
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.events.index') }}"
               class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition {{ !request('status') ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'bg-[#16181e] text-gray-400 hover:text-white border border-gray-800' }}">
                Tümü ({{ $counts['all'] }})
            </a>
            <a href="{{ route('admin.events.index', ['status' => 'pending']) }}"
               class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition {{ request('status') === 'pending' ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/25' : 'bg-[#16181e] text-amber-400 hover:bg-amber-500/10 border border-gray-800' }}">
                Bekleyenler ({{ $counts['pending'] }})
            </a>
            <a href="{{ route('admin.events.index', ['status' => 'approved']) }}"
               class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition {{ request('status') === 'approved' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'bg-[#16181e] text-emerald-400 hover:bg-emerald-500/10 border border-gray-800' }}">
                Onaylılar ({{ $counts['approved'] }})
            </a>
            <a href="{{ route('admin.events.index', ['status' => 'rejected']) }}"
               class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition {{ request('status') === 'rejected' ? 'bg-red-600 text-white shadow-lg shadow-red-600/25' : 'bg-[#16181e] text-red-400 hover:bg-red-500/10 border border-gray-800' }}">
                Reddedilenler ({{ $counts['rejected'] }})
            </a>
        </div>

        <a href="{{ route('admin.events.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-wider rounded-xl transition shadow-lg shadow-[#ff5528]/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Yeni Etkinlik Ekle
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="bg-[#16181e] p-4 rounded-2xl border border-gray-800">
        <form method="GET" action="{{ route('admin.events.index') }}" class="flex flex-col sm:flex-row gap-3">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="flex-1 relative">
                <svg class="w-4 h-4 text-gray-500 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Başlık, mekan veya şehir ara..."
                       class="w-full bg-white/5 border border-gray-700/60 rounded-xl py-2.5 pl-11 pr-4 text-xs font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-white/10 hover:bg-white/20 text-white text-xs font-black uppercase rounded-xl transition">
                Filtrele
            </button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.events.index') }}" class="px-4 py-2.5 text-xs text-gray-400 hover:text-white flex items-center justify-center">
                    Sıfırla
                </a>
            @endif
        </form>
    </div>

    {{-- Events Table --}}
    <div class="bg-[#16181e] rounded-3xl border border-gray-800/80 shadow-xl overflow-hidden">
        @if($events->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-white/5 text-gray-400 font-black uppercase tracking-wider text-[10px] border-b border-gray-800">
                            <th class="py-4 px-4">Etkinlik Bilgisi</th>
                            <th class="py-4 px-4">Kategori & Ücret</th>
                            <th class="py-4 px-4">Tarih & Mekan</th>
                            <th class="py-4 px-4">Kaynak & Durum</th>
                            <th class="py-4 px-4 text-right">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 font-medium">
                        @foreach($events as $event)
                            <tr class="hover:bg-white/[0.03] transition">
                                {{-- Görsel ve Başlık --}}
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=100' }}"
                                             alt="{{ $event->title }}"
                                             class="w-12 h-12 rounded-2xl object-cover flex-shrink-0 bg-gray-800">
                                        <div>
                                            <a href="{{ route('etkinlikler.show', $event->slug) }}" target="_blank" class="font-bold text-white hover:text-[#ff5528] line-clamp-1">
                                                {{ $event->title }}
                                            </a>
                                            <div class="text-[10px] text-gray-500 mt-0.5">Slug: {{ $event->slug }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kategori & Ücret --}}
                                <td class="py-4 px-4">
                                    <div class="font-bold text-gray-300">{{ $event->category ?: '-' }}</div>
                                    <div class="text-emerald-400 text-[11px] font-bold">{{ $event->cost ?: 'Ücretsiz' }}</div>
                                </td>

                                {{-- Tarih & Mekan --}}
                                <td class="py-4 px-4">
                                    <div class="text-gray-300 font-bold">{{ $event->date ? $event->date->translatedFormat('d M Y, H:i') : 'Tarih Yok' }}</div>
                                    <div class="text-gray-500 text-[11px]">{{ $event->district ? $event->district . ', ' : '' }}{{ $event->city ?: '-' }}</div>
                                </td>

                                {{-- Kaynak & Durum --}}
                                <td class="py-4 px-4">
                                    <div class="space-y-1">
                                        <div>
                                            @if($event->source_type === 'official')
                                                <span class="px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-400 text-[9px] font-black uppercase">Şehir</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 text-[9px] font-black uppercase">Sosyal</span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($event->status === 'approved')
                                                <span class="px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[9px] font-black uppercase">Onaylı</span>
                                            @elseif($event->status === 'pending')
                                                <span class="px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[9px] font-black uppercase">Bekliyor</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-full bg-red-500/10 text-red-400 border border-red-500/20 text-[9px] font-black uppercase">Red</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- İşlemler --}}
                                <td class="py-4 px-4 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        {{-- Durum Değiştirme Formları --}}
                                        @if($event->status !== 'approved')
                                            <form action="{{ route('admin.events.status', $event->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="px-2.5 py-1 rounded-lg bg-emerald-500/20 hover:bg-emerald-500 text-emerald-400 hover:text-white transition text-[10px] font-black uppercase" title="Onayla">
                                                    Onayla
                                                </button>
                                            </form>
                                        @endif

                                        @if($event->status !== 'rejected')
                                            <form action="{{ route('admin.events.status', $event->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="px-2.5 py-1 rounded-lg bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white transition text-[10px] font-black uppercase" title="Reddet">
                                                    Reddet
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Düzenle --}}
                                        <a href="{{ route('admin.events.edit', $event->id) }}"
                                           class="p-2 rounded-xl bg-white/5 hover:bg-white/15 text-gray-300 hover:text-white transition"
                                           title="Düzenle">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        {{-- Sil --}}
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Bu etkinliği kalıcı olarak silmek istediğinizden emin misiniz?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white transition" title="Sil">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-800 flex justify-center">
                {{ $events->links() }}
            </div>
        @else
            <div class="text-center py-16 text-gray-500 text-xs">
                Filtreleme kriterlerine uygun etkinlik bulunamadı.
            </div>
        @endif
    </div>

</div>
@endsection
