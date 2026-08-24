<?php $__env->startSection('title', 'Slider & Vitrin Yönetimi'); ?>
<?php $__env->startSection('page_title', 'Ana Sayfa Slider & Vitrin Yönetimi'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-base font-black text-white">Aktif Sliderlar</h2>
            <p class="text-xs text-gray-400 font-medium">Ana sayfadaki hero vitrininde dönen afiş ve bağlantılar</p>
        </div>
        <a href="<?php echo e(route('admin.sliders.create')); ?>"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-wider rounded-xl transition shadow-lg shadow-[#ff5528]/25">
            + Yeni Slider Ekle
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-[#16181e] rounded-3xl overflow-hidden border border-gray-800 shadow-xl flex flex-col group">
                <div class="relative h-48 bg-gray-900 overflow-hidden">
                    <img src="<?php echo e(asset('storage/' . $slider->image)); ?>" alt="<?php echo e($slider->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider <?php echo e($slider->is_active ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white'); ?>">
                        <?php echo e($slider->is_active ? 'Aktif' : 'Pasif'); ?>

                    </div>
                    <div class="absolute top-3 right-3 px-2 py-1 bg-black/70 backdrop-blur-md rounded-lg text-[10px] text-gray-300 font-bold">
                        Sıra: <?php echo e($slider->order); ?>

                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-sm font-black text-white mb-2 line-clamp-1"><?php echo e($slider->title); ?></h3>
                    <p class="text-xs text-gray-400 font-medium truncate mb-4"><?php echo e($slider->link ?: 'Bağlantı linki yok'); ?></p>

                    <div class="mt-auto pt-4 border-t border-gray-800 flex items-center justify-between">
                        <a href="<?php echo e(route('admin.sliders.edit', $slider->id)); ?>" class="text-xs font-bold text-gray-300 hover:text-white flex items-center gap-1">
                            <span>Düzenle</span>
                        </a>

                        <form action="<?php echo e(route('admin.sliders.destroy', $slider->id)); ?>" method="POST" onsubmit="return confirm('Bu sliderı silmek istediğinizden emin misiniz?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-xs font-bold text-red-400 hover:text-red-300">
                                Sil
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full bg-[#16181e] p-12 rounded-3xl text-center border border-gray-800 text-gray-500 text-xs">
                Henüz slider eklenmemiş. "+ Yeni Slider Ekle" butonuna basarak ilk görseli ekleyebilirsiniz.
            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/sliders/index.blade.php ENDPATH**/ ?>