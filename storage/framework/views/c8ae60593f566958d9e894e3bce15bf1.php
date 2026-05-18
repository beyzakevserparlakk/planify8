
<nav class="fixed w-full z-50 top-0 left-0 transition-all duration-300 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            
            <div class="flex-shrink-0 flex items-center bg-[#ff5528] rounded-lg px-5 py-1.5 shadow-lg shadow-orange-100">
                <a href="<?php echo e(url('/')); ?>" class="text-2xl font-black tracking-tighter text-white uppercase italic">
                    Planify
                </a>
            </div>

            
            <div class="hidden md:flex gap-8 items-center">
                <a href="<?php echo e(url('/')); ?>" class="text-[11px] font-black tracking-[0.2em] text-[#1a1a1a] hover:text-[#ff5528] transition-all uppercase">ANA SAYFA</a>
                <a href="<?php echo e(url('/etkinlikler')); ?>" class="text-[11px] font-black tracking-[0.2em] text-[#1a1a1a] hover:text-[#ff5528] transition-all uppercase">KEŞFET</a>
                <a href="<?php echo e(url('/haberler')); ?>" class="text-[11px] font-black tracking-[0.2em] text-[#1a1a1a] hover:text-[#ff5528] transition-all uppercase">HABERLER</a>

                <?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center gap-4 ml-4">
                        
                        <a href="<?php echo e(url('/etkinlikler/paylas')); ?>"
                           class="px-5 py-2 border-2 border-[#1a1a1a] text-[#1a1a1a] rounded-md hover:bg-[#ff5528] hover:border-[#ff5528] hover:text-white transition-all text-[10px] font-black tracking-widest uppercase">
                            ETKİNLİK PAYLAŞ
                        </a>

                        
                        <div class="relative group">
                            <button class="flex items-center space-x-1 text-[#ff5528] font-bold text-[11px] tracking-widest uppercase">
                                <span><?php echo e(auth()->user()->name); ?></span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            
                            <div class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-xl shadow-2xl opacity-0 group-hover:opacity-100 transition-all invisible group-hover:visible border border-gray-50 z-50">
                                <a href="<?php echo e(route('etkinlikler.my-events')); ?>" class="block px-4 py-3 text-[10px] font-bold text-gray-700 hover:bg-gray-50 border-b border-gray-50 uppercase tracking-widest">Planlarım</a>
                                <a href="<?php echo e(url('/profile/saved')); ?>" class="block px-4 py-3 text-[10px] font-bold text-gray-700 hover:bg-gray-50 uppercase tracking-widest">Kaydedilenler</a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-3 text-[10px] font-bold text-red-600 hover:bg-red-50 uppercase tracking-widest">Çıkış Yap</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    
                    <div class="flex items-center space-x-6 ml-4">
                        <a href="<?php echo e(route('login')); ?>" class="text-[11px] font-black tracking-widest text-[#1a1a1a] hover:text-[#ff5528] transition-colors uppercase">GİRİŞ YAP</a>
                        <a href="<?php echo e(route('register')); ?>"
                           class="px-6 py-2 bg-[#1a1a1a] text-white rounded-md hover:bg-[#ff5528] transition-all text-[11px] font-black tracking-widest uppercase">KAYIT OL</a>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="md:hidden">
                <button type="button" class="p-2 text-[#1a1a1a] hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>


<div class="h-20"></div><?php /**PATH C:\laragon\www\planify\resources\views/partials/navbar.blade.php ENDPATH**/ ?>