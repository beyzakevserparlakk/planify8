@extends('admin.layouts.app')

@section('title', 'Mesaj Detayı — ' . $message->name)
@section('page_title', 'İletişim Mesajı Detayı')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Geri Dön & Aksiyonlar --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.messages.index') }}"
           class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-gray-400 hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Tüm Mesajlara Dön
        </a>

        <div class="flex items-center gap-3">
            <form action="{{ route('admin.messages.toggleRead', $message->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition border {{ $message->is_read ? 'bg-white/5 border-gray-700 text-gray-300 hover:bg-white/10' : 'bg-[#ff5528] border-transparent text-white' }}">
                    {{ $message->is_read ? 'Okunmadı Olarak İşaretle' : 'Okundu Olarak İşaretle' }}
                </button>
            </form>

            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Bu mesajı silmek istediğinizden emin misiniz?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-xl text-xs font-bold transition border border-red-500/30">
                    Sil
                </button>
            </form>
        </div>
    </div>

    {{-- Mesaj Kartı --}}
    <div class="bg-[#16181e] rounded-3xl p-8 border border-gray-800 shadow-xl space-y-6">
        
        {{-- Üst Bilgi Başlığı --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-gray-800 gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#ff5528] to-amber-500 text-white font-black text-xl flex items-center justify-center shadow-lg shadow-[#ff5528]/20">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-lg font-black text-white">{{ $message->name }}</h2>
                    <div class="text-xs text-gray-400 mt-0.5 flex flex-wrap items-center gap-2">
                        <a href="mailto:{{ $message->email }}" class="text-[#ff5528] hover:underline font-bold">{{ $message->email }}</a>
                        @if($message->phone)
                            <span>•</span>
                            <a href="tel:{{ $message->phone }}" class="text-gray-300 hover:text-white font-medium">{{ $message->phone }}</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-right text-xs text-gray-400 font-medium">
                <div>{{ $message->created_at ? $message->created_at->translatedFormat('d F Y, H:i') : '' }}</div>
                @if($message->ip_address)
                    <div class="text-[10px] text-gray-500 mt-1">IP: {{ $message->ip_address }}</div>
                @endif
            </div>
        </div>

        {{-- Konu --}}
        <div>
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#ff5528] block mb-1">Konu</span>
            <h3 class="text-base font-black text-white">{{ $message->subject ?: 'Konu Belirtilmemiş' }}</h3>
        </div>

        {{-- Mesaj İçeriği --}}
        <div class="bg-[#0f1115] p-6 rounded-2xl border border-gray-800/80 text-sm font-medium text-gray-200 leading-relaxed whitespace-pre-wrap">{{ $message->message }}</div>

        {{-- Hızlı Yanıt Aksiyonu --}}
        <div class="pt-4 border-t border-gray-800 flex items-center justify-between">
            <a href="mailto:{{ $message->email }}?subject=Planify İletişim: {{ rawurlencode($message->subject ?? '') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-wider rounded-xl transition shadow-lg shadow-[#ff5528]/25">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>E-posta ile Yanıtla</span>
            </a>

            @if($message->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank"
                   class="inline-flex items-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-black uppercase tracking-wider rounded-xl transition">
                    <span>WhatsApp ile Ulaş 💬</span>
                </a>
            @endif
        </div>

    </div>

</div>
@endsection
