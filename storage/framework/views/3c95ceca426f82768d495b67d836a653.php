<?php $__env->startSection('title', $value->exists ? 'Edit Nilai' : 'Tambah Nilai'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e($value->exists ? route('admin.core-values.update', $value) : route('admin.core-values.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($value->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Judul (contoh: Integritas)</label>
        <input type="text" name="title" value="<?php echo e(old('title', $value->title)); ?>" required>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="form-group">
        <label>Judul (EN)</label>
        <input type="text" name="title_en" value="<?php echo e(old('title_en', $value->title_en)); ?>">
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label class="required">Deskripsi</label>
        <textarea name="description" required><?php echo e(old('description', $value->description)); ?></textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (EN)</label>
        <textarea name="description_en"><?php echo e(old('description_en', $value->description_en)); ?></textarea>
        <small>Opsional — kosongkan untuk memakai deskripsi Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group">
        <label class="required">Ikon</label>
        <select name="icon" required>
          <option value="integrity" <?php echo e(old('icon', $value->icon) == 'integrity' ? 'selected' : ''); ?>>Bintang (Integritas)</option>
          <option value="innovative" <?php echo e(old('icon', $value->icon) == 'innovative' ? 'selected' : ''); ?>>Lampu (Inovatif)</option>
          <option value="professional" <?php echo e(old('icon', $value->icon) == 'professional' ? 'selected' : ''); ?>>Perisai (Profesional)</option>
          <option value="collaborative" <?php echo e(old('icon', $value->icon) == 'collaborative' ? 'selected' : ''); ?>>Orang (Kolaboratif)</option>
          <option value="service" <?php echo e(old('icon', $value->icon) == 'service' ? 'selected' : ''); ?>>Tangan (Melayani)</option>
          <option value="accountable" <?php echo e(old('icon', $value->icon) == 'accountable' ? 'selected' : ''); ?>>Kunci (Akuntabel)</option>
        </select>
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $value->sort_order ?? 0)); ?>" required>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" <?php echo e(old('is_active', $value->exists ? $value->is_active : true) ? 'checked' : ''); ?>> Status aktif</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Nilai nonaktif tidak akan tampil di halaman mana pun untuk pengunjung situs.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="<?php echo e(route('admin.core-values.index')); ?>" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/core-values/form.blade.php ENDPATH**/ ?>