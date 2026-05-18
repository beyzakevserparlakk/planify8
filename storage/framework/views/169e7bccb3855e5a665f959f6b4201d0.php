<?php $__env->startSection('content'); ?>

<section class="py-16 md:py-24 max-w-7xl mx-auto px-6" style="font-family: 'Outfit', sans-serif;">
    
    <div class="flex flex-col lg:flex-row lg:justify-between gap-12 lg:gap-24">
        
        
        <div class="lg:w-[62%]">
            
            <div class="mb-12" id="detay-alani">
                <a href="<?php echo e(route('etkinlikler.index')); ?>" class="inline-flex items-center gap-3 text-xs font-black tracking-[0.2em] uppercase text-gray-400 hover:text-[#ff5528] transition-all no-underline mb-10 group">
                    <div class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center group-hover:border-[#ff5528] group-hover:bg-[#ff5528] group-hover:text-white transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                    </div>
                    Tüm Etkinlikler
                </a>
                
                <div class="flex flex-wrap items-center gap-4 mb-8">
                    <span class="px-5 py-2 bg-gradient-to-r from-[#ff5528]/10 to-orange-500/10 text-[#ff5528] rounded-full text-[11px] font-black uppercase tracking-widest border border-[#ff5528]/20 shadow-sm">
                        <?php echo e($etkinlik->category->name ?? 'Etkinlik'); ?>

                    </span>
                    <div class="flex items-center gap-2 text-gray-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                        <span class="text-[11px] font-bold uppercase tracking-widest">
                            <?php echo e($etkinlik->created_at->translatedFormat('d F Y')); ?>

                        </span>
                    </div>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-black text-gray-900 leading-[1.05] mb-12 tracking-tight">
                    <?php echo e($etkinlik->title); ?>

                </h1>
                

            </div>

            
            <?php if($etkinlik->image): ?>
                <div class="mb-20 rounded-[4rem] overflow-hidden shadow-[0_40px_80px_-20px_rgba(0,0,0,0.15)] border border-gray-100 group relative" style="border-radius: 0.9ch">
                    <img src="<?php echo e(asset('storage/' . $etkinlik->image)); ?>" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-[2s]" alt="<?php echo e($etkinlik->title); ?>" style="border-radius: 0.9ch">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
            <?php endif; ?>

            
            <div class="premium-card p-1 gap-1 flex flex-col md:flex-row md:items-center overflow-hidden !rounded-[3rem] mb-16">
                <div class="flex-1 flex items-center gap-6 p-6 md:p-8 bg-gray-50/50 rounded-[2.8rem] transition-all hover:bg-gray-50 group">
                    <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center text-[#ff5528] shadow-xl shadow-gray-200/50 group-hover:scale-110 transition-transform duration-500 border border-gray-100">
                        <i class="fas fa-map-marker-alt text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-[#ff5528] uppercase tracking-[0.3em] mb-2 opacity-70">Mekan / Lokasyon</p>
                        <p class="text-xl md:text-2xl text-gray-900 font-black leading-tight tracking-tight">
                            <?php echo e($etkinlik->location); ?>

                        </p>
                    </div>
                </div>
            </div>

            
            <div class="prose prose-2xl prose-slate max-w-none text-gray-600 leading-[1.7] mb-20 font-medium px-2">
                <style>
                    .prose h2 { font-size: 2.5rem; font-weight: 900; color: #0f172a; margin-top: 2em; letter-spacing: -0.02em; }
                    .prose p { margin-bottom: 1.8em; }
                    .prose strong { color: #0f172a; font-weight: 800; }
                </style>
                <?php echo $etkinlik->content; ?>

            </div>

            
            <div class="mt-16 py-12 border-t-2 border-gray-50 flex flex-wrap justify-between items-center gap-10">
                <?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center gap-10">
                        <?php $isLiked = auth()->user()->likes()->where('etkinlik_id', $etkinlik->id)->exists(); ?>
                        <div class="flex items-center gap-8">
                            <button type="button" id="like-btn" data-event-id="<?php echo e($etkinlik->id); ?>"
                                class="w-20 h-20 rounded-full flex items-center justify-center transition-all duration-500 shadow-[0_20px_40px_rgba(239,68,68,0.15)] hover:shadow-[0_25px_50px_rgba(239,68,68,0.25)] border-none cursor-pointer group relative overflow-hidden active:scale-90"
                                style="background: <?php echo e($isLiked ? '#fff1f2' : '#f8fafc'); ?>; 
                                       color: <?php echo e($isLiked ? '#ef4444' : '#ff5528'); ?>;">
                                <div class="absolute top-0 -right-full w-full h-full bg-gradient-to-r from-transparent via-red-100/50 to-transparent group-hover:right-full transition-all duration-[1.2s] ease-in-out"></div>
                                <svg class="w-9 h-9 group-hover:scale-125 transition-transform relative z-10 drop-shadow-md" fill="<?php echo e($isLiked ? 'currentColor' : 'none'); ?>" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                            <div class="flex flex-col">
                                <span id="like-count" class="text-4xl font-black text-gray-900 tracking-tighter leading-none"><?php echo e($etkinlik->likes()->count()); ?></span>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mt-2">Beğeni</span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="flex items-center gap-6">
                    <span class="text-xs font-black text-gray-400 uppercase tracking-[0.3em]">Paylaş:</span>
                    <div class="flex gap-4">
                        <button class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#25D366] hover:text-white hover:shadow-xl hover:shadow-[#25D366]/20 transition-all duration-300"><i class="fab fa-whatsapp text-xl"></i></button>
                        <button class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#1DA1F2] hover:text-white hover:shadow-xl hover:shadow-[#1DA1F2]/20 transition-all duration-300"><i class="fab fa-twitter text-xl"></i></button>
                        <button class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-gray-900 hover:text-white hover:shadow-xl transition-all duration-300"><i class="fas fa-link text-lg"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <aside class="lg:w-[28%] lg:translate-x-32 flex flex-col h-full" style="transform: translateX(100px);">
            <div class="sticky top-32 mb-10">
                <?php if($similarEvents->count() > 0): ?>
                    <div class="bg-white rounded-[3.5rem] p-10 border border-gray-100 shadow-[0_40px_100px_-20px_rgba(0,0,0,0.06)] relative overflow-hidden" style="border-radius:35px;">
                        
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#ff5528]/5 rounded-full blur-3xl"></div>
                        
                        <div class="mb-12 relative">
                            <h4 class="text-3xl font-black text-gray-900 m-0 tracking-tight leading-tight">Bunları da<br>Keşfet</h4>
                            <div class="w-16 h-1.5 bg-gradient-to-r from-[#ff5528] to-orange-400 mt-5 rounded-full"></div>
                        </div>

                        <div class="flex flex-col gap-10">
                            <?php $__currentLoopData = $similarEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('etkinlikler.show', $similar->slug)); ?>" class="group flex gap-6 no-underline items-start">
                                <div class="w-28 h-28 flex-shrink-0 rounded-[2rem] overflow-hidden shadow-lg border border-gray-100 relative" style="border-radius: 0.9ch">
                                    <img src="<?php echo e($similar->image ? asset('storage/' . $similar->image) : 'https://images.unsplash.com/photo-1514525253361-bee1863265c7?w=200'); ?>"
                                         class="w-full h-full object-cover group-hover:scale-115 transition duration-[1.5s]" style="border-radius: 0.9ch">
                                    <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                                <div class="flex-1 pt-2">
                                    <h5 class="text-base font-black text-gray-900 leading-[1.3] group-hover:text-[#ff5528] transition duration-300 line-clamp-2 mb-3">
                                        <?php echo e($similar->title); ?>

                                    </h5>
                                    <div class="flex items-center gap-2.5 text-gray-400 group-hover:text-gray-600 transition-colors">
                                        <div class="p-1.5 bg-gray-50 rounded-lg text-[#ff5528]">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        </div>
                                        <span class="text-[11px] font-black uppercase tracking-widest truncate"><?php echo e($similar->location); ?></span>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <a href="<?php echo e(route('etkinlikler.index')); ?>" class="mt-12 group/all block text-center py-5 bg-gray-50 rounded-[2rem] text-gray-900 font-black text-[11px] tracking-[0.25em] uppercase hover:bg-[#ff5528] hover:text-white transition-all duration-500 no-underline border border-gray-100">
                            HEPSİNİ GÖR <span class="inline-block group-hover/all:translate-x-1 transition-transform ml-1">›</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-auto pb-10">
                
                <div class="p-10 bg-white border border-gray-100 shadow-[0_40px_100px_-20px_rgba(0,0,0,0.06)] relative overflow-hidden group" style="border-radius: 3rem;">
                    <div class="absolute -top-10 -right-10 w-48 h-48 bg-[#ff5528]/5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-[2s]"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-5 mb-8">
                            <div class="w-14 h-14 bg-[#ff5528] rounded-2xl flex items-center justify-center font-black text-2xl text-white shadow-xl shadow-[#ff5528]/20">P</div>
                            <div>
                                <span class="block font-black text-lg tracking-tight text-gray-900" style="margin-left: 1ch;">Planify Topluluğu</span>
                                <span class="block text-[10px] font-black text-[#ff5528] uppercase tracking-[0.3em] mt-1" style="margin-left: 1ch;">Bize Katılın</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 leading-relaxed mb-10 font-medium">
                            Şehrin en iyi etkinliklerinden anında haberdar olmak ve topluluğumuza katılmak için bizi takip edin.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#ff5528] hover:text-white hover:shadow-xl hover:shadow-[#ff5528]/20 transition-all duration-300"><i class="fab fa-whatsapp text-xl"></i></a>
                            <a href="#" class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#ff5528] hover:text-white hover:shadow-xl hover:shadow-[#ff5528]/20 transition-all duration-300"><i class="fab fa-instagram text-xl"></i></a>
                            <a href="#" class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#ff5528] hover:text-white hover:shadow-xl hover:shadow-[#ff5528]/20 transition-all duration-300"><i class="fab fa-twitter text-xl"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</section>

<style>
    .sticky { position: -webkit-sticky; position: sticky; align-self: flex-start; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const likeBtn = document.getElementById('like-btn');
    if (likeBtn) {
        likeBtn.addEventListener('click', function() {
            const eventId = this.getAttribute('data-event-id');
            
            // Butona tıklandığında hafif bir küçülme efekti
            this.style.transform = 'scale(0.9)';
            setTimeout(() => { this.style.transform = ''; }, 150);

            axios.post(`/etkinlikler/${eventId}/like`)
                .then(response => {
                    const status = response.data.status;
                    const count = response.data.count;
                    
                    const countSpan = document.getElementById('like-count');
                    if (countSpan) countSpan.innerText = count;
                    
                    const svg = this.querySelector('svg');
                    if (status === 'liked') {
                        this.style.background = '#fff1f2';
                        this.style.color = '#ef4444';
                        this.style.boxShadow = '0 20px 40px rgba(239,68,68,0.2)';
                        svg.setAttribute('fill', 'currentColor');
                        svg.classList.add('scale-125');
                    } else {
                        this.style.background = '#f8fafc';
                        this.style.color = '#ff5528';
                        this.style.boxShadow = '0 20px 40px rgba(255,85,40,0.2)';
                        svg.setAttribute('fill', 'none');
                        svg.classList.remove('scale-125');
                    }
                })
                .catch(error => {
                    if (error.response && error.response.status === 401) {
                        window.location.href = '<?php echo e(route("login")); ?>';
                    } else {
                        console.error('Beğeni işlemi sırasında bir hata oluştu:', error);
                    }
                });
        });
    }
});

// RSVP fonksiyonu
let currentRsvpId = null;

function setRsvp(status, eventId, existingRsvpId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    currentRsvpId = existingRsvpId;

    // Tüm butonları pasif yap (loading göstergesi)
    ['attending','interested','declined'].forEach(s => {
        const btn = document.getElementById('btn-' + s);
        if (btn) btn.style.opacity = '0.5';
    });

    let url, method;
    if (currentRsvpId) {
        // Mevcut RSVP'yi güncelle
        url    = `/rsvps/${currentRsvpId}/status/${status}`;
        method = 'PATCH';
    } else {
        // Yeni RSVP oluştur
        url    = `/etkinlikler/${eventId}/rsvp`;
        method = 'POST';
    }

    axios({ method, url, headers: { 'X-CSRF-TOKEN': csrfToken } })
        .then(() => {
            // Sayfa yenile (basit ve güvenilir yöntem)
            window.location.reload();
        })
        .catch(err => {
            if (err.response && err.response.status === 422) {
                // Zaten bu statüste — sadece yenile
                window.location.reload();
            } else {
                ['attending','interested','declined'].forEach(s => {
                    const btn = document.getElementById('btn-' + s);
                    if (btn) btn.style.opacity = '1';
                });
                console.error('RSVP hatası:', err);
            }
        });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/etkinlikler/show.blade.php ENDPATH**/ ?>