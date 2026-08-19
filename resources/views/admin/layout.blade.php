{{-- resources/views/admin/layout.blade.php --}}
@php
  // Halaman list (admin.{resource}.index) auto-terdeteksi dari nama route,
  // supaya tiap index view tidak perlu diubah satu-satu untuk ikut polling.
  $__routeName = request()->route()?->getName();
  $__syncResource = null;
  if ($__routeName && str_starts_with($__routeName, 'admin.') && str_ends_with($__routeName, '.index')) {
    $__candidate = substr($__routeName, strlen('admin.'), -strlen('.index'));
    if (array_key_exists($__candidate, \App\Http\Controllers\Admin\SyncStatusController::RESOURCES)) {
      $__syncResource = $__candidate;
    }
  }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Dashboard') - Admin Pustekinfo</title>
<script>
  if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
  }
</script>
<link rel="icon" type="image/png" href="{{ asset('images/favicon-bg.png') }}?v=2">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --sidebar-w:300px;
    --navy:#12242E;
    --navy-deep:#0b2233;
    --teal:#14839C;
    --teal-light:#5FC0D1;
    --gold:#c9a34e;
    --ink:#0b2233;
    --white:#ffffff;
    --mist:#f4f7f8;
    --line:#e7ecee;
    --success:#1f9d7c;
    --danger:#b0413e;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body{
    font-family:'Work Sans',system-ui,sans-serif;
    background:var(--mist);
    color:var(--ink);
    display:flex;
    min-height:100vh;
    overflow-x:hidden;
  }
  h1,h2,.brand-text .name,.sidebar nav a,.btn,.card h3,.page-head h2{
    font-family:'Plus Jakarta Sans',system-ui,sans-serif;
  }
  a{color:inherit;}

  /* ---------- Sidebar ---------- */
  .sidebar{
    width:var(--sidebar-w);
    background:linear-gradient(190deg,#073D5F 0%,var(--navy-deep) 65%);
    color:#fff;
    flex-shrink:0;
    display:flex;
    flex-direction:column;
    position:fixed;
    top:0;bottom:0;left:0;
    z-index:10;
    transition:transform .28s ease;
  }
  .sidebar .brand{
    position:relative;
    display:flex;align-items:center;gap:12px;
    padding:24px 22px;
    border-bottom:1px solid rgba(255,255,255,.1);
    overflow:hidden;
  }
  .sidebar .brand::before{
    content:"";
    position:absolute;inset:0;
    background:radial-gradient(120% 140% at 100% 0%, rgba(20,128,140,.35), transparent 60%);
    pointer-events:none;
  }
  .sidebar .brand-logo{
    position:relative;
    width:42px;height:42px;flex-shrink:0;
    background:#ffffff;
    border:1px solid rgba(255,255,255,.4);
    border-radius:12px;
    box-shadow:0 2px 10px -2px rgba(0,0,0,.25);
    display:flex;align-items:center;justify-content:center;
    padding:6px;
  }
  .sidebar .brand-logo img{width:100%;height:100%;object-fit:contain;}
  .sidebar .brand .name{position:relative;font-weight:800;font-size:16px;color:#fff;line-height:1.2;letter-spacing:.01em;}
  .sidebar .brand .sub{position:relative;font-size:9.5px;letter-spacing:.1em;color:var(--teal-light);font-weight:700;margin-top:3px;text-transform:uppercase;}

  .sidebar nav{flex:1;padding:16px 12px;overflow-y:auto;}
  .sidebar nav::-webkit-scrollbar{width:5px;}
  .sidebar nav::-webkit-scrollbar-thumb{background:rgba(255,255,255,.14);border-radius:10px;}

  .sidebar nav a{
    display:flex;align-items:center;gap:11px;
    padding:11px 14px;
    margin-bottom:3px;
    border-radius:10px;
    color:rgba(255,255,255,.7);
    text-decoration:none;
    font-size:13.5px;font-weight:600;
    transition:.18s ease;
  }
  .sidebar nav a:hover{background:rgba(255,255,255,.08);color:#fff;}
  .sidebar nav a.active{
    background:linear-gradient(135deg,var(--teal) 0%,#0f6b7f 100%);
    color:#fff;
    box-shadow:0 8px 18px -6px rgba(20,128,140,.55);
  }
  .nav-icon{
    width:17px;height:17px;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    opacity:.85;
  }
  .nav-icon svg{width:100%;height:100%;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
  a.active .nav-icon{opacity:1;}

  .nav-group{border-bottom:none;margin-top:4px;}
  .nav-group summary{
    list-style:none;cursor:pointer;
    display:flex;align-items:center;justify-content:space-between;
    padding:12px 14px 8px;
    font-size:10.5px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;
    color:rgba(255,255,255,.38);
    transition:color .15s ease;
  }
  .nav-group summary::-webkit-details-marker{display:none;}
  .nav-group summary::after{content:"";width:7px;height:7px;border-right:1.6px solid currentColor;border-bottom:1.6px solid currentColor;transform:rotate(45deg);transition:transform .2s ease;opacity:.7;}
  .nav-group[open] summary::after{transform:rotate(225deg);}
  .nav-group summary:hover{color:rgba(255,255,255,.75);}

  .sidebar .bottom{
    position:relative;
    padding:16px 18px 20px;
    border-top:1px solid rgba(255,255,255,.1);
    display:flex;flex-direction:column;gap:8px;
    background-image:url('{{ asset('images/pola-batik.png') }}');
    background-repeat:no-repeat;
    background-position:right -40px bottom -30px;
    background-size:220px auto;
    filter:none;
  }
  .sidebar .bottom::before{
    content:"";position:absolute;inset:0;
    background:linear-gradient(0deg, rgba(11,34,51,.92) 40%, rgba(11,34,51,.6));
    pointer-events:none;
  }
  .sidebar .bottom > *{position:relative;z-index:1;}
  .sidebar .bottom a{
    font-size:12.5px;font-weight:700;color:rgba(255,255,255,.6);
    text-decoration:none;display:flex;align-items:center;gap:7px;
    transition:.15s ease;
  }
  .sidebar .bottom a svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
  .sidebar .bottom a:hover{color:#fff;}
  .sidebar .bottom form button{
    display:flex;align-items:center;justify-content:center;gap:7px;
    width:100%;padding:10px;border-radius:10px;
    border:1px solid rgba(255,143,138,.35);
    background:rgba(176,65,62,.14);
    color:#ff9490;font-weight:700;font-size:13px;cursor:pointer;
    transition:.2s ease;
    font-family:inherit;
  }
  .sidebar .bottom form button svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
  .sidebar .bottom form button:hover{background:var(--danger);color:#fff;border-color:var(--danger);}

  /* ---------- Menu toggle (burger, di topbar sebelah kiri judul — buka/tutup sidebar) ---------- */
  .menu-toggle{
    display:flex;
    align-items:center;justify-content:center;
    width:38px;height:38px;flex-shrink:0;
    border-radius:10px;border:1px solid var(--line);
    background:#fff;cursor:pointer;
  }
  .menu-toggle svg{width:18px;height:18px;stroke:var(--navy);fill:none;stroke-width:2;stroke-linecap:round;}
  .menu-toggle:hover{border-color:var(--teal);}

  .sidebar-backdrop{
    position:fixed;inset:0;background:rgba(11,34,51,.5);
    opacity:0;pointer-events:none;transition:opacity .25s ease;
    z-index:9;
  }
  .sidebar.open ~ .sidebar-backdrop{opacity:1;pointer-events:auto;}

  .sidebar.sidebar-closed{transform:translateX(calc(var(--sidebar-w) * -1));box-shadow:none;}
  .sidebar.sidebar-closed ~ .main{margin-left:0;}

  /* ---------- Resize handle (hover di ujung sidebar untuk atur lebar) ---------- */
  .sidebar-resize-handle{
    display:none;
    position:absolute;
    top:0;bottom:0;right:0;
    width:6px;
    cursor:ew-resize;
    z-index:12;
    background:transparent;
    touch-action:none;
  }
  .sidebar-resize-handle::after{
    content:"";
    position:absolute;top:0;bottom:0;right:1px;
    width:2px;border-radius:2px;
    background:var(--teal-light);
    opacity:0;
    transition:opacity .15s ease;
  }
  .sidebar-resize-handle:hover::after,
  .sidebar-resize-handle.resizing::after{opacity:.9;}
  .sidebar.sidebar-closed .sidebar-resize-handle{pointer-events:none;}
  @media (min-width:1025px){
    .sidebar-resize-handle{display:block;}
  }

  body.sidebar-resizing{cursor:ew-resize;user-select:none;}
  body.sidebar-resizing .sidebar,
  body.sidebar-resizing .main{transition:none;}

  /* ---------- Main ---------- */
  .main{flex:1;margin-left:var(--sidebar-w);display:flex;flex-direction:column;min-height:100vh;min-width:0;transition:margin-left .28s ease;}
  .topbar{
    background:rgba(255,255,255,.9);
    backdrop-filter:blur(10px);
    padding:20px 36px;
    border-bottom:1px solid var(--line);
    position:sticky;top:0;z-index:5;
    display:flex;align-items:center;justify-content:space-between;
    gap:20px;
  }
  .topbar-left{display:flex;align-items:center;gap:14px;min-width:0;}
  .topbar-titles h1{font-size:21px;font-weight:800;color:var(--navy);letter-spacing:-.01em;}
  .topbar-titles p{margin-top:3px;font-size:12.5px;color:#8a97a0;font-weight:500;}
  .topbar-chip{
    display:flex;align-items:center;gap:7px;
    padding:8px 14px;border-radius:20px;
    background:rgba(20,128,140,.08);
    border:1px solid rgba(20,128,140,.16);
    color:var(--teal);
    font-size:12px;font-weight:700;
    white-space:nowrap;
  }
  .topbar-chip .pulse{width:6px;height:6px;border-radius:50%;background:var(--success);flex-shrink:0;box-shadow:0 0 0 3px rgba(31,157,124,.18);}

  .content{padding:30px 36px 64px;width:100%;}

  .flash{
    display:flex;align-items:center;gap:10px;
    margin-bottom:18px;padding:13px 18px;border-radius:12px;
    font-size:13.5px;font-weight:700;
    background:#e6f7ee;color:var(--success);
    border:1px solid #c9ecd9;
  }
  .flash::before{content:"✓";display:flex;align-items:center;justify-content:center;width:18px;height:18px;border-radius:50%;background:var(--success);color:#fff;font-size:11px;flex-shrink:0;}
  .flash-error{background:#fbeaea;color:var(--danger);border-color:#f2cfcf;}
  .flash-error::before{content:"✕";background:var(--danger);}

  .sync-banner{
    display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;
    margin-bottom:18px;padding:12px 18px;border-radius:12px;
    font-size:13.5px;font-weight:700;
    background:rgba(20,128,140,.08);color:var(--teal);
    border:1px solid rgba(20,128,140,.18);
  }
  .sync-banner-btn{
    flex-shrink:0;padding:8px 16px;border-radius:20px;border:1.5px solid var(--teal);
    background:var(--teal);color:#fff;font-size:12.5px;font-weight:800;cursor:pointer;
    font-family:inherit;transition:.15s ease;
  }
  .sync-banner-btn:hover{background:#0f6b7f;border-color:#0f6b7f;}
  [data-theme="dark"] .sync-banner{background:rgba(20,128,140,.16);border-color:rgba(20,128,140,.32);color:var(--teal-light);}

  /* ---------- Loading indicators ---------- */
  .admin-loading-bar{
    position:fixed;top:0;left:0;height:3px;width:0;
    background:linear-gradient(90deg,var(--teal),var(--teal-light),var(--gold));
    box-shadow:0 0 10px rgba(20,128,140,.65);
    z-index:10000;transition:width .35s ease,opacity .25s ease .1s;
    opacity:0;pointer-events:none;
  }
  .admin-loading-bar.is-active{opacity:1;transition:width .35s ease;}

  .admin-loading-overlay{
    position:fixed;inset:0;z-index:9999;
    background:rgba(6,18,26,.6);backdrop-filter:blur(6px);
    display:flex;align-items:center;justify-content:center;
    opacity:0;pointer-events:none;transition:opacity .22s ease;
  }
  .admin-loading-overlay.is-visible{opacity:1;pointer-events:auto;}

  .admin-loading-box{
    display:flex;flex-direction:column;align-items:center;gap:24px;
    background:#fff;border-radius:28px;padding:46px 50px 40px;
    box-shadow:0 32px 80px -18px rgba(20,128,140,.3),0 16px 40px -14px rgba(11,34,51,.4);
    text-align:center;width:min(90vw,400px);
    transform:scale(.82) translateY(14px);
    opacity:0;
    transition:transform .4s cubic-bezier(.34,1.56,.64,1),opacity .25s ease;
  }
  .admin-loading-overlay.is-visible .admin-loading-box{
    transform:scale(1) translateY(0);
    opacity:1;
  }
  [data-theme="dark"] .admin-loading-box{background:#23272c;box-shadow:0 32px 80px -18px rgba(20,128,140,.22),0 16px 40px -14px rgba(0,0,0,.5);}

  .admin-loading-orbit{position:relative;width:100px;height:100px;display:flex;align-items:center;justify-content:center;}
  .admin-loading-orbit::before{
    content:"";position:absolute;inset:0;border-radius:50%;
    background:conic-gradient(from 0deg,transparent 0deg,var(--teal) 100deg,var(--teal-light) 190deg,var(--gold) 270deg,transparent 320deg);
    -webkit-mask:radial-gradient(farthest-side,transparent calc(100% - 4px),#000 calc(100% - 4px));
    mask:radial-gradient(farthest-side,transparent calc(100% - 4px),#000 calc(100% - 4px));
    animation:admin-orbit-spin 1.3s linear infinite;
  }
  .admin-loading-orbit::after{
    content:"";position:absolute;inset:12px;border-radius:50%;
    background:radial-gradient(circle,rgba(20,128,140,.2),transparent 72%);
    animation:admin-pulse-glow 2s ease-in-out infinite;
  }
  .admin-loading-logo-wrap{
    position:relative;z-index:1;width:60px;height:60px;
    animation:admin-logo-breathe 2s ease-in-out infinite;
  }
  .admin-loading-logo-frame{
    position:absolute;inset:0;border-radius:50%;
    background:#fff;
    box-shadow:0 8px 20px -6px rgba(11,34,51,.35);
  }
  [data-theme="dark"] .admin-loading-logo-frame{background:#2b3036;}
  .admin-loading-logo{
    position:relative;display:block;width:100%;height:100%;
    padding:11px;object-fit:contain;
  }
  @keyframes admin-orbit-spin{to{transform:rotate(360deg);}}
  @keyframes admin-pulse-glow{0%,100%{transform:scale(.85);opacity:.5;}50%{transform:scale(1.3);opacity:1;}}
  @keyframes admin-logo-breathe{0%,100%{transform:scale(1);}50%{transform:scale(1.07);}}

  .admin-loading-copy{display:flex;flex-direction:column;gap:7px;}
  .admin-loading-heading{
    font-family:'Plus Jakarta Sans',system-ui,sans-serif;
    font-size:21px;font-weight:800;color:var(--navy);letter-spacing:-.01em;
    display:flex;align-items:baseline;justify-content:center;gap:2px;
  }
  [data-theme="dark"] .admin-loading-heading{color:var(--ink);}
  .admin-loading-dots i{font-style:normal;opacity:.25;animation:admin-dot-pulse 1.3s ease-in-out infinite;}
  .admin-loading-dots i:nth-child(2){animation-delay:.15s;}
  .admin-loading-dots i:nth-child(3){animation-delay:.3s;}
  @keyframes admin-dot-pulse{0%,60%,100%{opacity:.25;}30%{opacity:1;}}

  .admin-loading-text{font-size:15px;font-weight:700;color:var(--teal);}
  [data-theme="dark"] .admin-loading-text{color:var(--teal-light);}
  .admin-loading-sub{display:block;font-size:13px;font-weight:600;color:#8a97a0;}

  .btn.is-loading,.btn-icon.is-loading{opacity:.55;pointer-events:none;}

  .card{
    background:#fff;border-radius:16px;padding:26px;
    box-shadow:0 8px 28px -16px rgba(11,34,51,.18);
    border:1px solid var(--line);
  }
  .card + .card{margin-top:20px;}

  .page-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
  .page-head h2{font-size:18px;font-weight:800;color:var(--navy);}

  .table-responsive{width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;}
  .table-responsive table{min-width:620px;}
  table{width:100%;border-collapse:collapse;}
  th,td{text-align:left;padding:13px 14px;border-bottom:1.5px solid #d3dde1;font-size:13.5px;vertical-align:middle;}
  th{color:#8a97a0;font-weight:800;text-transform:uppercase;font-size:10.5px;letter-spacing:.06em;border-bottom:2px solid #becad0;}
  tbody tr{transition:background .12s ease;}
  tbody tr:hover{background:#fafcfd;}
  tbody tr:last-child td{border-bottom:none;}

  .btn{
    display:inline-flex;align-items:center;gap:6px;
    padding:10px 20px;border-radius:22px;
    font-size:13px;font-weight:700;letter-spacing:.01em;
    text-decoration:none;cursor:pointer;border:1.5px solid transparent;
    transition:transform .15s ease, box-shadow .15s ease, background .15s ease;
    font-family:inherit;
  }
  .btn:hover{transform:translateY(-2px);}
  .btn-primary{background:var(--teal);color:#fff;}
  .btn-primary:hover{background:#0f6b7f;box-shadow:0 12px 22px -10px rgba(20,128,140,.6);}
  .btn-danger{background:#fff;color:var(--danger);border-color:#e3b8b8;}
  .btn-danger:hover{background:var(--danger);color:#fff;border-color:var(--danger);}
  .btn-outline{background:#fff;border-color:var(--line);color:#5b6b73;}
  .btn-outline:hover{border-color:var(--teal);color:var(--teal);}

  .btn-icon{
    display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;
    width:34px;height:34px;border-radius:9px;padding:0;
    border:1.5px solid var(--line);background:#fff;color:#5b6b73;
    cursor:pointer;transition:transform .15s ease, background .15s ease, border-color .15s ease, color .15s ease;
  }
  .btn-icon:hover{transform:translateY(-2px);}
  .btn-icon svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
  .btn-icon-edit:hover{border-color:var(--teal);color:var(--teal);background:rgba(20,128,140,.08);}
  .btn-icon-copy:hover{border-color:var(--gold);color:var(--gold);background:rgba(201,163,78,.1);}
  .btn-icon-delete{border-color:#e3b8b8;color:var(--danger);}
  .btn-icon-delete:hover{background:var(--danger);color:#fff;border-color:var(--danger);}

  .form-group{margin-bottom:18px;max-width:560px;}

  /* ---------- Form grid 2 kolom (supaya tidak ada ruang kosong di samping) ---------- */
  .form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:4px 32px;
    width:100%;
  }
  .form-grid .form-group{max-width:none;}
  .form-grid .form-span-2{grid-column:1 / -1;}
  .form-actions{margin-top:8px;}

  label{display:block;font-size:13px;font-weight:700;color:var(--navy);margin-bottom:7px;}
  label.required::after{content:" *";color:var(--danger);}
  input,textarea,select{
    width:100%;padding:11px 14px;border:1.5px solid #e2e8ec;border-radius:10px;
    font-size:14px;font-family:inherit;transition:border-color .15s ease, box-shadow .15s ease;
    background:#fff;color:var(--ink);
  }
  input:focus,textarea:focus,select:focus{outline:none;border-color:var(--teal);box-shadow:0 0 0 3px rgba(20,128,140,.12);}
  textarea{min-height:100px;resize:vertical;}
  small.error{color:var(--danger);display:block;margin-top:5px;font-weight:600;}
  small{color:#8a97a0;}

  input.field-invalid,textarea.field-invalid,select.field-invalid{border-color:var(--danger);}
  input.field-invalid:focus,textarea.field-invalid:focus,select.field-invalid:focus{
    border-color:var(--danger);box-shadow:0 0 0 3px rgba(176,65,62,.14);
  }
  small.error.field-error-msg{
    display:flex;align-items:center;gap:5px;
  }
  small.error.field-error-msg::before{
    content:"!";display:flex;align-items:center;justify-content:center;flex-shrink:0;
    width:14px;height:14px;border-radius:50%;background:var(--danger);color:#fff;
    font-size:9.5px;font-weight:800;font-style:normal;
  }

  /* .row-actions dipasang langsung di <td>. Sengaja BUKAN display:flex — sebuah <td>
     yang di-flex-kan berhenti ikut aturan tinggi baris tabel normal (jadi cuma setinggi
     kontennya sendiri, bukan setinggi baris), sehingga tombolnya nangkring di atas kalau
     ada sel lain di baris yang sama yang lebih tinggi (judul 2 baris, dst). Dengan tetap
     jadi table-cell biasa, vertical-align:middle bawaan th/td di atas otomatis berlaku. */
  .row-actions{white-space:nowrap;}
  .row-actions > a{vertical-align:middle;}
  .row-actions > form{display:inline-block;vertical-align:middle;margin-left:8px;}
  .row-actions > :first-child{margin-left:0;}
  .badge{display:inline-block;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:800;background:rgba(20,128,140,.1);color:var(--teal);border:1px solid rgba(20,128,140,.14);}
  .badge-count{display:inline-flex;align-items:center;justify-content:center;min-width:26px;height:22px;padding:0 8px;border-radius:20px;background:var(--mist);color:#5b6b73;font-size:12px;font-weight:800;border:1px solid var(--line);}
  .badge-success{display:inline-block;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:800;background:rgba(31,157,124,.1);color:var(--success);border:1px solid rgba(31,157,124,.18);}
  .badge-muted{display:inline-block;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:800;background:var(--mist);color:#8a97a0;border:1px solid var(--line);}
  .cap{text-transform:capitalize;}
  th.text-center,td.text-center{text-align:center;}

  .toggle-switch{position:relative;display:inline-block;width:42px;height:24px;flex-shrink:0;margin:0;}
  .toggle-switch input[type="checkbox"]{position:absolute;opacity:0;width:100%;height:100%;margin:0;padding:0;border:none;cursor:pointer;}
  .toggle-switch .slider{position:absolute;inset:0;background:#d7dde0;border-radius:24px;transition:background .2s ease;pointer-events:none;}
  .toggle-switch .slider::before{content:"";position:absolute;height:18px;width:18px;left:3px;top:3px;background:#fff;border-radius:50%;transition:transform .2s ease;box-shadow:0 1px 3px rgba(0,0,0,.25);}
  .toggle-switch input:checked + .slider{background:var(--teal);}
  .toggle-switch input:checked + .slider::before{transform:translateX(18px);}
  .toggle-switch input:focus-visible + .slider{box-shadow:0 0 0 3px rgba(20,128,140,.25);}
  [data-theme="dark"] .toggle-switch .slider{background:rgba(255,255,255,.15);}

  /* ---------- Dashboard stats ---------- */
  .stat-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:18px;margin-bottom:20px;}
  .stat-card{
    background:#fff;border-radius:16px;padding:20px;
    box-shadow:0 8px 28px -16px rgba(11,34,51,.18);
    border:1px solid var(--line);
  }
  .stat-icon{
    display:flex;align-items:center;justify-content:center;
    width:38px;height:38px;border-radius:10px;margin-bottom:14px;
    background:rgba(20,128,140,.1);color:var(--teal);
  }
  .stat-icon svg{width:19px;height:19px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
  .stat-value{font-family:'Plus Jakarta Sans',system-ui,sans-serif;font-size:26px;font-weight:800;color:var(--navy);line-height:1;}
  .stat-label{margin-top:6px;font-size:12.5px;color:#8a97a0;font-weight:600;}
  .stat-card-alert .stat-icon{background:rgba(176,65,62,.1);color:var(--danger);}
  .stat-card-alert .stat-value{color:var(--danger);}

  .quick-links{display:flex;flex-wrap:wrap;gap:10px;}
  .quick-link{
    padding:10px 18px;border-radius:20px;
    background:var(--mist);border:1px solid var(--line);color:var(--navy);
    font-size:13px;font-weight:700;text-decoration:none;
    transition:.15s ease;
  }
  .quick-link:hover{border-color:var(--teal);color:var(--teal);background:rgba(20,128,140,.06);}

  @media (max-width:1200px){.stat-grid{grid-template-columns:repeat(3,1fr);}}
  @media (max-width:640px){.stat-grid{grid-template-columns:repeat(2,1fr);gap:12px;}}

  /* ---------- Theme toggle ---------- */
  .theme-toggle{
    width:38px;height:38px;flex-shrink:0;border-radius:50%;
    border:1px solid var(--line);background:#fff;color:#5b6b73;
    display:flex;align-items:center;justify-content:center;
    font-size:15px;cursor:pointer;transition:.2s ease;
  }
  .theme-toggle:hover{border-color:var(--teal);color:var(--teal);}

  /* ---------- Dark mode ---------- */
  [data-theme="dark"]{
    --mist:#1b1e22;
    --ink:#dde1e4;
    --line:rgba(255,255,255,.07);
    --navy:#e4e7ea;
  }
  [data-theme="dark"] .menu-toggle,
  [data-theme="dark"] .theme-toggle{background:#25292e;border-color:rgba(255,255,255,.1);color:#b8bfc4;}
  [data-theme="dark"] .theme-toggle:hover{border-color:var(--teal-light);color:var(--teal-light);}
  [data-theme="dark"] .topbar{background:rgba(27,30,34,.85);border-color:rgba(255,255,255,.06);}
  [data-theme="dark"] .topbar-titles p{color:#8b929a;}
  [data-theme="dark"] .topbar-chip{background:rgba(20,128,140,.15);border-color:rgba(20,128,140,.28);}
  [data-theme="dark"] .flash{background:rgba(31,157,124,.13);color:#6fd6b3;border-color:rgba(31,157,124,.26);}
  [data-theme="dark"] .flash-error{background:rgba(176,65,62,.15);color:#e79a97;border-color:rgba(176,65,62,.32);}
  [data-theme="dark"] .card{background:#24282d;border-color:rgba(255,255,255,.06);box-shadow:0 8px 28px -16px rgba(0,0,0,.4);}
  [data-theme="dark"] th{color:#8b929a;border-bottom-color:rgba(255,255,255,.22);}
  [data-theme="dark"] td{border-bottom-color:rgba(255,255,255,.13);}
  [data-theme="dark"] tbody tr:hover{background:rgba(255,255,255,.025);}
  [data-theme="dark"] .btn-danger{background:transparent;border-color:rgba(176,65,62,.38);}
  [data-theme="dark"] .btn-outline{background:transparent;border-color:rgba(255,255,255,.12);color:#b8bfc4;}
  [data-theme="dark"] .btn-outline:hover{border-color:var(--teal-light);color:var(--teal-light);}
  [data-theme="dark"] .btn-icon{background:transparent;border-color:rgba(255,255,255,.12);color:#b8bfc4;}
  [data-theme="dark"] .btn-icon-edit:hover{border-color:var(--teal-light);color:var(--teal-light);background:rgba(20,128,140,.15);}
  [data-theme="dark"] .btn-icon-copy:hover{border-color:var(--gold);color:var(--gold);background:rgba(201,163,78,.15);}
  [data-theme="dark"] .btn-icon-delete{border-color:rgba(176,65,62,.38);}
  [data-theme="dark"] .btn-icon-delete:hover{background:var(--danger);color:#fff;border-color:var(--danger);}
  [data-theme="dark"] input,
  [data-theme="dark"] textarea,
  [data-theme="dark"] select{background:#202429;border-color:rgba(255,255,255,.1);color:var(--ink);}
  [data-theme="dark"] input:focus,
  [data-theme="dark"] textarea:focus,
  [data-theme="dark"] select:focus{box-shadow:0 0 0 3px rgba(20,128,140,.22);}
  [data-theme="dark"] small{color:#8b929a;}
  [data-theme="dark"] .badge-count,
  [data-theme="dark"] .badge-muted{border-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .stat-card{background:#24282d;border-color:rgba(255,255,255,.06);box-shadow:0 8px 28px -16px rgba(0,0,0,.4);}
  [data-theme="dark"] .stat-label{color:#8b929a;}
  [data-theme="dark"] .quick-link:hover{background:rgba(20,128,140,.14);}

  /* ---------- Tablet ---------- */
  @media (max-width:1024px){
    .sidebar{
      transform:translateX(-100%);
      width:280px;
      box-shadow:0 0 40px rgba(0,0,0,.25);
    }
    .sidebar.open{transform:translateX(0);}
    .main{margin-left:0;}
    .topbar{padding:16px 20px;}
    .topbar-chip{display:none;}
    .content{padding:24px 20px 50px;}
  }

  /* ---------- Mobile ---------- */
  @media (max-width:640px){
    .topbar{padding:14px 16px;gap:12px;}
    .topbar-titles h1{font-size:16.5px;}
    .topbar-titles p{display:none;}
    .content{padding:18px 14px 40px;}
    .card{padding:18px;border-radius:14px;}
    .page-head{margin-bottom:16px;}
    .page-head h2{font-size:16px;}
    .page-head .btn{width:100%;justify-content:center;}
    th,td{padding:11px 10px;font-size:12.5px;}
    .form-group{max-width:100%;}
    .form-grid{grid-template-columns:1fr;gap:0;}
  }
</style>
</head>
<body @if($__syncResource) data-sync-resource="{{ $__syncResource }}" @endif>
  <aside class="sidebar">
    <div class="sidebar-resize-handle" id="sidebarResizeHandle" title="Tarik untuk mengubah lebar sidebar"></div>
    <div class="brand">
      <div class="brand-logo"><img src="{{ asset('images/Logo.png') }}" alt="Logo"></div>
      <div>
        <div class="name">PUSTEKINFO</div>
        <div class="sub">Admin Panel</div>
      </div>
    </div>

    <nav>
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg></span>
        Dashboard
      </a>

      <details class="nav-group" open>
        <summary>Beranda</summary>
        <a href="{{ route('admin.statistics.index') }}" class="{{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></span>
          Statistik
        </a>
        <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M4 4h13a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H4z"/><path d="M4 4v16a2 2 0 0 0 2 2h13"/><line x1="8" y1="9" x2="15" y2="9"/><line x1="8" y1="13" x2="15" y2="13"/></svg></span>
          Berita
        </a>
        <a href="{{ route('admin.agenda.index') }}" class="{{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
          Agenda
        </a>
        <a href="{{ route('admin.hero-slides.index') }}" class="{{ request()->routeIs('admin.hero-slides.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 15l5-5 4 4 5-6 4 5"/></svg></span>
          Hero Slider
        </a>
        <a href="{{ route('admin.profil-photos.index') }}" class="{{ request()->routeIs('admin.profil-photos.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></span>
          Foto Profil Singkat
        </a>
        <a href="{{ route('admin.work-items.index') }}" class="{{ request()->routeIs('admin.work-items.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg></span>
          Apa yang Kami Kerjakan
        </a>
      </details>

      <details class="nav-group" open>
        <summary>Layanan</summary>
        <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></span>
          Kartu Layanan
        </a>
        <a href="{{ route('admin.layanan-pengajuan.index') }}" class="{{ request()->routeIs('admin.layanan-pengajuan.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg></span>
          Pengajuan Layanan
          @if(($pendingLayananCount ?? 0) > 0)
            <span class="badge-count" style="margin-left:auto;background:var(--danger);color:#fff;border-color:var(--danger);">{{ $pendingLayananCount }}</span>
          @endif
        </a>
        <a href="{{ route('admin.stela-videos.index') }}" class="{{ request()->routeIs('admin.stela-videos.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg></span>
          Video Sekilas STELA
        </a>
      </details>

      <details class="nav-group" open>
        <summary>Profil</summary>
        <a href="{{ route('admin.timeline.index') }}" class="{{ request()->routeIs('admin.timeline.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 14"/></svg></span>
          Sejarah Instansi
        </a>
        <a href="{{ route('admin.leadership.edit') }}" class="{{ request()->routeIs('admin.leadership.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
          Sambutan Pimpinan
        </a>
        <a href="{{ route('admin.organization-members.index') }}" class="{{ request()->routeIs('admin.organization-members.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><path d="M5 17v-2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><circle cx="12" cy="19" r="2"/></svg></span>
          Struktur Organisasi
        </a>
        <a href="{{ route('admin.vision-mission.edit') }}" class="{{ request()->routeIs('admin.vision-mission.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/></svg></span>
          Visi &amp; Misi
        </a>
        <a href="{{ route('admin.core-values.index') }}" class="{{ request()->routeIs('admin.core-values.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M12 2l3 7h7l-5.5 4.5L18 21l-6-4-6 4 1.5-7.5L2 9h7z"/></svg></span>
          Nilai Organisasi
        </a>
      </details>

      <details class="nav-group" open>
        <summary>Banner</summary>
        @foreach(\App\Models\PageBanner::PAGES as $bannerPage => $bannerLabel)
          <a href="{{ route('admin.page-banners.edit', $bannerPage) }}" class="{{ request()->routeIs('admin.page-banners.*') && request()->route('page') === $bannerPage ? 'active' : '' }}">
            <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 15l5-5 4 4 5-6 4 5"/></svg></span>
            Banner {{ $bannerLabel }}
          </a>
        @endforeach
      </details>

      <details class="nav-group" open>
        <summary>Galeri</summary>
        <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></span>
          Foto Galeri
        </a>
        <a href="{{ route('admin.gallery-categories.index') }}" class="{{ request()->routeIs('admin.gallery-categories.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M20.59 13.41 13.42 20.6a2 2 0 0 1-2.83 0L2.5 12.5V2.5h10l8.09 8.08a2 2 0 0 1 0 2.83z"/><circle cx="7" cy="7" r="1"/></svg></span>
          Kategori Galeri
        </a>
      </details>

      <details class="nav-group" open>
        <summary>Kontak &amp; Footer</summary>
        <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
          Pengaturan Kontak
        </a>
        <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
          <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg></span>
          Pesan Masuk
          @if(($unreadMessagesCount ?? 0) > 0)
            <span class="badge-count" style="margin-left:auto;background:var(--danger);color:#fff;border-color:var(--danger);">{{ $unreadMessagesCount }}</span>
          @endif
        </a>
      </details>
    </nav>

    <div class="bottom">
      <a href="{{ route('admin.account.edit') }}">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-3.5 3.5-6 8-6s8 2.5 8 6"/></svg>
        Akun Saya
      </a>
      <a href="{{ route('home') }}">
        <svg viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        Lihat Website
      </a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">
          <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Logout
        </button>
      </form>
    </div>
  </aside>

  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <div class="main">
    <div class="topbar">
      <div class="topbar-left">
        <button type="button" class="menu-toggle" id="sidebarToggle" aria-label="Buka menu">
          <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <div class="topbar-titles">
          <h1>@yield('title', 'Dashboard')</h1>
          <p>Kelola konten yang tampil di website Pustekinfo</p>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:12px;">
        <div class="topbar-chip">
          <span class="pulse"></span>
          Situs aktif
        </div>
        <button type="button" class="theme-toggle" id="themeToggle" aria-label="Ganti tema" aria-pressed="false">◐</button>
      </div>
    </div>
    <div class="content">
      @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="flash flash-error">{{ session('error') }}</div>
      @endif
      @yield('content')
    </div>
  </div>

  <script>
    (function(){
      var sidebar = document.querySelector('.sidebar');
      var toggle = document.getElementById('sidebarToggle');
      var backdrop = document.getElementById('sidebarBackdrop');
      var STORAGE_KEY = 'pustekinfo_sidebar_closed';

      function closeSidebar(){
        sidebar.classList.remove('open');
        document.body.style.overflow = '';
      }
      function openSidebar(){
        sidebar.classList.add('open');
        document.body.style.overflow = 'hidden';
      }

      // Buka/tutup sidebar (desktop: collapse, tersimpan di localStorage)
      function applySidebarClosedState(closed){
        sidebar.classList.toggle('sidebar-closed', closed);
        try { localStorage.setItem(STORAGE_KEY, closed ? '1' : '0'); } catch(e){}
      }

      try {
        if (localStorage.getItem(STORAGE_KEY) === '1') {
          applySidebarClosedState(true);
        }
      } catch(e){}

      // Simpan & pulihkan posisi scroll menu sidebar, supaya nggak balik ke atas
      // tiap kali pindah halaman (browser reset scroll begitu halaman baru dimuat).
      var sidebarNav = sidebar.querySelector('nav');
      var NAV_SCROLL_KEY = 'pustekinfo_sidebar_nav_scroll';
      if (sidebarNav) {
        try {
          var savedNavScroll = sessionStorage.getItem(NAV_SCROLL_KEY);
          if (savedNavScroll !== null) sidebarNav.scrollTop = parseInt(savedNavScroll, 10);
        } catch(e){}
        sidebarNav.addEventListener('scroll', function(){
          try { sessionStorage.setItem(NAV_SCROLL_KEY, String(sidebarNav.scrollTop)); } catch(e){}
        });
      }

      // Satu tombol burger di topbar: desktop = collapse sidebar, mobile/tablet = drawer off-canvas
      toggle && toggle.addEventListener('click', function(){
        if (window.innerWidth > 1024) {
          applySidebarClosedState(!sidebar.classList.contains('sidebar-closed'));
        } else {
          sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
        }
      });
      backdrop && backdrop.addEventListener('click', closeSidebar);
      sidebar.querySelectorAll('nav a').forEach(function(link){
        link.addEventListener('click', closeSidebar);
      });
      document.addEventListener('keydown', function(e){
        if (e.key === 'Escape') closeSidebar();
      });
      window.addEventListener('resize', function(){
        if (window.innerWidth > 1024) closeSidebar();
      });

      // Resize handle: tarik di ujung sidebar untuk menyesuaikan lebarnya
      var resizeHandle = document.getElementById('sidebarResizeHandle');
      var rootEl = document.documentElement;
      var WIDTH_KEY = 'pustekinfo_sidebar_width';
      var MIN_W = 220, MAX_W = 420;

      function setSidebarWidth(px){
        px = Math.min(MAX_W, Math.max(MIN_W, Math.round(px)));
        rootEl.style.setProperty('--sidebar-w', px + 'px');
        try { localStorage.setItem(WIDTH_KEY, String(px)); } catch(e){}
      }

      try {
        var savedW = parseInt(localStorage.getItem(WIDTH_KEY), 10);
        if (!isNaN(savedW)) setSidebarWidth(savedW);
      } catch(e){}

      if (resizeHandle){
        var dragging = false, startX = 0, startW = 0;

        resizeHandle.addEventListener('pointerdown', function(e){
          if (window.innerWidth <= 1024 || sidebar.classList.contains('sidebar-closed')) return;
          dragging = true;
          startX = e.clientX;
          startW = sidebar.getBoundingClientRect().width;
          resizeHandle.classList.add('resizing');
          document.body.classList.add('sidebar-resizing');
          try { resizeHandle.setPointerCapture(e.pointerId); } catch(err){}
        });

        resizeHandle.addEventListener('pointermove', function(e){
          if (!dragging) return;
          setSidebarWidth(startW + (e.clientX - startX));
        });

        function stopResize(){
          if (!dragging) return;
          dragging = false;
          resizeHandle.classList.remove('resizing');
          document.body.classList.remove('sidebar-resizing');
        }
        resizeHandle.addEventListener('pointerup', stopResize);
        resizeHandle.addEventListener('pointercancel', stopResize);
        resizeHandle.addEventListener('dblclick', function(){
          setSidebarWidth(300);
        });
      }

      // Dark mode toggle
      var themeToggle = document.getElementById('themeToggle');
      function applyTheme(isDark){
        document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
        themeToggle.setAttribute('aria-pressed', String(isDark));
        themeToggle.textContent = isDark ? '◑' : '◐';
      }
      applyTheme(localStorage.getItem('theme') === 'dark');
      themeToggle.addEventListener('click', function(){
        var isDark = document.documentElement.getAttribute('data-theme') !== 'dark';
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        applyTheme(isDark);
      });

      // Validasi ukuran & tipe file (foto/video) begitu dipilih, supaya user tahu
      // dari awal kalau filenya kurang/lebih dari limit — bukan setelah klik Simpan.
      document.querySelectorAll('input[type="file"][data-max-kb]').forEach(function (input) {
        var minKb = parseInt(input.dataset.minKb || '0', 10);
        var maxKb = parseInt(input.dataset.maxKb, 10);
        var allowedExt = input.dataset.ext ? input.dataset.ext.split(',') : null;

        var errorEl = input.nextElementSibling;
        if (!errorEl || errorEl.tagName !== 'SMALL' || !errorEl.classList.contains('error')) {
          errorEl = document.createElement('small');
          errorEl.className = 'error';
          errorEl.style.display = 'none';
          input.insertAdjacentElement('afterend', errorEl);
        }
        // Kalau errorEl sudah ada dari server (@@error blade), biarkan tampil apa adanya
        // sampai user memilih file baru — jangan langsung disembunyikan saat load.

        function formatSize(kb) {
          return kb >= 1024 ? (Math.round((kb / 1024) * 10) / 10) + 'MB' : kb + 'KB';
        }

        function showError(msg) {
          errorEl.textContent = msg;
          errorEl.style.display = 'block';
          input.value = '';
        }

        input.addEventListener('change', function () {
          errorEl.style.display = 'none';
          var file = input.files && input.files[0];
          if (!file) return;

          if (allowedExt) {
            var ext = file.name.split('.').pop().toLowerCase();
            if (allowedExt.indexOf(ext) === -1) {
              showError('Format file tidak didukung. Gunakan: ' + allowedExt.join(', ').toUpperCase() + '.');
              return;
            }
          }

          var sizeKb = file.size / 1024;
          if (sizeKb > maxKb) {
            showError('Ukuran file terlalu besar (maks ' + formatSize(maxKb) + '). File Anda: ' + formatSize(Math.round(sizeKb)) + '.');
            return;
          }
          if (minKb > 0 && sizeKb < minKb) {
            showError('Ukuran file terlalu kecil (min ' + formatSize(minKb) + '). File Anda: ' + formatSize(Math.round(sizeKb)) + '.');
            return;
          }
        });
      });
    })();

  </script>

  {{-- Validasi "wajib diisi" & format field pakai tampilan sendiri (bukan balon
       bawaan Chrome/browser) — dipakai bareng dengan halaman publik, lihat
       resources/views/partials/form-validation.blade.php --}}
  @include('partials.form-validation')

  <script>
    // Indikator loading global: progress bar tipis di atas untuk navigasi
    // (klik link) + overlay spinner untuk submit form (dipakai buat kasih
    // tahu proses simpan/hapus/upload sedang berjalan, dan mencegah klik
    // ganda saat upload gambar/video yang makan waktu).
    (function(){
      var bar = document.createElement('div');
      bar.className = 'admin-loading-bar';
      document.body.appendChild(bar);

      var overlay = document.createElement('div');
      overlay.className = 'admin-loading-overlay';
      overlay.setAttribute('aria-hidden', 'true');
      overlay.innerHTML =
        '<div class="admin-loading-box">' +
          '<div class="admin-loading-orbit">' +
            '<div class="admin-loading-logo-wrap">' +
              '<span class="admin-loading-logo-frame"></span>' +
              '<img src="{{ asset('images/Logo.png') }}" alt="Logo Pustekinfo" class="admin-loading-logo">' +
            '</div>' +
          '</div>' +
          '<div class="admin-loading-copy">' +
            '<span class="admin-loading-heading">Tolong menunggu sesaat<span class="admin-loading-dots"><i>.</i><i>.</i><i>.</i></span></span>' +
            '<span class="admin-loading-text">Memproses...</span>' +
            '<span class="admin-loading-sub">Mohon tunggu sebentar</span>' +
          '</div>' +
        '</div>';
      document.body.appendChild(overlay);
      var overlayText = overlay.querySelector('.admin-loading-text');
      var overlaySub = overlay.querySelector('.admin-loading-sub');
      var pageLabelEl = document.querySelector('.topbar-titles h1');
      var pageLabel = pageLabelEl ? pageLabelEl.textContent.trim() : 'halaman ini';

      var progress = 0, progressTimer = null, active = false;

      function startBar(){
        active = true;
        clearInterval(progressTimer);
        progress = 20;
        bar.classList.add('is-active');
        bar.style.width = progress + '%';
        progressTimer = setInterval(function(){
          progress += (90 - progress) * 0.1;
          bar.style.width = Math.min(progress, 90) + '%';
        }, 200);
      }

      function showOverlay(text, sub){
        overlayText.textContent = text;
        overlaySub.textContent = sub || 'Mohon tunggu sebentar';
        overlay.classList.add('is-visible');
        overlay.setAttribute('aria-hidden', 'false');
      }

      function resetLoading(){
        active = false;
        clearInterval(progressTimer);
        bar.classList.remove('is-active');
        bar.style.width = '0%';
        overlay.classList.remove('is-visible');
        overlay.setAttribute('aria-hidden', 'true');
        document.querySelectorAll('.is-loading').forEach(function(el){
          el.classList.remove('is-loading');
          el.disabled = false;
        });
      }

      // Rapikan label dari teks tombol/link: buang simbol "+", spasi ganda,
      // dan angka badge notifikasi yang ikut kebawa (mis. "Pengajuan Layanan 3").
      function cleanLabel(str){
        return (str || '')
          .replace(/\s+/g, ' ')
          .trim()
          .replace(/^\+\s*/, '')
          .replace(/\s*\d+\s*$/, '')
          .trim();
      }

      function formLoadingCopy(form){
        var action = form.getAttribute('action') || '';
        if (action.indexOf('logout') !== -1) {
          return { text: 'Keluar dari akun...', sub: 'Mengakhiri sesi Anda dengan aman' };
        }
        var methodField = form.querySelector('input[name="_method"]');
        var method = (methodField ? methodField.value : (form.method || 'POST')).toUpperCase();
        var hasFile = Array.prototype.some.call(form.querySelectorAll('input[type="file"]'), function(input){
          return input.files && input.files.length > 0;
        });

        if (method === 'DELETE') {
          return { text: 'Menghapus data...', sub: 'Menghapus data ' + pageLabel + ' secara permanen' };
        }
        if (/toggle/.test(action)) {
          return { text: 'Memperbarui status...', sub: 'Menyimpan perubahan status pada ' + pageLabel };
        }
        if (/duplicate/.test(action)) {
          return { text: 'Menduplikasi data...', sub: 'Membuat salinan data ' + pageLabel };
        }
        if (hasFile) {
          return { text: 'Mengunggah berkas...', sub: 'Mengunggah & menyimpan data ' + pageLabel };
        }
        return { text: 'Menyimpan data...', sub: 'Menyimpan perubahan pada ' + pageLabel };
      }

      function navLoadingCopy(link){
        var label = cleanLabel(link.getAttribute('aria-label') || link.getAttribute('title') || link.textContent);
        if (!label) return { text: 'Membuka halaman...', sub: 'Mohon tunggu sebentar' };
        if (/^edit$/i.test(label)) {
          return { text: 'Membuka formulir edit...', sub: 'Menyiapkan data ' + pageLabel + ' yang dipilih' };
        }
        if (/^tambah/i.test(label)) {
          return { text: 'Menyiapkan formulir baru...', sub: 'Menambah ' + label.replace(/^tambah\s*/i, '').trim() || pageLabel };
        }
        if (/^lihat website$/i.test(label)) {
          return { text: 'Membuka situs...', sub: 'Menampilkan tampilan publik website' };
        }
        return { text: 'Membuka ' + label + '...', sub: 'Memuat data terbaru dari server' };
      }

      // Navigasi lewat klik link internal (bukan tab baru/anchor/aksi lain)
      document.addEventListener('click', function(e){
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        var link = e.target.closest('a[href]');
        if (!link || (link.target && link.target !== '_self') || link.hasAttribute('download')) return;
        var href = link.getAttribute('href') || '';
        if (!href || href.charAt(0) === '#' || /^(javascript:|mailto:|tel:)/.test(href)) return;
        startBar();
        var copy = navLoadingCopy(link);
        showOverlay(copy.text, copy.sub);
      });

      // Submit form (simpan/hapus/update-status/dsb)
      document.addEventListener('submit', function(e){
        if (e.defaultPrevented) return; // dibatalkan, mis. confirm() hapus di-Cancel
        var form = e.target;
        startBar();
        var copy = formLoadingCopy(form);
        showOverlay(copy.text, copy.sub);
        setTimeout(function(){
          form.querySelectorAll('button[type="submit"], button:not([type]), input[type="submit"]').forEach(function(btn){
            btn.classList.add('is-loading');
            btn.disabled = true;
          });
        }, 0);
      });

      // Fallback untuk reload/refresh/navigasi lain yang tidak lewat klik/submit
      window.addEventListener('beforeunload', function(){
        if (!active) startBar();
      });

      // Pulihkan tampilan kalau halaman diambil dari bfcache (tombol back/forward)
      window.addEventListener('pageshow', function(e){
        if (e.persisted) resetLoading();
      });
    })();

    // Sinkronisasi lintas perangkat: polling ringan tiap beberapa detik untuk
    // memberi tahu kalau data di halaman list ini sudah diubah dari device/tab
    // lain, tanpa perlu server websocket. Reload tetap manual (tombol) supaya
    // tidak mengganggu admin yang sedang mengisi form/konfirmasi hapus.
    (function(){
      var resource = document.body.getAttribute('data-sync-resource');
      if (!resource) return;

      var checkUrl = '{{ route('admin.sync-check') }}?resource=' + encodeURIComponent(resource);
      var POLL_MS = 8000;
      var baseline = null;
      var notified = false;
      var timer = null;

      function showBanner(){
        if (notified) return;
        notified = true;
        var content = document.querySelector('.content');
        if (!content) return;
        var el = document.createElement('div');
        el.className = 'sync-banner';
        el.innerHTML = '<span>Data pada halaman ini telah diperbarui dari perangkat/pengguna lain.</span>';
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'sync-banner-btn';
        btn.textContent = 'Muat ulang';
        btn.addEventListener('click', function(){
          btn.disabled = true;
          btn.textContent = 'Memuat ulang...';
          window.location.reload();
        });
        el.appendChild(btn);
        content.insertBefore(el, content.firstChild);
        if (timer) { clearInterval(timer); timer = null; }
      }

      function poll(){
        if (notified || document.hidden) return;
        fetch(checkUrl, { headers: { 'Accept': 'application/json' } })
          .then(function(res){ return res.ok ? res.json() : null; })
          .then(function(data){
            if (!data || !data.version) return;
            if (baseline === null) {
              baseline = data.version;
              return;
            }
            if (data.version !== baseline) showBanner();
          })
          .catch(function(){});
      }

      poll();
      timer = setInterval(poll, POLL_MS);
      document.addEventListener('visibilitychange', function(){
        if (!document.hidden) poll();
      });
    })();
  </script>
</body>
</html>