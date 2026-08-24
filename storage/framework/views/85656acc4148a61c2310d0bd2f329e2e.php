<?php $__env->startSection('title', 'Etkinlik Yönetimi'); ?>
<?php $__env->startSection('page_title', 'Tüm Etkinlikler'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        
        
        <div class="flex flex-wrap items-center gap-2">
            <a href="<?php echo e(route('admin.events.index')); ?>"
               class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition <?php echo e(!request('status') ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'bg-[#16181e] text-gray-400 hover:text-white border border-gray-800'); ?>">
                Tümü (<?php echo e($counts['all']); ?>)
            </a>
            <a href="<?php echo e(route('admin.events.index', ['status' => 'pending'])); ?>"
               class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition <?php echo e(request('status') === 'pending' ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/25' : 'bg-[#16181e] text-amber-400 hover:bg-amber-500/10 border border-gray-800'); ?>">
                Bekleyenler (<?php echo e($counts['pending']); ?>)
            </a>
            <a href="<?php echo e(route('admin.events.index', ['status' => 'approved'])); ?>"
               class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition <?php echo e(request('status') === 'approved' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/25' : 'bg-[#16181e] text-emerald-400 hover:bg-emerald-500/10 border border-gray-800'); ?>">
                Onaylılar (<?php echo e($counts['approved']); ?>)
            </a>
            <a href="<?php echo e(route('admin.events.index', ['status' => 'rejected'])); ?>"
               class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition <?php echo e(request('status') === 'rejected' ? 'bg-red-600 text-white shadow-lg shadow-red-600/25' : 'bg-[#16181e] text-red-400 hover:bg-red-500/10 border border-gray-800'); ?>">
                Reddedilenler (<?php echo e($counts['rejected']); ?>)
            </a>
        </div>

        <a href="<?php echo e(route('admin.events.create')); ?>"
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-wider rounded-xl transition shadow-lg shadow-[#ff5528]/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Yeni Etkinlik Ekle
        </a>
    </div>

    
    <div class="bg-[#16181e] p-4 rounded-2xl border border-gray-800">
        <form method="GET" action="<?php echo e(route('admin.events.index')); ?>" class="flex flex-col sm:flex-row gap-3">
            <?php if(request('status')): ?>
                <input type="hidden" name="status" value="<?php echo e(request('status')); ?>">
            <?php endif; ?>
            <div class="flex-1 relative">
                <svg class="w-4 h-4 text-gray-500 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Başlık, mekan veya şehir ara..."
                       class="w-full bg-white/5 border border-gray-700/60 rounded-xl py-2.5 pl-11 pr-4 text-xs font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-white/10 hover:bg-white/20 text-white text-xs font-black uppercase rounded-xl transition">
                Filtrele
            </button>
            <?php if(request()->hasAny(['search', 'status'])): ?>
                <a href="<?php echo e(route('admin.events.index')); ?>" class="px-4 py-2.5 text-xs text-gray-400 hover:text-white flex items-center justify-center">
                    Sıfırla
                </a>
            <?php endif; ?>
        </form>
    </div>

    
    <div class="bg-[#16181e] rounded-3xl border border-gray-800/80 shadow-xl overflow-hidden">
        <?php if($events->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-white/5 text-gray-400 font-black uppercase tracking-wider text-[10px] border-b border-gray-800">
                            <th class="py-4 px-4">Etkinlik Bilgisi</th>
                            <th class="py-4 px-4">Kategori & Ücret</th>
                            <th class="py-4 px-4">Tarih & Mekan</th>
                            <th class="py-4 px-4">Kaynak & Durum</th>
                            <th class="py-4 px-4 text-right">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 font-medium">
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-white/[0.03] transition">
                                
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <img src="<?php echo e($event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=100'); ?>"
                                             alt="<?php echo e($event->title); ?>"
                                             class="w-12 h-12 rounded-2xl object-cover flex-shrink-0 bg-gray-800">
                                        <div>
                                            <a href="<?php echo e(route('etkinlikler.show', $event->slug)); ?>" target="_blank" class="font-bold text-white hover:text-[#ff5528] line-clamp-1">
                                                <?php echo e($event->title); ?>

                                            </a>
                                            <div class="text-[10px] text-gray-500 mt-0.5">Slug: <?php echo e($event->slug); ?></div>
                                        </div>
                                    </div>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <div class="font-bold text-gray-300"><?php echo e($event->category ?: '-'); ?></div>
                                    <div class="text-emerald-400 text-[11px] font-bold"><?php echo e($event->cost ?: 'Ücretsiz'); ?></div>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <div class="text-gray-300 font-bold"><?php echo e($event->date ? $event->date->translatedFormat('d M Y, H:i') : 'Tarih Yok'); ?></div>
                                    <div class="text-gray-500 text-[11px]"><?php echo e($event->district ? $event->district . ', ' : ''); ?><?php echo e($event->city ?: '-'); ?></div>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <div class="space-y-1">
                                        <div>
                                            <?php if($event->source_type === 'official'): ?>
                                                <span class="px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-400 text-[9px] font-black uppercase">Şehir</span>
                                            <?php else: ?>
                                                <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 text-[9px] font-black uppercase">Sosyal</span>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <?php if($event->status === 'approved'): ?>
                                                <span class="px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[9px] font-black uppercase">Onaylı</span>
                                            <?php elseif($event->status === 'pending'): ?>
                                                <span class="px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[9px] font-black uppercase">Bekliyor</span>
                                            <?php else: ?>
                                                <span class="px-2 py-0.5 rounded-full bg-red-500/10 text-red-400 border border-red-500/20 text-[9px] font-black uppercase">Red</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                
                                <td class="py-4 px-4 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        
                                        <?php if($event->status !== 'approved'): ?>
                                            <form action="<?php echo e(route('admin.events.status', $event->id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="px-2.5 py-1 rounded-lg bg-emerald-500/20 hover:bg-emerald-500 text-emerald-400 hover:text-white transition text-[10px] font-black uppercase" title="Onayla">
                                                    Onayla
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <?php if($event->status !== 'rejected'): ?>
                                            <form action="<?php echo e(route('admin.events.status', $event->id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="px-2.5 py-1 rounded-lg bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white transition text-[10px] font-black uppercase" title="Reddet">
                                                    Reddet
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        
                                        <a href="<?php echo e(route('admin.events.edit', $event->id)); ?>"
                                           class="p-2 rounded-xl bg-white/5 hover:bg-white/15 text-gray-300 hover:text-white transition"
                                           title="Düzenle">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        
                                        <form action="<?php echo e(route('admin.events.destroy', $event->id)); ?>" method="POST" onsubmit="return confirm('Bu etkinliği kalıcı olarak silmek istediğinizden emin misiniz?')" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="p-2 rounded-xl bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white transition" title="Sil">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-800 flex justify-center">
                <?php echo e($events->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-16 text-gray-500 text-xs">
                Filtreleme kriterlerine uygun etkinlik bulunamadı.
            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/events/index.blade.php ENDPATH**/ ?>