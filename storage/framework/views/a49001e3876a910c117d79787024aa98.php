<?php $__env->startSection('title', 'Detail Pesan'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-head">
  <h2>Pesan dari <?php echo e($message->nama); ?></h2>
</div>
<div class="card">
  <div class="form-grid">
    <div class="form-group">
      <label>Nama</label>
      <p><?php echo e($message->nama); ?></p>
    </div>
    <div class="form-group">
      <label>Email</label>
      <p><?php echo e($message->email); ?></p>
    </div>
    <?php if($message->instansi): ?>
    <div class="form-group">
      <label>Instansi</label>
      <p><?php echo e($message->instansi); ?></p>
    </div>
    <?php endif; ?>
    <div class="form-group">
      <label>Kategori</label>
      <p><span class="badge cap"><?php echo e($message->kategori); ?></span></p>
    </div>
    <div class="form-group">
      <label>Tanggal Kirim</label>
      <p><?php echo e($message->created_at->format('d M Y H:i')); ?></p>
    </div>
    <div class="form-group form-span-2">
      <label>Pesan</label>
      <p style="white-space:pre-line;"><?php echo e($message->pesan); ?></p>
    </div>
  </div>

  <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-outline">Kembali</a>
  <form action="<?php echo e(route('admin.messages.destroy', $message)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus pesan ini?')">
    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
    <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
      <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
    </button>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/messages/show.blade.php ENDPATH**/ ?>