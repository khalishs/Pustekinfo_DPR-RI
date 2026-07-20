{{-- resources/views/kontak.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontak - Pustekinfo DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<style>
  :root{
    --navy:#12242E;
    --teal:#14839C;
    --gold:#c9a34e;
    --ink:#0b2233;
    --white:#ffffff;
    --mist:#eef4f6;
    --line:rgba(255,255,255,.18);
  }
  *{box-sizing:border-box;margin:0;padding:0;}

  html{
    scroll-behavior:smooth;
  }
  body{
    font-family:'Work Sans',system-ui,sans-serif;
    color:var(--ink);
    background: var(--white);
  }
  a{text-decoration:none;color:inherit;}
  ul{list-style:none;}

  h1, h2, h3,
  .brand-text .name,
  .footer-brand-text .name,
  .page-banner h1,
  .kontak-info h2,
  .lokasi h2,
  .kontak-form-card h3,
  .kontak-info-body .title {
    font-family:'Plus Jakarta Sans', system-ui, sans-serif;
  }

  /* ---------- Eyebrow generik ---------- */
  .eyebrow{
    display:flex;
    align-items:center;
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    gap:10px;
    color:var(--teal);
    font-size:12px;
    font-weight:600;
    letter-spacing:.12em;
  }
  .eyebrow::before{
    content:"";
    width:22px;height:2px;
    background:var(--teal);
    display:inline-block;
  }

  /* ---------- Navbar (sama seperti beranda) ---------- */
  .navbar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px 48px;
    background:rgba(255,255,255,.95);
    backdrop-filter:blur(12px);
    border-bottom:1px solid #eaeaea;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    z-index:9999;
  }
  .brand{display:flex;align-items:center;gap:12px;}
  .brand-logo{
    width:50px;
    height:50px;
    object-fit:contain;
  }
  .brand-text .name{font-weight:800;font-size:23px;color:#073D5F;line-height:1.1;}
  .brand-text .sub{font-size:9.5px;letter-spacing:.08em;color: #0F6B7F;;font-weight:600;}
  .nav-links{display:flex;align-items:center;gap:34px;}

  .nav-links li a{
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    font-size:14.5px;font-weight:600;color:#3c4a52;
    display:flex;align-items:center;gap:4px;
  }
  .nav-links li.active a{color:var(--teal);}
  .nav-links li.active{position:relative;}
  .nav-links li.active::after{
    content:"";position:absolute;left:0;right:0;bottom:-18px;
    height:2px;background:var(--teal);
  }

  /* ---------- Dropdown Profil ---------- */
  .nav-item-dropdown{position:relative;}
  .nav-dropdown{
    position:absolute;
    top:calc(100% + 22px);
    left:50%;
    transform:translateX(-50%) translateY(8px);
    min-width:220px;
    background:var(--white);
    border:1px solid #e7dcc6;
    border-radius:12px;
    padding:10px;
    box-shadow:0 24px 50px -20px rgba(11,34,51,.25);
    opacity:0;
    visibility:hidden;
    transition:opacity .2s ease, transform .2s ease, visibility .2s ease;
    z-index:20;
  }
  .nav-item-dropdown:hover .nav-dropdown{
    opacity:1;
    visibility:visible;
    transform:translateX(-50%) translateY(0);
  }
  .nav-dropdown a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:10px 12px;
    border-radius:8px;
    font-size:14px;
    font-weight:600;
    color:#5b6b73;
    transition:.15s ease;
  }
  .nav-dropdown a:hover{background:var(--mist);color:var(--navy);}
  .nav-dropdown a .dd-icon{
    width:18px;height:18px;
    color:var(--teal);
    flex-shrink:0;
  }
  .nav-dropdown a .dd-icon svg{
    width:100%;height:100%;
    stroke:currentColor;fill:none;
    stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;
  }

  @media (max-width:900px){
    .nav-dropdown{
      position:static;
      transform:none;
      opacity:1;visibility:visible;
      display:none;
      box-shadow:none;
      border:none;
      padding:0 0 0 14px;
      margin-top:4px;
    }
    .nav-item-dropdown.open .nav-dropdown{display:block;}
    .nav-dropdown a{padding:10px 4px;border-bottom:1px solid #f1f4f5;border-radius:0;}
  }
  .caret{font-size:10px;opacity:.6;}

  .nav-actions{display:flex;align-items:center;gap:12px;}
  .icon-btn{
    width:36px;height:36px;border-radius:50%;
    border:1px solid #dfe4e7;
    display:flex;align-items:center;justify-content:center;
    font-size:14px;color:#5b6b73;background:var(--white);
    cursor:pointer;
  }
  .lang-btn{
    padding:8px 16px;border-radius:20px;border:1px solid #dfe4e7;
    font-size:13px;font-weight:700;color:#5b6b73;background:var(--white);
    cursor:pointer;
  }
  .btn-login{
    padding:10px 22px;border-radius:20px;border:none;
    background:var(--navy);color:var(--white);
    font-size:14px;font-weight:700;cursor:pointer;
  }

  .profile-box{
    display:flex;align-items:center;gap:10px;
    padding:6px 16px 6px 6px;border-radius:24px;
    border:1px solid #dfe4e7;background:var(--white);
  }
  .profile-avatar{
    width:32px;height:32px;border-radius:50%;
    object-fit:cover;flex-shrink:0;
  }
  .profile-name{
    font-size:13.5px;font-weight:700;color:var(--navy);
    white-space:nowrap;max-width:140px;overflow:hidden;text-overflow:ellipsis;
  }
  #logout-form{display:flex;align-items:center;}
  .logout-btn{
    padding:9px 18px;border-radius:20px;
    border:1px solid #e3b8b8;background:var(--white);
    color:#b0413e;font-size:13px;font-weight:700;
    cursor:pointer;transition:.2s ease;
  }
  .logout-btn:hover{background:#b0413e;color:var(--white);border-color:#b0413e;}

  @media (max-width:900px){
    .navbar{padding:10px 16px;gap:8px;}
    .nav-links{display:none;}

    .brand{gap:8px;min-width:0;}
    .brand-logo{width:36px;height:36px;flex-shrink:0;}
    .brand-text{min-width:0;}
    .brand-text .name{font-size:15px;white-space:nowrap;}
    .brand-text .sub{font-size:8px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}

    .burger{
      display:none;
      flex-direction:column;
      justify-content:center;
      gap:5px;
      width:36px;height:36px;
      border-radius:50%;
      border:1px solid #dfe4e7;
      background:var(--white);
      cursor:pointer;
      align-items:center;
    }
    .burger span{
      width:16px;height:2px;
      background:#3c4a52;
      border-radius:2px;
      transition:.25s ease;
    }
    .burger.open span:nth-child(1){transform:translateY(7px) rotate(45deg);}
    .burger.open span:nth-child(2){opacity:0;}
    .burger.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg);}
    .nav-actions{gap:6px;flex-shrink:0;}
    .icon-btn{width:30px;height:30px;font-size:12px;}
    .lang-btn{padding:6px 12px;font-size:11.5px;}
    .btn-login{padding:8px 14px;font-size:12.5px;white-space:nowrap;}
    .profile-box{padding:4px 10px 4px 4px;gap:6px;}
    .profile-avatar{width:26px;height:26px;}
    .profile-name{font-size:11.5px;max-width:80px;}
    .logout-btn{padding:6px 12px;font-size:11px;white-space:nowrap;}

    .burger{display:flex;}
    .nav-links{
      display:none;
      position:fixed;
      top:62px;
      left:0;
      right:0;
      flex-direction:column;
      gap:0;
      background:var(--white);
      border-bottom:1px solid #eaeaea;
      box-shadow:0 20px 30px -20px rgba(11,34,51,.25);
      padding:8px 20px 16px;
      z-index:9998;
    }
    .nav-links.open{display:flex;}
    .nav-links li{width:100%;}
    .nav-links li a{
      padding:14px 4px;
      width:100%;
      justify-content:space-between;
      border-bottom:1px solid #f1f4f5;
    }
    .nav-links li.active::after{display:none;}
  }

  @media (max-width:420px){
    .btn-login{padding:8px 10px;}
    .profile-name{display:none;}
    .profile-box{padding:4px;}
  }

  /* ---------- Page Banner ---------- */
  .page-banner{
    margin-top:70px;
    position:relative;
    background:linear-gradient(150deg,#073D5F 30%,#057888 100%);
    padding:64px 100px 68px;
    overflow:hidden;
  }
  .page-banner::after{
    content:"";
    position:absolute;
    inset:0;
    background:radial-gradient(60% 90% at 85% 0%, rgba(255,255,255,.08) 0%, transparent 60%);
    pointer-events:none;
  }
  .page-banner-inner{position:relative;z-index:1;max-width:1240px;margin:0 auto;}
  .breadcrumb{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:13px;
    font-weight:600;
    color:rgba(255,255,255,.55);
  }
  .breadcrumb a:hover{color:var(--white);}
  .breadcrumb .sep{color:rgba(255,255,255,.35);}
  .breadcrumb .current{color:#5FC0D1;}

  .page-banner h1{
    margin-top:18px;
    font-size:34px;
    font-weight:800;
    line-height:1.3;
    letter-spacing:-.01em;
    color:var(--white);
  }
  .page-banner h1 .accent{color:#5FC0D1;}
  .page-banner p{
    margin-top:16px;
    max-width:600px;
    color:rgba(255,255,255,.75);
    font-size:14.5px;
    line-height:1.75;
    font-weight:500;
  }

  @media (max-width:900px){
    .page-banner{margin-top:62px;padding:44px 20px 48px;}
    .page-banner h1{font-size:24px;}
  }

  /* ---------- Kontak: Informasi & Form ---------- */
  .kontak-page{
    background:var(--white);
    padding:70px 100px 40px;
    opacity:0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .kontak-page.show{opacity:1;transform:translateY(0);}

  .kontak-grid{
    max-width:1240px;
    margin:0 auto;
    display:grid;
    grid-template-columns:0.82fr 1fr;
    gap:70px;
    align-items:start;
  }

  /* --- Kolom info --- */
  .kontak-info h2{
    margin-top:14px;
    font-size:26px;
    font-weight:800;
    color:var(--navy);
    letter-spacing:-.01em;
  }

  .kontak-info-list{
    margin-top:28px;
    display:flex;
    flex-direction:column;
  }
  .kontak-info-item{
    display:flex;
    gap:16px;
    padding:20px 0;
    border-bottom:1px solid #eef1f3;
  }
  .kontak-info-item:first-child{padding-top:0;}
  .kontak-info-item:last-child{border-bottom:none;padding-bottom:0;}

  .kontak-info-icon{
    width:20px;height:20px;
    color:var(--teal);
    flex-shrink:0;
    margin-top:2px;
  }
  .kontak-info-icon svg{
    width:100%;height:100%;
    stroke:currentColor;
    fill:none;
    stroke-width:1.8;
    stroke-linecap:round;
    stroke-linejoin:round;
  }

  .kontak-info-body .title{
    font-size:14.5px;
    font-weight:700;
    color:var(--navy);
  }
  .kontak-info-body .desc{
    margin-top:4px;
    font-size:13.5px;
    color:#7a8a92;
    line-height:1.65;
  }

  .kontak-social{
    margin-top:28px;
    display:flex;
    gap:10px;
  }
  .kontak-social a{
    width:38px;height:38px;
    border-radius:10px;
    border:1px solid #dfe4e7;
    color:#5b6b73;
    display:flex;align-items:center;justify-content:center;
    transition:.2s ease;
  }
  .kontak-social a:hover{
    background:var(--teal);
    border-color:var(--teal);
    color:var(--white);
  }
  .kontak-social svg{
    width:15px;height:15px;
    stroke:currentColor;
    fill:none;
    stroke-width:1.8;
    stroke-linecap:round;
    stroke-linejoin:round;
  }

  /* --- Kolom form --- */
  .kontak-form-card{
    background:var(--white);
    border-radius:1px 20px 1px 20px;
    padding:40px 44px;
    box-shadow:0 30px 60px -28px rgba(11,34,51,.22);
    border:1px solid #eef1f3;
  }
  .kontak-form-card h3{
    font-size:20px;
    font-weight:800;
    color:var(--navy);
  }
  .kontak-form-card > p{
    margin-top:8px;
    color:#7a8a92;
    font-size:13.5px;
    line-height:1.65;
  }

  form.kontak-form{margin-top:24px;}

  .form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
    margin-top:20px;
  }
  .form-row:first-of-type{margin-top:0;}

  .form-field label{
    display:block;
    font-size:13px;
    font-weight:700;
    color:var(--navy);
    margin-bottom:8px;
  }
  .form-field input,
  .form-field select,
  .form-field textarea{
    width:100%;
    border:1px solid #dfe4e7;
    border-radius:8px;
    padding:12px 14px;
    font-size:13.5px;
    font-family:inherit;
    color:var(--ink);
    background:var(--white);
    transition:.2s ease;
  }
  .form-field input::placeholder,
  .form-field textarea::placeholder{color:#a7b3b8;}
  .form-field input:focus,
  .form-field select:focus,
  .form-field textarea:focus{
    outline:none;
    border-color:var(--teal);
    box-shadow:0 0 0 3px rgba(20,128,140,.12);
  }
  .form-field select{
    appearance:none;
    -webkit-appearance:none;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%235b6b73' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 14px center;
    padding-right:36px;
    cursor:pointer;
  }
  .form-field textarea{
    resize:vertical;
    min-height:120px;
    font-family:inherit;
  }
  .form-field.full{grid-column:1/-1;}

  .kontak-form-footer{
    margin-top:26px;
    display:flex;
    align-items:center;
    gap:18px;
    flex-wrap:wrap;
  }
  .btn-kirim{
    display:flex;
    align-items:center;
    gap:10px;
    background:var(--navy);
    color:var(--white);
    border:none;
    padding:14px 26px;
    border-radius:8px;
    font-size:13px;
    font-weight:700;
    letter-spacing:.04em;
    cursor:pointer;
    transition:.2s ease;
  }
  .btn-kirim:hover{
    background:var(--teal);
    transform:translateY(-2px);
  }
  .btn-kirim svg{
    width:15px;height:15px;
    stroke:currentColor;
    fill:none;
    stroke-width:2;
    stroke-linecap:round;
    stroke-linejoin:round;
  }
  .kontak-form-footer .note{
    font-size:12px;
    color:#9aa8af;
    font-weight:500;
  }

  @media (max-width:900px){
    .kontak-page{padding:50px 20px 20px;}
    .kontak-grid{grid-template-columns:1fr;gap:50px;}
    .kontak-form-card{padding:28px 24px;}
    .form-row{grid-template-columns:1fr;gap:16px;}
  }

  /* ---------- Lokasi ---------- */
  .lokasi{
    background:var(--white);
    padding:30px 100px 110px;
    opacity:0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .lokasi.show{opacity:1;transform:translateY(0);}
  .lokasi-inner{max-width:1240px;margin:0 auto;}
  .lokasi-inner h2{
    margin-top:14px;
    font-size:26px;
    font-weight:800;
    color:var(--navy);
    letter-spacing:-.01em;
  }

  .lokasi-map{
    margin-top:30px;
    position:relative;
    overflow:hidden;
    border-radius:1px 20px 1px 20px;
    min-height:340px;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:14px;
    background:
      radial-gradient(120% 140% at 15% 10%, var(--teal) 0%, transparent 55%),
      linear-gradient(150deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
    box-shadow:0 30px 60px -28px rgba(11,34,51,.3);
  }
  .lokasi-map iframe{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    border:0;
    display:block;
  }
  @media (max-width:900px){
    .lokasi{padding:20px 20px 80px;}
    .lokasi-map{min-height:260px;}
  }

  .footer-divider{
    margin-top:-1px;
    height:3px;
    background:linear-gradient(10deg, #057888 0%, #0b2233 55%, #0b2233 100%);
  }

  /* ---------- Footer (sama seperti beranda) ---------- */
  .footer{
    background:var(--navy);
    padding:64px 100px 0;
  }
  .footer-inner{
    max-width:1240px;
    margin:0 auto;
    display:grid;
    grid-template-columns:1.4fr 1fr 1fr 1fr;
    gap:40px;
    padding-bottom:50px;
  }

  .footer-brand{display:flex;align-items:center;gap:12px;}
  .footer-brand-logo{
    width:50px;
    object-fit:contain;
  }
  .footer-brand-text .name{font-family: 'Plus Jakarta Sans', system-ui, sans-serif;font-weight:800;font-size:23px;color:var(--white);line-height:1.1;}
  .footer-brand-text .sub{font-family: 'Plus Jakarta Sans', system-ui, sans-serif;font-size:10px;letter-spacing:.08em;color:var(--white);font-weight:600;}

  .footer-desc{
    margin-top:18px;
    color:rgba(255,255,255,.55);
    font-size:13px;
    line-height:1.75;
    max-width:260px;
  }

  .footer-social{
    margin-top:22px;
    display:flex;
    gap:10px;
  }
  .footer-social a{
    width:34px;height:34px;
    border-radius:8px;
    border:1px solid rgba(255,255,255,.14);
    color:rgba(255,255,255,.7);
    display:flex;align-items:center;justify-content:center;
    transition:.2s ease;
  }
  .footer-social a:hover{
    background:var(--teal);
    border-color:var(--teal);
    color:var(--white);
  }
  .footer-social svg{
    width:15px;height:15px;
    stroke:currentColor;
    fill:none;
    stroke-width:1.8;
    stroke-linecap:round;
    stroke-linejoin:round;
  }

  .footer-col .head{
    color:rgba(255,255,255,.85);
    font-size:11.5px;
    font-weight:800;
    letter-spacing:.1em;
    padding-bottom:12px;
    border-bottom:2px solid var(--teal);
    display:inline-block;
  }
  .footer-links{
    margin-top:20px;
    display:flex;
    flex-direction:column;
    gap:14px;
  }
  .footer-links a{
    display:flex;
    align-items:center;
    gap:6px;
    color:rgba(255,255,255,.6);
    font-size:13.5px;
    font-weight:500;
    transition:.2s ease;
    width:max-content;
  }
  .footer-links a .chev{
    font-size:11px;
    color:var(--teal);
  }
  .footer-links a:hover{color:var(--white);}

  .footer-contact{
    margin-top:20px;
    display:flex;
    flex-direction:column;
    gap:16px;
  }
  .footer-contact .item{
    display:flex;
    align-items:flex-start;
    gap:10px;
    color:rgba(255,255,255,.65);
    font-size:13px;
    line-height:1.6;
  }
  .footer-contact .item svg{
    width:16px;height:16px;
    stroke:var(--teal);
    fill:none;
    stroke-width:1.8;
    stroke-linecap:round;
    stroke-linejoin:round;
    flex-shrink:0;
    margin-top:1px;
  }

  .footer-bottom{
    border-top:1px solid rgba(255,255,255,.1);
    padding:22px 0;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
  }
  .footer-bottom p{
    color:rgba(255,255,255,.45);
    font-size:12.5px;
    font-weight:500;
  }

  @media (max-width:900px){
    .footer{padding:50px 20px 0;}
    .footer-inner{grid-template-columns:1fr 1fr;gap:36px;padding-bottom:40px;}
    .footer-brand-text .sub{white-space:normal;}
    .footer-bottom{flex-direction:column;text-align:center;padding:20px 0;}
  }
  @media (max-width:560px){
    .footer-inner{grid-template-columns:1fr;}
  }
</style>
</head>
<body>

  {{-- ================= NAVBAR ================= --}}
  <nav class="navbar">
    <div class="brand">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo Pustekinfo" class="brand-logo">
      <div class="brand-text">
        <div class="name">PUSTEKINFO</div>
        <div class="sub">Sekretariat Jendral DPR RI</div>
      </div>
    </div>

    <ul class="nav-links">
      <li><a href="{{ route('home') }}">Beranda</a></li>
      <li class="nav-item-dropdown" id="profilDropdown">
        <a href="{{ route('profil') }}">Profil <span class="caret">▾</span></a>
        <div class="nav-dropdown">
          <a href="{{ route('profil') }}#tentang">
            <span class="dd-icon"><svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></span>
            Tentang
          </a>
          <a href="{{ route('profil') }}#pimpinan">
            <span class="dd-icon"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
            Pimpinan
          </a>
          <a href="{{ route('profil') }}#struktur">
            <span class="dd-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><path d="M5 17v-2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><circle cx="12" cy="19" r="2"/></svg></span>
            Struktur Organisasi
          </a>
          <a href="{{ route('profil') }}#visi-misi">
            <span class="dd-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/></svg></span>
            Visi dan Misi
          </a>
        </div>
      </li>
      <li><a href="{{ route('home') }}#layanan">Layanan <span class="caret"></span></a></li>
      <li><a href="{{ route('home') }}#berita">Informasi <span class="caret"></span></a></li>
      <li><a href="{{ route('galeri') }}">Galeri</a></li>
      <li class="active"><a href="{{ route('kontak') }}">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <button class="icon-btn" aria-label="Ganti tema">◐</button>
      <button class="lang-btn">EN</button>       
        <a href="{{ route('login') }}" class="btn-login">Masuk</a>
      <button class="burger" id="burgerBtn" aria-label="Buka menu">
         <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  {{-- ================= PAGE BANNER ================= --}}
  <header class="page-banner">
    <div class="page-banner-inner">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <span class="sep">/</span>
        <span class="current">Kontak</span>
      </div>
      <h1>Kami siap <span class="accent">membantu Anda</span></h1>
      <p>Hubungi kami untuk pertanyaan seputar layanan, kerja sama, atau bantuan teknis.</p>
    </div>
  </header>

  {{-- ================= INFORMASI KONTAK & FORM ================= --}}
  <section class="kontak-page">
    <div class="kontak-grid">

      {{-- Kolom kiri: Informasi kontak --}}
      <div class="kontak-info">
        <div class="eyebrow">INFORMASI KONTAK</div>
        <h2>Ada pertanyaan?</h2>

        <div class="kontak-info-list">
          <div class="kontak-info-item">
          <div class="kontak-info-icon">
            <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div class="kontak-info-body">
            <div class="title">Alamat</div>
            <div class="desc">{{ $setting->address ?? 'Alamat belum diatur' }}</div>
          </div>
        </div>

        <div class="kontak-info-item">
          <div class="kontak-info-icon">
            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div class="kontak-info-body">
            <div class="title">Telepon</div>
            <div class="desc">{{ $setting->phone ?? '-' }}</div>
          </div>
        </div>

        <div class="kontak-info-item">
          <div class="kontak-info-icon">
            <svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg>
          </div>
          <div class="kontak-info-body">
            <div class="title">Email</div>
            <div class="desc">{{ $setting->email ?? '-' }}</div>
          </div>
        </div>
      </div>
      </div>


      {{-- Kolom kanan: Form kirim pesan --}}
      <div class="kontak-form-card">
        <h3>Kirim pesan</h3>
        <p>Isi formulir berikut, tim kami akan merespons dalam 1&times;24 jam kerja.</p>

        @if(session('status'))
          <div style="margin-bottom:20px;padding:14px 18px;border-radius:10px;background:#e6f7ee;color:#1f9d7c;font-size:13.5px;font-weight:600;">
            {{ session('status') }}
          </div>
        @endif
        <form class="kontak-form" method="POST" action="{{ route('kontak.kirim') }}">
          @csrf

          <div class="form-row">
            <div class="form-field">
              <label for="nama">Nama lengkap</label>
              <input type="text" id="nama" name="nama" placeholder="Nama Anda" required>
            </div>
            <div class="form-field">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="nama@email.com" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-field">
              <label for="instansi">Unit kerja / Instansi</label>
              <input type="text" id="instansi" name="instansi" placeholder="Opsional">
            </div>
            <div class="form-field">
              <label for="kategori">Kategori</label>
              <select id="kategori" name="kategori">
                <option value="umum">Pertanyaan umum</option>
                <option value="teknis">Bantuan teknis</option>
                <option value="kerjasama">Kerja sama</option>
                <option value="pengaduan">Pengaduan</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-field full">
              <label for="pesan">Pesan</label>
              <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda di sini..." required></textarea>
            </div>
          </div>

          <div class="kontak-form-footer">
            <button type="submit" class="btn-kirim">
              <svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
              KIRIM PESAN
            </button>
            <span class="note">Data Anda akan kami jaga kerahasiaannya.</span>
          </div>
        </form>
      </div>

    </div>
  </section>

  {{-- ================= LOKASI ================= --}}
  <section class="lokasi">
    <div class="lokasi-inner">
      <div class="eyebrow">LOKASI</div>
      <h2>Temukan kami</h2>

      <div class="lokasi-map">
        {{-- Ganti nilai pb= di bawah dengan link embed dari Google Maps
             (Google Maps > Bagikan > Sematkan peta > salin kode iframe, lalu ambil bagian pb=...) --}}
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4137668829876!2d106.79718367398998!3d-6.209030293778832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6b735ae6133%3A0x214dde968c25b376!2sSekretariat%20Jenderal%20Dewan%20Perwakilan%20Rakyat%20Republik%20Indonesia!5e0!3m2!1sid!2sus!4v1784135196454!5m2!1sid!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"
          width="100%"
          height="100%"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Lokasi Pustekinfo - Gedung Sekretariat Jakarta">
        </iframe>
      </div>
    </div>
  </section>

  <div class="footer-divider"></div>

  {{-- ================= FOOTER (sama seperti beranda) ================= --}}
  <footer class="footer">
    <div class="footer-inner">

      <div class="footer-col">
        <div class="footer-brand">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo Pustekinfo" class="brand-logo">
          <div class="footer-brand-text">
            <div class="name">PUSTEKINFO</div>
            <div class="sub">Sekretariat Jendral DPR RI</div>
          </div>
        </div>
        <p class="footer-desc">Melayani unit kerja dan masyarakat dalam bidang teknologi informasi, jaringan, dan keamanan data.</p>

        <div class="footer-social">
          <a href="{{ $setting->instagram_url ?? '#' }}" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/></svg></a>
          <a href="{{ $setting->youtube_url ?? '#' }}" aria-label="YouTube"><svg viewBox="0 0 24 24"><path d="M22 8.5a4 4 0 0 0-2.8-2.8C17.4 5.2 12 5.2 12 5.2s-5.4 0-7.2.5A4 4 0 0 0 2 8.5 41 41 0 0 0 2 12a41 41 0 0 0 0 3.5 4 4 0 0 0 2.8 2.8c1.8.5 7.2.5 7.2.5s5.4 0 7.2-.5a4 4 0 0 0 2.8-2.8A41 41 0 0 0 22 12a41 41 0 0 0 0-3.5z"/><polygon points="10 9 15 12 10 15"/></svg></a>
          <a href="{{ $setting->x_url ?? '#' }}" aria-label="X"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></a>
        </div>
      </div>

      <div class="footer-col">
        <span class="head">TAUTAN</span>
        <div class="footer-links">
          <a href=""><span class="chev">›</span> Sistem Akademik</a>
          <a href="#"><span class="chev">›</span> Sistem Kepegawaian</a>
          <a href="#"><span class="chev">›</span> Sistem Keuangan</a>
          <a href="#"><span class="chev">›</span> PPID</a>
        </div>
      </div>

      <div class="footer-col">
        <span class="head">BANTUAN</span>
        <div class="footer-links">
          <a href="#"><span class="chev">›</span> Helpdesk</a>
          <a href="#"><span class="chev">›</span> Pengaduan</a>
          <a href="#"><span class="chev">›</span> FAQ</a>
          <a href="#"><span class="chev">›</span> Whistleblowing</a>
        </div>
      </div>

      <div class="footer-col">
        <span class="head">KONTAK</span>
        <div class="footer-contact">
          <div class="item">
            <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            {{ $setting->address ?? 'Alamat belum diatur' }}
          </div>
          <div class="item">
            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            {{ $setting->phone ?? '-' }}
          </div>
          <div class="item">
            <svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg>
            {{ $setting->email ?? '-' }}
          </div>
        </div>
      </div>

    </div>

    <div class="footer-inner footer-bottom">
      <p>© 2026 Pustekinfo. Seluruh hak dilindungi.</p>
      <p>Referensi mockup — bukan situs resmi</p>
    </div>
  </footer>

  <script>

    // Dropdown Profil (mobile)
    const profilDropdown = document.getElementById("profilDropdown");
    if (window.innerWidth <= 900) {
        profilDropdown.querySelector("a").addEventListener("click", (e) => {
            e.preventDefault();
            profilDropdown.classList.toggle("open");
        });
    }

    // Burger menu
    const burgerBtn = document.getElementById("burgerBtn");
    const navLinks = document.querySelector(".nav-links");

    burgerBtn.addEventListener("click", () => {
        burgerBtn.classList.toggle("open");
        navLinks.classList.toggle("open");
    });

    navLinks.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", () => {
            burgerBtn.classList.remove("open");
            navLinks.classList.remove("open");
        });
    });

    // Fade-in saat scroll
    function observeSection(selector, threshold = 0.15) {
        const section = document.querySelector(selector);
        if (!section) return;
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold });
        observer.observe(section);
    }
    observeSection(".kontak-page", 0.1);
    observeSection(".lokasi", 0.15);

  </script>
</body>
</html>