<?php $__env->startSection('title', $newsItem->exists ? 'Edit Berita' : 'Tambah Berita'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <form action="<?php echo e($newsItem->exists ? route('admin.news.update', $newsItem) : route('admin.news.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($newsItem->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Judul</label>
        <input type="text" name="title" value="<?php echo e(old('title', $newsItem->title)); ?>" required>
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
        <input type="text" name="title_en" value="<?php echo e(old('title_en', $newsItem->title_en)); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group">
        <label class="required">Kategori</label>
        <input type="text" name="category" value="<?php echo e(old('category', $newsItem->category)); ?>" placeholder="Pengumuman, Sistem, Pelatihan, dll" required>
      </div>

      <div class="form-group">
        <label>Kategori (EN)</label>
        <input type="text" name="category_en" value="<?php echo e(old('category_en', $newsItem->category_en)); ?>" placeholder="Announcement, System, Training, etc">
        <small>Opsional — kosongkan untuk memakai kategori Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label class="required">Ringkasan</label>
        <textarea name="excerpt" required><?php echo e(old('excerpt', $newsItem->excerpt)); ?></textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Ringkasan (EN)</label>
        <textarea name="excerpt_en"><?php echo e(old('excerpt_en', $newsItem->excerpt_en)); ?></textarea>
        <small>Opsional — kosongkan untuk memakai ringkasan Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Isi lengkap (opsional)</label>
        <textarea name="content" style="min-height:180px;"><?php echo e(old('content', $newsItem->content)); ?></textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Isi lengkap (EN, opsional)</label>
        <textarea name="content_en" style="min-height:180px;"><?php echo e(old('content_en', $newsItem->content_en)); ?></textarea>
        <small>Opsional — kosongkan untuk memakai isi Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Gambar</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($newsItem->image): ?>
          <img src="<?php echo e(asset($newsItem->image)); ?>" style="width:160px;border-radius:8px;margin-bottom:10px;display:block;">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <input type="file" name="image" accept="image/*" data-min-kb="2048" data-max-kb="10240">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Kosongkan jika tidak ingin mengganti gambar.</small>
      </div>

      <div class="form-group">
        <label class="required">Penulis</label>
        <input type="text" name="author" value="<?php echo e(old('author', $newsItem->author ?? 'Humas Pustekinfo')); ?>" required>
      </div>

      <div class="form-group">
        <label class="required">Estimasi waktu baca (menit)</label>
        <input type="number" name="reading_minutes" value="<?php echo e(old('reading_minutes', $newsItem->reading_minutes ?? 3)); ?>" min="1" required>
      </div>

      <div class="form-group">
        <label>Tanggal publish</label>
        <input type="datetime-local" name="published_at" value="<?php echo e(old('published_at', $newsItem->published_at?->format('Y-m-d\TH:i'))); ?>">
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_featured" value="1" style="width:auto;display:inline-block;" <?php echo e(old('is_featured', $newsItem->is_featured) ? 'checked' : ''); ?>> Jadikan berita utama (featured)</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['is_featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Cuma satu berita yang bisa jadi berita utama. Batalkan berita utama yang aktif dulu untuk memindahkannya.</small>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" <?php echo e(old('is_active', $newsItem->exists ? $newsItem->is_active : true) ? 'checked' : ''); ?>> Status aktif</label>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <small>Berita nonaktif tidak akan tampil di halaman mana pun untuk pengunjung situs.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="<?php echo e(route('admin.news.index')); ?>" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/news/form.blade.php ENDPATH**/ ?>