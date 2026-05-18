<?php $__env->startSection('content'); ?>
<div class="bg-[#fafafa] min-h-screen py-24 mt-10 relative overflow-hidden">
    
    <div class="absolute top-0 -left-20 w-[600px] h-[600px] bg-[#ff5528]/10 rounded-full blur-[120px]"></div>
    <div class="absolute top-1/2 -right-20 w-[500px] h-[500px] bg-[#ff5528]/5 rounded-full blur-[100px]"></div>
    <div class="absolute -bottom-20 left-1/3 w-[400px] h-[400px] bg-[#0f172a]/5 rounded-full blur-[100px]"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <div class="bg-white/90 backdrop-blur-xl rounded-[48px] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] overflow-hidden mb-16 relative group border border-slate-200" style="border-radius: 48px;">
            <div class="p-10 md:p-16 relative overflow-hidden">
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-orange-50 rounded-full mb-6 border border-orange-100">
                        <span class="w-2 h-2 bg-[#ff5528] rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#ff5528]">Yönetim Paneli</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black font-heading mb-6 italic uppercase tracking-tighter leading-none text-[#0f172a]">
                        Hoş Geldin, <br><span class="text-[#ff5528] drop-shadow-[0_0_15px_rgba(255,85,40,0.3)]"><?php echo e(auth()->user()->name); ?>!</span>
                    </h1>
                    <p class="text-gray-500 text-lg md:text-xl max-w-2xl font-medium leading-relaxed italic">
                        Bugün şehirde neler oluyor? Yeni etkinliklerini paylaş, topluluğun ritmini belirle ve kendi planlarını yönet.
                    </p>
                </div>
                
                <div class="absolute -right-20 -top-20 w-96 h-96 bg-[#ff5528]/10 rounded-full blur-[100px] group-hover:scale-125 transition-transform duration-1000"></div>
                <div class="absolute left-1/4 -bottom-10 w-64 h-64 bg-[#ff5528]/5 rounded-full blur-[80px]"></div>
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            
            <div class="bg-white/90 backdrop-blur-xl p-10 rounded-[40px] border border-slate-200 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.05)] hover:shadow-orange-500/10 hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-16 h-16 bg-gradient-to-br from-[#ff5528] to-[#ff8c28] text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-orange-500/30 group-hover:rotate-6 transition-transform">
                    <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 4v16m8-8H4"/></svg>
                </div>
                <h3 class="text-2xl font-black font-heading mb-3 uppercase tracking-tight text-[#0f172a]">Duyur</h3>
                <p class="text-gray-500 text-sm mb-8 font-medium leading-relaxed italic">Şehirdeki bir keşfini hemen herkesle paylaş.</p>
                <a href="<?php echo e(route('etkinlikler.create')); ?>" class="inline-flex items-center justify-center gap-3 px-10 py-4 bg-[#ff5528] text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-[#0f172a] shadow-lg shadow-orange-500/25 transition-all group-hover:scale-105 transition-transform">
                    BAŞLA <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            
            <div class="bg-white/90 backdrop-blur-xl p-10 rounded-[40px] border border-slate-200 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.05)] hover:shadow-orange-500/10 hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-16 h-16 bg-gradient-to-br from-[#ff5528] to-[#ff8c28] text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-orange-500/30 group-hover:rotate-6 transition-transform">
                    <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                </div>
                <h3 class="text-2xl font-black font-heading mb-3 uppercase tracking-tight text-[#0f172a]">Favoriler</h3>
                <p class="text-gray-500 text-sm mb-8 font-medium leading-relaxed italic">Kaçırmak istemediğin o özel planlar burada.</p>
                <a href="<?php echo e(route('profile.saved')); ?>" class="inline-flex items-center justify-center gap-3 px-10 py-4 bg-[#ff5528] text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-[#0f172a] shadow-lg shadow-orange-500/25 transition-all group-hover:scale-105 transition-transform">
                    LİSTEYE GİT <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            
            <div class="bg-white/90 backdrop-blur-xl p-10 rounded-[40px] border border-slate-200 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.05)] hover:shadow-orange-500/10 hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-16 h-16 bg-gradient-to-br from-[#ff5528] to-[#ff8c28] text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-orange-500/30 group-hover:rotate-6 transition-transform">
                    <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h3 class="text-2xl font-black font-heading mb-3 uppercase tracking-tight text-[#0f172a]">Hesap</h3>
                <p class="text-gray-500 text-sm mb-8 font-medium leading-relaxed italic">Profilini ve kişisel tercihlerini düzenle.</p>
                <a href="<?php echo e(route('profile.edit')); ?>" class="inline-flex items-center justify-center gap-3 px-10 py-4 bg-[#ff5528] text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-[#0f172a] shadow-lg shadow-orange-500/25 transition-all group-hover:scale-105 transition-transform">
                    DÜZENLE <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <div class="bg-white/80 backdrop-blur-xl p-12 rounded-[48px] border border-slate-200 shadow-xl" style="border-radius: 28px;">
                <div class="flex items-center justify-between mb-12">
                    <h3 class="text-2xl font-black font-heading italic uppercase tracking-tighter">Aktivite Akışın</h3>
                    <div class="flex gap-2">
                        <div class="w-8 h-1.5 bg-[#ff5528]/20 rounded-full"></div>
                        <div class="w-3 h-1.5 bg-[#ff5528]/10 rounded-full"></div>
                    </div>
                </div>
                <div class="py-12 text-center">
                    <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-8 border-2 border-dashed border-orange-200">
                        <svg class="w-10 h-10 text-orange-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-[#0f172a] font-black text-xs uppercase tracking-[0.2em] mb-2">Sessizliği Boz!</p>
                    <p class="text-gray-400 text-xs font-medium italic">Şehrin ritmine ilk notayı sen bırakmaya ne dersin?</p>
                </div>
            </div>

            
            <div class="bg-[#0f172a] p-12 rounded-[48px] shadow-2xl text-white relative overflow-hidden group border border-white/5" style="border-radius: 28px;">
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#ff5528]/10 rounded-full blur-[80px] group-hover:bg-[#ff5528]/20 transition-all duration-700"></div>
                <h3 class="text-2xl font-black font-heading italic uppercase tracking-tighter text-[#ff5528] mb-12 relative z-10">Planify Haberleri</h3>
                <div class="space-y-6 relative z-10">
                    <div class="p-8 bg-white rounded-[32px] border border-slate-200 shadow-xl hover:shadow-2xl transition-all cursor-pointer group/item">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="px-3 py-1 bg-[#ff5528] rounded-full text-[9px] font-black uppercase tracking-widest text-white shadow-lg shadow-orange-500/30">Yeni Özellik</span>
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">30 Nisan 2026</span>
                        </div>
                        <h4 class="text-xl font-black mb-3 text-[#0f172a] group-hover/item:text-[#ff5528] transition-colors leading-tight">Sosyal Etkinlik Paylaşımı Yayında!</h4>
                        <p class="text-gray-500 text-sm font-medium italic leading-relaxed">Artık kendi keşiflerini tek tıkla tüm şehre duyurabilirsin. Topluluğun ritmini sen belirle!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/dashboard.blade.php ENDPATH**/ ?>