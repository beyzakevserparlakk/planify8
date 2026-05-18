<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="<?php echo e(__('Pagination Navigation')); ?>" class="flex items-center justify-center gap-3">
        
        <?php if($paginator->onFirstPage()): ?>
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-50 text-gray-300 border border-gray-100 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </span>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white text-gray-600 border border-gray-200 hover:border-[#ff5528] hover:text-[#ff5528] hover:shadow-lg transition-all duration-300 group">
                <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
        <?php endif; ?>

        
        <div class="flex items-center gap-2">
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <span class="w-12 h-12 flex items-center justify-center text-gray-400 font-bold"><?php echo e($element); ?></span>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-[#ff5528] text-white font-black shadow-lg shadow-[#ff5528]/20 border border-[#ff5528]"><?php echo e($page); ?></span>
                        <?php else: ?>
                            <a href="<?php echo e($url); ?>" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white text-gray-600 font-bold border border-gray-200 hover:border-[#ff5528] hover:text-[#ff5528] hover:shadow-md transition-all duration-300">
                                <?php echo e($page); ?>

                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white text-gray-600 border border-gray-200 hover:border-[#ff5528] hover:text-[#ff5528] hover:shadow-lg transition-all duration-300 group">
                <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
        <?php else: ?>
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-50 text-gray-300 border border-gray-100 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </span>
        <?php endif; ?>
    </nav>
<?php endif; ?>
<?php /**PATH C:\laragon\www\planify\resources\views/partials/pagination.blade.php ENDPATH**/ ?>