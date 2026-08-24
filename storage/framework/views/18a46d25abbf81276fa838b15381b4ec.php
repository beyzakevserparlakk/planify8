<?php $__env->startSection('title', 'Kontrol Paneli'); ?>
<?php $__env->startSection('page_title', 'Genel Bakış & İstatistikler'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        
        <div class="bg-[#16181e] p-6 rounded-3xl border border-gray-800/80 shadow-xl relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-gray-400">Toplam Etkinlik</p>
                    <h3 class="text-3xl font-black text-white mt-2"><?php echo e($stats['total_events']); ?></h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-[#ff5528]/10 text-[#ff5528] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-800/60 flex items-center justify-between text-xs">
                <span class="text-emerald-400 font-bold"><?php echo e($stats['approved_events']); ?> Onaylı</span>
                <span class="text-amber-400 font-bold"><?php echo e($stats['pending_events']); ?> Bekleyen</span>
            </div>
        </div>

        
        <div class="bg-[#16181e] p-6 rounded-3xl border border-amber-500/20 shadow-xl relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-amber-400">Onay Bekleyenler</p>
                    <h3 class="text-3xl font-black text-amber-300 mt-2"><?php echo e($stats['pending_events']); ?></h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-800/60 flex items-center justify-between text-xs">
                <a href="<?php echo e(route('admin.events.index', ['status' => 'pending'])); ?>" class="text-amber-400 hover:underline font-bold">
                    İncelemeye Git &rarr;
                </a>
            </div>
        </div>

        
        <div class="bg-[#16181e] p-6 rounded-3xl border border-gray-800/80 shadow-xl relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-gray-400">Kullanıcılar</p>
                    <h3 class="text-3xl font-black text-white mt-2"><?php echo e($stats['total_users']); ?></h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-800/60 flex items-center justify-between text-xs">
                <a href="<?php echo e(route('admin.users.index')); ?>" class="text-indigo-400 hover:underline font-bold">
                    Tüm Üyeler &rarr;
                </a>
            </div>
        </div>

        
        <div class="bg-[#16181e] p-6 rounded-3xl border border-gray-800/80 shadow-xl relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-gray-400">Slider & Vitrin</p>
                    <h3 class="text-3xl font-black text-white mt-2"><?php echo e($stats['total_sliders']); ?></h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-800/60 flex items-center justify-between text-xs">
                <a href="<?php echo e(route('admin.sliders.index')); ?>" class="text-purple-400 hover:underline font-bold">
                    Vitrin Yönetimi &rarr;
                </a>
            </div>
        </div>

    </div>

    
    <div class="bg-gradient-to-r from-[#1c1f26] to-[#16181e] p-6 rounded-3xl border border-gray-800 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-black text-white">Hızlı İşlemler</h3>
            <p class="text-xs text-gray-400 font-medium">Yeni resmi etkinlik veya ana sayfa vitrin görseli ekleyin</p>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <a href="<?php echo e(route('admin.events.create')); ?>"
               class="flex-1 sm:flex-none px-5 py-3 bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-wider rounded-2xl transition shadow-lg shadow-[#ff5528]/25 text-center">
                + Yeni Etkinlik Ekle
            </a>
            <a href="<?php echo e(route('admin.sliders.create')); ?>"
               class="flex-1 sm:flex-none px-5 py-3 bg-white/10 hover:bg-white/20 text-white text-xs font-black uppercase tracking-wider rounded-2xl transition text-center">
                + Slider Ekle
            </a>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        
        <div class="lg:col-span-2 bg-[#16181e] rounded-3xl border border-gray-800/80 p-6 shadow-xl space-y-4">
            <div class="flex items-center justify-between pb-4 border-b border-gray-800">
                <h3 class="text-base font-black text-white">Son Eklenen Etkinlikler</h3>
                <a href="<?php echo e(route('admin.events.index')); ?>" class="text-xs font-bold text-[#ff5528] hover:underline">Tümünü Gör &rarr;</a>
            </div>

            <?php if($latestEvents->count() > 0): ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-gray-400 font-black uppercase tracking-wider border-b border-gray-800 text-[10px]">
                                <th class="py-3 px-2">Afiş / Başlık</th>
                                <th class="py-3 px-2">Şehir</th>
                                <th class="py-3 px-2">Durum</th>
                                <th class="py-3 px-2 text-right">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/60 font-medium">
                            <?php $__currentLoopData = $latestEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-white/5 transition">
                                    <td class="py-3 px-2 flex items-center gap-3">
                                        <img src="<?php echo e($event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=100'); ?>"
                                             alt="<?php echo e($event->title); ?>"
                                             class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                                        <div>
                                            <a href="<?php echo e(route('admin.events.edit', $event->id)); ?>" class="font-bold text-white hover:text-[#ff5528] line-clamp-1">
                                                <?php echo e($event->title); ?>

                                            </a>
                                            <span class="text-[10px] text-gray-500"><?php echo e($event->category ?: 'Genel'); ?></span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-2 text-gray-300"><?php echo e($event->city ?: '-'); ?></td>
                                    <td class="py-3 px-2">
                                        <?php if($event->status === 'approved'): ?>
                                            <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[10px] font-black uppercase">Onaylı</span>
                                        <?php elseif($event->status === 'pending'): ?>
                                            <span class="px-2.5 py-1 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[10px] font-black uppercase">Bekliyor</span>
                                        <?php else: ?>
                                            <span class="px-2.5 py-1 rounded-full bg-red-500/10 text-red-400 border border-red-500/20 text-[10px] font-black uppercase">Reddedildi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-3 px-2 text-right">
                                        <div class="inline-flex items-center gap-1">
                                            <a href="<?php echo e(route('admin.events.edit', $event->id)); ?>"
                                               class="p-1.5 rounded-lg bg-white/5 hover:bg-white/15 text-gray-300 hover:text-white"
                                               title="Düzenle">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <?php if($event->status === 'pending'): ?>
                                                <form action="<?php echo e(route('admin.events.status', $event->id)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="p-1.5 rounded-lg bg-emerald-500/20 text-emerald-400 hover:bg-emerald-500 hover:text-white transition" title="Onayla">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-xs text-gray-500 italic py-6 text-center">Henüz etkinlik bulunmuyor.</p>
            <?php endif; ?>
        </div>

        
        <div class="bg-[#16181e] rounded-3xl border border-gray-800/80 p-6 shadow-xl space-y-4">
            <div class="flex items-center justify-between pb-4 border-b border-gray-800">
                <h3 class="text-base font-black text-white">Son Kullanıcılar</h3>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="text-xs font-bold text-[#ff5528] hover:underline">Tümü &rarr;</a>
            </div>

            <div class="space-y-3">
                <?php $__empty_1 = true; $__currentLoopData = $latestUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-white/5 hover:bg-white/10 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-gray-700 to-gray-600 text-white font-black text-xs flex items-center justify-center">
                                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                            </div>
                            <div>
                                <div class="text-xs font-bold text-white"><?php echo e($user->name); ?></div>
                                <div class="text-[10px] text-gray-400"><?php echo e($user->email); ?></div>
                            </div>
                        </div>
                        <?php if($user->is_admin): ?>
                            <span class="px-2 py-0.5 rounded bg-[#ff5528]/10 text-[#ff5528] text-[9px] font-black uppercase">Admin</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-xs text-gray-500 italic py-4 text-center">Henüz kullanıcı bulunmuyor.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>