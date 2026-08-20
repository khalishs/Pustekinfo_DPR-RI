<?php $__env->startSection('title', $statistic->exists ? 'Edit Statistik' : 'Tambah Statistik'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e($statistic->exists ? route('admin.statistics.update', $statistic) : route('admin.statistics.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($statistic->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="required">Kode SVG ikon</label>
        <textarea name="icon_svg" id="iconSvgInput" rows="3" style="font-family:monospace;font-size:12.5px;" required><?php echo e(old('icon_svg', $statistic->icon_svg)); ?></textarea>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['icon_svg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Isi elemen SVG-nya saja (tanpa tag &lt;svg&gt; pembungkus), contoh: <code>&lt;circle cx="12" cy="12" r="9"/&gt;</code>. Tag yang diizinkan: path, rect, circle, ellipse, line, polygon, polyline, g. Viewbox mengikuti "0 0 24 24".</small>
        <div style="margin-top:10px;width:48px;height:48px;border-radius:12px;background:rgba(20,128,140,.1);display:flex;align-items:center;justify-content:center;">
          <svg id="iconSvgPreview" viewBox="0 0 24 24" style="width:22px;height:22px;stroke:var(--teal);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;"><?php echo old('icon_svg', $statistic->icon_svg); ?></svg>
        </div>
      </div>

      <div class="form-group">
        <label class="required">Label</label>
        <input type="text" name="label" value="<?php echo e(old('label', $statistic->label)); ?>" required>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
      <div class="form-group">
        <label>Label (EN)</label>
        <input type="text" name="label_en" value="<?php echo e(old('label_en', $statistic->label_en)); ?>">
        <small>Opsional — kosongkan untuk memakai label Bahasa Indonesia di atas.</small>
      </div>
      <div class="form-group">
        <label class="required">Nilai (angka)</label>
        <input type="number" step="0.01" name="value" value="<?php echo e(old('value', $statistic->value)); ?>" required>
      </div>
      <div class="form-group">
        <label>Suffix (contoh: +, K — kosongkan kalau tidak ada)</label>
        <input type="text" name="suffix" value="<?php echo e(old('suffix', $statistic->suffix)); ?>">
      </div>
      <div class="form-group">
        <label class="required">Jumlah angka desimal</label>
        <input type="number" name="decimals" value="<?php echo e(old('decimals', $statistic->decimals ?? 0)); ?>" min="0" max="2" required>
      </div>
      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $statistic->sort_order ?? 0)); ?>" required>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" <?php echo e(old('is_active', $statistic->exists ? $statistic->is_active : true) ? 'checked' : ''); ?>> Status aktif</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Statistik nonaktif tidak akan tampil di halaman mana pun untuk pengunjung situs.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="<?php echo e(route('admin.statistics.index')); ?>" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>

<script>
  document.getElementById('iconSvgInput').addEventListener('input', function () {
    document.getElementById('iconSvgPreview').innerHTML = this.value;
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/statistics/form.blade.php ENDPATH**/ ?>