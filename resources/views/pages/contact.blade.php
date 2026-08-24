@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#fcfcfc] text-gray-900">

    {{-- 1. HERO SECTION --}}
    <section class="relative pt-16 pb-20 md:pt-24 md:pb-28 overflow-hidden border-b border-gray-900 text-white"
             style="background: radial-gradient(circle at 50% 20%, #1f1412 0%, #0d0e10 70%);">
        
        {{-- Ambient Glows --}}
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[#ff5528]/15 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute top-0 right-10 w-96 h-96 bg-indigo-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col items-center text-center">
                {{-- Badge & Breadcrumb --}}
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-6">
                    <span class="w-2 h-2 rounded-full bg-[#ff5528] animate-pulse"></span>
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] text-[#ff5528]">Bize Ulaşın</span>
                    <span class="text-gray-600">•</span>
                    <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Ana Sayfa</a>
                        <span class="text-gray-600">/</span>
                        <span class="text-white font-bold">İletişim</span>
                    </div>
                </div>

                {{-- Hero Heading --}}
                <h1 class="text-4xl sm:text-6xl md:text-7xl font-black tracking-tight leading-[1.1] text-white max-w-3xl">
                    Bizimle <br class="hidden sm:inline"/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff5528] via-orange-400 to-amber-300">
                        İletişime Geçin
                    </span>
                </h1>
                
                <p class="text-gray-400 text-sm md:text-lg mt-4 max-w-2xl font-medium leading-relaxed">
                    {{ $siteSettings['contact_description'] ?? 'Planify ekibi olarak soru, öneri, sponsorluk ve etkinlik ortaklığı taleplerinizi dinlemek için buradayız.' }}
                </p>
            </div>
        </div>
    </section>

    {{-- 2. MAIN CONTENT: INFO CARDS & CONTACT FORM --}}
    <section class="max-w-7xl mx-auto px-6 py-16 -mt-8 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            {{-- SOL KOLON: İletişim Bilgi Kartları & Sosyal Medya (5 col) --}}
            <div class="lg:col-span-5 space-y-6">

                {{-- Telefon & WhatsApp Kartı --}}
                <div class="bg-white rounded-3xl p-7 border border-gray-200/80 shadow-[0_10px_35px_rgba(0,0,0,0.04)] hover:shadow-xl transition-all duration-300 flex items-start gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 text-2xl border border-emerald-200/60">
                        📞
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 block mb-1">Doğrudan İletişim</span>
                        <h4 class="text-base font-black text-gray-900">Telefon & Destek Hattı</h4>
                        <div class="mt-2 space-y-1 text-xs font-bold text-gray-700">
                            @if(!empty($siteSettings['contact_phone']))
                                <div>
                                    <span class="text-gray-400 font-medium">Sabit Tel:</span>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['contact_phone']) }}" class="hover:text-[#ff5528] transition ml-1">
                                        {{ $siteSettings['contact_phone'] }}
                                    </a>
                                </div>
                            @endif
                            @if(!empty($siteSettings['contact_whatsapp']))
                                <div>
                                    <span class="text-gray-400 font-medium">WhatsApp:</span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_whatsapp']) }}" target="_blank" class="hover:text-emerald-600 transition ml-1 text-emerald-600">
                                        {{ $siteSettings['contact_whatsapp'] }} 💬
                                    </a>
                                </div>
                            @endif
                            @if(empty($siteSettings['contact_phone']) && empty($siteSettings['contact_whatsapp']))
                                <p class="text-xs text-gray-500 font-medium">+90 (212) 555 01 23</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- E-posta Kartı --}}
                <div class="bg-white rounded-3xl p-7 border border-gray-200/80 shadow-[0_10px_35px_rgba(0,0,0,0.04)] hover:shadow-xl transition-all duration-300 flex items-start gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0 text-2xl border border-indigo-200/60">
                        ✉️
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 block mb-1">E-posta İletişimi</span>
                        <h4 class="text-base font-black text-gray-900">Yazılı Destek</h4>
                        <p class="text-xs text-gray-500 font-medium mt-1">Sorularınız için e-posta gönderebilirsiniz:</p>
                        <a href="mailto:{{ $siteSettings['contact_email'] ?? 'destek@planify.com' }}"
                           class="inline-block mt-2 text-xs font-black text-[#ff5528] hover:underline">
                            {{ $siteSettings['contact_email'] ?? 'destek@planify.com' }}
                        </a>
                    </div>
                </div>

                {{-- Çalışma Saatleri Kartı --}}
                <div class="bg-white rounded-3xl p-7 border border-gray-200/80 shadow-[0_10px_35px_rgba(0,0,0,0.04)] hover:shadow-xl transition-all duration-300 flex items-start gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 text-2xl border border-amber-200/60">
                        ⏰
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-600 block mb-1">Çalışma Saatleri</span>
                        <h4 class="text-base font-black text-gray-900">Ofis ve Müşteri Destek</h4>
                        <p class="text-xs text-gray-500 font-medium mt-1.5 leading-relaxed">
                            {{ $siteSettings['contact_working_hours'] ?? 'Pazartesi - Cuma: 09:00 - 18:00' }}
                        </p>
                    </div>
                </div>

                {{-- Sosyal Medya Kutusu --}}
                <div class="bg-[#16181e] text-white rounded-3xl p-7 shadow-xl border border-gray-800">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#ff5528] block mb-2">Sosyal Ağlar</span>
                    <h4 class="text-base font-black text-white mb-2">Bizi Sosyal Medyada Takip Edin</h4>
                    <p class="text-xs text-gray-400 font-medium mb-5">En taze etkinlik haberleri ve anlık duyurular için hesaplarımıza göz atın.</p>
                    
                    <div class="flex flex-wrap gap-2.5">
                        @if(!empty($siteSettings['social_instagram']))
                            <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" rel="noopener noreferrer"
                               class="px-4 py-2.5 rounded-xl bg-white/5 hover:bg-[#ff5528] text-gray-300 hover:text-white border border-white/10 text-xs font-bold transition-all flex items-center gap-2">
                                <span>📸 Instagram</span>
                            </a>
                        @endif

                        @if(!empty($siteSettings['social_twitter']))
                            <a href="{{ $siteSettings['social_twitter'] }}" target="_blank" rel="noopener noreferrer"
                               class="px-4 py-2.5 rounded-xl bg-white/5 hover:bg-[#ff5528] text-gray-300 hover:text-white border border-white/10 text-xs font-bold transition-all flex items-center gap-2">
                                <span>𝕏 Twitter</span>
                            </a>
                        @endif

                        @if(!empty($siteSettings['social_youtube']))
                            <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" rel="noopener noreferrer"
                               class="px-4 py-2.5 rounded-xl bg-white/5 hover:bg-[#ff5528] text-gray-300 hover:text-white border border-white/10 text-xs font-bold transition-all flex items-center gap-2">
                                <span>📺 YouTube</span>
                            </a>
                        @endif

                        @if(!empty($siteSettings['social_linkedin']))
                            <a href="{{ $siteSettings['social_linkedin'] }}" target="_blank" rel="noopener noreferrer"
                               class="px-4 py-2.5 rounded-xl bg-white/5 hover:bg-[#ff5528] text-gray-300 hover:text-white border border-white/10 text-xs font-bold transition-all flex items-center gap-2">
                                <span>💼 LinkedIn</span>
                            </a>
                        @endif

                        @if(!empty($siteSettings['social_facebook']))
                            <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" rel="noopener noreferrer"
                               class="px-4 py-2.5 rounded-xl bg-white/5 hover:bg-[#ff5528] text-gray-300 hover:text-white border border-white/10 text-xs font-bold transition-all flex items-center gap-2">
                                <span>👥 Facebook</span>
                            </a>
                        @endif

                        @if(!empty($siteSettings['social_tiktok']))
                            <a href="{{ $siteSettings['social_tiktok'] }}" target="_blank" rel="noopener noreferrer"
                               class="px-4 py-2.5 rounded-xl bg-white/5 hover:bg-[#ff5528] text-gray-300 hover:text-white border border-white/10 text-xs font-bold transition-all flex items-center gap-2">
                                <span>🎵 TikTok</span>
                            </a>
                        @endif
                    </div>
                </div>

            </div>

            {{-- SAĞ KOLON: İletişim Formu (7 col) --}}
            <div class="lg:col-span-7">
                <div class="bg-white rounded-[2.5rem] p-8 sm:p-12 border border-gray-200/80 shadow-[0_15px_50px_rgba(0,0,0,0.06)] relative overflow-hidden">
                    
                    {{-- Ambient Corner Light --}}
                    <div class="absolute -top-20 -right-20 w-52 h-52 bg-[#ff5528]/10 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative z-10 mb-8">
                        <span class="text-[11px] font-black uppercase tracking-[0.2em] text-[#ff5528] block mb-2">Mesaj Gönder</span>
                        <h2 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">Size Nasıl Yardımcı Olabiliriz?</h2>
                        <p class="text-xs sm:text-sm text-gray-500 font-medium mt-2">
                            Formu doldurarak mesajınızı bize iletebilirsiniz. Ekibimiz mesai saatleri içerisinde en kısa sürede dönüş yapacaktır.
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="mb-8 p-5 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-800 flex items-center gap-4 animate-fade-in">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-black flex-shrink-0">
                                ✓
                            </div>
                            <div>
                                <h5 class="text-xs font-black uppercase tracking-wider text-emerald-900">Harika!</h5>
                                <p class="text-xs font-bold text-emerald-700 mt-0.5">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-8 p-5 bg-red-50 border border-red-200 rounded-2xl text-red-800">
                            <div class="flex items-center gap-2 mb-2 text-xs font-black uppercase tracking-wider text-red-900">
                                <span>⚠️</span>
                                <span>Lütfen form hatalarını düzeltin:</span>
                            </div>
                            <ul class="list-disc list-inside text-xs font-medium space-y-1 text-red-700">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            {{-- Ad Soyad --}}
                            <div>
                                <label for="name" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                    Adınız & Soyadınız <span class="text-[#ff5528]">*</span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', auth()->user()->name ?? '') }}"
                                       required
                                       placeholder="Örn: Ahmet Yılmaz"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#ff5528] focus:bg-white transition-all shadow-sm">
                            </div>

                            {{-- E-posta --}}
                            <div>
                                <label for="email" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                    E-Posta Adresiniz <span class="text-[#ff5528]">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', auth()->user()->email ?? '') }}"
                                       required
                                       placeholder="Örn: ahmet@example.com"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#ff5528] focus:bg-white transition-all shadow-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            {{-- Telefon --}}
                            <div>
                                <label for="phone" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                    Telefon Numarası
                                </label>
                                <input type="tel"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="Örn: 0555 123 45 67"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#ff5528] focus:bg-white transition-all shadow-sm">
                            </div>

                            {{-- Konu --}}
                            <div>
                                <label for="subject" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                    Mesaj Konusu
                                </label>
                                <select id="subject"
                                        name="subject"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-gray-900 focus:outline-none focus:border-[#ff5528] focus:bg-white transition-all shadow-sm cursor-pointer">
                                    <option value="Genel Bilgi & Soru" {{ old('subject') == 'Genel Bilgi & Soru' ? 'selected' : '' }}>Genel Bilgi & Soru</option>
                                    <option value="Etkinlik Ekleme & Sponsorluk" {{ old('subject') == 'Etkinlik Ekleme & Sponsorluk' ? 'selected' : '' }}>Etkinlik Ekleme & Sponsorluk</option>
                                    <option value="Teknik Destek & Hata Bildirimi" {{ old('subject') == 'Teknik Destek & Hata Bildirimi' ? 'selected' : '' }}>Teknik Destek & Hata Bildirimi</option>
                                    <option value="İş Birliği & Ortaklık" {{ old('subject') == 'İş Birliği & Ortaklık' ? 'selected' : '' }}>İş Birliği & Ortaklık</option>
                                    <option value="Diğer" {{ old('subject') == 'Diğer' ? 'selected' : '' }}>Diğer</option>
                                </select>
                            </div>
                        </div>

                        {{-- Mesajınız --}}
                        <div>
                            <label for="message" class="block text-xs font-black uppercase tracking-wider text-gray-700 mb-2">
                                Mesajınız <span class="text-[#ff5528]">*</span>
                            </label>
                            <textarea id="message"
                                      name="message"
                                      rows="5"
                                      required
                                      placeholder="Mesajınızı, talebinizi veya önerinizi buraya detaylıca yazabilirsiniz..."
                                      class="w-full bg-gray-50 border border-gray-200 rounded-2xl p-4 text-xs sm:text-sm font-bold text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#ff5528] focus:bg-white transition-all shadow-sm">{{ old('message') }}</textarea>
                        </div>

                        {{-- KVKK Onay & Gönder Butonu --}}
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                            <p class="text-[11px] text-gray-400 font-medium text-center sm:text-left">
                                Formu göndererek <a href="{{ route('home') }}" class="text-[#ff5528] underline">Gizlilik Politikası</a>'nı kabul etmiş sayılırsınız.
                            </p>

                            <button type="submit"
                                    class="w-full sm:w-auto px-8 py-4 bg-[#ff5528] hover:bg-black text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-300 shadow-lg shadow-[#ff5528]/30 flex items-center justify-center gap-2 group">
                                <span>Mesajı Gönder</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>

    {{-- 3. HARİTA ALANI --}}
    @if(!empty($siteSettings['contact_map_iframe']))
        <section class="max-w-7xl mx-auto px-6 pb-20">
            <div class="bg-white rounded-[2.5rem] p-3 border border-gray-200/80 shadow-[0_10px_35px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="rounded-3xl overflow-hidden h-80 md:h-96 w-full">
                    <iframe src="{{ $siteSettings['contact_map_iframe'] }}"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full grayscale hover:grayscale-0 transition-all duration-500"></iframe>
                </div>
            </div>
        </section>
    @endif

</div>
@endsection
