<?php $__env->startSection('title', $member->exists ? 'Edit Anggota' : 'Tambah Anggota'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e($member->exists ? route('admin.organization-members.update', $member) : route('admin.organization-members.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($member->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <div class="form-grid">
      <div class="form-group">
        <label>Nama (opsional)</label>
        <input type="text" name="name" value="<?php echo e(old('name', $member->name)); ?>">
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <small>Kosongkan kalau cuma mau tampilkan jabatannya saja.</small>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="show_name" value="1" style="width:auto;display:inline-block;" <?php echo e(old('show_name', $member->exists ? $member->show_name : false) ? 'checked' : ''); ?>> Tampilkan nama</label>
        <?php $__errorArgs = ['show_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <small>Nama cuma muncul di bagan kalau kotak ini dicentang DAN kolom Nama di atas terisi.</small>
      </div>

      <div class="form-group">
        <label class="required">Jabatan</label>
        <input type="text" name="position" value="<?php echo e(old('position', $member->position)); ?>" required>
      </div>

      <div class="form-group">
        <label>Jabatan (EN)</label>
        <input type="text" name="position_en" value="<?php echo e(old('position_en', $member->position_en)); ?>">
        <small>Opsional — kosongkan untuk memakai jabatan Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Foto</label>
        <?php if($member->photo): ?>
          <img src="<?php echo e(asset($member->photo)); ?>" style="width:120px;border-radius:8px;margin-bottom:10px;display:block;">
        <?php endif; ?>
        <input type="file" name="photo" accept="image/*" data-min-kb="2048" data-max-kb="10240">
        <small>Kosongkan jika tidak ingin mengganti foto.</small>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="show_photo" value="1" style="width:auto;display:inline-block;" <?php echo e(old('show_photo', $member->exists ? $member->show_photo : false) ? 'checked' : ''); ?>> Tampilkan foto</label>
        <?php $__errorArgs = ['show_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <small>Foto cuma muncul di bagan kalau kotak ini dicentang DAN foto sudah diunggah.</small>
      </div>

      <div class="form-group">
        <label class="required">Level</label>
        <select name="level" required>
          <option value="kepala" <?php echo e(old('level', $member->level) == 'kepala' ? 'selected' : ''); ?> <?php echo e($kepalaFull ? 'disabled' : ''); ?>>Kepala (baris atas bagan — hanya 1)<?php echo e($kepalaFull ? ' — sudah terisi' : ''); ?></option>
          <option value="bidang" <?php echo e(old('level', $member->level ?? 'bidang') == 'bidang' ? 'selected' : ''); ?> <?php echo e($bidangFull ? 'disabled' : ''); ?>>Bidang (baris bawah bagan — maksimal 4)<?php echo e($bidangFull ? ' — sudah penuh' : ''); ?></option>
        </select>
        <?php $__errorArgs = ['level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <small>Bagan organisasi cuma 2 baris: 1 Kepala di atas, dan maksimal 4 anggota "Bidang" berjajar di bawahnya (total maksimal 5 anggota).</small>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi Unit (opsional)</label>
        <textarea name="unit_description" placeholder="Mengelola jaringan, pusat data, dll."><?php echo e(old('unit_description', $member->unit_description)); ?></textarea>
        <small>Tampil sebagai teks kecil di bawah jabatan pada bagan organisasi, kalau diisi.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi Unit (EN, opsional)</label>
        <textarea name="unit_description_en" placeholder="Manages networking, data center, etc."><?php echo e(old('unit_description_en', $member->unit_description_en)); ?></textarea>
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $member->sort_order ?? 0)); ?>" required>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" <?php echo e(old('is_active', $member->exists ? $member->is_active : true) ? 'checked' : ''); ?>> Status aktif</label>
        <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <small>Anggota nonaktif tidak akan tampil di halaman mana pun untuk pengunjung situs.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="<?php echo e(route('admin.organization-members.index')); ?>" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/organization-members/form.blade.php ENDPATH**/ ?>