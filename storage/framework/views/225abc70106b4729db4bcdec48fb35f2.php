<?php $__env->startSection('title', 'Pengaturan Lokasi'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-head">
  <h2>Pengaturan Lokasi</h2>
</div>

<div class="card">
  <form action="<?php echo e(route('admin.location-settings.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="form-grid">
      <div class="form-group form-span-2" style="display:flex;align-items:center;gap:12px;">
        <label class="toggle-switch">
          <input type="checkbox" name="show_location" value="1" <?php echo e(old('show_location', $setting->show_location ?? true) ? 'checked' : ''); ?>>
          <span class="slider"></span>
        </label>
        <div>
          <strong style="display:block;font-size:13.5px;color:var(--navy);">Tampilkan section Lokasi di halaman Kontak</strong>
          <small style="color:#8a97a0;">Kalau dimatikan, seluruh section Lokasi (judul, peta, dsb) akan disembunyikan dari halaman Kontak publik — pengaturan peta di bawah tetap tersimpan.</small>
        </div>
      </div>

      <div class="form-group form-span-2">
        <label>Link Peta (Google Maps Embed)</label>
        <input type="url" name="maps_embed_url" id="mapsEmbedUrl" value="<?php echo e(old('maps_embed_url', $setting->maps_embed_url)); ?>" placeholder="https://www.google.com/maps/embed?pb=...">
        <small>Buka Google Maps &rarr; Bagikan &rarr; Sematkan peta &rarr; salin kode iframe &rarr; ambil hanya nilai atribut <code>src="..."</code>-nya, lalu tempel di sini. Kosongkan untuk memakai peta default Gedung Sekretariat DPR RI.</small>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['maps_embed_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="form-group form-span-2">
        <label>Pratinjau Peta</label>
        <div id="mapsPreviewWrap" style="border-radius:12px;overflow:hidden;border:1px solid var(--line);background:#eef1f3;min-height:320px;position:relative;">
          <iframe id="mapsPreview"
            src="<?php echo e(old('maps_embed_url', $setting->maps_embed_url) ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4137668829876!2d106.79718367398998!3d-6.209030293778832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6b735ae6133%3A0x214dde968c25b376!2sSekretariat%20Jenderal%20Dewan%20Perwakilan%20Rakyat%20Republik%20Indonesia!5e0!3m2!1sid!2sus!4v1784135196454!5m2!1sid!2sus'); ?>"
            style="width:100%;height:320px;border:0;display:block;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <small>Pratinjau ikut berubah kalau link di atas diganti — cek dulu peta yang muncul sebelum disimpan.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>

<script>
  (function(){
    var input = document.getElementById('mapsEmbedUrl');
    var preview = document.getElementById('mapsPreview');
    var defaultSrc = preview.getAttribute('src');
    var timer = null;
    input.addEventListener('input', function(){
      clearTimeout(timer);
      timer = setTimeout(function(){
        var url = input.value.trim();
        preview.src = url || defaultSrc;
      }, 500);
    });
  })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/settings/location.blade.php ENDPATH**/ ?>