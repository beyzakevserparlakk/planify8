<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-[#fafafa] relative overflow-hidden font-sans pt-48 pb-20">
    
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#ff5528]/5 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-6">
        
        <form action="<?php echo e(route('etkinlikler.store')); ?>" method="POST" enctype="multipart/form-data" id="eventForm">
            <?php echo csrf_field(); ?>
            <?php if($errors->any()): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-xl max-w-6xl mx-auto mb-8">
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <input type="hidden" name="source_type" value="user">

            <div class="flex flex-col lg:flex-row gap-12 items-start">
                
                
                <div class="lg:w-5/12 space-y-8" style="margin-top: 90px; margin-left: -40px;">
                    <div>
                        <div class="inline-flex items-center gap-3 px-3 py-1.5 bg-orange-50 border border-orange-100 rounded-full mb-6">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#ff5528]">Yeni Etkinlik Paylaş</span>
                        </div>
                        <h1 class="text-6xl font-black text-[#0f172a] leading-none tracking-tighter italic uppercase mb-6">
                            Şehrin <span class="text-[#ff5528]">Ritmini</span> <br>
                            <span class="outline-text-dark">BELİRLE.</span>
                        </h1>
                    </div>

                    <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-sm space-y-6">
                        
                        <div x-data="{ fileName: null, preview: null }">
                            <label class="premium-label">Kapak Fotoğrafı</label>
                            <input type="file" id="image_file_custom" name="image_file" class="hidden" 
                                @change="const file = $event.target.files[0]; if (file) { fileName = file.name; const reader = new FileReader(); reader.onload = (e) => { preview = e.target.result }; reader.readAsDataURL(file); }">
                            
                            <label for="image_file_custom" class="relative flex items-center justify-center w-full h-56 border-2 border-dashed border-gray-100 rounded-2xl cursor-pointer hover:border-[#ff5528] hover:bg-orange-50/20 transition-all overflow-hidden group">
                                <template x-if="!preview">
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-12 bg-orange-50 text-[#ff5528] rounded-xl flex items-center justify-center mb-4">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Görsel Seç</span>
                                    </div>
                                </template>
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </template>
                            </label>
                        </div>

                        
                        <div>
                            <label class="premium-label">Etkinlik Detayları</label>
                            <textarea name="content" rows="5" required placeholder="Neler olacak? Detaylardan bahset..." 
                                class="w-full px-5 py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[#0f172a] text-sm outline-none transition-all focus:border-[#ff5528] focus:bg-white resize-none"></textarea>
                        </div>
                    </div>
                </div>

                
                <div class="lg:w-7/12 w-full" style="margin-top: 150px; margin-right: 0px;">
                    <div class="bg-white rounded-[40px] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.06)] border border-gray-100 p-8 md:p-12">
                        <div class="space-y-6">
                            
                            <div class="group">
                                <label class="premium-label">Etkinlik Başlığı</label>
                                <input type="text" name="title" required placeholder="Örn: Yaz Konseri" 
                                    class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[#0f172a] font-bold transition-all focus:bg-white focus:border-[#ff5528] outline-none">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div class="group">
                                    <label class="premium-label">Kategori</label>
                                    <select name="category" required class="select2-el w-full">
                                        <option value="">Seçiniz</option>
                                        <option value="Konser">Konser</option>
                                        <option value="Festival">Festival</option>
                                        <option value="Tiyatro">Tiyatro</option>
                                        <option value="Sergi">Sergi</option>
                                        <option value="Atölye">Atölye</option>
                                        <option value="Spor">Spor</option>
                                        <option value="Teknoloji">Teknoloji</option>
                                        <option value="Gastronomi">Gastronomi</option>
                                        <option value="Eğitim">Eğitim</option>
                                        <option value="Gezi">Gezi</option>
                                        <option value="Gece Hayatı">Gece Hayatı</option>
                                        <option value="Sinema">Sinema</option>
                                        <option value="Kitap & Edebiyat">Kitap & Edebiyat</option>
                                        <option value="Sosyal Sorumluluk">Sosyal Sorumluluk</option>
                                        <option value="Diğer">Diğer</option>
                                    </select>
                                </div>

                                
                                <div class="group">
                                    <label class="premium-label">Maliyet / Giriş</label>
                                    <input type="text" name="cost" placeholder="Ücretsiz veya Fiyat" 
                                        class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[#0f172a] text-base outline-none transition-all focus:border-[#ff5528] focus:bg-white">
                                </div>

                                
                                <div class="group">
                                    <label class="premium-label">Şehir</label>
                                    <select name="city" id="citySelect" required class="select2-el w-full">
                                        <option value="">Şehir Seçin</option>
                                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($city->name); ?>" data-id="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                
                                <div class="group">
                                    <label class="premium-label">İlçe</label>
                                    <select name="district" id="districtSelect" required class="select2-el w-full"> 
                                        <option value="">İlçe Seçin</option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="group">
                                <label class="premium-label">Tam Adres / Mekan</label>
                                <input type="text" name="location" required placeholder="Mekan adı veya tam adres..." 
                                    class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[#0f172a] text-base outline-none transition-all focus:border-[#ff5528] focus:bg-white">
                            </div>

                            
                            <div class="group">
                                <label class="premium-label">Etkinlik Tarihi & Saati</label>
                                <input type="datetime-local" name="date" required 
                                    class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[#0f172a] text-base outline-none transition-all focus:border-[#ff5528] focus:bg-white">
                            </div>

                            
                            <div class="pt-6">
                                <button type="submit" class="w-full py-6 bg-[#ff5528] text-white rounded-[24px] font-black text-lg uppercase tracking-[0.4em] shadow-[0_20px_50px_-10px_rgba(255,85,40,0.4)] hover:bg-[#0f172a] hover:shadow-none transition-all duration-500" style="border-radius: 20px;">
                                    Şehre Duyur →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        const districtsData = <?php echo json_encode($districts, 15, 512) ?>;

        // Laravel Session Success Alert
        <?php if(session('success')): ?>
            Swal.fire({
                title: 'Başarılı!',
                text: '<?php echo e(session('success')); ?>',
                icon: 'success',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#ff5528',
                customClass: {
                    popup: 'rounded-[32px]',
                    confirmButton: 'rounded-xl px-6 py-2 font-bold uppercase tracking-widest text-xs'
                }
            });
        <?php endif; ?>

        function initSelect2() {
            $('.select2-el').select2({
                width: '100%',
                placeholder: 'Seçiniz...',
                allowClear: true,
                language: { noResults: function() { return "Sonuç bulunamadı"; } }
            });
        }

        initSelect2();

        // Şehir değişimini dinle
        $('#citySelect').on('change', function() {
            const cityId = $(this).find(':selected').data('id');
            const $districtSelect = $('#districtSelect');
            
            $districtSelect.empty().append('<option value="">İlçe Seçin</option>');
            
            if (cityId) {
                const filtered = districtsData.filter(d => d.city_id == cityId);
                filtered.forEach(d => {
                    $districtSelect.append(new Option(d.name, d.name));
                });
            }
            $districtSelect.trigger('change');
        });

        $(window).on('scroll', function() {
            $('.select2-el').select2('close');
        });
    });
</script>

<style>
    .outline-text-dark { color: transparent; -webkit-text-stroke: 2px #0f172a; }
    .premium-label { display: block; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.5rem; margin-left: 0.25rem; font-style: italic; }
    .group:focus-within .premium-label { color: #ff5528; }
    * { transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); }

    /* Index Sayfası Select2 Birebir Stilleri */
    .select2-container--default .select2-selection--single {
        background-color: #fff !important;
        border: 2px solid #e2e8f0 !important;
        border-radius: 0.75rem !important;
        height: 52px !important;
        display: flex !important;
        align-items: center !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #1e293b !important;
        font-weight: 700 !important;
        font-size: 0.875rem !important;
        padding-left: 1rem !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 50px !important;
    }
    .select2-container--default .select2-selection--single:hover {
        border-color: #ff5528 !important;
    }
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #ff5528 !important;
        box-shadow: 0 0 0 4px rgba(255, 85, 40, 0.1) !important;
        
    }
    .select2-dropdown {
        border: 2px solid #e2e8f0 !important;
        border-radius: 0.75rem !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1) !important;
        z-index: 9999 !important;
        
    }
    .select2-results__option--highlighted[aria-selected] {
        background-color: #ff5528 !important;
        background-color: #a8a8a8f5 !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/etkinlikler/create.blade.php ENDPATH**/ ?>