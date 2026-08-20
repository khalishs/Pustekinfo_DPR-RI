<?php $__env->startSection('title', 'Pengaturan Kontak'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="required">Alamat</label>
        <textarea name="address" required><?php echo e(old('address', $setting->address)); ?></textarea>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="form-group form-span-2">
        <label>Alamat (EN)</label>
        <textarea name="address_en"><?php echo e(old('address_en', $setting->address_en)); ?></textarea>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['address_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Opsional — kosongkan untuk memakai alamat Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group">
        <label class="required">Telepon</label>
        <input type="text" name="phone" value="<?php echo e(old('phone', $setting->phone)); ?>" required>
      </div>

      <div class="form-group">
        <label class="required">Email</label>
        <input type="email" name="email" value="<?php echo e(old('email', $setting->email)); ?>" required>
      </div>

      <div class="form-group">
        <label>Link Instagram</label>
        <input type="url" name="instagram_url" value="<?php echo e(old('instagram_url', $setting->instagram_url)); ?>" placeholder="https://instagram.com/...">
      </div>

      <div class="form-group">
        <label>Link YouTube</label>
        <input type="url" name="youtube_url" value="<?php echo e(old('youtube_url', $setting->youtube_url)); ?>" placeholder="https://youtube.com/...">
      </div>

      <div class="form-group">
        <label>Link X (Twitter)</label>
        <input type="url" name="x_url" value="<?php echo e(old('x_url', $setting->x_url)); ?>" placeholder="https://x.com/...">
      </div>

    </div>

    <p style="margin-top:4px;color:#7a8a92;font-size:12.5px;">Pengaturan section Lokasi (peta &amp; tampil/sembunyikan) sekarang ada di menu <a href="<?php echo e(route('admin.location-settings.edit')); ?>" style="color:var(--teal);font-weight:700;">Pengaturan Lokasi</a> tersendiri.</p>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/settings/edit.blade.php ENDPATH**/ ?>