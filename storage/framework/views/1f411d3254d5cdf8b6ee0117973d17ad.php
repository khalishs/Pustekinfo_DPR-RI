<?php $__env->startSection('title', 'Pengajuan Layanan'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-head">
  <h2>Pengajuan Layanan</h2>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Kode</th><th>Nama</th><th>No. Telepon</th><th>Jenis Layanan</th><th>Tanggal</th><th class="text-center">Status</th><th></th></tr></thead>
    <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><?php echo e($req->kode); ?></td>
        <td><?php echo e($req->nama); ?></td>
        <td><?php echo e($req->no_tlpn); ?></td>
        <td><?php echo e($req->jenis_layanan); ?></td>
        <td><?php echo e($req->created_at->format('d M Y H:i')); ?></td>
        <td class="text-center"><?php echo $__env->make('admin.layanan-pengajuan._status-badge', ['status' => $req->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
        <td class="row-actions">
          <a href="<?php echo e(route('admin.layanan-pengajuan.show', $req)); ?>" class="btn btn-outline">Lihat</a>
          <form action="<?php echo e(route('admin.layanan-pengajuan.destroy', $req)); ?>" method="POST" onsubmit="return confirm('Hapus pengajuan ini?')">
            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="7">Belum ada pengajuan layanan.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/layanan-pengajuan/index.blade.php ENDPATH**/ ?>