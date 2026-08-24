<?php $__env->startSection('title', 'İletişim & Sosyal Medya Ayarları'); ?>
<?php $__env->startSection('page_title', 'İletişim ve Sosyal Medya Yönetimi'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8" x-data="{ activeTab: 'contact' }">

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-white">Site İletişim & Sosyal Medya Ayarları</h2>
            <p class="text-xs text-gray-400 font-medium mt-1">İletişim sayfası, üst menü ve alt bilgi (footer) alanlarında görünen tüm dinamik bilgileri buradan yönetebilirsiniz.</p>
        </div>
        <a href="<?php echo e(route('contact')); ?>" target="_blank"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/5 hover:bg-[#ff5528] text-gray-300 hover:text-white text-xs font-black uppercase tracking-wider rounded-xl transition border border-white/10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            İletişim Sayfasını Gör
        </a>
    </div>

    
    <div class="flex items-center gap-2 border-b border-gray-800 pb-4">
        <button @click="activeTab = 'contact'"
                :class="activeTab === 'contact' ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'bg-white/5 text-gray-400 hover:text-white hover:bg-white/10'"
                class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all flex items-center gap-2">
            <span>📍 İletişim Bilgileri</span>
        </button>

        <button @click="activeTab = 'social'"
                :class="activeTab === 'social' ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'bg-white/5 text-gray-400 hover:text-white hover:bg-white/10'"
                class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all flex items-center gap-2">
            <span>🌐 Sosyal Medya Hesapları</span>
        </button>

        <button @click="activeTab = 'general'"
                :class="activeTab === 'general' ? 'bg-[#ff5528] text-white shadow-lg shadow-[#ff5528]/25' : 'bg-white/5 text-gray-400 hover:text-white hover:bg-white/10'"
                class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all flex items-center gap-2">
            <span>⚙️ Footer & Açıklamalar</span>
        </button>
    </div>

    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" class="space-y-8">
        <?php echo csrf_field(); ?>

        
        <div x-show="activeTab === 'contact'" class="bg-[#16181e] rounded-3xl p-6 sm:p-8 border border-gray-800 shadow-xl space-y-6">
            <div class="border-b border-gray-800 pb-4 mb-6">
                <h3 class="text-sm font-black text-white uppercase tracking-wider">Temel İletişim Detayları</h3>
                <p class="text-xs text-gray-400 font-medium mt-0.5">Ziyaretçilerin ve kullanıcıların size ulaşacağı resmi iletişim bilgileri</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        Resmi E-Posta Adresi
                    </label>
                    <input type="email"
                           name="contact_email"
                           value="<?php echo e($settings['contact_email'] ?? 'destek@planify.com'); ?>"
                           placeholder="destek@planify.com"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        Telefon Numarası
                    </label>
                    <input type="text"
                           name="contact_phone"
                           value="<?php echo e($settings['contact_phone'] ?? '+90 (212) 555 01 23'); ?>"
                           placeholder="+90 (212) 555 01 23"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        WhatsApp Destek Hattı
                    </label>
                    <input type="text"
                           name="contact_whatsapp"
                           value="<?php echo e($settings['contact_whatsapp'] ?? '+90 (555) 123 45 67'); ?>"
                           placeholder="+90 (555) 123 45 67"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        Çalışma / Mesai Saatleri
                    </label>
                    <input type="text"
                           name="contact_working_hours"
                           value="<?php echo e($settings['contact_working_hours'] ?? 'Pazartesi - Cuma: 09:00 - 18:00'); ?>"
                           placeholder="Pazartesi - Cuma: 09:00 - 18:00"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div class="md:col-span-2">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        Açık Adres / Ofis Konumu
                    </label>
                    <textarea name="contact_address"
                              rows="3"
                              placeholder="Levent, Büyükdere Cad. No:199, Şişli / İstanbul"
                              class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl p-4 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition"><?php echo e($settings['contact_address'] ?? 'Levent, Büyükdere Cad. No:199, Şişli / İstanbul'); ?></textarea>
                </div>

                
                <div class="md:col-span-2">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        İletişim Sayfası Üst Açıklama Metni
                    </label>
                    <textarea name="contact_description"
                              rows="2"
                              placeholder="Sorularınız, etkinlik ortaklıkları ve önerileriniz için bize dilediğiniz zaman ulaşabilirsiniz."
                              class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl p-4 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition"><?php echo e($settings['contact_description'] ?? 'Sorularınız, etkinlik ortaklıkları ve önerileriniz için bize dilediğiniz zaman ulaşabilirsiniz.'); ?></textarea>
                </div>

                
                <div class="md:col-span-2">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        Google Haritalar (Maps) Embed URL
                    </label>
                    <input type="text"
                           name="contact_map_iframe"
                           value="<?php echo e($settings['contact_map_iframe'] ?? ''); ?>"
                           placeholder="https://www.google.com/maps/embed?pb=..."
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                    <p class="text-[11px] text-gray-500 font-medium mt-1.5">Google Maps'ten "Haritayı Yerleştir" seçeneğindeki `src="..."` URL'sini buraya yapıştırabilirsiniz.</p>
                </div>
            </div>
        </div>

        
        <div x-show="activeTab === 'social'" class="bg-[#16181e] rounded-3xl p-6 sm:p-8 border border-gray-800 shadow-xl space-y-6" style="display: none;">
            <div class="border-b border-gray-800 pb-4 mb-6">
                <h3 class="text-sm font-black text-white uppercase tracking-wider">Sosyal Medya Bağlantıları</h3>
                <p class="text-xs text-gray-400 font-medium mt-0.5">Footer ve İletişim sayfasında ziyaretçilerinize sunulacak resmi sosyal medya bağlantıları</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        📸 Instagram URL
                    </label>
                    <input type="url"
                           name="social_instagram"
                           value="<?php echo e($settings['social_instagram'] ?? ''); ?>"
                           placeholder="https://instagram.com/planify"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        𝕏 X (Twitter) URL
                    </label>
                    <input type="url"
                           name="social_twitter"
                           value="<?php echo e($settings['social_twitter'] ?? ''); ?>"
                           placeholder="https://x.com/planify"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        📺 YouTube URL
                    </label>
                    <input type="url"
                           name="social_youtube"
                           value="<?php echo e($settings['social_youtube'] ?? ''); ?>"
                           placeholder="https://youtube.com/@planify"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        💼 LinkedIn URL
                    </label>
                    <input type="url"
                           name="social_linkedin"
                           value="<?php echo e($settings['social_linkedin'] ?? ''); ?>"
                           placeholder="https://linkedin.com/company/planify"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        👥 Facebook URL
                    </label>
                    <input type="url"
                           name="social_facebook"
                           value="<?php echo e($settings['social_facebook'] ?? ''); ?>"
                           placeholder="https://facebook.com/planify"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        🎵 TikTok URL
                    </label>
                    <input type="url"
                           name="social_tiktok"
                           value="<?php echo e($settings['social_tiktok'] ?? ''); ?>"
                           placeholder="https://tiktok.com/@planify"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>

                
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        ✈️ Telegram Kanalı / Grubu
                    </label>
                    <input type="url"
                           name="social_telegram"
                           value="<?php echo e($settings['social_telegram'] ?? ''); ?>"
                           placeholder="https://t.me/planify"
                           class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl px-4 py-3.5 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition">
                </div>
            </div>
        </div>

        
        <div x-show="activeTab === 'general'" class="bg-[#16181e] rounded-3xl p-6 sm:p-8 border border-gray-800 shadow-xl space-y-6" style="display: none;">
            <div class="border-b border-gray-800 pb-4 mb-6">
                <h3 class="text-sm font-black text-white uppercase tracking-wider">Site & Footer Ayarları</h3>
                <p class="text-xs text-gray-400 font-medium mt-0.5">Alt bilgi alanındaki kurumsal tanıtım ve genel metinler</p>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">
                        Footer Tanıtım Metni
                    </label>
                    <textarea name="footer_about"
                              rows="3"
                              placeholder="Şehrin ritmini yakala, yeni deneyimler keşfet ve toplulukla buluş..."
                              class="w-full bg-[#0f1115] border border-gray-700/80 rounded-2xl p-4 text-xs sm:text-sm font-bold text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528] transition"><?php echo e($settings['footer_about'] ?? 'Şehrin ritmini yakala, yeni deneyimler keşfet ve toplulukla buluş. En güncel konserler, tiyatrolar, atölyeler ve sosyal planlar tek bir platformda.'); ?></textarea>
                </div>
            </div>
        </div>

        
        <div class="flex items-center justify-end gap-4 pt-4">
            <button type="submit"
                    class="px-8 py-4 bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all duration-300 shadow-lg shadow-[#ff5528]/25 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Ayarları Kaydet</span>
            </button>
        </div>

    </form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>