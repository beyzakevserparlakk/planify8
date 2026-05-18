<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($seo->title ?? 'Planify | Sosyal Etkinlik Platformu'); ?></title>
    <meta name="description" content="<?php echo e($seo->description ?? 'Şehrin en iyi etkinliklerini keşfedin, deneyimlerinizi paylaşın ve yeni planlar yapın.'); ?>">
    <meta name="keywords" content="<?php echo e($seo->keywords ?? 'etkinlik, planlama, sosyal, mekanlar, konserler'); ?>">

    <?php if(isset($seo->image)): ?>
        <meta property="og:image" content="<?php echo e($seo->image); ?>">
    <?php endif; ?>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        :root {
            --primary-color: <?php echo e($siteSettings['primary_color'] ?? '#ff5528'); ?>;
            --dark-color: <?php echo e($siteSettings['dark_color'] ?? '#0f172a'); ?>;
        }

        /* Global Select2 Premium Theme */
        .select2-container--default .select2-selection--single {
            background-color: #fff !important;
            border: 2px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
            height: 52px !important;
            display: flex !important;
            align-items: center !important;
            position: relative !important;
            transition: all 0.3s ease !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #1a1a1a !important;
            font-weight: 700 !important;
            font-size: 0.875rem !important;
            padding-left: 1.25rem !important;
            line-height: 48px !important;
            margin: 0 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px !important;
            right: 12px !important;
        }
        .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 1rem !important;
            overflow: hidden !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
            z-index: 999999 !important;
            background: white !important;
        }
        .select2-container--default .select2-dropdown--below {
            margin-top: 4px !important;
        }
        .select2-container--default .select2-dropdown--above {
            margin-top: -4px !important;
        }
        .select2-results__option {
            padding: 10px 16px !important;
            font-size: 0.875rem !important;
            color: #4a5568 !important;
            transition: all 0.2s ease !important;
        }
        .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary-color) !important;
            opacity: 0.1;
            color: var(--primary-color) !important;
            padding-left: 24px !important;
        }
        /* Highlight fix */
        .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary-color) !important;
            color: white !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__clear {
            position: absolute !important;
            right: 24px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            color: #a0aec0 !important;
            font-size: 1.25rem !important;
            font-weight: bold !important;
            cursor: pointer !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__clear:hover {
            color: var(--primary-color) !important;
        }
        .select2-container { z-index: 999999 !important; }
    </style>

    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased text-gray-900 overflow-x-hidden bg-white">
    
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="min-h-screen">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div x-data="{ 
            show: false, 
            message: '', 
            type: 'success',
            init() {
                <?php if(session('success')): ?>
                    this.showAlert('<?php echo e(session('success')); ?>', 'success');
                <?php endif; ?>
                <?php if(session('error')): ?>
                    this.showAlert('<?php echo e(session('error')); ?>', 'error');
                <?php endif; ?>
            },
            showAlert(message, type) {
                this.message = message;
                this.type = type;
                this.show = true;
                setTimeout(() => { this.show = false }, 5000);
            }
        }"
        x-show="show"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 -translate-y-10 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-10 scale-95"
        class="fixed top-10 left-1/2 -translate-x-1/2 z-[9999] w-full max-w-md px-4"
        style="display: none; top: 2.5rem !important;">
        
        <div class="flex items-center space-x-4 px-6 py-4 rounded-3xl backdrop-blur-2xl border shadow-2xl"
             :class="type === 'success' ? 'bg-emerald-500/20 border-emerald-500/30 text-emerald-400' : 'bg-rose-500/20 border-rose-500/30 text-rose-400'">
            <div class="p-2 rounded-xl bg-white/10">
                <template x-if="type === 'success'">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </template>
                <template x-if="type === 'error'">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </template>
            </div>
            <div class="flex flex-col">
                <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-60" x-text="type === 'success' ? 'Başarılı' : 'Hata'"></span>
                <span class="font-semibold text-sm tracking-wide" x-text="message"></span>
            </div>
            <button @click="show = false" class="ml-4 p-1 hover:bg-white/10 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    
</body>
</html>
<?php /**PATH C:\laragon\www\planify\resources\views/layouts/app.blade.php ENDPATH**/ ?>