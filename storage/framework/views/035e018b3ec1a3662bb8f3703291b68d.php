<?php $__env->startSection('content'); ?>

<div class="min-h-screen bg-gray-50 font-sans pb-12">
  <main class="container max-w-7xl mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-12 gap-8">
      
      <div class="lg:col-span-8">
        <?php if($haberler->count() > 0): ?>
          <?php $featured = $haberler->first(); ?>
          
          
          <div class="mb-8">
            <a href="<?php echo e(route('haberler.show', $featured->slug)); ?>" class="block relative rounded-2xl overflow-hidden group h-[400px]">
                <img src="<?php echo e($featured->image ? asset('storage/'.$featured->image) : 'https://images.unsplash.com/photo-1679762904524-eefde9861bac?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080'); ?>"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 w-full">
                    <span class="inline-block bg-[#ff5528] text-white text-[10px] font-bold px-2 py-1 rounded mb-3 uppercase tracking-wider"><?php echo e($featured->category ?? 'Gündem'); ?></span>
                    <h2 class="text-3xl font-bold text-white mb-2 leading-tight">
                        <?php echo e($featured->title); ?>

                    </h2>
                    <p class="text-gray-200 mb-4 line-clamp-2 text-sm pr-4">
                        <?php echo e($featured->summary ?: strip_tags(substr($featured->content, 0, 150))); ?>

                    </p>
                    <div class="flex items-center text-gray-300 text-xs font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <?php echo e($featured->created_at->diffForHumans()); ?>

                    </div>
                </div>
            </a>
          </div>

          
          <div class="grid md:grid-cols-2 gap-6">
            <?php $__currentLoopData = $haberler->slice(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col group hover:shadow-lg transition">
                <a href="<?php echo e(route('haberler.show', $news->slug)); ?>" class="relative block h-48">
                  <img src="<?php echo e($news->image ? asset('storage/'.$news->image) : 'https://images.unsplash.com/photo-1573164713988-8665fc963095?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080'); ?>" 
                       class="w-full h-full object-cover">
                  <span class="absolute top-3 left-3 bg-[#ff5528] text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase"><?php echo e($news->category ?? 'Haber'); ?></span>
                </a>
                <div class="p-5 flex flex-col flex-grow">
                  <h3 class="text-lg font-bold text-gray-900 mb-2 leading-snug hover:text-[#ff5528] transition line-clamp-2">
                    <a href="<?php echo e(route('haberler.show', $news->slug)); ?>"><?php echo e($news->title); ?></a>
                  </h3>
                  <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-grow">
                    <?php echo e($news->summary ?: strip_tags(substr($news->content, 0, 100))); ?>

                  </p>
                  <div class="flex items-center text-gray-400 text-xs font-medium mt-auto">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <?php echo e($news->created_at->diffForHumans()); ?>

                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          
          <div class="mt-8">
            <?php echo e($haberler->links()); ?>

          </div>
        <?php else: ?>
          <div class="py-24 text-center bg-white rounded-xl border border-gray-100">
            <p class="text-gray-500 text-lg font-medium">Henüz haber bulunmuyor.</p>
          </div>
        <?php endif; ?>
      </div>

      <aside class="lg:col-span-4">
        
        <div class="bg-white rounded-xl border border-gray-100 p-6 mb-6">
          <div class="flex items-center gap-2 mb-4">
            <svg class="w-5 h-5 text-[#ff5528]" viewBox="0 0 24 24" fill="currentColor"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/></svg>
            <h3 class="font-bold text-lg text-gray-900">Öne Çıkanlar</h3>
          </div>
          
          <div class="space-y-4">
            <?php $__currentLoopData = \App\Models\Haber::where('is_active', true)->inRandomOrder()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $trending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e(route('haberler.show', $trending->slug)); ?>" class="flex items-start gap-4 group border-b border-gray-50 pb-4 last:border-0 last:pb-0">
                <span class="text-4xl font-light text-gray-200 leading-none pt-1 hover:text-orange-100 transition">0<?php echo e($idx + 1); ?></span>
                <div>
                  <h4 class="font-semibold text-sm text-gray-800 group-hover:text-[#ff5528] transition line-clamp-2 leading-snug">
                    <?php echo e($trending->title); ?>

                  </h4>
                  <span class="text-xs text-gray-400 mt-1 block"><?php echo e($trending->created_at->diffForHumans()); ?></span>
                </div>
              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>

        
        <div class="bg-[#ff5528] rounded-xl p-6 text-white">
          <h3 class="font-bold text-xl mb-2">Haberleri Kaçırma!</h3>
          <p class="text-sm mb-4 text-orange-50 leading-relaxed">
            E-posta bültenimize abone ol, en önemli haberler doğrudan gelen kutuna gelsin.
          </p>
          <form class="space-y-2">
            <input
              type="email"
              placeholder="E-posta Adresi"
              class="w-full px-4 py-2.5 rounded text-gray-900 placeholder-gray-400 text-sm focus:outline-none"
            />
            <button type="button" class="w-full bg-white text-[#ff5528] py-2.5 rounded font-bold text-sm hover:bg-gray-50 transition">
              Abone Ol
            </button>
          </form>
        </div>
      </aside>

    </div>
  </main>

</div>

<style>
  .scrollbar-hide::-webkit-scrollbar { display: none; }
  .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/haberler/index.blade.php ENDPATH**/ ?>