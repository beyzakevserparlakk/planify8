<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-20 mt-10">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-[40px] shadow-2xl overflow-hidden border border-gray-100">
            <div class="premium-gradient p-12 text-white text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-4xl md:text-5xl font-bold font-heading mb-4 italic">Etkinliği Düzenle</h1>
                    <p class="text-indigo-100 text-lg">Paylaştığın etkinlik detaylarını güncelle veya geliştir.</p>
                </div>
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <form action="<?php echo e(route('etkinlikler.update', $etkinlik->id)); ?>" method="POST" enctype="multipart/form-data" class="p-12 space-y-8">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest ml-1">Etkinlik Başlığı</label>
                        <input type="text" name="title" value="<?php echo e(old('title', $etkinlik->title)); ?>" required placeholder="Örn: Galata'da Gün Batımı Karnavalı"
                               class="w-full px-6 py-4 rounded-2xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50 text-lg">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest ml-1">Konum / Mekan</label>
                        <input type="text" name="location" value="<?php echo e(old('location', $etkinlik->location)); ?>" required placeholder="Örn: Beşiktaş Sahili veya Mekan Adı"
                               class="w-full px-6 py-4 rounded-2xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50 text-lg">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest ml-1">Şehir</label>
                        <div class="relative">
                            <select name="city" id="citySelect" required
                                    class="w-full px-6 py-4 rounded-2xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50 text-lg appearance-none cursor-pointer">
                                <option value="">Şehir Seçin</option>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($city->name); ?>" <?php echo e(old('city', $etkinlik->city) == $city->name ? 'selected' : ''); ?>><?php echo e($city->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest ml-1">İlçe</label>
                        <div class="relative">
                            <select name="district" id="districtSelect" required
                                    class="w-full px-6 py-4 rounded-2xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50 text-lg appearance-none cursor-pointer">
                                <option value="">İlçe Seçin</option>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <optgroup label="<?php echo e($city->name); ?>">
                                        <?php $__currentLoopData = $districts->where('city_id', $city->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($district->name); ?>" <?php echo e(old('district', $etkinlik->district) == $district->name ? 'selected' : ''); ?>><?php echo e($district->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </optgroup>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest ml-1">Etkinlik Tarihi</label>
                        <input type="datetime-local" name="date" value="<?php echo e(old('date', $etkinlik->date ? $etkinlik->date->format('Y-m-d\TH:i') : '')); ?>" required
                               class="w-full px-6 py-4 rounded-2xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50 text-lg">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest ml-1">Kategori</label>
                        <select name="category" required
                                class="w-full px-6 py-4 rounded-2xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50 text-lg appearance-none">
                            <option value="">Kategori Seçin</option>
                            <?php
                                $categories = ['Yürüyüş', 'Konser', 'Tiyatro', 'Atölye', 'Gezi', 'Spor', 'Yemek', 'Sergi', 'Diğer'];
                            ?>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category); ?>" <?php echo e(old('category', $etkinlik->category) == $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest ml-1">Kapak Fotoğrafı (Değiştirmek istemiyorsanız boş bırakın)</label>
                    <?php if($etkinlik->image): ?>
                        <div class="mb-4">
                            <img src="<?php echo e(asset('storage/' . $etkinlik->image)); ?>" class="h-32 rounded-xl border border-gray-200" alt="Current image">
                        </div>
                    <?php endif; ?>
                    <div class="relative">
                        <input type="file" name="image_file" accept="image/*"
                               class="w-full px-6 py-4 rounded-2xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50 text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest ml-1">Deneyimlerin & Detaylar</label>
                    <textarea name="content" rows="6" required placeholder="Etkinlik hakkında neler söylemek istersin?"
                              class="w-full px-6 py-4 rounded-2xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50 text-lg"><?php echo e(old('content', $etkinlik->content)); ?></textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 premium-gradient text-white rounded-2xl font-bold text-xl shadow-xl shadow-indigo-200 hover:scale-[1.02] transition-all duration-300">
                        Değişiklikleri Kaydet
                    </button>
                    <a href="<?php echo e(route('etkinlikler.show', $etkinlik->slug)); ?>" class="block text-center text-gray-500 mt-6 font-bold hover:text-indigo-600 transition-colors underline">Vazgeç</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/etkinlikler/edit.blade.php ENDPATH**/ ?>