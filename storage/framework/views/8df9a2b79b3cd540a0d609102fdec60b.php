<?php $__env->startSection('title', $event->exists ? 'Edit Agenda' : 'Tambah Agenda'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e($event->exists ? route('admin.agenda.update', $event) : route('admin.agenda.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Judul Kegiatan</label>
        <input type="text" name="title" value="<?php echo e(old('title', $event->title)); ?>" required>
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
        <label>Judul Kegiatan (EN)</label>
        <input type="text" name="title_en" value="<?php echo e(old('title_en', $event->title_en)); ?>">
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (opsional)</label>
        <textarea name="description"><?php echo e(old('description', $event->description)); ?></textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (EN, opsional)</label>
        <textarea name="description_en"><?php echo e(old('description_en', $event->description_en)); ?></textarea>
      </div>

      <div class="form-group">
        <label class="required">Tanggal</label>
        <input type="date" name="event_date" value="<?php echo e(old('event_date', $event->event_date?->format('Y-m-d'))); ?>" required>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['event_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="form-group">
        <label>Jam (opsional)</label>
        <input type="time" name="event_time" value="<?php echo e(old('event_time', $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('H:i') : '')); ?>">
      </div>

      <div class="form-group">
        <label>Lokasi (opsional)</label>
        <input type="text" name="location" value="<?php echo e(old('location', $event->location)); ?>">
      </div>

      <div class="form-group">
        <label class="required">Warna Titik Penanda</label>
        <div style="display:flex;align-items:center;gap:10px;">
          <input type="color" name="color" id="colorInput" value="<?php echo e(old('color', $event->color ?? '#14839C')); ?>" style="width:48px;height:40px;padding:2px;border:1px solid #dfe4e7;border-radius:8px;cursor:pointer;" required>
          <span id="colorHexPreview" style="font-family:monospace;font-size:13px;color:#5b6b73;"><?php echo e(old('color', $event->color ?? '#14839C')); ?></span>
        </div>
        <small>Warna ini akan tampil sebagai titik penanda pada kalender agenda di halaman publik.</small>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" <?php echo e(old('is_active', $event->exists ? $event->is_active : true) ? 'checked' : ''); ?>> Status aktif</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Agenda nonaktif tidak akan tampil di halaman mana pun untuk pengunjung situs.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="<?php echo e(route('admin.agenda.index')); ?>" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>

<script>
  document.getElementById('colorInput').addEventListener('input', function () {
    document.getElementById('colorHexPreview').textContent = this.value;
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/agenda/form.blade.php ENDPATH**/ ?>