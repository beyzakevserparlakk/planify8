@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#fcfcfc] text-gray-900 pb-24"
     x-data="{
         title: '{{ old('title', '') }}',
         category: '{{ old('category', '') }}',
         cost: '{{ old('cost', '') }}',
         date: '{{ old('date', '') }}',
         location: '{{ old('location', '') }}',
         selectedCity: '{{ old('city_id', '') }}',
         selectedDistrict: '{{ old('district_id', '') }}',
         allDistricts: {{ json_encode($allDistricts) }},
         imagePreview: null,
         get filteredDistricts() {
             if (!this.selectedCity) return [];
             return this.allDistricts.filter(d => String(d.city_id) === String(this.selectedCity));
         },
         handleFileChange(event) {
             const file = event.target.files[0];
             if (file) {
                 const reader = new FileReader();
                 reader.onload = (e) => {
                     this.imagePreview = e.target.result;
                 };
                 reader.readAsDataURL(file);
             } else {
                 this.imagePreview = null;
             }
         }
     }">

    {{-- 1. DARK HERO / BANNER --}}
    <section class="relative pt-12 pb-20 md:pt-16 md:pb-24 overflow-hidden border-b border-gray-900 text-white"
             style="background: radial-gradient(circle at 50% 20%, #1f1412 0%, #0d0e10 70%);">
        
        {{-- Ambient Glows --}}
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-[#ff5528]/15 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            
            {{-- Breadcrumb & Badge --}}
            <div class="flex items-center justify-between mb-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-[#ff5528] animate-pulse"></span>
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-[#ff5528]">Toplulukla Paylaş</span>
                    <span class="text-gray-600">•</span>
                    <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Ana Sayfa</a>
                        <span class="text-gray-600">/</span>
                        <a href="{{ route('etkinlikler.index') }}" class="hover:text-white transition-colors">Etkinlikler</a>
                        <span class="text-gray-600">/</span>
                        <span class="text-white font-bold">Yeni Plan</span>
                    </div>
                </div>

                <a href="{{ route('etkinlikler.index') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Vazgeç ve Dön
                </a>
            </div>

            {{-- Heading --}}
            <div class="max-w-3xl">
                <h1 class="text-3xl sm:text-5xl md:text-6xl font-black tracking-tight text-white leading-tight">
                    Yeni Bir Plan <br class="hidden sm:inline"/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff5528] via-orange-400 to-amber-300">
                        Oluştur ve Paylaş
                    </span>
                </h1>
                <p class="text-gray-400 text-sm md:text-base mt-3 font-medium leading-relaxed max-w-2xl">
                    Düzenlediğin konseri, workshop'u, tiyatroyu veya sosyal buluşmayı Planify topluluğuna duyur. Planın anında yayına alınacaktır.
                </p>
            </div>

        </div>
    </section>

    {{-- 2. MAIN FORM & LIVE PREVIEW CONTAINER --}}
    <main class="max-w-7xl mx-auto px-6 -mt-8 relative z-20">
        
        {{-- Error Alert --}}
        @if (isset($errors) && $errors->any())
            <div class="mb-8 p-5 bg-red-50 border-2 border-red-200 rounded-3xl text-red-700 shadow-sm">
                <div class="flex items-center gap-3 font-bold mb-2">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Lütfen formdaki eksik veya hatalı alanları düzeltin:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 pl-2 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('etkinlikler.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- LEFT COLUMN: FORM FIELDS (8 COLS) --}}
                <div class="lg:col-span-8 space-y-8">
                    
                    {{-- 1. GENEL BİLGİLER KARTI --}}
                    <div class="bg-white rounded-3xl p-8 md:p-10 border border-gray-200/80 shadow-[0_10px_35px_rgba(0,0,0,0.03)]">
                        <div class="flex items-center gap-3 pb-6 mb-6 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-2xl bg-[#ff5528]/10 text-[#ff5528] flex items-center justify-center font-black">
                                01
                            </div>
                            <div>
                                <h2 class="text-lg font-black text-gray-900">Etkinlik Temel Bilgileri</h2>
                                <p class="text-xs text-gray-400 font-medium">Başlık, kategori ve katılım ücretini belirleyin</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            {{-- Başlık --}}
                            <div>
                                <label for="title" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                    Etkinlik Başlığı <span class="text-[#ff5528]">*</span>
                                </label>
                                <input type="text"
                                       id="title"
                                       name="title"
                                       x-model="title"
                                       value="{{ old('title') }}"
                                       placeholder="Örn: Akustik Gece Konseri veya Seramik Atölyesi"
                                       required
                                       class="w-full bg-gray-50 border-2 border-gray-200 focus:bg-white focus:border-[#ff5528] rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 outline-none transition">
                            </div>

                            {{-- Kategori & Ücret Grid --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="category" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                        Kategori
                                    </label>
                                    <select id="category"
                                            name="category"
                                            x-model="category"
                                            class="w-full bg-gray-50 border-2 border-gray-200 focus:bg-white focus:border-[#ff5528] rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 outline-none transition cursor-pointer">
                                        <option value="">Kategori Seçin</option>
                                        @php
                                            $categories = [
                                                'Date & Romantik Mekanlar',
                                                'Kahve & Sohbet Mekanları',
                                                'Arkadaş Buluşması & Eğlence',
                                                'Konser & Canlı Müzik',
                                                'Tiyatro & Gösteri',
                                                'Sinema & Film',
                                                'Sergi & Kültür-Sanat',
                                                'Atölye & Workshop',
                                                'Spor & Doğa',
                                                'Yeme & İçme & Gastronomi',
                                                'Festival & Açık Hava',
                                                'Kutu Oyunları & Aktivite',
                                                'Stand-Up & Komedi',
                                                'Diğer Deneyimler'
                                            ];
                                        @endphp
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="cost" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                        Katılım Ücreti
                                    </label>
                                    <input type="text"
                                           id="cost"
                                           name="cost"
                                           x-model="cost"
                                           value="{{ old('cost') }}"
                                           placeholder="Örn: Ücretsiz, 250 TL, Bağış"
                                           class="w-full bg-gray-50 border-2 border-gray-200 focus:bg-white focus:border-[#ff5528] rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 outline-none transition">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. TARİH VE KONUM KARTI --}}
                    <div class="bg-white rounded-3xl p-8 md:p-10 border border-gray-200/80 shadow-[0_10px_35px_rgba(0,0,0,0.03)]">
                        <div class="flex items-center gap-3 pb-6 mb-6 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-2xl bg-[#ff5528]/10 text-[#ff5528] flex items-center justify-center font-black">
                                02
                            </div>
                            <div>
                                <h2 class="text-lg font-black text-gray-900">Tarih, Saat ve Konum</h2>
                                <p class="text-xs text-gray-400 font-medium">Etkinliğin gerçekleşeceği zaman ve yer bilgileri</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            {{-- Tarih & Saat --}}
                            <div>
                                <label for="date" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                    Tarih ve Başlangıç Saati
                                </label>
                                <input type="datetime-local"
                                       id="date"
                                       name="date"
                                       x-model="date"
                                       value="{{ old('date') }}"
                                       class="w-full bg-gray-50 border-2 border-gray-200 focus:bg-white focus:border-[#ff5528] rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 outline-none transition">
                            </div>

                            {{-- Şehir & İlçe --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="city_id" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                        Şehir
                                    </label>
                                    <select id="city_id"
                                            name="city_id"
                                            x-model="selectedCity"
                                            @change="selectedDistrict = ''"
                                            class="w-full bg-gray-50 border-2 border-gray-200 focus:bg-white focus:border-[#ff5528] rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 outline-none transition cursor-pointer">
                                        <option value="">Şehir Seçin</option>
                                        @foreach($cities as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="district_id" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                        İlçe
                                    </label>
                                    <select id="district_id"
                                            name="district_id"
                                            x-model="selectedDistrict"
                                            :disabled="!selectedCity"
                                            :class="!selectedCity ? 'opacity-50 cursor-not-allowed bg-gray-100' : 'cursor-pointer'"
                                            class="w-full bg-gray-50 border-2 border-gray-200 focus:bg-white focus:border-[#ff5528] rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 outline-none transition">
                                        <option value="" x-text="!selectedCity ? 'Önce şehir seçin' : 'İlçe Seçin'"></option>
                                        <template x-for="district in filteredDistricts" :key="district.id">
                                            <option :value="district.id" x-text="district.name" :selected="String(district.id) === String(selectedDistrict)"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            {{-- Mekan Adı / Açık Adres --}}
                            <div>
                                <label for="location" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                    Mekan Adı veya Açık Adres
                                </label>
                                <input type="text"
                                       id="location"
                                       name="location"
                                       x-model="location"
                                       value="{{ old('location') }}"
                                       placeholder="Örn: KüçükÇiftlik Park, Kadıköy Sahil veya Çevrimiçi"
                                       class="w-full bg-gray-50 border-2 border-gray-200 focus:bg-white focus:border-[#ff5528] rounded-2xl px-5 py-4 text-sm font-bold text-gray-900 outline-none transition">
                            </div>
                        </div>
                    </div>

                    {{-- 3. GÖRSEL VE DETAYLI AÇIKLAMA KARTI --}}
                    <div class="bg-white rounded-3xl p-8 md:p-10 border border-gray-200/80 shadow-[0_10px_35px_rgba(0,0,0,0.03)]">
                        <div class="flex items-center gap-3 pb-6 mb-6 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-2xl bg-[#ff5528]/10 text-[#ff5528] flex items-center justify-center font-black">
                                03
                            </div>
                            <div>
                                <h2 class="text-lg font-black text-gray-900">Afiş ve Detaylı Açıklama</h2>
                                <p class="text-xs text-gray-400 font-medium">Katılımcıların ilgisini çekecek fotoğraf ve program detayları</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            {{-- Afiş Yükleme Dropzone --}}
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                    Etkinlik Afişi / Fotoğrafı (Maks. 2MB)
                                </label>
                                <div class="relative border-2 border-dashed border-gray-300 hover:border-[#ff5528] rounded-3xl p-8 text-center transition group cursor-pointer bg-gray-50/60 hover:bg-[#ff5528]/5">
                                    <input type="file"
                                           id="image"
                                           name="image"
                                           accept="image/*"
                                           @change="handleFileChange($event)"
                                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                                    
                                    <template x-if="!imagePreview">
                                        <div class="flex flex-col items-center justify-center py-4">
                                            <div class="w-16 h-16 mb-4 rounded-2xl bg-white shadow-sm group-hover:bg-[#ff5528] text-gray-400 group-hover:text-white flex items-center justify-center transition-all duration-300">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-bold text-gray-900">Afiş seçmek için tıklayın veya sürükleyin</p>
                                            <p class="text-xs text-gray-400 mt-1 font-medium">JPG, PNG veya WEBP formatları desteklenir</p>
                                        </div>
                                    </template>

                                    <template x-if="imagePreview">
                                        <div class="relative z-10 flex flex-col items-center">
                                            <img :src="imagePreview" alt="Afiş Önizleme" class="h-52 w-auto max-w-full rounded-2xl object-cover shadow-lg">
                                            <span class="mt-3 inline-block px-4 py-1.5 bg-gray-900/80 text-white text-xs font-bold rounded-full">Görseli değiştirmek için tıklayın</span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            {{-- Açıklama --}}
                            <div>
                                <label for="description" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                    Detaylı Bilgi & Katılım Şartları
                                </label>
                                <textarea id="description"
                                          name="description"
                                          rows="6"
                                          placeholder="Etkinlik hakkında detaylı bilgi verin... Program akışı, yaş sınırı, kapı açılış saati veya yanınızda getirmeniz gerekenler."
                                          class="w-full bg-gray-50 border-2 border-gray-200 focus:bg-white focus:border-[#ff5528] rounded-2xl p-5 text-sm font-medium text-gray-900 outline-none transition">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT COLUMN: LIVE CARD PREVIEW & PUBLISH ACTION (4 COLS) --}}
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">
                    
                    {{-- CANLI KART ÖNİZLEME (DICE / EVENTBRITE PREVIEW) --}}
                    <div class="bg-white rounded-3xl p-6 border border-gray-200/80 shadow-[0_10px_35px_rgba(0,0,0,0.03)]">
                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100">
                            <span class="text-[11px] font-black uppercase tracking-wider text-[#ff5528] flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-[#ff5528] animate-pulse"></span>
                                Canlı Kart Önizlemesi
                            </span>
                            <span class="text-[10px] font-bold text-gray-400">Anlık Görünüm</span>
                        </div>

                        {{-- Önizleme Kartı --}}
                        <div class="group bg-[#16181d] rounded-2xl overflow-hidden shadow-xl border border-white/5 flex flex-col text-white">
                            <div class="relative h-48 overflow-hidden bg-gray-900 flex-shrink-0">
                                <img :src="imagePreview || 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=600'"
                                     alt="Önizleme"
                                     class="w-full h-full object-cover">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-[#16181d] via-black/20 to-transparent"></div>

                                {{-- Date Badge --}}
                                <div class="absolute top-3 left-3 bg-white text-gray-900 rounded-xl shadow-lg overflow-hidden text-center min-w-[48px]">
                                    <div class="bg-[#ff5528] text-white text-[9px] font-black uppercase py-0.5 px-2">
                                        PLAN
                                    </div>
                                    <div class="py-1 px-1.5 text-base font-black leading-none text-gray-900" x-text="date ? new Date(date).getDate() : '📅'">
                                    </div>
                                </div>

                                {{-- Category Badge --}}
                                <div class="absolute bottom-3 left-3">
                                    <span class="bg-black/80 text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full backdrop-blur-md"
                                          x-text="category || 'Etkinlik'"></span>
                                </div>

                                {{-- Price Badge --}}
                                <div class="absolute bottom-3 right-3">
                                    <span class="bg-emerald-500 text-white text-[10px] font-black px-2.5 py-0.5 rounded-full"
                                          x-text="cost || 'Ücretsiz'"></span>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="text-xs text-gray-400 mb-2 font-medium" x-text="location || 'Mekan belirtilmedi'"></div>
                                <h3 class="text-base font-black text-white line-clamp-2 mb-4 leading-tight"
                                    x-text="title || 'Etkinlik Başlığı Buraya Gelecek'"></h3>
                                
                                <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs text-[#ff5528] font-bold">
                                    <span>Planify Topluluğu</span>
                                    <span>İncele &rarr;</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- YAYINLA AKSİYON KARTI --}}
                    <div class="bg-white rounded-3xl p-6 border border-gray-200/80 shadow-xl shadow-gray-200/50 space-y-4">
                        <button type="submit"
                                class="w-full py-4 bg-[#ff5528] hover:bg-black text-white rounded-2xl font-black text-sm uppercase tracking-widest transition-all duration-300 shadow-xl shadow-[#ff5528]/25 hover:shadow-none flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                            Planı Yayınla
                        </button>

                        <p class="text-[11px] text-gray-400 text-center font-medium leading-relaxed">
                            Paylaş butonuna bastığınızda etkinliğiniz onaylanarak anında listelenmeye başlayacaktır.
                        </p>
                    </div>

                </div>

            </div>
        </form>

    </main>

</div>
@endsection
