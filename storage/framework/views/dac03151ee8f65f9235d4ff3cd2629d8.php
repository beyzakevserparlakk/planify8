<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Admin Paneli - <?php echo e(config('app.name', 'Planify')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwind.min.css">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwind.min.js"></script>
    
    <!-- SortableJS (Sürükle-Bırak Sıralama) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <style>
        :root {
            --primary-color: <?php echo e($siteSettings['primary_color'] ?? '#ff5528'); ?>;
            --dark-color: <?php echo e($siteSettings['dark_color'] ?? '#0f172a'); ?>;
        }
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Outfit', sans-serif; }

        /* Dinamik Renk Uygulamaları */
        .bg-primary { background-color: var(--primary-color) !important; }
        .text-primary { color: var(--primary-color) !important; }
        /* Modern Buton Stilleri */
        .b-r-4 { border-radius: 4px !important; }
        .icon-btn { 
            width: 38px; 
            height: 38px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        
        .btn-light-primary { 
            background-color: color-mix(in srgb, var(--primary-color), white 90%); 
            color: var(--primary-color); 
        }
        .btn-light-primary:hover { 
            background-color: var(--primary-color); 
            color: white; 
        }

        .btn-light-secondary { 
            background-color: color-mix(in srgb, var(--dark-color), white 90%); 
            color: var(--dark-color); 
        }
        .btn-light-secondary:hover { 
            background-color: var(--dark-color); 
            color: white; 
        }

        .btn-light-success { 
            background-color: #f0fdf4; 
            color: #16a34a; 
        }
        .btn-light-success:hover { 
            background-color: #16a34a; 
            color: white; 
        }

        .btn-light-danger { 
            background-color: #fef2f2; 
            color: #dc2626; 
        }
        .btn-light-danger:hover { 
            background-color: #dc2626; 
            color: white; 
        }
    </style>
</head>

<body class="bg-[#f1f5f9] text-[#0f172a] antialiased">
    <div class="flex min-h-screen">
        
        <aside class="w-72 bg-[#0f172a] text-white flex-shrink-0 flex flex-col transition-all duration-300">
            <div class="p-8">
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/30">
                        <i class="fa-solid fa-rocket text-white"></i>
                    </div>
                    <span class="text-2xl font-black font-heading tracking-tighter italic uppercase">Planify <span class="text-primary">Admin</span></span>
                </div>

                <nav class="space-y-2">
                    <a href="<?php echo e(route('admin.index')); ?>" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all <?php echo e(request()->routeIs('admin.index') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white'); ?>">
                        <i class="fa-solid fa-chart-line w-5"></i>
                        <span class="text-sm font-bold uppercase tracking-widest">Dashboard</span>
                    </a>

                    <a href="<?php echo e(route('admin.sliders.index')); ?>" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all <?php echo e(request()->routeIs('admin.sliders.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white'); ?>">
                        <i class="fa-solid fa-images w-5"></i>
                        <span class="text-sm font-bold uppercase tracking-widest">Slider Yönetimi</span>
                    </a>

                    <a href="<?php echo e(route('admin.events.index')); ?>" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all <?php echo e(request()->routeIs('admin.events.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white'); ?>">
                        <i class="fa-solid fa-calendar-check w-5"></i>
                        <span class="text-sm font-bold uppercase tracking-widest">Etkinlik Onayı</span>
                    </a>

                    <a href="<?php echo e(route('admin.settings.index')); ?>" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white'); ?>">
                        <i class="fa-solid fa-palette w-5"></i>
                        <span class="text-sm font-bold uppercase tracking-widest">Tema Ayarları</span>
                    </a>
                </nav>
            </div>


        </aside>

        
        <main class="flex-1 flex flex-col min-w-0">
            
            <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-10 flex-shrink-0">
                <h2 class="text-xl font-black font-heading uppercase tracking-tight text-[#0f172a]">
                    <?php echo $__env->yieldContent('title', 'Yönetim Paneli'); ?>
                </h2>

                
                <div class="relative" id="userDropdownWrapper">
                    <button id="userDropdownBtn" onclick="toggleDropdown()" class="flex items-center gap-3 px-4 py-2 rounded-2xl hover:bg-gray-100 transition-all cursor-pointer">
                        <div class="text-right hidden md:block">
                            <p class="text-xs font-black text-[#0f172a] uppercase tracking-widest"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Süper Admin</p>
                        </div>
                        <div class="w-10 h-10 bg-[#0f172a] rounded-xl flex items-center justify-center text-white font-black text-xs uppercase">
                            <?php echo e(substr(auth()->user()->name, 0, 2)); ?>

                        </div>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 transition-transform duration-200" id="dropdownChevron"></i>
                    </button>

                    
                    <div id="userDropdownMenu" class="hidden absolute right-0 top-full mt-2 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                        <div class="p-2 space-y-1">
                            <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black text-gray-600 uppercase tracking-widest hover:bg-gray-50 hover:text-[#0f172a] transition-all">
                                <i class="fa-solid fa-house w-4 text-gray-400"></i>
                                Siteye Dön
                            </a>
                            <div class="h-px bg-gray-100 mx-2"></div>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black text-red-500 uppercase tracking-widest hover:bg-red-50 transition-all">
                                    <i class="fa-solid fa-right-from-bracket w-4"></i>
                                    Çıkış Yap
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <script>
                function toggleDropdown() {
                    const menu = document.getElementById('userDropdownMenu');
                    const chevron = document.getElementById('dropdownChevron');
                    menu.classList.toggle('hidden');
                    chevron.classList.toggle('rotate-180');
                }
                // Dışarıya tıklayınca kapat
                document.addEventListener('click', function(e) {
                    const wrapper = document.getElementById('userDropdownWrapper');
                    if (wrapper && !wrapper.contains(e.target)) {
                        document.getElementById('userDropdownMenu').classList.add('hidden');
                        document.getElementById('dropdownChevron').classList.remove('rotate-180');
                    }
                });
            </script>

            
            <div class="flex-1 p-10 overflow-y-auto">
                <?php if(session('success')): ?>
                    <div class="mb-8 p-5 bg-green-50 border border-green-100 text-green-700 rounded-2xl flex items-center gap-4 animate-in fade-in slide-in-from-top duration-500">
                        <i class="fa-solid fa-circle-check text-xl"></i>
                        <span class="text-sm font-bold uppercase tracking-widest"><?php echo e(session('success')); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-8 p-5 bg-red-50 border border-red-100 text-red-700 rounded-2xl flex items-center gap-4 animate-in fade-in slide-in-from-top duration-500">
                        <i class="fa-solid fa-circle-exclamation text-xl"></i>
                        <span class="text-sm font-bold uppercase tracking-widest"><?php echo e(session('error')); ?></span>
                    </div>
                <?php endif; ?>

                <div class="animate-in fade-in slide-in-from-bottom duration-700">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </main>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH C:\laragon\www\planify\resources\views/layouts/admin.blade.php ENDPATH**/ ?>