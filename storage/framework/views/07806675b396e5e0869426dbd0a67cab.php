<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<div class="stat-grid">
  <div class="stat-card">
    <span class="stat-icon"><svg viewBox="0 0 24 24"><path d="M4 4h13a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H4z"/><path d="M4 4v16a2 2 0 0 0 2 2h13"/><line x1="8" y1="9" x2="15" y2="9"/><line x1="8" y1="13" x2="15" y2="13"/></svg></span>
    <div class="stat-value"><?php echo e($newsCount); ?></div>
    <div class="stat-label">Total Berita</div>
  </div>
  <div class="stat-card">
    <span class="stat-icon"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
    <div class="stat-value"><?php echo e($upcomingAgendaCount); ?></div>
    <div class="stat-label">Agenda Mendatang</div>
  </div>
  <div class="stat-card">
    <span class="stat-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></span>
    <div class="stat-value"><?php echo e($galleryCount); ?></div>
    <div class="stat-label">Foto Galeri</div>
  </div>
  <div class="stat-card">
    <span class="stat-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><path d="M5 17v-2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><circle cx="12" cy="19" r="2"/></svg></span>
    <div class="stat-value"><?php echo e($organizationMemberCount); ?></div>
    <div class="stat-label">Anggota Struktur</div>
  </div>
  <div class="stat-card <?php echo e($unreadMessagesCount > 0 ? 'stat-card-alert' : ''); ?>">
    <span class="stat-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg></span>
    <div class="stat-value"><?php echo e($unreadMessagesCount); ?></div>
    <div class="stat-label">Pesan Belum Dibaca</div>
  </div>
  <div class="stat-card <?php echo e($pendingLayananCount > 0 ? 'stat-card-alert' : ''); ?>">
    <span class="stat-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg></span>
    <div class="stat-value"><?php echo e($pendingLayananCount); ?></div>
    <div class="stat-label">Pengajuan Menunggu</div>
  </div>
</div>

<div class="card">
  <div class="page-head">
    <h2>Akses Cepat</h2>
  </div>
  <div class="quick-links">
    <a href="<?php echo e(route('admin.news.index')); ?>" class="quick-link">+ Tambah Berita</a>
    <a href="<?php echo e(route('admin.agenda.index')); ?>" class="quick-link">+ Tambah Agenda</a>
    <a href="<?php echo e(route('admin.hero-slides.index')); ?>" class="quick-link">Kelola Hero Slider</a>
    <a href="<?php echo e(route('admin.services.index')); ?>" class="quick-link">Kelola Layanan</a>
    <a href="<?php echo e(route('admin.gallery.index')); ?>" class="quick-link">+ Tambah Foto Galeri</a>
    <a href="<?php echo e(route('admin.messages.index')); ?>" class="quick-link">Lihat Pesan Masuk</a>
  </div>
</div>

<div class="card">
  <div class="page-head">
    <h2>Pesan Terbaru</h2>
    <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-outline">Lihat Semua</a>
  </div>
  <div class="table-responsive">
  <table>
    <thead><tr><th>Nama</th><th>Kategori</th><th>Tanggal</th><th class="text-center">Status</th></tr></thead>
    <tbody>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $latestMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
      <tr>
        <td><a href="<?php echo e(route('admin.messages.show', $message)); ?>"><?php echo e($message->nama); ?></a></td>
        <td><span class="badge cap"><?php echo e($message->kategori); ?></span></td>
        <td><?php echo e($message->created_at->format('d M Y H:i')); ?></td>
        <td class="text-center"><?php echo $message->is_read ? '<span class="badge-muted">Dibaca</span>' : '<span class="badge-success">Baru</span>'; ?></td>
      </tr>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
      <tr><td colspan="4">Belum ada pesan masuk.</td></tr>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
  </table>
  </div>
</div>

<div class="card">
  <div class="page-head">
    <h2>Pengajuan Layanan Terbaru</h2>
    <a href="<?php echo e(route('admin.layanan-pengajuan.index')); ?>" class="btn btn-outline">Lihat Semua</a>
  </div>
  <div class="table-responsive">
  <table>
    <thead><tr><th>Kode</th><th>Nama</th><th>Jenis Layanan</th><th>Tanggal</th><th class="text-center">Status</th></tr></thead>
    <tbody>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $latestLayananRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
      <tr>
        <td><a href="<?php echo e(route('admin.layanan-pengajuan.show', $req)); ?>"><?php echo e($req->kode); ?></a></td>
        <td><?php echo e($req->nama); ?></td>
        <td><?php echo e($req->jenis_layanan); ?></td>
        <td><?php echo e($req->created_at->format('d M Y H:i')); ?></td>
        <td class="text-center"><?php echo $__env->make('admin.layanan-pengajuan._status-badge', ['status' => $req->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
      </tr>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
      <tr><td colspan="5">Belum ada pengajuan layanan.</td></tr>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
  </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Khalish\Documents\Pustekinfo_DPR-RI\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>