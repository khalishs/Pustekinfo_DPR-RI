
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
  @page { margin: 0; }
  *{ margin:0; padding:0; box-sizing:border-box; }
  body{
    font-family: 'DejaVu Sans', sans-serif;
    color:#12242E;
    font-size:11px;
    padding:0 48px 48px;
  }

  .header{
    background:#12242E;
    background-image: linear-gradient(135deg, #12242E 0%, #14839C 100%);
    margin:0 -48px 28px;
    padding:26px 48px 22px;
  }
  .header table{ width:100%; border-collapse:collapse; }
  .header img{ height:34px; }
  .header .doc-title{
    color:#ffffff;
    font-size:15px;
    font-weight:bold;
    text-align:right;
  }
  .header .doc-sub{
    color:#bfe9f1;
    font-size:9.5px;
    text-align:right;
    margin-top:3px;
  }

  .kode-box{
    border:1.5px dashed #14839C;
    background:#eef6f8;
    border-radius:6px;
    padding:14px 18px;
    margin-bottom:22px;
  }
  .kode-box table{ width:100%; }
  .kode-label{ color:#5b6b73; font-size:9.5px; letter-spacing:1px; text-transform:uppercase; }
  .kode-value{ color:#12242E; font-size:20px; font-weight:bold; letter-spacing:1px; margin-top:2px; }
  .status-pill{
    display:inline-block;
    background:#c9a34e;
    color:#ffffff;
    font-size:9.5px;
    font-weight:bold;
    padding:5px 12px;
    border-radius:12px;
    text-transform:uppercase;
  }

  .section-title{
    font-size:11.5px;
    font-weight:bold;
    color:#12242E;
    border-bottom:1.5px solid #e0e6e8;
    padding-bottom:6px;
    margin-bottom:10px;
  }

  table.data{ width:100%; border-collapse:collapse; margin-bottom:20px; }
  table.data td{ padding:6px 0; font-size:11px; vertical-align:top; }
  table.data td.label{ width:150px; color:#7a8a92; }
  table.data td.value{ color:#12242E; font-weight:bold; }

  .pesan-box{
    background:#f7f9fa;
    border-left:3px solid #14839C;
    border-radius:4px;
    padding:12px 16px;
    font-size:11px;
    line-height:1.6;
    color:#3c4a52;
    margin-bottom:24px;
  }

  .footer{
    border-top:1px solid #e0e6e8;
    padding-top:14px;
    font-size:9px;
    color:#8a97a0;
    line-height:1.6;
  }
  .footer strong{ color:#5b6b73; }
</style>
</head>
<body>

  <div class="header">
    <table>
      <tr>
        <td style="width:50%;"><img src="<?php echo e($logoBase64); ?>" alt="Pustekinfo"></td>
        <td style="width:50%;">
          <div class="doc-title">TIKET PENGAJUAN LAYANAN</div>
          <div class="doc-sub">Pusat Teknologi Informasi dan Komunikasi &mdash; Sekretariat Jenderal DPR RI</div>
        </td>
      </tr>
    </table>
  </div>

  <div class="kode-box">
    <table>
      <tr>
        <td>
          <div class="kode-label">Kode Tiket</div>
          <div class="kode-value"><?php echo e($serviceRequest->kode); ?></div>
        </td>
        <td style="width:140px;text-align:right;">
          <span class="status-pill"><?php echo e(\App\Models\ServiceRequest::STATUSES[$serviceRequest->status] ?? 'Diajukan'); ?></span>
        </td>
      </tr>
    </table>
  </div>

  <div class="section-title">Detail Pemohon</div>
  <table class="data">
    <tr>
      <td class="label">Nama Lengkap</td>
      <td class="value"><?php echo e($serviceRequest->nama); ?></td>
    </tr>
    <tr>
      <td class="label">Email</td>
      <td class="value"><?php echo e($serviceRequest->email); ?></td>
    </tr>
    <tr>
      <td class="label">No. WhatsApp/Telepon</td>
      <td class="value">+<?php echo e($serviceRequest->no_tlpn); ?></td>
    </tr>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($serviceRequest->instansi)): ?>
    <tr>
      <td class="label">Unit Kerja/Instansi</td>
      <td class="value"><?php echo e($serviceRequest->instansi); ?></td>
    </tr>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <tr>
      <td class="label">Jenis Layanan</td>
      <td class="value"><?php echo e($serviceRequest->jenis_layanan); ?></td>
    </tr>
    <tr>
      <td class="label">Tanggal Pengajuan</td>
      <td class="value"><?php echo e($serviceRequest->created_at->locale('id')->translatedFormat('d F Y, H:i')); ?> WIB</td>
    </tr>
  </table>

  <div class="section-title">Detail Kebutuhan</div>
  <div class="pesan-box"><?php echo e($serviceRequest->pesan); ?></div>

  <div class="footer">
    <strong>Simpan tiket ini.</strong> Gunakan kode tiket di atas untuk memantau status pengajuan Anda kapan saja
    melalui halaman "Cek Status Layanan" di website Pustekinfo DPR RI.<br>
    Dokumen ini dibuat otomatis oleh sistem pada <?php echo e(now()->locale('id')->translatedFormat('d F Y, H:i')); ?> WIB dan tidak memerlukan tanda tangan.
  </div>

</body>
</html>
<?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/pdf/tiket-layanan.blade.php ENDPATH**/ ?>