<?php $__env->startSection('title', 'Tema Ayarları'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl">
    <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-10 border-b border-gray-50 bg-gray-50/50">
            <h3 class="text-xl font-black font-heading uppercase tracking-tight text-[#0f172a]">Görünüm Ayarları</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-2">Sitenin ana renklerini ve stilini buradan yönetebilirsiniz.</p>
        </div>

        <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" class="p-10 space-y-12">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <div class="space-y-4">
                    <label class="block text-xs font-black text-[#0f172a] uppercase tracking-[0.2em]">Ana Renk (Primary)</label>
                    <div class="flex items-center gap-4">
                        <div class="relative w-20 h-20 rounded-2xl overflow-hidden border-4 border-gray-100 shadow-inner">
                            <input type="color" name="primary_color" value="<?php echo e($settings['primary_color'] ?? '#ff5528'); ?>" 
                                class="absolute inset-0 w-full h-full cursor-pointer scale-150 border-none outline-none bg-transparent">
                        </div>
                        <div class="flex-1">
                            <input type="text" value="<?php echo e($settings['primary_color'] ?? '#ff5528'); ?>" readonly
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono font-bold text-gray-500 uppercase tracking-widest">
                            <p class="text-[10px] font-medium text-gray-400 mt-2 italic">Butonlar, ikonlar ve önemli vurgular için kullanılır.</p>
                        </div>
                    </div>
                </div>

                
                <div class="space-y-4">
                    <label class="block text-xs font-black text-[#0f172a] uppercase tracking-[0.2em]">Koyu Renk (Dark)</label>
                    <div class="flex items-center gap-4">
                        <div class="relative w-20 h-20 rounded-2xl overflow-hidden border-4 border-gray-100 shadow-inner">
                            <input type="color" name="dark_color" value="<?php echo e($settings['dark_color'] ?? '#0f172a'); ?>" 
                                class="absolute inset-0 w-full h-full cursor-pointer scale-150 border-none outline-none bg-transparent">
                        </div>
                        <div class="flex-1">
                            <input type="text" value="<?php echo e($settings['dark_color'] ?? '#0f172a'); ?>" readonly
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono font-bold text-gray-500 uppercase tracking-widest">
                            <p class="text-[10px] font-medium text-gray-400 mt-2 italic">Sidebar, header ve koyu arka planlar için kullanılır.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-50 flex items-center justify-between">
                <div class="flex items-center gap-3 text-orange-500 bg-orange-50 px-4 py-2 rounded-xl border border-orange-100">
                    <i class="fa-solid fa-circle-info text-sm"></i>
                    <span class="text-[10px] font-black uppercase tracking-widest">Değişiklikler anında tüm siteye uygulanır.</span>
                </div>
                <button type="submit" class="inline-flex items-center gap-3 px-10 py-4 bg-[#ff5528] text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-[#0f172a] shadow-lg shadow-orange-500/25 transition-all">
                    AYARLARI KAYDET <i class="fa-solid fa-save ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Renk seçici değiştikçe yanındaki metni güncelle
    document.querySelectorAll('input[type="color"]').forEach(input => {
        input.addEventListener('input', (e) => {
            e.target.closest('.flex').querySelector('input[type="text"]').value = e.target.value;
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>