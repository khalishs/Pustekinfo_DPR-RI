{{-- resources/views/galeri.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Galeri Kegiatan - Pustekinfo DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('images/favicon-bg.png') }}">
<style>
  :root{
    --navy:#12242E; --teal:#14839C; --ink:#0b2233;
    --white:#ffffff; --mist:#eef4f6; --line:rgba(255,255,255,.18);
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  html{scroll-behavior:smooth;}
  body{
    font-family:'Work Sans',system-ui,sans-serif;
    color:var(--ink);
    position:relative;
    background-color:#14839C1A;
  }
  body::before{
    content:"";
    position:absolute;
    inset:0;
    z-index:-1;
    pointer-events:none;
    background-image:url('{{ asset('images/group-batik.png') }}');
    background-repeat:no-repeat;
    background-position:center top;
    background-size:10000px auto;
    filter:url(#batikBoostLight);
  }
  [data-theme="dark"] body::before{
    filter:url(#batikTintTeal);
    opacity:.4;
  }
  @media (max-width:900px){
    body::before{background-size:3000px auto;}
  }
  @view-transition{navigation:auto;}
  a{text-decoration:none;color:inherit;}
  ul{list-style:none;}
  h1,h2,.stat-num,.sorotan-title{font-family:'Plus Jakarta Sans',system-ui,sans-serif;}

  .navbar-logo{height:50px;width:auto;object-fit:contain; transform:scale(4.9); /* 1.2 - 1.8 sesuaikan */
    transform-origin:left center;}
  .navbar{display:flex;align-items:center;justify-content:space-between;padding:10px 48px;background:rgba(255,255,255,.95);backdrop-filter:blur(12px);border-bottom:1px solid #eaeaea;position:fixed;top:0;left:0;width:100%;z-index:9999;}
  .brand{display:flex;align-items:center;gap:12px;}
  .brand-logo{width:50px;height:50px;object-fit:contain;}
  .nav-links{display:flex;align-items:center;gap:34px;}
  .nav-links li a{font-family:'Plus Jakarta Sans',system-ui,sans-serif;font-size:14.5px;font-weight:600;color:#3c4a52;display:flex;align-items:center;gap:4px;transition:color .2s ease;}
  .nav-links li a:hover{color:var(--teal);}
  .nav-links li.active a{color:var(--teal);}
  .nav-links li.active{position:relative;}
  .nav-links li.active::after{content:"";position:absolute;left:0;right:0;bottom:-18px;height:2px;background:var(--teal);view-transition-name:nav-underline;}
  .nav-item-dropdown{position:relative;}
  .nav-dropdown{position:absolute;top:calc(100% + 22px);left:50%;transform:translateX(-50%) translateY(8px);min-width:220px;background:var(--white);border:1px solid #e7dcc6;border-radius:12px;padding:10px;box-shadow:0 24px 50px -20px rgba(11,34,51,.25);opacity:0;visibility:hidden;transition:.2s ease;z-index:20;}
  .nav-item-dropdown:hover .nav-dropdown{opacity:1;visibility:visible;transform:translateX(-50%) translateY(0);}
  .nav-dropdown a{display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:8px;font-size:14px;font-weight:600;color:#5b6b73;transition:.15s ease;}
  .nav-dropdown a:hover{background:var(--mist);color:var(--navy);}
  .nav-dropdown a .dd-icon{width:18px;height:18px;color:var(--teal);flex-shrink:0;}
  .nav-dropdown a .dd-icon svg{width:100%;height:100%;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
  .caret{font-size:10px;opacity:.6;}
  .nav-actions{display:flex;align-items:center;gap:12px;}

  /* ---------- Tombol mode gelap (di navbar, sebelah tombol translate) ---------- */
  .theme-fab{
    width:38px;height:38px;border-radius:50%;flex-shrink:0;position:relative;
    border:1px solid #dfe4e7;background:var(--white);color:#5b6b73;
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;
    transition:background .2s ease, border-color .2s ease, color .2s ease, transform .2s ease;
  }
  .theme-fab:active{transform:scale(.9);}
  @keyframes theme-fab-pulse{0%{transform:scale(1);}45%{transform:scale(.86);}100%{transform:scale(1);}}
  .theme-fab.pulse{animation:theme-fab-pulse .45s ease;}
  .theme-fab-icon{
    position:absolute;width:18px;height:18px;
    display:flex;align-items:center;justify-content:center;
    transition:opacity .4s ease, transform .5s cubic-bezier(.34,1.56,.64,1);
  }
  .theme-fab-icon svg{width:100%;height:100%;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
  .theme-fab .icon-moon{opacity:1;transform:rotate(0) scale(1);}
  .theme-fab .icon-sun{opacity:0;transform:rotate(90deg) scale(.4);}
  [data-theme="dark"] .theme-fab{background:#122530;border-color:rgba(255,255,255,.14);color:#c3cdd2;}
  [data-theme="dark"] .theme-fab:hover{border-color:#5FC0D1;color:#5FC0D1;}
  [data-theme="dark"] .theme-fab .icon-moon{opacity:0;transform:rotate(-90deg) scale(.4);}
  [data-theme="dark"] .theme-fab .icon-sun{opacity:1;transform:rotate(0) scale(1);}
  @media (max-width:900px){
    .theme-fab{width:32px;height:32px;}
    .theme-fab-icon{width:16px;height:16px;}
  }

  .lang-btn{padding:8px 16px;border-radius:20px;border:1px solid #dfe4e7;font-size:13px;font-weight:700;color:#5b6b73;background:var(--white);cursor:pointer;transition:.2s ease;}
  .lang-btn:hover{background:var(--mist);border-color:var(--teal);color:var(--teal);}
  .btn-login{padding:10px 22px;border-radius:20px;border:none;background:var(--navy);color:var(--white);font-size:14px;font-weight:700;cursor:pointer;transition:.2s ease;}
  .btn-login:hover{background:var(--teal);transform:translateY(-2px);box-shadow:0 10px 22px -10px rgba(20,128,140,.55);}
  .burger{display:none;flex-direction:column;justify-content:center;gap:5px;width:36px;height:36px;border-radius:50%;border:1px solid #dfe4e7;background:var(--white);cursor:pointer;align-items:center;}
  .burger span{width:16px;height:2px;background:#3c4a52;border-radius:2px;transition:.25s ease;}
  .burger.open span:nth-child(1){transform:translateY(7px) rotate(45deg);}
  .burger.open span:nth-child(2){opacity:0;}
  .burger.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg);}

  @media (max-width:900px){
    .navbar{padding:10px 16px;gap:8px;}
    .nav-links{display:flex;position:fixed;top:62px;left:0;right:0;flex-direction:column;gap:0;background:var(--white);border-bottom:1px solid #eaeaea;box-shadow:0 20px 30px -20px rgba(11,34,51,.25);padding:8px 20px 16px;z-index:9998;opacity:0;visibility:hidden;transform:translateY(-10px);pointer-events:none;transition:opacity .25s ease, transform .25s ease, visibility .25s ease;}
    .nav-links.open{opacity:1;visibility:visible;transform:translateY(0);pointer-events:auto;}
    .nav-links li{width:100%;}
    .nav-links li a{padding:14px 4px;width:100%;justify-content:space-between;border-bottom:1px solid #f1f4f5;}
    .nav-links li.active::after{display:none;}
    .burger{display:flex;}
    .brand-logo{width:36px;height:36px;}
    .navbar-logo{height:32px;width:auto;}
  }

  /* ---------- Hero / Page Banner (sama seperti Profil, Layanan, Informasi) ---------- */
  .hero-profil{
    margin-top:70px;
    position:relative;
    background:#073D5F;
    padding:90px 24px 60px;
    overflow:hidden;
  }
  .hero-profil::before{
    content:"";position:absolute;inset:0;
    background:radial-gradient(60% 60% at 85% 0%, rgba(79,179,172,.25), transparent 60%);
    pointer-events:none;
  }
  .hero-profil-inner{position:relative;z-index:2;max-width:1240px;margin:0 auto;text-align:center;}
  .breadcrumb{color:rgba(255,255,255,.55);font-size:13px;font-weight:600;margin-bottom:18px;}
  .breadcrumb span{color:var(--teal);}
  .hero-profil h1{
    color:var(--white);font-size:34px;font-weight:800;line-height:1.28;letter-spacing:-.01em;
    max-width:680px;margin:0 auto;
  }
  .hero-profil h1 .accent{color:#5FC0D1;}
  .hero-profil p{
    margin:20px auto 0;max-width:600px;color:rgba(255,255,255,.7);font-size:15px;line-height:1.75;font-weight:500;
  }

  .stats-bar{
    position:relative;
    z-index:3;
    max-width:1160px;
    margin:60px auto 0;
    padding:0 10px;
  }
  .stats-bar-inner{
    display: flex;
    align-items: center;
    background: var(--white);
    border: 1px solid var(--line);
    border-radius:14px;
    overflow: hidden;
    display:grid;
    grid-template-columns:repeat(4,1fr);
    box-shadow:0 20px 40px -12px rgba(11,34,51,.35);
  }
  .stat-card{
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    gap:14px;
    padding:22px 24px;
    border-right:1px solid #c3cdd2;
  }
  .stat-card:last-child{border-right:none;}
  .stat-num{align-items:center;font-size:24px;font-weight:800;color:var(--ink);line-height:1;}
  .stat-label{align-items:center;margin-top:5px;font-size:11.5px;font-weight:;color:var(--ink);}

  @media (max-width:900px){
    .stats-bar{padding:0 20px;margin-top:-40px;}
    .stats-bar-inner{grid-template-columns:repeat(2,1fr);border-radius:12px;}
    .stat-card{border-right:none;border-bottom:1px solid var(--line);padding:16px 18px;}
    .stat-card:nth-last-child(-n+2){border-bottom:none;}
    .hero-profil{margin-top:62px;padding:70px 20px 44px;}
    .hero-profil h1{font-size:24px;}
  }
  .stat-num{font-size:26px;font-weight:800;color:var(--navy);}
  .stat-label{margin-top:6px;font-size:12px;font-weight:600;color:#7a8a92;}

  .galeri-page{padding:50px 100px 100px;max-width:1240px;margin:0 auto;}

  .galeri-layout{display:grid;grid-template-columns:230px 1fr;gap:32px;align-items:start;}
  .galeri-sidebar{
    background:var(--white);
    border:1px solid #eef1f3;
    border-radius:16px;
    padding:20px;
    box-shadow:0 20px 40px -26px rgba(11,34,51,.22);
    position:sticky;top:96px;
  }
  .galeri-sidebar-title{font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#8a97a0;margin-bottom:14px;}
  [data-theme="dark"] .galeri-sidebar{background:#1c2126;border-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .galeri-sidebar-title{color:#6d8189;}

  .sorotan-card{
    position:relative;
    border-radius:18px;
    overflow:hidden;
    padding:36px 40px;
    min-height:180px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    background:linear-gradient(150deg,#073D5F 30%,#057888 100%);
    margin-bottom:40px;
  }
  .sorotan-card img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.28;}
  .sorotan-card .inner{position:relative;z-index:1;max-width:640px;}
  .sorotan-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.14);color:#5FC0D1;font-size:11px;font-weight:800;letter-spacing:.1em;padding:6px 14px;border-radius:20px;}
  .sorotan-title{margin-top:14px;font-size:22px;font-weight:800;color:#fff;line-height:1.35;}
  .sorotan-desc{margin-top:10px;font-size:13.5px;color:rgba(255,255,255,.75);line-height:1.7;}

  .galeri-filters-wrap{position:relative;}
  .galeri-filters{position:relative;z-index:1;display:flex;flex-direction:column;gap:8px;padding:2px;}
  .galeri-filter{display:flex;align-items:center;justify-content:space-between;gap:6px;padding:10px 14px;border-radius:12px;border:1px solid #dfe4e7;background:var(--mist);font-size:13px;font-weight:700;color:#5b6b73;cursor:pointer;transition:transform .2s ease, box-shadow .2s ease, border-color .2s ease, color .2s ease;white-space:nowrap;}
  .galeri-filter:hover{border-color:var(--teal);color:var(--teal);box-shadow:0 10px 20px -12px rgba(20,128,140,.5);}
  .galeri-filter.active{background:var(--navy);border-color:var(--navy);color:var(--white);box-shadow:0 8px 20px -10px rgba(11,34,51,.5);}
  .galeri-filter.active:hover{box-shadow:0 12px 26px -10px rgba(11,34,51,.6);}
  .galeri-filter .count{opacity:.6;font-weight:600;}
  [data-theme="dark"] .galeri-filter{background:#20262c;}
  [data-theme="dark"] .galeri-filter:hover{border-color:#5FC0D1;color:#5FC0D1;box-shadow:0 10px 24px -10px rgba(95,192,209,.4);}

  @media (max-width:900px){
    .galeri-layout{display:block;}
    .galeri-sidebar{position:static;margin-bottom:24px;padding:14px;}
    .galeri-filters{flex-direction:row;flex-wrap:nowrap;overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:none;-ms-overflow-style:none;}
    .galeri-filters::-webkit-scrollbar{display:none;}
    .galeri-filter{flex-shrink:0;}
  }

  .galeri-grid{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:150px;gap:20px;}
  .galeri-card{position:relative;border-radius:14px;overflow:hidden;background:linear-gradient(160deg,var(--navy) 0%,var(--teal) 100%);transition:transform .3s ease, box-shadow .3s ease;}
  /* Susunan bento: kartu pertama besar (2x2), kartu ke-4 & ke-11 melebar (2x1) — pola berulang tiap 12 item (1 halaman) */
  .galeri-card:nth-child(1){grid-column:span 2;grid-row:span 2;}
  .galeri-card:nth-child(4){grid-column:span 2;}
  .galeri-card:nth-child(11){grid-column:span 2;}
  .galeri-card img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
  .galeri-card:hover{transform:translateY(-4px);box-shadow:0 20px 40px -18px rgba(11,34,51,.4);}
  .galeri-card .cat-badge{position:absolute;top:10px;left:10px;background:rgba(11,34,51,.65);color:#fff;font-size:9.5px;font-weight:800;letter-spacing:.06em;text-transform:uppercase;padding:5px 10px;border-radius:6px;z-index:1;}
  .galeri-card .overlay{position:absolute;inset:0;background:linear-gradient(0deg,rgba(11,34,51,.85) 0%,transparent 60%);display:flex;align-items:flex-end;padding:14px;}
  .galeri-card .overlay span{color:#fff;font-size:12.5px;font-weight:700;line-height:1.4;}
  .galeri-empty{grid-column:1/-1;text-align:center;padding:60px 20px;color:#8a97a0;font-size:14px;}

  .load-more{display:flex;justify-content:center;margin-top:44px;}
  .load-more a{padding:13px 30px;border-radius:22px;border:1px solid #dfe4e7;background:var(--white);color:var(--navy);font-size:13px;font-weight:700;transition:.2s ease;}
  .load-more a:hover{border-color:var(--teal);color:var(--teal);}

  @media (max-width:900px){
    .galeri-page{padding:40px 20px 60px;}
    .galeri-grid{grid-template-columns:repeat(2,1fr);grid-auto-rows:auto;gap:14px;}
    .galeri-card{aspect-ratio:4/3;}
    .galeri-card:nth-child(1),
    .galeri-card:nth-child(4),
    .galeri-card:nth-child(11){grid-column:auto;grid-row:auto;}
    .sorotan-card{padding:26px 24px;}
    .sorotan-title{font-size:18px;}
  }

  .footer-divider{height:3px;background:linear-gradient(10deg, #057888 0%, #052D46 55%, #052D46 100%);}
  .footer{position:relative;background:#052D46;padding:64px 100px 0;overflow:hidden;}
  .footer::before{
    content:"";position:absolute;inset:0;z-index:0;pointer-events:none;
    background-image:url('{{ asset('images/batik_footer.png') }}');
    background-repeat:no-repeat;background-position:center center;background-size:cover;
    opacity:.08;filter:brightness(0) invert(1);
  }
  .footer-inner{position:relative;z-index:1;max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr;gap:40px;padding-bottom:50px;}
  .footer-brand{display:flex;align-items:center;gap:12px;}
  .footer-brand-logo{width:190px;height:auto;object-fit:contain;}
  .footer-desc{margin-top:18px;color:rgba(255,255,255,.55);font-size:13px;line-height:1.75;max-width:260px;}
  .footer-social{margin-top:22px;display:flex;gap:10px;}
  .footer-social a{width:34px;height:34px;border-radius:8px;border:1px solid rgba(255,255,255,.14);color:rgba(255,255,255,.7);display:flex;align-items:center;justify-content:center;transition:.2s ease;}
  .footer-social a:hover{background:var(--teal);border-color:var(--teal);color:var(--white);}
  .footer-social svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
  .footer-col .head{color:rgba(255,255,255,.85);font-size:11.5px;font-weight:800;letter-spacing:.1em;padding-bottom:12px;border-bottom:2px solid var(--teal);display:inline-block;}
  .footer-links{margin-top:20px;display:flex;flex-direction:column;gap:14px;}
  .footer-links a{display:flex;align-items:center;gap:6px;color:rgba(255,255,255,.6);font-size:13.5px;font-weight:500;transition:.2s ease;width:max-content;}
  .footer-links a .chev{font-size:11px;color:var(--teal);}
  .footer-links a:hover{color:var(--white);gap:10px;}
  .footer-contact{margin-top:20px;display:flex;flex-direction:column;gap:16px;}
  .footer-contact .item{display:flex;align-items:flex-start;gap:10px;color:rgba(255,255,255,.65);font-size:13px;line-height:1.6;}
  .footer-contact .item svg{width:16px;height:16px;stroke:var(--teal);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0;margin-top:1px;}
  .footer-bottom{border-top:1px solid rgba(255,255,255,.1);padding:22px 0;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;}
  .footer-bottom p{color:rgba(255,255,255,.45);font-size:12.5px;font-weight:500;}

  @media (max-width:900px){
    .footer{padding:50px 20px 0;}
    .footer::before{
      background-size:180% auto;
    }
    .footer-inner{grid-template-columns:1fr 1fr;gap:36px;padding-bottom:40px;}
    .footer-brand-logo{width:150px;}
    .footer-bottom{flex-direction:column;text-align:center;padding:20px 0;}
  }
  @media (max-width:560px){.footer-inner{grid-template-columns:1fr;}}

  [data-theme="dark"] body{background-color:#0e1b23;background-image:none;color:#c3cdd2;}
  [data-theme="dark"] .navbar{background:rgba(11,23,32,.92);border-bottom-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .nav-links li a{color:#c3cdd2;}
  [data-theme="dark"] .lang-btn,[data-theme="dark"] .galeri-filter,[data-theme="dark"] .load-more a{background:#122530;border-color:rgba(255,255,255,.14);color:#c3cdd2;}
  [data-theme="dark"] .btn-login{background:#5FC0D1;color:#0b1720;}
  [data-theme="dark"] .stat-card{background:#122530; border-right-color:black;}
  [data-theme="dark"] .stats-bar-inner{background-color:var(--navy);border: 1px solid var(--navy);}
  [data-theme="dark"] .stat-num{color:#eaf3f5;}
  [data-theme="dark"] .galeri-empty{color:#6d8189;}
</style>
</head>
<body>

  <svg width="0" height="0" style="position:absolute;overflow:hidden" aria-hidden="true">
    <filter id="batikTintTeal">
      <feColorMatrix type="matrix" values="
        0 0 0 0 0.0784
        0 0 0 0 0.5137
        0 0 0 0 0.6118
        0 0 0 4.5 0"/>
    </filter>
    <filter id="batikBoostLight">
      <feColorMatrix type="saturate" values="2.2"/>
      <feComponentTransfer>
        <feFuncA type="linear" slope="2.6" intercept="0"/>
      </feComponentTransfer>
    </filter>
  </svg>

  {{-- ================= NAVBAR ================= --}}
  <nav class="navbar">
    <div class="brand">
      <img src="{{ asset('images/logo_pustekinfo_landscape.png') }}" alt="Logo Pustekinfo" class="navbar-logo">
    </div>

    <ul class="nav-links">
      <li><a href="{{ route('home') }}" data-en="Home">Beranda</a></li>
      <li><a href="{{ route('profil') }}" data-en="Profile">Profil </a></li>
      <li><a href="{{ route('layanan') }}" data-en="Services">Layanan</a></li>
      <li><a href="{{ route('informasi') }}" data-en="Information">Informasi</a></li>
      <li class="active"><a href="{{ route('galeri') }}" data-en="Gallery">Galeri</a></li>
      <li><a href="{{ route('kontak') }}" data-en="Contact">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <button class="theme-fab" id="themeToggle" aria-label="Ganti tema" aria-pressed="false">
        <span class="theme-fab-icon icon-moon">
          <svg viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </span>
        <span class="theme-fab-icon icon-sun">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        </span>
      </button>
      <button class="lang-btn" id="langToggle" aria-label="Ganti bahasa" aria-pressed="false">EN</button>
      <button class="burger" id="burgerBtn" aria-label="Buka menu"><span></span><span></span><span></span></button>
    </div>
  </nav>

  <header class="hero-profil" @if($pageBanner?->image) style="background-image:linear-gradient(160deg, rgba(7,61,95,.85) 0%, rgba(7,61,95,.7) 50%, rgba(20,131,156,.55) 100%), url('{{ asset('storage/'.$pageBanner->image) }}');background-size:cover;background-position:center;" @endif>
    <div class="hero-profil-inner">
      <p class="breadcrumb" data-en-html="Home / &lt;span&gt;Gallery&lt;/span&gt;">Beranda / <span>Galeri</span></p>
      <h1 data-en-html="Documentation of <span class=&quot;accent&quot;>Our Activities</span>">Dokumentasi <span class="accent">Kegiatan Kami</span></h1>
      <p data-en="A collection of moments from Pustekinfo's activities, training, and partnerships in supporting the institution's information technology services.">Kumpulan momen kegiatan, pelatihan, dan kerja sama Pustekinfo dalam mendukung layanan teknologi informasi lembaga.</p>
    </div>
  </header>

  <div class="stats-bar">
    <div class="stats-bar-inner">
      <div class="stat-card">
        <div>
          <div class="stat-num">{{ $totalFoto }}+</div>
          <div class="stat-label" data-en="Total Photos">Total Foto</div>
        </div>
      </div>
      <div class="stat-card">
        <div>
          <div class="stat-num">{{ $kegiatanTerdokumentasi }}</div>
          <div class="stat-label" data-en="Documented Activities">Kegiatan Terdokumentasi</div>
        </div>
      </div>
      <div class="stat-card">
        <div>
          <div class="stat-num">{{ $totalKategori }}</div>
          <div class="stat-label" data-en="Categories">Kategori</div>
        </div>
      </div>
      <div class="stat-card">
        <div>
          <div class="stat-num">{{ $rentangWaktu }}</div>
          <div class="stat-label" data-en="Time Range">Rentang Waktu</div>
        </div>
      </div>
    </div>
  </div>

  <main class="galeri-page">

    <div class="galeri-layout">
      <aside class="galeri-sidebar">
        <div class="galeri-sidebar-title" data-en="CATEGORIES">KATEGORI</div>
        <div class="galeri-filters-wrap">
          <div class="galeri-filters">
            <a href="{{ route('galeri') }}" class="galeri-filter {{ !$activeCategory ? 'active' : '' }}"><span data-en="All">Semua</span> <span class="count">{{ $totalFoto }}</span></a>
            @foreach($categories as $cat)
              <a href="{{ route('galeri', ['kategori' => $cat->slug]) }}" class="galeri-filter {{ $activeCategory == $cat->slug ? 'active' : '' }}">
                <span data-en="{{ $cat->name_en ?: $cat->name }}">{{ $cat->name }}</span> <span class="count">{{ $cat->items_count }}</span>
              </a>
            @endforeach
          </div>
        </div>
      </aside>

      <div class="galeri-main">
        @if($featured)
          <div class="sorotan-card">
            <img src="{{ asset('storage/'.$featured->image) }}" alt="{{ $featured->title }}">
            <div class="inner">
              <span class="sorotan-badge" data-en="HIGHLIGHT">SOROTAN</span>
              <div class="sorotan-title" data-en="{{ $featured->title_en ?: $featured->title }}">{{ $featured->title }}</div>
              @if($featured->description)
                <p class="sorotan-desc" data-en="{{ $featured->description_en ?: $featured->description }}">{{ $featured->description }}</p>
              @endif
            </div>
          </div>
        @endif

        <div class="galeri-grid">
          @forelse($items as $item)
            <div class="galeri-card">
              <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
              @if($item->category)
                <span class="cat-badge" data-en="{{ $item->category->name_en ?: $item->category->name }}">{{ $item->category->name }}</span>
              @endif
              @if($item->title)
                <div class="overlay"><span data-en="{{ $item->title_en ?: $item->title }}">{{ $item->title }}</span></div>
              @endif
            </div>
          @empty
            <div class="galeri-empty" data-en="No photos in this category yet.">Belum ada foto pada kategori ini.</div>
          @endforelse
        </div>

        @if($items->hasMorePages())
          <div class="load-more">
            <a href="{{ $items->nextPageUrl() }}" data-en="Load more">Muat lebih banyak</a>
          </div>
        @endif
      </div>
    </div>

  </main>

  <footer class="footer">
    <div class="footer-inner">
      <div class="footer-col">
        <div class="footer-brand">
          <img src="{{ asset('images/landscape_putih.png') }}" alt="Logo Pustekinfo" class="footer-brand-logo">
        </div>
        <p class="footer-desc" data-en="Serving work units and the public in information technology, networking, and data security.">Melayani unit kerja dan masyarakat dalam bidang teknologi informasi, jaringan, dan keamanan data.</p>
        <div class="footer-social">
          <a href="{{ $setting->instagram_url ?? '#' }}" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/></svg></a>
          <a href="{{ $setting->youtube_url ?? '#' }}" aria-label="YouTube"><svg viewBox="0 0 24 24"><path d="M22 8.5a4 4 0 0 0-2.8-2.8C17.4 5.2 12 5.2 12 5.2s-5.4 0-7.2.5A4 4 0 0 0 2 8.5 41 41 0 0 0 2 12a41 41 0 0 0 0 3.5 4 4 0 0 0 2.8 2.8c1.8.5 7.2.5 7.2.5s5.4 0 7.2-.5a4 4 0 0 0 2.8-2.8A41 41 0 0 0 22 12a41 41 0 0 0 0-3.5z"/><polygon points="10 9 15 12 10 15"/></svg></a>
          <a href="{{ $setting->x_url ?? '#' }}" aria-label="X"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></a>
        </div>
      </div>

      <div class="footer-col">
        <span class="head" data-en="LINKS">TAUTAN</span>
        <div class="footer-links">
          <a href="#"><span class="chev">›</span> <span data-en="Academic System">Sistem Akademik</span></a>
          <a href="#"><span class="chev">›</span> <span data-en="HR System">Sistem Kepegawaian</span></a>
          <a href="#"><span class="chev">›</span> <span data-en="Finance System">Sistem Keuangan</span></a>
          <a href="#"><span class="chev">›</span> PPID</a>
        </div>
      </div>

      <div class="footer-col">
        <span class="head" data-en="HELP">BANTUAN</span>
        <div class="footer-links">
          <a href="#"><span class="chev">›</span> Helpdesk</a>
          <a href="#"><span class="chev">›</span> <span data-en="Complaints">Pengaduan</span></a>
          <a href="#"><span class="chev">›</span> FAQ</a>
          <a href="#"><span class="chev">›</span> Whistleblowing</a>
        </div>
      </div>

      <div class="footer-col">
        <span class="head" data-en="CONTACT">KONTAK</span>
        <div class="footer-contact">
          <div class="item"><svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg><span data-en="{{ $setting->address_en ?: ($setting->address ?? 'Address not set') }}">{{ $setting->address ?? 'Alamat belum diatur' }}</span></div>
          <div class="item"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>{{ $setting->phone ?? '-' }}</div>
          <div class="item"><svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg>{{ $setting->email ?? '-' }}</div>
        </div>
      </div>
    </div>

    <div class="footer-inner footer-bottom">
      <p data-en="© 2026 Pustekinfo. All rights reserved.">© 2026 Pustekinfo. Seluruh hak dilindungi.</p>
      <p data-en="Mockup reference — not an official site">Referensi mockup — bukan situs resmi</p>
    </div>
  </footer>

<script>

  if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
  }

  const burgerBtn = document.getElementById("burgerBtn");
  const navLinks = document.querySelector(".nav-links");
  burgerBtn.addEventListener("click", () => {
    burgerBtn.classList.toggle("open");
    navLinks.classList.toggle("open");
  });

  const themeToggle = document.getElementById("themeToggle");
  function applyTheme(isDark) {
    document.documentElement.setAttribute("data-theme", isDark ? "dark" : "light");
    themeToggle.setAttribute("aria-pressed", String(isDark));
  }
  applyTheme(document.documentElement.getAttribute("data-theme") === "dark");
  themeToggle.addEventListener("click", () => {
    const isDark = document.documentElement.getAttribute("data-theme") !== "dark";
    localStorage.setItem("theme", isDark ? "dark" : "light");
    applyTheme(isDark);
    themeToggle.classList.add("pulse");
    setTimeout(() => themeToggle.classList.remove("pulse"), 450);
  });

  // ---- Ganti bahasa (ID/EN) ----
  const langToggle = document.getElementById("langToggle");

  function applyLang(lang) {
    document.documentElement.setAttribute("lang", lang);
    document.querySelectorAll("[data-en]").forEach((el) => {
      if (el.dataset.idText === undefined) el.dataset.idText = el.textContent;
      el.textContent = lang === "en" ? el.dataset.en : el.dataset.idText;
    });
    document.querySelectorAll("[data-en-html]").forEach((el) => {
      if (el.dataset.idHtml === undefined) el.dataset.idHtml = el.innerHTML;
      el.innerHTML = lang === "en" ? el.dataset.enHtml : el.dataset.idHtml;
    });
    document.querySelectorAll("[data-en-placeholder]").forEach((el) => {
      if (el.dataset.idPlaceholder === undefined) el.dataset.idPlaceholder = el.placeholder;
      el.placeholder = lang === "en" ? el.dataset.enPlaceholder : el.dataset.idPlaceholder;
    });
    if (langToggle) {
      langToggle.textContent = lang === "en" ? "ID" : "EN";
      langToggle.setAttribute("aria-pressed", String(lang === "en"));
    }
  }

  applyLang(localStorage.getItem("lang") || "id");

  if (langToggle) {
    langToggle.addEventListener("click", () => {
      const next = document.documentElement.getAttribute("lang") === "en" ? "id" : "en";
      localStorage.setItem("lang", next);
      applyLang(next);
    });
  }

  const profilDropdown = document.getElementById("profilDropdown");
  if (window.innerWidth <= 900) {
    profilDropdown.querySelector("a").addEventListener("click", (e) => {
      e.preventDefault();
      profilDropdown.classList.toggle("open");
    });
  }
</script>

@include('partials.interactive-cursor')
</body>
</html>