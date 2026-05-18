<?php $__env->startSection('title', 'Etkinlik Yönetimi'); ?>

<?php $__env->startSection('content'); ?>


<div class="flex items-center gap-2 mb-6">
    <button onclick="switchTab('pending')" id="tab-pending"
        class="tab-btn active-tab px-6 py-3 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all flex items-center gap-2">
        <span class="w-5 h-5 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center text-[9px] font-black">
            <?php echo e($pending->count()); ?>

        </span>
        Bekleyenler
    </button>
    <button onclick="switchTab('approved')" id="tab-approved"
        class="tab-btn px-6 py-3 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all flex items-center gap-2">
        <span class="w-5 h-5 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-[9px] font-black">
            <?php echo e($approved->count()); ?>

        </span>
        Onaylananlar
    </button>
    <button onclick="switchTab('rejected')" id="tab-rejected"
        class="tab-btn px-6 py-3 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all flex items-center gap-2">
        <span class="w-5 h-5 rounded-full bg-red-100 text-red-500 flex items-center justify-center text-[9px] font-black">
            <?php echo e($rejected->count()); ?>

        </span>
        Reddedilenler
    </button>
</div>


<div id="panel-pending" class="tab-panel">
    <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-black font-heading uppercase tracking-tight text-[#0f172a]">Onay Bekleyen Etkinlikler</h3>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Aşağıdaki etkinlikleri inceleyip onaylayın veya reddedin.</p>
            </div>
        </div>
        <div class="overflow-x-auto p-8">
            <table id="pendingTable" class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Etkinlik</th>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Ekleyen</th>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Tarih</th>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etkinlik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t border-gray-50 hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                    <?php if($etkinlik->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $etkinlik->image)); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-300"><i class="fa-solid fa-image text-sm"></i></div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-[#0f172a]"><?php echo e($etkinlik->title); ?></p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase"><?php echo e(Str::limit($etkinlik->location, 25)); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-black text-[9px]"><?php echo e(substr($etkinlik->user->name, 0, 2)); ?></div>
                                <span class="text-xs font-bold text-gray-600"><?php echo e($etkinlik->user->name); ?></span>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="text-xs font-bold text-gray-500"><?php echo e($etkinlik->date ? $etkinlik->date->format('d.m.Y') : '-'); ?></span>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="<?php echo e(route('admin.events.approve', $etkinlik)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="icon-btn b-r-4 btn-light-success" title="Onayla"><i class="fa-solid fa-check"></i></button>
                                </form>
                                <form action="<?php echo e(route('admin.events.reject', $etkinlik)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="icon-btn b-r-4 btn-light-secondary" title="Reddet"><i class="fa-solid fa-xmark"></i></button>
                                </form>
                                <form action="<?php echo e(route('admin.events.destroy', $etkinlik)); ?>" method="POST" onsubmit="return confirm('Bu etkinliği silmek istediğinize emin misiniz?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="icon-btn b-r-4 btn-light-danger" title="Sil"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="px-4 py-16 text-center text-gray-400 text-sm font-bold uppercase tracking-widest">Onay bekleyen etkinlik yok 🎉</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="panel-approved" class="tab-panel hidden">
    <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-gray-50 bg-green-50/50 flex items-center gap-4">
            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-circle-check text-green-500"></i>
            </div>
            <div>
                <h3 class="text-lg font-black font-heading uppercase tracking-tight text-[#0f172a]">Onaylanan Etkinlikler</h3>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Bu etkinlikler sitede yayında.</p>
            </div>
        </div>
        <div class="overflow-x-auto p-8">
            <table id="approvedTable" class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Etkinlik</th>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Ekleyen</th>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Tarih</th>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $approved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etkinlik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t border-gray-50 hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                    <?php if($etkinlik->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $etkinlik->image)); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-300"><i class="fa-solid fa-image text-sm"></i></div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-[#0f172a]"><?php echo e($etkinlik->title); ?></p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase"><?php echo e(Str::limit($etkinlik->location, 25)); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-black text-[9px]"><?php echo e(substr($etkinlik->user->name, 0, 2)); ?></div>
                                <span class="text-xs font-bold text-gray-600"><?php echo e($etkinlik->user->name); ?></span>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="text-xs font-bold text-gray-500"><?php echo e($etkinlik->date ? $etkinlik->date->format('d.m.Y') : '-'); ?></span>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="<?php echo e(route('admin.events.reject', $etkinlik)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="icon-btn b-r-4 btn-light-secondary" title="Geri Al"><i class="fa-solid fa-rotate-left"></i></button>
                                </form>
                                <form action="<?php echo e(route('admin.events.destroy', $etkinlik)); ?>" method="POST" onsubmit="return confirm('Bu etkinliği silmek istediğinize emin misiniz?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="icon-btn b-r-4 btn-light-danger" title="Sil"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="px-4 py-16 text-center text-gray-400 text-sm font-bold uppercase tracking-widest">Henüz onaylanan etkinlik yok.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="panel-rejected" class="tab-panel hidden">
    <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-gray-50 bg-red-50/50 flex items-center gap-4">
            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-circle-xmark text-red-500"></i>
            </div>
            <div>
                <h3 class="text-lg font-black font-heading uppercase tracking-tight text-[#0f172a]">Reddedilen Etkinlikler</h3>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Bu etkinlikler sitede görünmüyor.</p>
            </div>
        </div>
        <div class="overflow-x-auto p-8">
            <table id="rejectedTable" class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Etkinlik</th>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Ekleyen</th>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Tarih</th>
                        <th class="px-4 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rejected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etkinlik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t border-gray-50 hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                    <?php if($etkinlik->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $etkinlik->image)); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-300"><i class="fa-solid fa-image text-sm"></i></div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-[#0f172a]"><?php echo e($etkinlik->title); ?></p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase"><?php echo e(Str::limit($etkinlik->location, 25)); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-black text-[9px]"><?php echo e(substr($etkinlik->user->name, 0, 2)); ?></div>
                                <span class="text-xs font-bold text-gray-600"><?php echo e($etkinlik->user->name); ?></span>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="text-xs font-bold text-gray-500"><?php echo e($etkinlik->date ? $etkinlik->date->format('d.m.Y') : '-'); ?></span>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="<?php echo e(route('admin.events.approve', $etkinlik)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="icon-btn b-r-4 btn-light-success" title="Onayla"><i class="fa-solid fa-check"></i></button>
                                </form>
                                <form action="<?php echo e(route('admin.events.destroy', $etkinlik)); ?>" method="POST" onsubmit="return confirm('Bu etkinliği silmek istediğinize emin misiniz?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="icon-btn b-r-4 btn-light-danger" title="Sil"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="px-4 py-16 text-center text-gray-400 text-sm font-bold uppercase tracking-widest">Reddedilen etkinlik yok.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<style>
    .tab-btn { background: white; color: #9ca3af; border: 1px solid #f3f4f6; }
    .tab-btn.active-tab { background: var(--primary-color); color: white; border-color: var(--primary-color); box-shadow: 0 4px 15px color-mix(in srgb, var(--primary-color), transparent 70%); }
</style>
<script>
// DataTables uyarılarını popup yerine console'a yaz
$.fn.dataTable.ext.errMode = 'none';

var tables = {};

const dtOpts = {
    language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json' },
    pageLength: 25,
    autoWidth: false,
    order: [[2, 'desc']],
    dom: '<"flex justify-between items-center mb-4"f>rt<"flex justify-between items-center mt-4"ip>',
    columns: [
        { orderable: true },
        { orderable: true },
        { orderable: true },
        { orderable: false }
    ],
    drawCallback: function() {
        $('.dataTables_filter input').addClass('bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm outline-none transition-all ml-2');
    }
};

function switchTab(tab) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active-tab'));
    document.getElementById('panel-' + tab).classList.remove('hidden');
    document.getElementById('tab-' + tab).classList.add('active-tab');
    if (tables[tab]) tables[tab].columns.adjust().draw();
}

$(document).ready(function() {
    ['approved', 'rejected'].forEach(function(tab) {
        var panel = document.getElementById('panel-' + tab);
        panel.style.cssText = 'display:block !important; position:absolute; visibility:hidden; pointer-events:none;';
        try {
            tables[tab] = $('#' + tab + 'Table').DataTable(dtOpts);
        } catch(e) {
            console.warn('DataTable init hatası (' + tab + '):', e);
        }
        panel.style.cssText = '';
        panel.classList.add('hidden');
    });

    tables['pending'] = $('#pendingTable').DataTable(dtOpts);
});
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\planify\resources\views/admin/events/index.blade.php ENDPATH**/ ?>