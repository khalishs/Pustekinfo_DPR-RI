
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background-color:#eef4f6;font-family:'Segoe UI',Helvetica,Arial,sans-serif;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#eef4f6;padding:32px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:520px;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 8px 28px rgba(11,34,51,.08);">

          <tr>
            <td style="background:linear-gradient(135deg,#12242E,#14839C);background-color:#12242E;padding:28px 32px;">
              <img src="<?php echo e($logoUrl); ?>" alt="Pustekinfo DPR RI" height="32" style="display:block;">
            </td>
          </tr>

          <tr>
            <td style="padding:32px;">
              <h1 style="margin:0 0 6px;font-size:18px;color:#12242E;">Pengajuan Layanan Diterima</h1>
              <p style="margin:0 0 20px;font-size:13.5px;line-height:1.7;color:#5b6b73;">
                Halo <strong><?php echo e($serviceRequest->nama); ?></strong>, terima kasih sudah mengajukan layanan ke Pustekinfo DPR RI.
                Pengajuan Anda sudah kami catat dengan detail berikut. Tiket lengkap dalam format PDF turut terlampir pada email ini &mdash; mohon disimpan sebagai bukti pengajuan.
              </p>

              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#eef6f8;border:1.5px dashed #14839C;border-radius:10px;padding:16px 20px;margin-bottom:20px;">
                <tr>
                  <td style="font-size:10.5px;font-weight:700;letter-spacing:.08em;color:#5b6b73;text-transform:uppercase;padding-bottom:4px;">Kode Tiket</td>
                </tr>
                <tr>
                  <td style="font-size:22px;font-weight:800;color:#12242E;letter-spacing:.03em;"><?php echo e($serviceRequest->kode); ?></td>
                </tr>
              </table>

              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:13px;color:#3c4a52;margin-bottom:24px;">
                <tr>
                  <td style="padding:6px 0;color:#8a97a0;width:150px;">Jenis Layanan</td>
                  <td style="padding:6px 0;font-weight:700;"><?php echo e($serviceRequest->jenis_layanan); ?></td>
                </tr>
                <tr>
                  <td style="padding:6px 0;color:#8a97a0;">Tanggal Pengajuan</td>
                  <td style="padding:6px 0;font-weight:700;"><?php echo e($serviceRequest->created_at->locale('id')->translatedFormat('d F Y, H:i')); ?> WIB</td>
                </tr>
              </table>

              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($waUrl): ?>
              <table role="presentation" cellpadding="0" cellspacing="0" style="margin-bottom:22px;">
                <tr>
                  <td style="border-radius:10px;background-color:#1f9d7c;">
                    <a href="<?php echo e($waUrl); ?>" style="display:inline-block;padding:13px 24px;font-size:13.5px;font-weight:700;color:#ffffff;text-decoration:none;">Lanjutkan di WhatsApp &rarr;</a>
                  </td>
                </tr>
              </table>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

              <p style="margin:0;font-size:12.5px;line-height:1.7;color:#8a97a0;">
                Anda bisa memantau status pengajuan kapan saja lewat halaman "Cek Status Layanan" di website kami menggunakan kode tiket di atas.
              </p>
            </td>
          </tr>

          <tr>
            <td style="padding:18px 32px;background:#f7f9fa;border-top:1px solid #eef1f3;">
              <p style="margin:0;font-size:11px;color:#9aa8af;">Email ini dikirim otomatis oleh sistem Pustekinfo DPR RI, mohon tidak membalas email ini.</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
<?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/emails/tiket-layanan.blade.php ENDPATH**/ ?>