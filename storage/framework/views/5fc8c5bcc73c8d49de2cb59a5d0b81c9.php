<?php $__env->startSection('title', 'Struktur Organisasi'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-head">
  <h2>Struktur Organisasi</h2>
  <?php if($atCapacity): ?>
    <span class="btn btn-outline" style="opacity:.6;cursor:not-allowed;" title="Sudah mencapai batas maksimal (1 Kepala + 4 Bidang)">Struktur sudah penuh (5/5)</span>
  <?php else: ?>
    <a href="<?php echo e(route('admin.organization-members.create')); ?>" class="btn btn-primary">+ Tambah Anggota</a>
  <?php endif; ?>
</div>
<p style="color:#7a8a92;font-size:13px;margin:-10px 0 16px;">Struktur organisasi dibatasi maksimal 5 anggota: 1 Kepala dan 4 Bidang.</p>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Foto</th><th>Nama</th><th>Jabatan</th><th>Level</th><th class="text-center">Urutan</th><th class="text-center">Aktif</th><th></th></tr></thead>
    <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td>
          <?php if($m->photo): ?>
            <img src="<?php echo e(asset($m->photo)); ?>" style="width:44px;height:44px;object-fit:cover;border-radius:50%;<?php echo e($m->show_photo ? '' : 'opacity:.35;'); ?>">
            <div><?php echo $m->show_photo ? '<span class="badge-success" style="margin-top:4px;">Tampil</span>' : '<span class="badge-muted" style="margin-top:4px;">Sembunyi</span>'; ?></div>
          <?php else: ?>
            <span style="color:#b7c2c7;font-size:12px;">Belum ada</span>
          <?php endif; ?>
        </td>
        <td>
          <?php echo e($m->name ?: '-'); ?>

          <?php if($m->name): ?>
            <div><?php echo $m->show_name ? '<span class="badge-success">Tampil</span>' : '<span class="badge-muted">Sembunyi</span>'; ?></div>
          <?php endif; ?>
        </td>
        <td><?php echo e($m->position); ?></td>
        <td><span class="badge"><?php echo e(['kepala'=>'Kepala','bidang'=>'Bidang'][$m->level]); ?></span></td>
        <td class="text-center"><span class="badge-count"><?php echo e($m->sort_order); ?></span></td>
        <td class="text-center">
          <form action="<?php echo e(route('admin.organization-members.toggle-active', $m)); ?>" method="POST">
            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
            <label class="toggle-switch" title="<?php echo e($m->is_active ? 'Aktif — klik untuk nonaktifkan' : 'Nonaktif — klik untuk aktifkan'); ?>">
              <input type="checkbox" onchange="this.form.requestSubmit()" <?php echo e($m->is_active ? 'checked' : ''); ?>>
              <span class="slider"></span>
            </label>
          </form>
        </td>
        <td class="row-actions">
          <a href="<?php echo e(route('admin.organization-members.edit', $m)); ?>" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="<?php echo e(route('admin.organization-members.destroy', $m)); ?>" method="POST" onsubmit="return confirm('Hapus anggota ini?')">
            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="7">Belum ada data struktur organisasi.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/organization-members/index.blade.php ENDPATH**/ ?>