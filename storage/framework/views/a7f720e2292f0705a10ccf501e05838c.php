<?php $__env->startSection('title', 'Banner Halaman '.$label); ?>
<?php $__env->startSection('content'); ?>
<div class="page-head">
  <h2>Banner Halaman <?php echo e($label); ?></h2>
</div>
<div class="card">
  <form action="<?php echo e(route('admin.page-banners.update', $pageKey)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="required">Gambar Banner Saat Ini</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banner->image): ?>
          <img src="<?php echo e(asset($banner->image)); ?>" style="width:100%;max-width:420px;aspect-ratio:16/6;object-fit:cover;border-radius:8px;margin-bottom:10px;display:block;">
        <?php else: ?>
          <p style="color:#8a97a0;font-size:13px;margin-bottom:10px;">Belum ada banner. Halaman akan memakai latar polos bawaan.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <input type="file" name="image" accept="image/*" data-min-kb="2048" data-max-kb="10240" required>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Disarankan gambar lebar (misal 1600×600px) agar tidak terpotong.</small>
      </div>
    </div>

    <div class="form-actions" style="display:flex;gap:10px;">
      <button class="btn btn-primary">Simpan Banner</button>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banner->exists && $banner->image): ?>
        <button class="btn btn-outline" type="submit" form="deleteBannerForm">Hapus Banner</button>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </form>

  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banner->exists && $banner->image): ?>
    <form id="deleteBannerForm" action="<?php echo e(route('admin.page-banners.destroy', $pageKey)); ?>" method="POST" onsubmit="return confirm('Hapus banner halaman <?php echo e($label); ?>?')">
      <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
    </form>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Khalish\Documents\Pustekinfo_DPR-RI\resources\views/admin/page-banners/edit.blade.php ENDPATH**/ ?>