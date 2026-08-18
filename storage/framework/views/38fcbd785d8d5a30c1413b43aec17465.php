<?php $__env->startSection('title', 'Sambutan Pimpinan'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e(route('admin.leadership.update')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="form-grid">
      <div class="form-group">
        <label>Nama Pimpinan</label>
        <input type="text" name="name" value="<?php echo e(old('name', $leadership->name)); ?>" placeholder="Nama lengkap beserta gelar">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="show_name" value="1" style="width:auto;display:inline-block;" <?php echo e(old('show_name', $leadership->show_name ?? false) ? 'checked' : ''); ?>> Tampilkan nama</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['show_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Nama cuma muncul di section Sambutan Pimpinan kalau kotak ini dicentang DAN kolom Nama di atas terisi.</small>
      </div>

      <div class="form-group">
        <label class="required">Jabatan (tampil di foto)</label>
        <input type="text" name="position" value="<?php echo e(old('position', $leadership->position ?? 'KEPALA PUSTEKINFO')); ?>" required>
      </div>

      <div class="form-group form-span-2">
        <label>Foto Pimpinan</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($leadership->photo): ?>
          <img src="<?php echo e(asset($leadership->photo)); ?>" style="width:160px;border-radius:8px;margin-bottom:10px;display:block;">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <input type="file" name="photo" accept="image/*" data-min-kb="2048" data-max-kb="10240">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Kosongkan jika tidak ingin mengganti foto.</small>
      </div>

      <div class="form-group">
        <label class="required">Judul Sambutan</label>
        <input type="text" name="welcome_title" value="<?php echo e(old('welcome_title', $leadership->welcome_title ?? 'Teknologi untuk pelayanan yang lebih baik')); ?>" required>
      </div>

      <div class="form-group">
        <label>Judul Sambutan (EN)</label>
        <input type="text" name="welcome_title_en" value="<?php echo e(old('welcome_title_en', $leadership->welcome_title_en)); ?>">
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label class="required">Isi Sambutan</label>
        <textarea name="description" style="min-height:140px;" required><?php echo e(old('description', $leadership->description)); ?></textarea>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="form-group form-span-2">
        <label>Isi Sambutan (EN)</label>
        <textarea name="description_en" style="min-height:140px;"><?php echo e(old('description_en', $leadership->description_en)); ?></textarea>
        <small>Opsional — kosongkan untuk memakai isi Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group">
        <label class="required">Jabatan di Tanda Tangan</label>
        <input type="text" name="signature_role" value="<?php echo e(old('signature_role', $leadership->signature_role ?? 'Kepala Pusat Teknologi Informasi')); ?>" required>
      </div>

      <div class="form-group">
        <label>Jabatan di Tanda Tangan (EN)</label>
        <input type="text" name="signature_role_en" value="<?php echo e(old('signature_role_en', $leadership->signature_role_en)); ?>">
        <small>Opsional — kosongkan untuk memakai teks Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group">
        <label>Pendidikan</label>
        <input type="text" name="education" value="<?php echo e(old('education', $leadership->education)); ?>" placeholder="S2 Teknik Informatika">
      </div>

      <div class="form-group">
        <label>Pendidikan (EN)</label>
        <input type="text" name="education_en" value="<?php echo e(old('education_en', $leadership->education_en)); ?>" placeholder="M.Eng in Informatics">
      </div>

      <div class="form-group">
        <label>Masa Jabatan</label>
        <input type="text" name="term" value="<?php echo e(old('term', $leadership->term)); ?>" placeholder="2023 — sekarang">
      </div>

      <div class="form-group">
        <label>Masa Jabatan (EN)</label>
        <input type="text" name="term_en" value="<?php echo e(old('term_en', $leadership->term_en)); ?>" placeholder="2023 — present">
      </div>

      <div class="form-group">
        <label>Bidang Keahlian</label>
        <input type="text" name="expertise" value="<?php echo e(old('expertise', $leadership->expertise)); ?>" placeholder="Tata kelola TI & keamanan informasi">
      </div>

      <div class="form-group">
        <label>Bidang Keahlian (EN)</label>
        <input type="text" name="expertise_en" value="<?php echo e(old('expertise_en', $leadership->expertise_en)); ?>" placeholder="IT governance & information security">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo e(old('email', $leadership->email)); ?>" placeholder="kepala@pustekinfo.go.id">
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Khalish\Documents\Pustekinfo_DPR-RI\resources\views/admin/leadership/edit.blade.php ENDPATH**/ ?>