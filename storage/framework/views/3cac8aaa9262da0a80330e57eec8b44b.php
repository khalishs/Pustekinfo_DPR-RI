
<?php
  $style = match($status) {
    'selesai' => 'background:rgba(31,157,124,.1);color:var(--success);border-color:rgba(31,157,124,.18);',
    'diproses' => 'background:rgba(201,163,78,.12);color:var(--gold);border-color:rgba(201,163,78,.25);',
    'ditolak' => 'background:rgba(176,65,62,.1);color:var(--danger);border-color:rgba(176,65,62,.2);',
    default => 'background:rgba(20,128,140,.1);color:var(--teal);border-color:rgba(20,128,140,.14);',
  };
?>
<span class="badge" style="<?php echo e($style); ?>"><?php echo e(\App\Models\ServiceRequest::STATUSES[$status] ?? $status); ?></span>
<?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/admin/layanan-pengajuan/_status-badge.blade.php ENDPATH**/ ?>