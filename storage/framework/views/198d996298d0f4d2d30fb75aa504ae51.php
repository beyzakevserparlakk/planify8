

<?php $__env->startSection('content'); ?>

    
    <section class="relative w-full overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900" style="margin-top: 0;">
        <?php if($sliders->count() > 0): ?>
            <div class="swiper hero-swiper w-full" style="height: 650px;">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide relative flex items-center justify-center group">
                            
                            <img src="<?php echo e(asset('storage/' . $slider->image)); ?>" 
                                 class="absolute inset-0 w-full h-full object-cover" 
                                 alt="<?php echo e($slider->title); ?>">
                            
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/50 to-transparent"></div>

                            
                            <div class="relative max-w-7xl mx-auto pt-[300px] px-6 w-full z-10 flex items-center justify-center" style="padding-top: 200px;">
                                <div class="max-w-3xl text-center space-y-6 animate-fade-up" >
                                    
                                    <div class="inline-block">
                                        <span class="px-4 py-2 bg-[#ff5528]/20 text-[#ff5528] rounded-full text-xs font-bold tracking-widest uppercase backdrop-blur-md border border-[#ff5528]/30" >
                                            ✨ Keşfet
                                        </span>
                                    </div>
                                    
                                    
                                    <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-tight drop-shadow-2xl">
                                        <?php echo e($slider->title); ?>

                                    </h1>

                                    
                                    <?php if($slider->link): ?>
                                        <div class="pt-4">
                                            <a href="<?php echo e($slider->link); ?>"
                                                class="group/btn inline-flex items-center gap-2 px-8 py-4 bg-[#ff5528] text-white rounded-xl text-sm font-bold tracking-widest hover:bg-[#ff5528] hover:shadow-2xl hover:shadow-[#ff5528]/50 transition-all duration-300 uppercase relative overflow-hidden">
                                                <span class="relative z-10">Detayları Gör</span>
                                                <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="swiper-pagination !bottom-8 !z-20">
                    <style>
                        .swiper-pagination-bullet { 
                            background: rgba(255,255,255,0.4); 
                            width: 12px; 
                            height: 12px; 
                            border-radius: 50%;
                            transition: all 0.3s ease;
                        }
                        .swiper-pagination-bullet-active { 
                            background: #ff5528;
                            box-shadow: 0 0 20px rgba(255,85,40,0.5);
                        }
                    </style>
                </div>

                
                <button class="hero-nav-prev absolute left-8 top-1/2 -translate-y-1/2 z-20 w-14 h-14 rounded-full bg-white/10 backdrop-blur-md border border-white/20 hover:bg-[#ff5528] text-white transition-all duration-300 hover:shadow-lg hidden md:flex items-center justify-center group">
                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button class="hero-nav-next absolute right-8 top-1/2 -translate-y-1/2 z-20 w-14 h-14 rounded-full bg-white/10 backdrop-blur-md border border-white/20 hover:bg-[#ff5528] text-white transition-all duration-300 hover:shadow-lg hidden md:flex items-center justify-center group">
                    <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        <?php else: ?>
            <div class="flex flex-col items-center justify-center h-[650px] text-white">
                <div class="text-center">
                    <svg class="w-24 h-24 mx-auto mb-6 text-gray-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <h2 class="text-4xl font-bold">Henüz Slider Eklenmemiş</h2>
                    <p class="text-gray-400 mt-2">Lütfen yönetim panelinden slider ekleyiniz</p>
                </div>
            </div>
        <?php endif; ?>
    </section>

    
    <section class="py-16 bg-gradient-to-b from-white to-gray-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col items-center gap-10">
                
                
                <div class="text-center space-y-3 max-w-2xl">
                    <span class="text-[#ff5528] font-black tracking-[0.3em] uppercase text-xs italic block">
                        🎯 Kategorilere Göz At
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight">
                        Sana Özel Deneyimler
                    </h2>
                    <p class="text-gray-600 text-lg">Farklı kategorilerdeki etkinlikleri keşfet</p>
                </div>

                
                <div class="flex flex-wrap justify-center gap-4">
                    
                    
                    <a href="<?php echo e(route('etkinlikler.index', array_merge(request()->except('source_type'), ['source_type' => null]))); ?>" 
                       class="group relative px-8 py-4 rounded-2xl font-black text-xs tracking-widest uppercase transition-all duration-500 <?php echo e(!request('source_type') ? 'bg-[#ff5528] text-white shadow-[0_10px_30px_rgba(255,85,40,0.3)] scale-105 ring-2 ring-[#ff5528]/50' : 'bg-white text-gray-700 border-2 border-gray-200 hover:border-[#ff5528] hover:text-[#ff5528] hover:shadow-md'); ?>">
                       <div class="flex items-center gap-3">
                           <span class="text-lg">🔥</span>
                           <span>Tüm Etkinlikler</span>
                       </div>
                    </a>

                    
                    <a href="<?php echo e(route('etkinlikler.index', array_merge(request()->except('source_type'), ['source_type' => 'user']))); ?>" 
                       class="group relative px-8 py-4 rounded-2xl font-black text-xs tracking-widest uppercase transition-all duration-500 <?php echo e(request('source_type') == 'user' ? 'bg-emerald-500 text-white shadow-[0_10px_30px_rgba(16,185,129,0.3)] scale-105 ring-2 ring-emerald-500/50' : 'bg-white text-gray-700 border-2 border-gray-200 hover:border-emerald-500 hover:text-emerald-500 hover:shadow-md'); ?>">
                       <div class="flex items-center gap-3">
                           <span class="text-lg">✨</span>
                           <span>Arkadaş Önerileri</span>
                       </div>
                    </a>

                    
                    <a href="<?php echo e(route('etkinlikler.index', array_merge(request()->except('source_type'), ['source_type' => 'official']))); ?>" 
                       class="group relative px-8 py-4 rounded-2xl font-black text-xs tracking-widest uppercase transition-all duration-500 <?php echo e(request('source_type') == 'official' ? 'bg-indigo-600 text-white shadow-[0_10px_30px_rgba(79,70,229,0.3)] scale-105 ring-2 ring-indigo-600/50' : 'bg-white text-gray-700 border-2 border-gray-200 hover:border-indigo-600 hover:text-indigo-600 hover:shadow-md'); ?>">
                       <div class="flex items-center gap-3">
                           <span class="text-lg">🏛️</span>
                           <span>Şehir Rehberi</span>
                       </div>
                    </a>

                </div>

                
                <div class="flex items-center gap-6 text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#ff5528]" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                        <span class="font-bold"><?php echo e($etkinlikler->total()); ?> Deneyim</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            
            
            <div class="mb-12">
                <span class="text-[#ff5528] font-black tracking-[0.3em] uppercase text-xs mb-3 block italic">📍 Mekanlar</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight">Keşfedilecek Yerler</h2>
            </div>

            
            <section class="relative z-30 w-full flex justify-center mb-12">
                <div class="w-full">
                    <form action="<?php echo e(request()->url()); ?>" method="GET" class="w-full relative" id="filterForm">
                        <?php if(request('source_type')): ?>
                            <input type="hidden" name="source_type" value="<?php echo e(request('source_type')); ?>">
                        <?php endif; ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4" 
                             x-data="{ 
                                selectedCity: '<?php echo e(request('city')); ?>', 
                                selectedDistrict: '<?php echo e(request('district')); ?>',
                                allDistricts: <?php echo e($allDistricts->map(fn($d) => ['id' => $d->id, 'name' => $d->name, 'city_name' => $d->city->name])->toJson()); ?>, 
                                filteredDistricts: [] 
                             }" 
                             x-init="filteredDistricts = allDistricts.filter(d => d.city_name === selectedCity); $watch('selectedCity', value => { filteredDistricts = allDistricts.filter(d => d.city_name === value); selectedDistrict = ''; })">
                            
                            
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-gray-700">
                                    <svg class="w-4 h-4 text-[#ff5528]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Arama
                                </label>
                                <div class="relative">
                                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Etkinlik veya mekan ara..." 
                                        class="w-full bg-white border-2 border-gray-300 hover:border-[#ff5528] rounded-xl py-3 pl-12 pr-5 text-sm font-bold placeholder-gray-400 focus:ring-2 focus:ring-[#ff5528]/20 focus:border-[#ff5528] transition-all shadow-sm hover:shadow-md">
                                </div>
                            </div>

                            
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-gray-700">
                                    <svg class="w-4 h-4 text-[#ff5528]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Şehir
                                </label>
                                <select name="city" id="citySelect" x-model="selectedCity" 
                                    class="select2-el w-full bg-white border-2 border-gray-300 rounded-xl py-3 px-4 text-sm font-bold appearance-none">
                                    <option value="">Tüm Şehirler</option>
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($name); ?>"><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-gray-700">
                                    <svg class="w-4 h-4 text-[#ff5528]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    İlçe
                                </label>
                                <select name="district" id="districtSelect" :disabled="!selectedCity" x-model="selectedDistrict"
                                    class="select2-el w-full bg-white border-2 border-gray-300 rounded-xl py-3 px-4 text-sm font-bold appearance-none disabled:opacity-50 disabled:cursor-not-allowed">
                                    <option value="">Tüm İlçeler</option>
                                    <template x-for="district in filteredDistricts" :key="district.id">
                                        <option :value="district.name" x-text="district.name" :selected="district.name === selectedDistrict"></option>
                                    </template>
                                </select>
                            </div>

                            
                            <div class="flex gap-3 items-end">
                                <button type="submit"  style="width: 35ch"
                                    class="w-full flex items-center justify-center gap-2 bg-[#ff5528] text-white font-bold py-3 px-6 rounded-xl hover:bg-[#ff5528]/90 active:scale-95 transition-all duration-200 uppercase text-xs tracking-widest shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                    <span class="hidden md:inline">Filtrele</span>
                                </button>
                                
                                <?php if(request()->anyFilled(['city', 'district', 'search', 'category'])): ?>
                                    <a href="<?php echo e(request()->url()); ?>" class="flex items-center justify-center p-3 bg-red-100 text-red-500 rounded-xl hover:bg-red-200 transition-all hover:shadow-md border-2 border-red-200 hover:border-red-300" title="Filtreleri Sıfırla">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            
            <?php if(request('city') || request('search') || request('district')): ?>
                <div class="mb-8 pb-4 border-b-2 border-gray-200">
                    <span class="bg-gradient-to-r from-[#ff5528] to-orange-500 bg-clip-text text-transparent font-bold text-lg">
                        <?php if(request('city')): ?>
                            <?php echo e(request('city')); ?> 
                            <?php if(request('district')): ?>
                                / <?php echo e(request('district')); ?>

                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(request('search')): ?>
                            "<?php echo e(request('search')); ?>"
                        <?php endif; ?>
                        Sonuçları
                    </span>
                </div>
            <?php endif; ?>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__empty_1 = true; $__currentLoopData = $etkinlikler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etkinlik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-md border border-gray-200 transition-all duration-500 hover:shadow-2xl hover:-translate-y-1">
                        
                        <div class="relative h-64 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300">
                            <img src="<?php echo e(asset('storage/' . $etkinlik->image)); ?>" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            
                            <div class="absolute top-4 left-4 z-10">
                                <span class="bg-white/95 backdrop-blur-md text-gray-900 px-4 py-2 rounded-lg text-xs font-black uppercase tracking-widest shadow-lg">
                                    📍 <?php echo e($etkinlik->city); ?>

                                </span>
                            </div>

                            
                            <?php if($etkinlik->cost): ?>
                                <div class="absolute top-4 right-4 z-10">
                                    <span class="bg-emerald-500 text-white px-4 py-2 rounded-lg text-xs font-black uppercase tracking-widest shadow-lg">
                                        💰 <?php echo e($etkinlik->cost); ?>

                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="p-6 space-y-4">
                            <div>
                                <h3 class="text-xl font-black text-gray-900 mb-2 line-clamp-2">
                                    <?php echo e($etkinlik->title); ?>

                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    <?php echo e($etkinlik->district ?: $etkinlik->location); ?>

                                </p>
                            </div>

                            
                            <a href="<?php echo e(url('/etkinlikler/' . $etkinlik->slug)); ?>#detay-alani"
                               class="block w-full text-center bg-gradient-to-r from-[#ff5528] to-orange-500 hover:from-[#ff5528] hover:to-[#ff5528] text-white px-6 py-3 rounded-xl text-xs font-bold tracking-widest uppercase transition-all duration-300 group/btn hover:shadow-lg active:scale-95">
                                Detayları Gör →
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full py-20 text-center">
                        <div class="inline-block p-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl mb-6">
                            <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-black text-gray-800 mb-2">Sonuç Bulunamadı</h3>
                        <p class="text-gray-600 text-lg mb-6">Seçtiğin kriterlere uygun etkinlik yok. Farklı filtreler deneyebilirsin.</p>
                        <a href="<?php echo e(route('etkinlikler.index')); ?>" class="inline-block px-6 py-3 bg-[#ff5528] text-white rounded-xl font-bold hover:bg-[#ff5528]/90 transition-all">
                            Tüm Etkinlikleri Gör
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            
            <?php if($etkinlikler->count() > 0): ?>
                <div class="mt-16 mb-8">
                    <div class="flex justify-center">
                        <?php echo e($etkinlikler->links('partials.pagination')); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // Select2 Başlatma
            function initSelect2() {
                $('.select2-el').each(function() {
                    $(this).select2({
                        width: '100%',
                        placeholder: 'Seçiniz...',
                        allowClear: true,
                        language: {
                            noResults: function() { return "Sonuç bulunamadı"; }
                        }
                    });
                });
            }

            initSelect2();

            // Şehir değiştiğinde Alpine verisini güncelle ve ilçeleri yükle
            $('#citySelect').on('change', function (e) {
                let data = e.target.value;
                let alpineEl = document.querySelector('[x-data]');
                if (alpineEl && window.Alpine) {
                    let alpineData = Alpine.$data(alpineEl);
                    alpineData.selectedCity = data;
                    
                    // İlçeleri manuel olarak Select2'ye yükle
                    let filtered = alpineData.allDistricts.filter(d => d.city_name === data);
                    let $districtSelect = $('#districtSelect');
                    
                    $districtSelect.empty().append('<option value="">Tüm İlçeler</option>');
                    filtered.forEach(d => {
                        $districtSelect.append(new Option(d.name, d.name));
                    });
                    
                    // Select2'yi yeniden başlat
                    $districtSelect.select2({
                        width: '100%',
                        placeholder: 'Seçiniz...',
                        allowClear: true,
                        language: { noResults: function() { return "Sonuç bulunamadı"; } }
                    }).prop('disabled', !data).trigger('change');
                }
            });

            // İlçe değiştiğinde Alpine verisini güncelle
            // İlçe değiştiğinde Alpine verisini güncelle
            $('#districtSelect').on('change', function (e) {
                let alpineEl = document.querySelector('[x-data]');
                if (alpineEl && window.Alpine) {
                    let alpineData = Alpine.$data(alpineEl);
                    alpineData.selectedDistrict = e.target.value;
                }
            });

            // Sayfa kaydırıldığında açık olan Select2 kutularını kapat (konum kaymasını önlemek için)
            $(window).on('scroll', function() {
                $('.select2-el').select2('close');
            });
        });

        // Swiper Konfigürasyonu
        new Swiper('.hero-swiper', {
            loop: true,
            autoplay: { 
                delay: 5000, 
                disableOnInteraction: false 
            },
            pagination: { 
                el: '.swiper-pagination', 
                clickable: true 
            },
            navigation: { 
                nextEl: '.hero-nav-next', 
                prevEl: '.hero-nav-prev' 
            },
            speed: 800,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });
    </script>

    <style>
        /* Animasyon */
        .animate-fade-up { animation: fadeUp 1s ease-out forwards; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
<?php $__env->stopSection(); ?>








<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/etkinlikler/index.blade.php ENDPATH**/ ?>