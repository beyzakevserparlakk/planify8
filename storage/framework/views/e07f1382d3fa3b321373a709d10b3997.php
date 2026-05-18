<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-20 mt-10">
    <div class="max-w-7xl mx-auto px-4">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 font-heading mb-2">Planlarım</h1>
                <p class="text-gray-500 text-lg">Paylaştığın tüm planları buradan yönetebilirsin.</p>
            </div>
            <a href="<?php echo e(route('etkinlikler.create')); ?>" class="px-8 py-4 premium-gradient text-white rounded-full font-bold shadow-xl shadow-indigo-200 hover:scale-105 transition-all">
                + Yeni Plan Paylaş
            </a>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-8 rounded-[30px] border border-gray-100 shadow-sm">
                <span class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Toplam Paylaşım</span>
                <span class="text-3xl font-bold text-gray-900"><?php echo e($etkinlikler->total()); ?></span>
            </div>
            <div class="bg-white p-8 rounded-[30px] border border-gray-100 shadow-sm">
                <span class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Toplam Etkileşim</span>
                <span class="text-3xl font-bold text-indigo-600">
                    <?php echo e($etkinlikler->sum(function($e) { return $e->likes->count() + $e->comments->count(); })); ?>

                </span>
            </div>
            <div class="bg-white p-8 rounded-[30px] border border-gray-100 shadow-sm">
                <span class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Aktif Durum</span>
                <span class="text-3xl font-bold text-green-500">Çevrimiçi</span>
            </div>
        </div>

        
        <div class="bg-white rounded-[40px] shadow-xl shadow-indigo-500/5 border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-6 text-sm font-bold text-gray-400 uppercase tracking-widest">Plan</th>
                            <th class="px-8 py-6 text-sm font-bold text-gray-400 uppercase tracking-widest">Kategori</th>
                            <th class="px-8 py-6 text-sm font-bold text-gray-400 uppercase tracking-widest">Tarih</th>
                            <th class="px-8 py-6 text-sm font-bold text-gray-400 uppercase tracking-widest">Etkileşim</th>
                            <th class="px-8 py-6 text-sm font-bold text-gray-400 uppercase tracking-widest text-right">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php $__empty_1 = true; $__currentLoopData = $etkinlikler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etkinlik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="h-16 w-16 rounded-2xl overflow-hidden mr-4 shadow-sm">
                                            <img src="<?php echo e($etkinlik->image ? asset('storage/'.$etkinlik->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?auto=format&fit=crop&q=80&w=200'); ?>" 
                                                 class="w-full h-full object-cover" alt="">
                                        </div>
                                        <div>
                                            <a href="<?php echo e(route('etkinlikler.show', $etkinlik->slug)); ?>" class="font-bold text-gray-900 hover:text-indigo-600 transition-colors block"><?php echo e($etkinlik->title); ?></a>
                                            <span class="text-xs text-gray-400 font-medium italic"><?php echo e($etkinlik->location); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-wider">
                                        <?php echo e($etkinlik->category); ?>

                                    </span>
                                </td>
                                <td class="px-8 py-6 text-gray-600 font-medium">
                                    <?php echo e($etkinlik->date ? $etkinlik->date->format('d M Y') : '-'); ?>

                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-4 text-gray-400">
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                            <span class="text-sm font-bold text-gray-600"><?php echo e($etkinlik->likes->count()); ?></span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                            <span class="text-sm font-bold text-gray-600"><?php echo e($etkinlik->comments->count()); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-3 translate-x-4 group-hover:translate-x-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                        <a href="<?php echo e(route('etkinlikler.show', $etkinlik->slug)); ?>" class="p-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors" title="Görüntüle">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <a href="<?php echo e(route('etkinlikler.edit', $etkinlik->slug)); ?>" class="p-3 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-colors" title="Düzenle">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="<?php echo e(route('etkinlikler.destroy', $etkinlik->id)); ?>" method="POST" onsubmit="return confirm('Bu etkinliği silmek istediğinizden emin misiniz?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="p-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-colors" title="Sil">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">Henüz bir plan paylaşmamışsın.</p>
                                        <a href="<?php echo e(route('etkinlikler.create')); ?>" class="mt-4 text-indigo-600 font-bold hover:underline">Hemen İlk Planını Paylaş →</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($etkinlikler->hasPages()): ?>
                <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
                    <?php echo e($etkinlikler->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/etkinlikler/my-events.blade.php ENDPATH**/ ?>