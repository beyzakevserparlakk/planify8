<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Yönetim Paneli'); ?> — Planify Admin</title>

    
    <script src="https://cdn.tailwindcss.com"></script>

    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#0f1115] text-gray-100 font-sans antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    
    <div x-show="sidebarOpen"
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/80 z-40 lg:hidden" style="display: none;"></div>

    
    <aside class="fixed lg:static inset-y-0 left-0 z-50 w-72 bg-[#16181e] border-r border-gray-800/80 flex flex-col transition-transform duration-300 ease-in-out"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        
        
        <div class="h-20 flex items-center justify-between px-6 border-b border-gray-800/80">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-2 text-2xl font-black tracking-tight text-white">
                Plan<span class="text-[#ff5528]">ify</span>
                <span class="px-2 py-0.5 rounded-md bg-[#ff5528]/10 text-[#ff5528] text-[10px] font-black uppercase tracking-widest border border-[#ff5528]/20">
                    Admin
                </span>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        
        <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">
            <div class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-500 px-3 mb-2">Genel</div>

            
            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-xs font-black uppercase tracking-wider transition-all <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'text-gray-400 hover:text-white hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Kontrol Paneli
            </a>

            <div class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-500 px-3 pt-6 mb-2">İçerik Yönetimi</div>

            
            <a href="<?php echo e(route('admin.events.index')); ?>"
               class="flex items-center justify-between px-3.5 py-3 rounded-2xl text-xs font-black uppercase tracking-wider transition-all <?php echo e(request()->routeIs('admin.events.*') ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'text-gray-400 hover:text-white hover:bg-white/5'); ?>">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Etkinlikler</span>
                </div>
            </a>

            
            <a href="<?php echo e(route('admin.sliders.index')); ?>"
               class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-xs font-black uppercase tracking-wider transition-all <?php echo e(request()->routeIs('admin.sliders.*') ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'text-gray-400 hover:text-white hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Slider & Vitrin
            </a>

            <div class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-500 px-3 pt-6 mb-2">Kullanıcılar</div>

            
            <a href="<?php echo e(route('admin.users.index')); ?>"
               class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-xs font-black uppercase tracking-wider transition-all <?php echo e(request()->routeIs('admin.users.*') ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'text-gray-400 hover:text-white hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Kullanıcı Yönetimi
            </a>

            <div class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-500 px-3 pt-6 mb-2">İletişim & Yapılandırma</div>

            
            <a href="<?php echo e(route('admin.messages.index')); ?>"
               class="flex items-center justify-between px-3.5 py-3 rounded-2xl text-xs font-black uppercase tracking-wider transition-all <?php echo e(request()->routeIs('admin.messages.*') ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'text-gray-400 hover:text-white hover:bg-white/5'); ?>">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Gelen Mesajlar</span>
                </div>
                <?php if(isset($unreadMessagesCount) && $unreadMessagesCount > 0): ?>
                    <span class="px-2 py-0.5 rounded-full bg-red-500 text-white text-[10px] font-black animate-pulse">
                        <?php echo e($unreadMessagesCount); ?>

                    </span>
                <?php endif; ?>
            </a>

            
            <a href="<?php echo e(route('admin.settings.index')); ?>"
               class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-xs font-black uppercase tracking-wider transition-all <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'text-gray-400 hover:text-white hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                İletişim & Sosyal Medya
            </a>
        </div>

        
        <div class="p-4 border-t border-gray-800/80">
            <a href="<?php echo e(route('home')); ?>"
               target="_blank"
               class="flex items-center justify-center gap-2 w-full py-3 bg-white/5 hover:bg-[#ff5528] text-gray-300 hover:text-white rounded-2xl text-xs font-black uppercase tracking-wider transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Siteyi Görüntüle
            </a>
        </div>

    </aside>

    
    <div class="flex-1 flex flex-col min-w-0">
        
        
        <header class="h-20 bg-[#16181e] border-b border-gray-800/80 px-6 flex items-center justify-between sticky top-0 z-30">
            
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden text-gray-400 hover:text-white p-2 rounded-xl bg-white/5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="hidden sm:block text-sm font-bold text-gray-400">
                    <?php echo $__env->yieldContent('page_title', 'Yönetim Paneli'); ?>
                </div>
            </div>

            
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-[#ff5528] to-amber-500 text-white font-black flex items-center justify-center shadow-lg shadow-[#ff5528]/20 text-sm">
                        <?php echo e(strtoupper(substr(auth()->user()->name ?? 'A', 0, 1))); ?>

                    </div>
                    <div class="hidden md:block text-left">
                        <div class="text-xs font-black text-white leading-tight"><?php echo e(auth()->user()->name); ?></div>
                        <div class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest">Süper Yönetici</div>
                    </div>
                </div>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                            class="p-2.5 rounded-xl bg-white/5 hover:bg-red-500/20 text-gray-400 hover:text-red-400 transition"
                            title="Çıkış Yap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        
        <div class="px-6 pt-6 max-w-7xl w-full mx-auto">
            <?php if(session('success')): ?>
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-xs font-bold flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="p-4 bg-red-500/10 border border-red-500/30 rounded-2xl text-red-400 text-xs font-bold flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>
        </div>

        
        <main class="flex-1 p-6 max-w-7xl w-full mx-auto">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\planify\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>