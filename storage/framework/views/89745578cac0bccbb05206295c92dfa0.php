<?php $__env->startSection('title', 'Kullanıcı Yönetimi'); ?>
<?php $__env->startSection('page_title', 'Kayıtlı Kullanıcılar'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="w-full sm:w-80 relative">
            <svg class="w-4 h-4 text-gray-500 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="İsim veya e-posta ara..."
                   class="w-full bg-[#16181e] border border-gray-800 rounded-2xl py-3 pl-11 pr-4 text-xs font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
        </form>

        <div class="text-xs text-gray-400 font-bold">
            Toplam <strong class="text-white"><?php echo e($users->total()); ?></strong> kullanıcı kayıtlı
        </div>
    </div>

    
    <div class="bg-[#16181e] rounded-3xl border border-gray-800 shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-white/5 text-gray-400 font-black uppercase tracking-wider text-[10px] border-b border-gray-800">
                        <th class="py-4 px-4">Kullanıcı</th>
                        <th class="py-4 px-4">E-Posta</th>
                        <th class="py-4 px-4">Rol / Yetki</th>
                        <th class="py-4 px-4">Kayıt Tarihi</th>
                        <th class="py-4 px-4 text-right">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800 font-medium">
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-white/[0.03] transition">
                            <td class="py-4 px-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-[#ff5528] to-amber-500 text-white font-black text-xs flex items-center justify-center shadow-md">
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                </div>
                                <div>
                                    <div class="font-bold text-white"><?php echo e($user->name); ?></div>
                                    <div class="text-[10px] text-gray-500">ID: #<?php echo e($user->id); ?></div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-300 font-mono text-[11px]"><?php echo e($user->email); ?></td>
                            <td class="py-4 px-4">
                                <?php if($user->is_admin || $user->role === 'admin'): ?>
                                    <span class="px-3 py-1 rounded-full bg-[#ff5528]/10 text-[#ff5528] border border-[#ff5528]/20 text-[10px] font-black uppercase tracking-wider">
                                        ⚡ Yönetici (Admin)
                                    </span>
                                <?php else: ?>
                                    <span class="px-3 py-1 rounded-full bg-gray-800 text-gray-400 text-[10px] font-black uppercase tracking-wider">
                                        Kullanıcı
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-4 text-gray-400"><?php echo e($user->created_at ? $user->created_at->format('d.m.Y H:i') : '-'); ?></td>
                            <td class="py-4 px-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    
                                    <?php if($user->id !== auth()->id()): ?>
                                        <form action="<?php echo e(route('admin.users.toggle-admin', $user->id)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="px-3 py-1.5 rounded-xl bg-white/5 hover:bg-white/15 text-gray-300 hover:text-white text-[10px] font-bold uppercase transition">
                                                <?php echo e($user->is_admin ? 'Yetkiyi Al' : 'Admin Yap'); ?>

                                            </button>
                                        </form>

                                        
                                        <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?')" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="p-1.5 rounded-xl bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white transition" title="Kullanıcıyı Sil">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-[10px] text-gray-600 italic">Siz</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500">Kullanıcı bulunamadı.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-800 flex justify-center">
            <?php echo e($users->links()); ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/users/index.blade.php ENDPATH**/ ?>