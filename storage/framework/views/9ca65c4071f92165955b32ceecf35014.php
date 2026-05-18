<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Premium Fonts: Outfit & Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans text-[#0f172a] antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#fafafa] relative overflow-hidden">
            
            <div class="absolute -top-24 -left-24 w-[500px] h-[500px] bg-[#ff5528]/10 rounded-full blur-[120px]"></div>
            <div class="absolute -bottom-24 -right-24 w-[500px] h-[500px] bg-[#ff5528]/15 rounded-full blur-[120px]"></div>

            <div class="relative z-10 mb-4">
                <a href="/">
                    <h1 class="text-5xl font-black text-[#0f172a] leading-none tracking-tighter italic uppercase text-center font-heading">
                        PLAN<span class="text-[#ff5528] drop-shadow-[0_0_15px_rgba(255,85,40,0.3)]">IFY</span>
                    </h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-10 py-12 bg-white shadow-[0_50px_100px_-20px_rgba(0,0,0,0.08)] border border-gray-100/50 overflow-hidden rounded-[48px] relative z-10">
                <?php echo e($slot); ?>

            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\laragon\www\planify\resources\views/layouts/guest.blade.php ENDPATH**/ ?>