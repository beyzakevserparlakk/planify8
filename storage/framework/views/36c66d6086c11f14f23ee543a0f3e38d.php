<?php $__env->startSection('content'); ?>
<div class="saved-page">

    <div class="saved-wrapper">

        
        <div class="saved-header">
            <span class="saved-badge">KİŞİSEL KOLEKSİYONUN</span>
            <h1 class="saved-title">Kaydedilen <span>Planlarım</span></h1>
            <p class="saved-subtitle">Seni heyecanlandıran, daha sonra tekrar bakmak için sakladığın tüm keşiflerin burada güvende.</p>
        </div>

        <?php if($saves->count() > 0): ?>

            
            <div class="saved-stats-bar">
                <span class="saved-count"><?php echo e($saves->count()); ?> içerik kaydedildi</span>
                <div class="saved-filter-group">
                    <button class="filter-btn active" onclick="filterItems(this, 'all')">Tümü</button>
                    <button class="filter-btn" onclick="filterItems(this, 'etkinlik')">Etkinlikler</button>
                </div>
            </div>

            
            <div class="saved-grid" id="saved-grid">
                <?php $__currentLoopData = $saves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $save): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $etkinlik = $save->etkinlik; ?>
                    <?php if($etkinlik): ?>
                    <div class="saved-card" data-type="etkinlik">
                        <div class="saved-card-image">
                            <img src="<?php echo e($etkinlik->image ? (str_starts_with($etkinlik->image, 'http') ? $etkinlik->image : asset('storage/' . $etkinlik->image)) : 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&q=80&w=600'); ?>"
                                alt="<?php echo e($etkinlik->title); ?>">

                            <div class="saved-card-overlay"></div>

                            <span class="saved-card-category"><?php echo e($etkinlik->category ?? 'Keşif'); ?></span>

                            <form action="<?php echo e(route('etkinlikler.save', $etkinlik->id)); ?>" method="POST" class="saved-card-remove-form">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="saved-card-remove" title="Kaydı kaldır">
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                </button>
                            </form>
                        </div>

                        <div class="saved-card-body">
                            <div class="saved-card-meta">
                                <span class="saved-card-location">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <?php echo e($etkinlik->location); ?>

                                </span>
                                <span class="saved-card-date"><?php echo e($etkinlik->date ? $etkinlik->date->format('d M Y') : 'Yakında'); ?></span>
                            </div>

                            <h3 class="saved-card-title"><?php echo e($etkinlik->title); ?></h3>

                            <a href="<?php echo e(route('etkinlikler.show', $etkinlik->slug)); ?>" class="saved-card-link">
                                Detayı Gör
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        <?php else: ?>
            
            <div class="saved-empty">
                <div class="saved-empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                </div>
                <h2 class="saved-empty-title">Henüz boş bir sayfa...</h2>
                <p class="saved-empty-text">Gelecekteki planlarını burada saklayabilirsin. Hemen yeni maceralar keşfetmeye ne dersin?</p>
                <a href="<?php echo e(route('etkinlikler.index')); ?>" class="saved-empty-btn">Keşfe Çık</a>
            </div>
        <?php endif; ?>

    </div>
</div>

<style>
/* ─── Page ─────────────────────────────────────────────── */
.saved-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #fff8f5 0%, #fff0eb 100%);
    padding: 80px 0 120px;
}

.saved-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* ─── Header ────────────────────────────────────────────── */
.saved-header {
    text-align: center;
    margin-bottom: 56px;
}

.saved-badge {
    display: inline-block;
    padding: 6px 18px;
    background: #eef0ff;
    color: #FF5528;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.35em;
    text-transform: uppercase;
    border-radius: 100px;
    border: 1px solid #d9dcff;
    margin-bottom: 20px;
}

.saved-title {
    font-size: clamp(36px, 6vw, 64px);
    font-weight: 900;
    color: #111;
    letter-spacing: -0.03em;
    line-height: 1.1;
    margin: 0 0 16px;
    font-style: italic;
}

.saved-title span {
    color: #FF5528;
}

.saved-subtitle {
    font-size: 16px;
    color: #888;
    max-width: 520px;
    margin: 0 auto;
    line-height: 1.7;
    font-style: italic;
}

/* ─── Stats bar ─────────────────────────────────────────── */
.saved-stats-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 12px;
}

.saved-count {
    font-size: 13px;
    color: #666;
    font-weight: 500;
}

.saved-filter-group {
    display: flex;
    gap: 6px;
}

.filter-btn {
    padding: 7px 16px;
    border-radius: 100px;
    border: 1px solid #e0e0e0;
    background: #fff;
    font-size: 12px;
    font-weight: 600;
    color: #666;
    cursor: pointer;
    transition: all 0.2s ease;
    will-change: transform;
}

.filter-btn.active,
.filter-btn:hover {
    background: #FF5528;
    border-color: #ffffff;
    color: #fff;
    transform: scale(1.08);
    box-shadow: 0 4px 12px rgba(255, 85, 40, 0.3);
}

/* ─── Grid ──────────────────────────────────────────────── */
.saved-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

/* ─── Card ──────────────────────────────────────────────── */
.saved-card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #ebebeb;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.saved-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 48px -8px rgba(79, 82, 211, 0.12);
}

/* Image */
.saved-card-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.saved-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.saved-card:hover .saved-card-image img {
    transform: scale(1.05);
}

.saved-card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 55%);
}

.saved-card-category {
    position: absolute;
    top: 14px;
    left: 14px;
    background: #FF5528;
    backdrop-filter: blur(8px);
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 100px;
}

.saved-card-remove-form {
    position: absolute;
    top: 12px;
    right: 12px;
}

.saved-card-remove {
    width: 36px;
    height: 36px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border: none;
    border-radius: 10px;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.18s;
}

.saved-card-remove:hover {
    background: #ff5a28;
}

.saved-card-remove svg {
    width: 16px;
    height: 16px;
}

/* Body */
.saved-card-body {
    padding: 20px 22px 22px;
}

.saved-card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

.saved-card-location {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 600;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.saved-card-location svg {
    width: 12px;
    height: 12px;
    color: #FF5528;
    flex-shrink: 0;
}

.saved-card-date {
    font-size: 11px;
    font-weight: 600;
    color: #bbb;
    letter-spacing: 0.05em;
}

.saved-card-title {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin: 0 0 18px;
    line-height: 1.3;
    font-style: italic;
    letter-spacing: -0.02em;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.saved-card-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 700;
    color: #FF5528;
    text-decoration: none;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    transition: gap 0.18s;
}

.saved-card-link:hover {
    gap: 12px;
}

.saved-card-link svg {
    width: 14px;
    height: 14px;
}

/* ─── Empty State ───────────────────────────────────────── */
.saved-empty {
    text-align: center;
    padding: 80px 24px;
    background: #fff;
    border-radius: 24px;
    border: 1px solid #ebebeb;
}

.saved-empty-icon {
    display: inline-flex;
    padding: 28px;
    background: #eef0ff;
    border-radius: 24px;
    margin-bottom: 28px;
}

.saved-empty-icon svg {
    width: 64px;
    height: 64px;
    color: #c7caff;
}

.saved-empty-title {
    font-size: 28px;
    font-weight: 900;
    color: #111;
    margin: 0 0 12px;
    font-style: italic;
    letter-spacing: -0.02em;
}

.saved-empty-text {
    font-size: 15px;
    color: #888;
    max-width: 400px;
    margin: 0 auto 32px;
    line-height: 1.7;
    font-style: italic;
}

.saved-empty-btn {
    display: inline-block;
    padding: 14px 36px;
    background: #FF5528;
    color: #fff;
    border-radius: 14px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    text-decoration: none;
    transition: opacity 0.18s, transform 0.18s;
}

.saved-empty-btn:hover {
    opacity: 0.88;
    transform: scale(1.03);
}

/* ─── Responsive ────────────────────────────────────────── */
@media (max-width: 640px) {
    .saved-page { padding: 48px 0 80px; }
    .saved-grid { grid-template-columns: 1fr; }
    .saved-stats-bar { flex-direction: column; align-items: flex-start; }
}
</style>

<script>
function filterItems(btn, type) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.querySelectorAll('.saved-card').forEach(card => {
        card.style.display = (type === 'all' || card.dataset.type === type) ? '' : 'none';
    });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/profile/saved.blade.php ENDPATH**/ ?>