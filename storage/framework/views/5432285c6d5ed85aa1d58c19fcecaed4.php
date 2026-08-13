<?php $__env->startSection('title', 'Layanan'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-head">
  <h2>Kartu Layanan</h2>
  <a href="<?php echo e(route('admin.services.create')); ?>" class="btn btn-primary">+ Tambah Layanan</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Gambar</th><th>Judul</th><th>Ringkasan</th><th class="text-center">Jml. Fitur</th><th class="text-center">Urutan</th><th class="text-center">Aktif</th><th></th></tr></thead>
    <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td>
          <?php if($service->icon_image): ?>
            <img src="<?php echo e(asset($service->icon_image)); ?>" style="width:56px;height:56px;object-fit:contain;border-radius:8px;background:#f1f4f5;padding:4px;">
          <?php else: ?>
            <span style="color:#b7c2c7;font-size:12px;">Belum ada</span>
          <?php endif; ?>
        </td>
        <td><?php echo e($service->title); ?></td>
        <td><?php echo e(\Illuminate\Support\Str::limit($service->description, 70)); ?></td>
        <td class="text-center"><span class="badge-count"><?php echo e(count($service->features)); ?></span></td>
        <td class="text-center"><span class="badge-count"><?php echo e($service->sort_order); ?></span></td>
        <td class="text-center">
          <form action="<?php echo e(route('admin.services.toggle-active', $service)); ?>" method="POST">
            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
            <label class="toggle-switch" title="<?php echo e($service->is_active ? 'Aktif — klik untuk nonaktifkan' : 'Nonaktif — klik untuk aktifkan'); ?>">
              <input type="checkbox" onchange="this.form.submit()" <?php echo e($service->is_active ? 'checked' : ''); ?>>
              <span class="slider"></span>
            </label>
          </form>
        </td>
        <td class="row-actions">
          <a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="<?php echo e(route('admin.services.duplicate', $service)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button class="btn-icon btn-icon-copy" title="Salin" aria-label="Salin">
              <svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
            </button>
          </form>
          <form action="<?php echo e(route('admin.services.destroy', $service)); ?>" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="7">Belum ada layanan.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/services/index.blade.php ENDPATH**/ ?>