<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
    
    <div class="bg-white p-8 rounded-[32px] border border-gray-100 shadow-sm hover:shadow-xl transition-all group">
        <div class="flex items-center justify-between mb-6">
            <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-calendar-days text-xl"></i>
            </div>
            <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Toplam</span>
        </div>
        <h3 class="text-3xl font-black font-heading text-[#0f172a] mb-1"><?php echo e($stats['total_events']); ?></h3>
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Etkinlikler</p>
    </div>

    
    <div class="bg-white p-8 rounded-[32px] border border-gray-100 shadow-sm hover:shadow-xl transition-all group">
        <div class="flex items-center justify-between mb-6">
            <div class="w-12 h-12 bg-orange-50 text-[#ff5528] rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-clock text-xl"></i>
            </div>
            <span class="text-xs font-black text-[#ff5528] uppercase tracking-widest">Bekliyor</span>
        </div>
        <h3 class="text-3xl font-black font-heading text-[#0f172a] mb-1"><?php echo e($stats['pending_events']); ?></h3>
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Onay Bekleyenler</p>
    </div>

    
    <div class="bg-white p-8 rounded-[32px] border border-gray-100 shadow-sm hover:shadow-xl transition-all group">
        <div class="flex items-center justify-between mb-6">
            <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-users text-xl"></i>
            </div>
            <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Aktif</span>
        </div>
        <h3 class="text-3xl font-black font-heading text-[#0f172a] mb-1"><?php echo e($stats['total_users']); ?></h3>
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Kullanıcılar</p>
    </div>

    
    <div class="bg-white p-8 rounded-[32px] border border-gray-100 shadow-sm hover:shadow-xl transition-all group">
        <div class="flex items-center justify-between mb-6">
            <div class="w-12 h-12 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-images text-xl"></i>
            </div>
            <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Yayında</span>
        </div>
        <h3 class="text-3xl font-black font-heading text-[#0f172a] mb-1"><?php echo e($stats['total_sliders']); ?></h3>
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Sliderlar</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <div class="bg-[#0f172a] p-10 rounded-[40px] shadow-2xl text-white relative overflow-hidden group">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#ff5528]/10 rounded-full blur-[80px]"></div>
        <h3 class="text-2xl font-black font-heading italic uppercase tracking-tighter text-[#ff5528] mb-8 relative z-10">Hızlı Aksiyonlar</h3>
        <div class="grid grid-cols-2 gap-4 relative z-10">
            <a href="<?php echo e(route('admin.sliders.index')); ?>" class="p-6 bg-white/5 rounded-3xl border border-white/10 hover:bg-[#ff5528] hover:border-[#ff5528] transition-all group/link">
                <i class="fa-solid fa-plus-circle text-2xl mb-4 block group-hover/link:scale-110 transition-transform"></i>
                <span class="text-xs font-black uppercase tracking-widest">Slider Ekle</span>
            </a>
            <a href="#" class="p-6 bg-white/5 rounded-3xl border border-white/10 hover:bg-[#ff5528] hover:border-[#ff5528] transition-all group/link">
                <i class="fa-solid fa-check-double text-2xl mb-4 block group-hover/link:scale-110 transition-transform"></i>
                <span class="text-xs font-black uppercase tracking-widest">Onayları Yönet</span>
            </a>
        </div>
    </div>

    
    <div class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-sm">
        <h3 class="text-2xl font-black font-heading italic uppercase tracking-tighter text-[#0f172a] mb-8">Sistem Durumu</h3>
        <div class="space-y-6">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                <span class="text-xs font-black uppercase tracking-widest text-gray-400">Laravel Versiyon</span>
                <span class="text-sm font-bold text-[#0f172a]"><?php echo e(App::VERSION()); ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                <span class="text-xs font-black uppercase tracking-widest text-gray-400">PHP Versiyon</span>
                <span class="text-sm font-bold text-[#0f172a]"><?php echo e(PHP_VERSION); ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                <span class="text-xs font-black uppercase tracking-widest text-gray-400">Environment</span>
                <span class="text-sm font-bold text-green-500 uppercase tracking-widest"><?php echo e(app()->environment()); ?></span>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/index.blade.php ENDPATH**/ ?>