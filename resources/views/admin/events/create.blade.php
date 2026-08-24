@extends('admin.layouts.app')

@section('title', 'Yeni Etkinlik Ekle')
@section('page_title', 'Etkinlik Oluştur (Yönetici)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.events.index') }}" class="text-xs font-bold text-gray-400 hover:text-white flex items-center gap-1.5">
            &larr; Etkinlik Listesine Dön
        </a>
    </div>

    <div class="bg-[#16181e] p-8 md:p-10 rounded-3xl border border-gray-800 shadow-xl"
         x-data="{
             selectedCity: '{{ old('city_id', '') }}',
             selectedDistrict: '{{ old('district_id', '') }}',
             allDistricts: {{ json_encode($allDistricts) }},
             get filteredDistricts() {
                 if (!this.selectedCity) return [];
                 return this.allDistricts.filter(d => String(d.city_id) === String(this.selectedCity));
             }
         }">
        
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Başlık *</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Etkinlik başlığı"
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
                @error('title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Source Type & Status --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Kaynak Tipi *</label>
                    <select name="source_type" required class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                        <option value="official" {{ old('source_type') === 'official' ? 'selected' : '' }} class="bg-gray-900">🏛️ Şehir Resmi Duyurusu</option>
                        <option value="user" {{ old('source_type') === 'user' ? 'selected' : '' }} class="bg-gray-900">🙋 Topluluk & Sosyal Plan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Durum *</label>
                    <select name="status" required class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                        <option value="approved" {{ old('status', 'approved') === 'approved' ? 'selected' : '' }} class="bg-gray-900">✅ Onaylı (Yayında)</option>
                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }} class="bg-gray-900">⏳ Onay Bekliyor</option>
                        <option value="rejected" {{ old('status') === 'rejected' ? 'selected' : '' }} class="bg-gray-900">❌ Reddedildi</option>
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
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }} class="bg-gray-900">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Ücret</label>
                    <input type="text" name="cost" value="{{ old('cost') }}" placeholder="Örn: Ücretsiz, 250 TL"
                           class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
                </div>
            </div>

            {{-- Date & Time --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Etkinlik Tarihi</label>
                <input type="datetime-local" name="date" value="{{ old('date') }}"
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
            </div>

            {{-- City & District --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Şehir</label>
                    <select name="city_id" x-model="selectedCity" class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                        <option value="" class="bg-gray-900">Şehir Seçin</option>
                        @foreach($cities as $id => $name)
                            <option value="{{ $id }}" class="bg-gray-900">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">İlçe</label>
                    <select name="district_id" x-model="selectedDistrict" class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                        <option value="" class="bg-gray-900">İlçe Seçin</option>
                        <template x-for="district in filteredDistricts" :key="district.id">
                            <option :value="district.id" x-text="district.name" class="bg-gray-900"></option>
                        </template>
                    </select>
                </div>
            </div>

            {{-- Location --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Mekan / Açık Adres</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="Mekan adı veya adresi"
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
            </div>

            {{-- Image --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Afiş / Görsel (Maks. 2MB)</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:bg-[#ff5528] file:text-white hover:file:bg-black">
            </div>

            {{-- Content --}}
            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Açıklama / İçerik</label>
                <textarea name="content" rows="6" placeholder="Etkinlik açıklaması..."
                          class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">{{ old('content') }}</textarea>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('admin.events.index') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white text-xs font-bold">İptal</a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-wider transition shadow-lg shadow-[#ff5528]/25">
                    Kaydet ve Yayınla
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
