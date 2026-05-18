<?php $__env->startSection('title', 'Yeni Slider Ekle'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl">
    <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-10 border-b border-gray-50 bg-gray-50/50">
            <h3 class="text-xl font-black font-heading uppercase tracking-tight text-[#0f172a]">Slider Bilgileri</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-2">Görsel, başlık ve yönlendirme linkini tanımlayın.</p>
        </div>

        <form action="<?php echo e(route('admin.sliders.store')); ?>" method="POST" enctype="multipart/form-data" class="p-10 space-y-8">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-[#0f172a] uppercase tracking-[0.2em] ml-1">Slider Başlığı</label>
                    <input type="text" name="title" value="<?php echo e(old('title')); ?>" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-bold text-[#0f172a] focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                        placeholder="Slider üzerinde görünecek başlık...">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[10px] font-black uppercase mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-[#0f172a] uppercase tracking-[0.2em] ml-1">Görüneceği Sayfa</label>
                    <select name="page" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-bold text-[#0f172a] focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                        <option value="home" <?php echo e(old('page') == 'home' ? 'selected' : ''); ?>>Anasayfa</option>
                        <option value="kesfet" <?php echo e(old('page') == 'kesfet' ? 'selected' : ''); ?>>Keşfet</option>
                        <option value="both" <?php echo e(old('page') == 'both' ? 'selected' : ''); ?>>Her İki Sayfa</option>
                    </select>
                </div>

                
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-[#0f172a] uppercase tracking-[0.2em] ml-1">Yönlendirme Linki (URL)</label>
                    <input type="url" name="link" value="<?php echo e(old('link')); ?>" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-bold text-[#0f172a] focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                        placeholder="https://example.com/etkinlik...">
                    <?php $__errorArgs = ['link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[10px] font-black uppercase mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-[#0f172a] uppercase tracking-[0.2em] ml-1">Görüntüleme Sırası</label>
                    <input type="number" name="order" value="<?php echo e(old('order', 0)); ?>" 
                        class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 text-sm font-bold text-[#0f172a] focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                </div>
            </div>

            
            <div class="space-y-4">
                <label class="block text-[10px] font-black text-[#0f172a] uppercase tracking-[0.2em] ml-1">Slider Görseli</label>
                <div class="relative group">
                    <input type="file" name="image" id="imageInput" class="hidden" accept="image/*" required onchange="previewImage(this)">
                    <label for="imageInput" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-200 rounded-[32px] bg-gray-50 cursor-pointer hover:bg-gray-100 hover:border-primary transition-all overflow-hidden relative">
                        <div id="previewContainer" class="hidden absolute inset-0 w-full h-full">
                            <img id="imagePreview" src="#" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-white text-xs font-black uppercase tracking-widest">Görseli Değiştir</span>
                            </div>
                        </div>
                        <div id="uploadPlaceholder" class="flex flex-col items-center">
                            <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-300 mb-4 group-hover:text-primary transition-colors"></i>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Görsel Seçmek İçin Tıklayın</p>
                            <p class="text-[10px] text-gray-300 mt-2">JPG, PNG veya WEBP (Max 2MB)</p>
                        </div>
                    </label>
                </div>
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[10px] font-black uppercase mt-1 text-center"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="pt-8 border-t border-gray-50 flex items-center justify-end gap-4">
                <a href="<?php echo e(route('admin.sliders.index')); ?>" class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-[#0f172a] transition-all">Vazgeç</a>
                <button type="submit" class="inline-flex items-center gap-3 px-12 py-4 bg-primary text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:opacity-90 shadow-lg shadow-primary/25 transition-all">
                    SLIDER'I YAYINLA <i class="fa-solid fa-paper-plane ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('previewContainer').classList.remove('hidden');
                document.getElementById('uploadPlaceholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/sliders/create.blade.php ENDPATH**/ ?>