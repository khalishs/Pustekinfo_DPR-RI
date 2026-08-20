<?php $__env->startSection('title', $item->exists ? 'Edit Foto Galeri' : 'Tambah Foto Galeri'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e($item->exists ? route('admin.gallery.update', $item) : route('admin.gallery.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Judul Kegiatan</label>
        <input type="text" name="title" value="<?php echo e(old('title', $item->title)); ?>" required>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Foto dengan judul kegiatan yang sama akan dihitung sebagai 1 kegiatan terdokumentasi.</small>
      </div>

      <div class="form-group">
        <label>Judul Kegiatan (EN)</label>
        <input type="text" name="title_en" value="<?php echo e(old('title_en', $item->title_en)); ?>">
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (opsional, tampil kalau dijadikan sorotan)</label>
        <textarea name="description"><?php echo e(old('description', $item->description)); ?></textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (EN, opsional)</label>
        <textarea name="description_en"><?php echo e(old('description_en', $item->description_en)); ?></textarea>
      </div>

      <div class="form-group form-span-2">
        <label class="<?php echo e($item->exists ? '' : 'required'); ?>">Foto</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->image): ?>
          <img src="<?php echo e(asset($item->image)); ?>" style="width:160px;border-radius:8px;margin-bottom:10px;display:block;">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <input type="file" name="image" accept="image/*" data-min-kb="2048" data-max-kb="10240" <?php echo e($item->exists ? '' : 'required'); ?>>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->exists): ?><small>Kosongkan jika tidak ingin mengganti foto.</small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="form-group">
        <label class="required">Kategori</label>
        <select name="category_id" required>
          <option value="">— Pilih kategori —</option>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $item->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </select>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Kategori baru bisa ditambah di menu "Kategori Galeri".</small>
      </div>

      <div class="form-group">
        <label class="required">Ukuran kartu</label>
        <select name="size" required>
          <option value="big" <?php echo e(old('size', $item->size) == 'big' ? 'selected' : ''); ?>>Besar (2x2)</option>
          <option value="wide" <?php echo e(old('size', $item->size) == 'wide' ? 'selected' : ''); ?>>Lebar</option>
          <option value="med" <?php echo e(old('size', $item->size) == 'med' ? 'selected' : ''); ?>>Sedang</option>
          <option value="small" <?php echo e(old('size', $item->size ?? 'small') == 'small' ? 'selected' : ''); ?>>Kecil</option>
        </select>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Slot di Home &mdash; Besar: <?php echo e($sizeCounts['big'] ?? 0); ?>/<?php echo e($sizeLimits['big']); ?>, Sedang: <?php echo e($sizeCounts['med'] ?? 0); ?>/<?php echo e($sizeLimits['med']); ?>, Lebar: <?php echo e($sizeCounts['wide'] ?? 0); ?>/<?php echo e($sizeLimits['wide']); ?>, Kecil: <?php echo e($sizeCounts['small'] ?? 0); ?>/<?php echo e($sizeLimits['small']); ?>.</small>
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $item->sort_order ?? 0)); ?>" required>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_featured" value="1" style="width:auto;display:inline-block;" <?php echo e(old('is_featured', $item->is_featured) ? 'checked' : ''); ?>> Jadikan sorotan di halaman galeri</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['is_featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Cuma satu foto yang bisa jadi sorotan. Kalau sudah ada foto lain yang jadi sorotan, batalkan dulu sorotannya sebelum mencentang ini.</small>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="show_on_home" value="1" style="width:auto;display:inline-block;" <?php echo e(old('show_on_home', $item->show_on_home) ? 'checked' : ''); ?>> Tampilkan di halaman utama (Home)</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['show_on_home'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Slot terpakai: <?php echo e($homeCount); ?>/<?php echo e($maxHomeItems); ?>. Maksimal <?php echo e($maxHomeItems); ?> foto yang bisa tampil di Home.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="<?php echo e(route('admin.gallery.index')); ?>" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/gallery/form.blade.php ENDPATH**/ ?>