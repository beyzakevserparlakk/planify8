@extends('admin.layouts.app')

@section('title', 'Gelen İletişim Mesajları')
@section('page_title', 'Gelen İletişim Mesajları')

@section('content')
<div class="space-y-6">

    {{-- Üst Başlık & Filtreler --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-white">İletişim Formu Mesajları</h2>
            <p class="text-xs text-gray-400 font-medium mt-1">Ziyaretçilerin iletişim sayfasından gönderdiği tüm mesajlar</p>
        </div>

        {{-- Filtre Butonları --}}
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.messages.index', ['status' => 'all']) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $status === 'all' ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'bg-[#16181e] text-gray-400 hover:text-white border border-gray-800' }}">
                Tümü ({{ $totalCount }})
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $status === 'unread' ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'bg-[#16181e] text-gray-400 hover:text-white border border-gray-800' }}">
                <span>Okunmamış</span>
                @if($unreadCount > 0)
                    <span class="px-1.5 py-0.5 rounded-full bg-red-500 text-white text-[10px] font-black leading-none">{{ $unreadCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'read']) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $status === 'read' ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'bg-[#16181e] text-gray-400 hover:text-white border border-gray-800' }}">
                Okunmuş
            </a>
        </div>
    </div>

    {{-- Mesaj Tablosu --}}
    <div class="bg-[#16181e] rounded-3xl overflow-hidden border border-gray-800 shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-gray-800 text-gray-400 font-black uppercase tracking-wider text-[11px] bg-white/[0.02]">
                        <th class="py-4 px-6">Durum</th>
                        <th class="py-4 px-6">Gönderen</th>
                        <th class="py-4 px-6">Konu & Özet</th>
                        <th class="py-4 px-6">Tarih</th>
                        <th class="py-4 px-6 text-right">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/60">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-white/[0.02] transition {{ !$msg->is_read ? 'bg-[#ff5528]/[0.03]' : '' }}">
                            
                            {{-- Durum Rozeti --}}
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if(!$msg->is_read)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-[#ff5528]/20 text-[#ff5528] text-[10px] font-black uppercase tracking-wider border border-[#ff5528]/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#ff5528] animate-pulse"></span>
                                        Yeni
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gray-800 text-gray-400 text-[10px] font-bold uppercase tracking-wider">
                                        Okundu
                                    </span>
                                @endif
                            </td>

                            {{-- Gönderen Bilgisi --}}
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="font-black text-white text-sm">{{ $msg->name }}</div>
                                <div class="text-gray-400 text-xs mt-0.5 flex items-center gap-2">
                                    <a href="mailto:{{ $msg->email }}" class="hover:text-[#ff5528] transition">{{ $msg->email }}</a>
                                    @if($msg->phone)
                                        <span>•</span>
                                        <span class="text-gray-500">{{ $msg->phone }}</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Konu & Mesaj Önizleme --}}
                            <td class="py-4 px-6">
                                <div class="font-bold text-gray-200 line-clamp-1">{{ $msg->subject ?: 'Konu Belirtilmemiş' }}</div>
                                <div class="text-gray-400 text-xs line-clamp-1 mt-0.5">{{ $msg->message }}</div>
                            </td>

                            {{-- Tarih --}}
                            <td class="py-4 px-6 whitespace-nowrap text-gray-400 font-medium">
                                <div>{{ $msg->created_at ? $msg->created_at->translatedFormat('d M Y') : '-' }}</div>
                                <div class="text-[10px] text-gray-500">{{ $msg->created_at ? $msg->created_at->format('H:i') : '' }}</div>
                            </td>

                            {{-- İşlemler --}}
                            <td class="py-4 px-6 whitespace-nowrap text-right space-x-2">
                                <a href="{{ route('admin.messages.show', $msg->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 bg-[#ff5528] hover:bg-white hover:text-black text-white rounded-xl text-xs font-black uppercase tracking-wider transition">
                                    Görüntüle
                                </a>

                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bu mesajı silmek istediğinizden emin misiniz?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-400 rounded-lg hover:bg-red-500/10 transition" title="Sil">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-500 text-xs">
                                Henüz bu filtreye uygun bir mesaj bulunmuyor.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="p-4 border-t border-gray-800">
                {{ $messages->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
