<?php $__env->startSection('title', 'Visi & Misi'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e(route('admin.vision-mission.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="required">Teks Visi</label>
        <textarea name="vision_text" style="min-height:100px;" required><?php echo e(old('vision_text', $item->vision_text)); ?></textarea>
        <?php $__errorArgs = ['vision_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group form-span-2">
        <label>Teks Visi (EN)</label>
        <textarea name="vision_text_en" style="min-height:100px;"><?php echo e(old('vision_text_en', $item->vision_text_en)); ?></textarea>
        <small>Opsional — kosongkan untuk memakai teks Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label class="required">Poin-poin Misi</label>
        <textarea name="mission_items" style="min-height:160px;" required><?php echo e(old('mission_items', $item->mission_items)); ?></textarea>
        <?php $__errorArgs = ['mission_items'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <small>Tulis satu poin misi per baris (tekan Enter untuk poin baru).</small>
      </div>

      <div class="form-group form-span-2">
        <label>Poin-poin Misi (EN)</label>
        <textarea name="mission_items_en" style="min-height:160px;"><?php echo e(old('mission_items_en', $item->mission_items_en)); ?></textarea>
        <small>Opsional — tulis satu poin per baris, urutan harus sama dengan versi Indonesia.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/vision-mission/edit.blade.php ENDPATH**/ ?>