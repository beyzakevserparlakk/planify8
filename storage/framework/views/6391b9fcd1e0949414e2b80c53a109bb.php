<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Session Status -->
    <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-4','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

    <div class="form_container">
        <form method="POST" action="<?php echo e(route('login')); ?>" class="app-form">
            <?php echo csrf_field(); ?>

            
            <div class="mb-8 text-center">
                <h3 class="text-2xl font-bold text-[#0f172a] mb-2">Hesabınıza Giriş Yapın</h3>
                <p class="text-xs text-gray-500 tracking-wide leading-relaxed">
                    Uygulamamıza başlamak için giriş yapın ve <br>deneyimin tadını çıkarın.
                </p>
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">E-posta Adresi</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                    class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:border-[#ff5528] focus:ring-1 focus:ring-[#ff5528] outline-none transition-all"
                    placeholder="e-posta@adresiniz.com">
                <div class="mt-2 text-[11px] text-gray-400">E-postanızı asla başkalarıyla paylaşmayacağız.</div>
                <?php if($errors->has('email')): ?>
                    <p class="mt-1 text-[10px] font-bold text-red-500 uppercase tracking-tighter"><?php echo e($errors->first('email')); ?></p>
                <?php endif; ?>
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Şifre</label>
                <input type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:border-[#ff5528] focus:ring-1 focus:ring-[#ff5528] outline-none transition-all"
                    placeholder="••••••••">
                <?php if($errors->has('password')): ?>
                    <p class="mt-1 text-[10px] font-bold text-red-500 uppercase tracking-tighter"><?php echo e($errors->first('password')); ?></p>
                <?php endif; ?>
            </div>

            
            <div class="mb-6 flex items-center">
                <input id="remember_me" type="checkbox" name="remember" 
                    class="w-4 h-4 rounded border-gray-300 text-[#ff5528] focus:ring-[#ff5528] cursor-pointer">
                <label for="remember_me" class="ms-2 text-xs font-medium text-gray-600 cursor-pointer italic uppercase tracking-wider">Beni Hatırla</label>
            </div>

            
            <div class="mb-6">
                <button type="submit" class="w-full py-4 bg-[#ff5528] text-white rounded-xl font-bold text-sm uppercase tracking-[0.1em] hover:bg-[#0f172a] transition-all shadow-lg shadow-orange-500/20">
                    Giriş Yap
                </button>
            </div>

            
            <div class="relative flex items-center justify-center mb-6">
                <div class="w-full border-t border-gray-100"></div>
                <div class="absolute bg-white px-4 text-[10px] font-bold text-gray-300 uppercase tracking-widest italic">VEYA</div>
            </div>

            
            <div class="mb-8">
                <div class="flex items-center justify-center gap-3">
                    <button type="button" class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 text-blue-600 hover:bg-blue-50 transition-all">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </button>
                    <button type="button" class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 text-red-500 hover:bg-red-50 transition-all">
                        <i class="fab fa-google text-lg"></i>
                    </button>
                    <button type="button" class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 text-gray-800 hover:bg-gray-200 transition-all">
                        <i class="fab fa-github text-lg"></i>
                    </button>
                </div>
            </div>

            
            <div class="text-center space-y-3">
                <?php if(Route::has('register')): ?>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest italic">
                        Hesabınız yok mu? 
                        <a href="<?php echo e(route('register')); ?>" class="text-[#ff5528] hover:underline ms-1">Hemen Kaydol</a>
                    </p>
                <?php endif; ?>
                <div class="pt-2">
                    <a class="text-[9px] text-gray-400 font-medium underline underline-offset-4 hover:text-[#ff5528]" href="#">
                        Kullanım Koşulları & Şartlar
                    </a>
                </div>
            </div>
        </form>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\planify\resources\views/auth/login.blade.php ENDPATH**/ ?>