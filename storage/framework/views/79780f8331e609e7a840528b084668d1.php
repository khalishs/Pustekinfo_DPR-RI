<?php $__env->startSection('title', $item->exists ? 'Edit Video Sekilas STELA' : 'Tambah Video Sekilas STELA'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e($item->exists ? route('admin.stela-videos.update', $item) : route('admin.stela-videos.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label>Link Video</label>
        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:9px;">
          <span class="badge">YouTube</span>
          <span class="badge">Google Drive</span>
          <span class="badge">Terabox</span>
          <span class="badge">Link video lainnya</span>
        </div>
        <input type="url" name="video_url" value="<?php echo e(old('video_url', $item->video_url)); ?>" placeholder="Masukkan link video">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['video_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Link YouTube &amp; Google Drive akan tampil langsung terputar di halaman; link lain akan tampil sebagai tombol buka video.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Link Website STELA</label>
        <input type="url" name="link_url" value="<?php echo e(old('link_url', $item->link_url)); ?>" placeholder="https://stela.dpr.go.id">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['link_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Kosongkan untuk memakai default: https://stela.dpr.go.id</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="<?php echo e(route('admin.stela-videos.index')); ?>" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Khalish\Documents\Pustekinfo_DPR-RI\resources\views/admin/stela-videos/form.blade.php ENDPATH**/ ?>