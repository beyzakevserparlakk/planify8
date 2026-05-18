<?php $__env->startSection('content'); ?>
<section class="py-24 max-w-4xl mx-auto px-4">
    <div class="mb-12">
        <a href="<?php echo e(route('haberler.index')); ?>" class="text-[#ff5528] font-bold mb-6 inline-flex items-center hover:gap-2 transition-all">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            Tüm Haberler
        </a>
        <div class="flex items-center text-sm font-bold text-[#ff5528] uppercase tracking-widest mb-4">
            <?php echo e($haber->created_at->format('d F Y')); ?>

            <span class="mx-3 text-gray-300">•</span>
            Duyuru
        </div>
        <h1 class="text-4xl md:text-6xl font-bold font-heading text-gray-900 leading-tight mb-8 italic"><?php echo e($haber->title); ?></h1>
        <p class="text-xl md:text-2xl text-gray-600 leading-relaxed font-light italic border-l-4 border-[#ff5528] pl-8"><?php echo e($haber->summary); ?></p>
    </div>

    <?php if($haber->image): ?>
        <div class="mb-16 rounded-[40px] overflow-hidden shadow-2xl border border-gray-100">
            <img src="<?php echo e(asset('storage/'.$haber->image)); ?>" class="w-full h-auto" alt="<?php echo e($haber->title); ?>">
        </div>
    <?php endif; ?>

    <div class="prose prose-xl prose-orange max-w-none text-gray-700 leading-relaxed">
        <?php echo $haber->content; ?>

    </div>

    <div class="mt-20 pt-12 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-8">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-[#ff5528] font-bold">P</div>
            <div>
                <div class="font-bold text-gray-900">Planify Editör</div>
                <div class="text-sm text-gray-500">İçerik Stratejisti</div>
            </div>
        </div>
        <div class="flex space-x-4">
            <button class="bg-orange-50 text-[#ff5528] p-3 rounded-xl hover:bg-orange-100 transition-colors">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
            </button>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/haberler/show.blade.php ENDPATH**/ ?>