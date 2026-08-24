@extends('admin.layouts.app')

@section('title', 'Etkinliği Düzenle')
@section('page_title', 'Etkinlik Düzenle: ' . $event->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.events.index') }}" class="text-xs font-bold text-gray-400 hover:text-white flex items-center gap-1.5">
            &larr; Etkinlik Listesine Dön
        </a>
        <a href="{{ route('etkinlikler.show', $event->slug) }}" target="_blank" class="text-xs font-bold text-[#ff5528] hover:underline flex items-center gap-1">
            <span>Sitede Görüntüle</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        </a>
    </div>

    <div class="bg-[#16181e] p-8 md:p-10 rounded-3xl border border-gray-800 shadow-xl"
         x-data="{
             selectedCity: '{{ old('city', $event->city) }}',
             selectedDistrict: '{{ old('district', $event->district) }}',
             allDistricts: {{ json_encode($allDistricts) }},
             get filteredDistricts() {
                 if (!this.selectedCity) return [];
                 return this.allDistricts.filter(d => d.city && d.city.name === this.selectedCity);
             }
         }">
        
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Başlık *</label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
                @error('title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Source Type & Status --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Kaynak Tipi *</label>
                    <select name="source_type" required class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                        <option value="official" {{ old('source_type', $event->source_type) === 'official' ? 'selected' : '' }} class="bg-gray-900">🏛️ Şehir Resmi Duyurusu</option>
                        <option value="user" {{ old('source_type', $event->source_type) === 'user' ? 'selected' : '' }} class="bg-gray-900">🙋 Topluluk & Sosyal Plan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Durum *</label>
                    <select name="status" required class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                        <option value="approved" {{ old('status', $event->status) === 'approved' ? 'selected' : '' }} class="bg-gray-900">✅ Onaylı (Yayında)</option>
                        <option value="pending" {{ old('status', $event->status) === 'pending' ? 'selected' : '' }} class="bg-gray-900">⏳ Onay Bekliyor</option>
                        <option value="rejected" {{ old('status', $event->status) === 'rejected' ? 'selected' : '' }} class="bg-gray-900">❌ Reddedildi</option>
                    </select>
                </div>
            </div>

            {{-- Category & Cost --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Kategori</label>
                    <select name="category" class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                        <option value="" class="bg-gray-900">Kategori Seçin</option>
                        @foreach(['Date & Romantik Mekanlar', 'Kahve & Sohbet Mekanları', 'Arkadaş Buluşması & Eğlence', 'Konser & Canlı Müzik', 'Tiyatro & Gösteri', 'Sinema & Film', 'Sergi & Kültür-Sanat', 'Atölye & Workshop', 'Spor & Doğa', 'Yeme & İçme & Gastronomi', 'Festival & Açık Hava', 'Kutu Oyunları & Aktivite', 'Stand-Up & Komedi', 'Diğer Deneyimler'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $event->category) == $cat ? 'selected' : '' }} class="bg-gray-900">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Ücret</label>
                    <input type="text" name="cost" value="{{ old('cost', $event->cost) }}" placeholder="Örn: Ücretsiz, 250 TL"
                           class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
                </div>
            </div>

            {{-- Date & Time --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Etkinlik Tarihi</label>
                <input type="datetime-local" name="date" value="{{ old('date', $event->date ? $event->date->format('Y-m-d\TH:i') : '') }}"
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
            </div>

            {{-- City & District --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Şehir</label>
                    <select name="city" x-model="selectedCity" class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                        <option value="" class="bg-gray-900">Şehir Seçin</option>
                        @foreach($cities as $id => $name)
                            <option value="{{ $name }}" class="bg-gray-900">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">İlçe</label>
                    <input type="text" name="district" value="{{ old('district', $event->district) }}" placeholder="İlçe adı"
                           class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                </div>
            </div>

            {{-- Location --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Mekan / Açık Adres</label>
                <input type="text" name="location" value="{{ old('location', $event->location) }}"
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
            </div>

            {{-- Image --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Afiş / Görsel</label>
                @if($event->image)
                    <div class="mb-3 flex items-center gap-3">
                        <img src="{{ asset('storage/' . $event->image) }}" class="h-20 w-32 rounded-xl object-cover border border-gray-700" alt="Mevcut Görsel">
                        <span class="text-xs text-gray-400">Yeni bir görsel seçerseniz eskisiyle değiştirilecektir.</span>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:bg-[#ff5528] file:text-white hover:file:bg-black">
            </div>

            {{-- Content --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Açıklama / İçerik</label>
                <textarea name="content" rows="6"
                          class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">{{ old('content', $event->content) }}</textarea>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('admin.events.index') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white text-xs font-bold">İptal</a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-wider transition shadow-lg shadow-[#ff5528]/25">
                    Değişiklikleri Kaydet
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
