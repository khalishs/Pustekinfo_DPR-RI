<?php $__env->startSection('title', 'Galeri Kegiatan'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-head">
  <h2>Galeri Kegiatan</h2>
  <a href="<?php echo e(route('admin.gallery.create')); ?>" class="btn btn-primary">+ Tambah Foto</a>
</div>
<div class="card">
  <small style="display:block;margin-bottom:14px;">Toggle <strong>Sorotan</strong> untuk memilih foto yang tampil sebagai sorotan di halaman galeri. Hanya bisa satu aktif — mengaktifkan salah satu otomatis menonaktifkan yang lain.</small>
  <div class="table-responsive">
  <table>
    <thead><tr><th>Foto</th><th>Judul</th><th>Kategori</th><th>Ukuran</th><th>Home</th><th class="text-center">Sorotan</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
      <tr>
        <td><img src="<?php echo e(asset($item->image)); ?>" style="width:70px;height:52px;object-fit:cover;border-radius:6px;"></td>
        <td><?php echo e($item->title ?? '-'); ?></td>
        <td><?php echo e($item->category->name ?? '-'); ?></td>
        <td><span class="badge cap"><?php echo e($item->size); ?></span></td>
        <td><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->show_on_home): ?><span class="badge-success">Ya</span><?php else: ?><span class="badge-muted">Tidak</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td>
        <td class="text-center">
          <form action="<?php echo e(route('admin.gallery.toggle-featured', $item)); ?>" method="POST">
            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
            <label class="toggle-switch" title="<?php echo e($item->is_featured ? 'Sorotan aktif — klik untuk nonaktifkan' : 'Jadikan sorotan'); ?>">
              <input type="checkbox" onchange="this.form.requestSubmit()" <?php echo e($item->is_featured ? 'checked' : ''); ?>>
              <span class="slider"></span>
            </label>
          </form>
        </td>
        <td class="text-center"><span class="badge-count"><?php echo e($item->sort_order); ?></span></td>
        <td class="row-actions">
          <a href="<?php echo e(route('admin.gallery.edit', $item)); ?>" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="<?php echo e(route('admin.gallery.destroy', $item)); ?>" method="POST" data-confirm="Hapus foto ini?">
            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
      <tr><td colspan="8">Belum ada foto galeri.</td></tr>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
  </table>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/gallery/index.blade.php ENDPATH**/ ?>