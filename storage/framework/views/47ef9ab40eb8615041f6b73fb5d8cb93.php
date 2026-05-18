<?php $__env->startSection('title', 'Slider Yönetimi'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-10 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
        <div>
            <h3 class="text-xl font-black font-heading uppercase tracking-tight text-[#0f172a]">Slider Listesi</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-2">Ana sayfa ve Keşfet sayfasındaki slider görsellerini yönetin.</p>
        </div>
        <a href="<?php echo e(route('admin.sliders.create')); ?>" class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:opacity-90 shadow-lg shadow-primary/25 transition-all">
            <i class="fa-solid fa-plus text-sm"></i> YENİ SLIDER EKLE
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100">Görsel</th>
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100">Başlık</th>
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100">Sayfa</th>
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100 text-center">Sıra</th>
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100">Durum</th>
                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100 text-right">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-10 py-6">
                        <div class="w-24 h-14 rounded-xl overflow-hidden bg-gray-100 border border-gray-100 shadow-sm">
                            <img src="<?php echo e(asset('storage/' . $slider->image)); ?>" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="px-10 py-6">
                        <span class="text-sm font-bold text-[#0f172a] uppercase tracking-tight"><?php echo e($slider->title ?? 'Başlıksız'); ?></span>
                    </td>
                    <td class="px-10 py-6">
                        <span class="text-sm font-bold text-[#0f172a] uppercase tracking-tight">
                            <?php if($slider->page == 'home'): ?>
                                Anasayfa
                            <?php elseif($slider->page == 'kesfet'): ?>
                                Keşfet
                            <?php else: ?>
                                Hepsi
                            <?php endif; ?>
                        </span>
                    </td>
                    <td class="px-10 py-6 text-center">
                        <span class="text-xs font-black text-gray-400"><?php echo e($slider->order); ?></span>
                    </td>
                    <td class="px-10 py-6">
                        <?php if($slider->is_active): ?>
                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 text-green-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-green-100">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Aktif
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-red-50 text-red-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-red-100">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Pasif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-10 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="<?php echo e(route('admin.sliders.edit', $slider)); ?>" class="icon-btn b-r-4 btn-light-primary" title="Düzenle">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="<?php echo e(route('admin.sliders.destroy', $slider)); ?>" method="POST" onsubmit="return confirm('Bu sliderı silmek istediğinize emin misiniz?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="icon-btn b-r-4 btn-light-danger" title="Sil">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="px-10 py-20 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fa-solid fa-images text-3xl text-gray-200"></i>
                        </div>
                        <h4 class="text-sm font-black text-gray-400 uppercase tracking-widest">Henüz slider bulunmuyor.</h4>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/sliders/index.blade.php ENDPATH**/ ?>