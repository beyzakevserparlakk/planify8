<?php $__env->startSection('content'); ?>
<div class="py-20 max-w-4xl mx-auto px-6">
    <h1 class="text-3xl font-black mb-8 italic uppercase text-[#0f172a]">
        Katılımcılar: <span class="text-[#ff5528]"><?php echo e($etkinlik->title); ?></span>
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        
        <div>
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                Katılıyor (<?php echo e($attending->count()); ?>)
            </h3>
            <div class="space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $attending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rsvp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center font-bold">
                            <?php echo e(substr($rsvp->user->name, 0, 1)); ?>

                        </div>
                        <span class="font-bold text-gray-700"><?php echo e($rsvp->user->name); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-400 italic">Henüz katılan yok.</p>
                <?php endif; ?>
            </div>
        </div>

        
        <div>
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                İlgileniyor (<?php echo e($interested->count()); ?>)
            </h3>
            <div class="space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $interested; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rsvp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center font-bold">
                            <?php echo e(substr($rsvp->user->name, 0, 1)); ?>

                        </div>
                        <span class="font-bold text-gray-700"><?php echo e($rsvp->user->name); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-400 italic">Henüz ilgilenen yok.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/rsvp/list.blade.php ENDPATH**/ ?>