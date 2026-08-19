<?php $__env->startSection('title', $photo->exists ? 'Edit Foto' : 'Tambah Foto'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e($photo->exists ? route('admin.profil-photos.update', $photo) : route('admin.profil-photos.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($photo->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="<?php echo e($photo->exists ? '' : 'required'); ?>">Foto</label>
        <?php if($photo->image): ?>
          <img src="<?php echo e(asset($photo->image)); ?>" style="width:200px;border-radius:8px;margin-bottom:10px;display:block;">
        <?php endif; ?>
        <input type="file" name="image" accept="image/*" data-min-kb="2048" data-max-kb="10240" <?php echo e($photo->exists ? '' : 'required'); ?>>
        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php if($photo->exists): ?><small>Kosongkan jika tidak ingin mengganti foto.</small><?php endif; ?>
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $photo->sort_order ?? 0)); ?>" required>
        <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" <?php echo e(old('is_active', $photo->is_active ?? true) ? 'checked' : ''); ?>> Tampilkan di beranda</label>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="<?php echo e(route('admin.profil-photos.index')); ?>" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/profil-photos/form.blade.php ENDPATH**/ ?>