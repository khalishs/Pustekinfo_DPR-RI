{{-- resources/views/berita-detail.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $news->title }} - Pustekinfo | Pusat Teknologi Informasi DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('images/favicon-bg.png') }}">
<style>
  :root{
    --navy:#12242E;
    --teal:#14839C;
    --ink:#0b2233;
    --white:#ffffff;
    --mist:#eef4f6;
    --line:rgba(255,255,255,.18);
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
  @view-transition{
    navigation:auto;
  }
  a{text-decoration:none;color:inherit;}
  ul{list-style:none;}
  img{max-width:100%;display:block;}

  h1, h2, h3, h4 {
    font-family:'Plus Jakarta Sans', system-ui, sans-serif;
  }

  /* ================= NAVBAR (sama seperti halaman lain) ================= */
  .navbar{
    display:flex;align-items:center;justify-content:space-between;
    padding:10px 48px;
    background:rgba(255,255,255,.95);
    backdrop-filter:blur(12px);
    border-bottom:1px solid #eaeaea;
    position:fixed;top:0;left:0;width:100%;z-index:9999;
  }
  .navbar-logo{height:50px;width:auto;object-fit:contain; transform:scale(4.9); /* 1.2 - 1.8 sesuaikan */
    transform-origin:left center;}
  .navbar{display:flex;align-items:center;justify-content:space-between;padding:10px 48px;background:rgba(255,255,255,.95);backdrop-filter:blur(12px);border-bottom:1px solid #eaeaea;position:fixed;top:0;left:0;width:100%;z-index:9999;}
  .brand{display:flex;align-items:center;gap:12px;}
  .brand-logo{width:50px;height:50px;object-fit:contain;}
  .nav-links{display:flex;align-items:center;gap:34px;}
  .nav-links li a{font-family: 'Plus Jakarta Sans', system-ui, sans-serif;font-size:14.5px;font-weight:600;color:#3c4a52;display:flex;align-items:center;gap:4px;}
  .nav-links li.active a{color:var(--teal);}
  .nav-links li.active{position:relative;}
  .nav-links li.active::after{content:"";position:absolute;left:0;right:0;bottom:-18px;height:2px;background:var(--teal);view-transition-name:nav-underline;}
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

  .lang-btn{padding:8px 16px;border-radius:20px;border:1px solid #dfe4e7;font-size:13px;font-weight:700;color:#5b6b73;background:var(--white);cursor:pointer;}
  .btn-login{padding:10px 22px;border-radius:20px;border:none;background:var(--navy);color:var(--white);font-size:14px;font-weight:700;cursor:pointer;}
  .burger{display:none;flex-direction:column;justify-content:center;gap:5px;width:36px;height:36px;border-radius:50%;border:1px solid #dfe4e7;background:var(--white);cursor:pointer;align-items:center;}
  .burger span{width:16px;height:2px;background:#3c4a52;border-radius:2px;transition:.25s ease;}
  .burger.open span:nth-child(1){transform:translateY(7px) rotate(45deg);}
  .burger.open span:nth-child(2){opacity:0;}
  .burger.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg);}
  @media (max-width:900px){
    .navbar{padding:10px 16px;gap:8px;}
    .nav-links{display:none;}
    .brand{gap:8px;min-width:0;}
    .brand-logo{width:36px;height:36px;flex-shrink:0;}
    .navbar-logo{height:32px;width:auto;flex-shrink:0;}
    .nav-actions{gap:6px;flex-shrink:0;}
    .lang-btn{padding:6px 12px;font-size:11.5px;}
    .btn-login{padding:8px 14px;font-size:12.5px;white-space:nowrap;}
    .burger{display:flex;}
    .nav-links{display:flex;position:fixed;top:62px;left:0;right:0;flex-direction:column;gap:0;background:var(--white);border-bottom:1px solid #eaeaea;box-shadow:0 20px 30px -20px rgba(11,34,51,.25);padding:8px 20px 16px;z-index:9998;opacity:0;visibility:hidden;transform:translateY(-10px);pointer-events:none;transition:opacity .25s ease, transform .25s ease, visibility .25s ease;}
    .nav-links.open{opacity:1;visibility:visible;transform:translateY(0);pointer-events:auto;}
    .nav-links li{width:100%;}
    .nav-links li a{padding:14px 4px;width:100%;justify-content:space-between;border-bottom:1px solid #f1f4f5;}
    .nav-links li.active::after{display:none;}
  }

  /* ================= HERO (breadcrumb, pola sama seperti halaman lain) ================= */
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
  .hero-profil-inner{position:relative;z-index:2;max-width:820px;margin:0 auto;text-align:center;}
  .breadcrumb{color:rgba(255,255,255,.55);font-size:13px;font-weight:600;margin-bottom:18px;}
  .breadcrumb span{color:var(--teal);}
  .hero-profil h1{
    color:var(--white);font-size:32px;font-weight:800;line-height:1.32;letter-spacing:-.01em;
  }
  .article-badge{
    display:inline-block;margin-bottom:16px;
    background:rgba(255,255,255,.14);color:var(--white);
    font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;
    padding:6px 14px;border-radius:20px;
  }
  .article-meta{
    margin-top:22px;display:flex;justify-content:center;gap:22px;flex-wrap:wrap;
    color:rgba(255,255,255,.65);font-size:13px;font-weight:600;
  }
  .article-meta span{display:flex;align-items:center;gap:6px;}
  .article-meta svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:1.8;flex-shrink:0;}

  /* ================= ARTIKEL ================= */
  .article-wrap{max-width:760px; margin-top:70px; margin-bottom: 70px; margin-left:420px; padding:56px 24px 90px; background-color: rgba(255, 255, 255, 0.7); border-radius: 10px;}
  .article-image{width:100%;height:380px;object-fit:cover;border-radius:16px;margin-bottom:40px;box-shadow:0 30px 60px -30px rgba(11,34,51,.3);}
  .article-body{color:#354049;font-size:16px;line-height:1.9;font-weight:400;white-space:pre-line;}
  .article-body p{margin-bottom:18px;}
  .article-back{
    display:inline-flex;align-items:center;gap:8px;margin-bottom:28px;
    color:var(--teal);font-size:13.5px;font-weight:700;
  }
  .article-back svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;}

  /* ================= FOOTER ================= */
  .footer-divider{height:3px;background:linear-gradient(10deg, #057888 0%, #052D46 55%, #052D46 100%);}
  .footer{position:relative;background:#052D46;padding:64px 100px 0;overflow:hidden;}
  /* Motif batik dekoratif di ujung kiri footer — sama seperti beranda */
  .footer::before{
    content:"";position:absolute;inset:-40px 0 -80px;
    background-repeat:no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat;
    background-image:url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}');
    background-position:left -100px bottom -30px,right -80px top -40px,30% 68%,35% 15%,55% 82%,75% 20%,90% 75%;
    background-size:480px auto,320px auto,150px auto,130px auto,170px auto,140px auto,220px auto;
    filter:brightness(0) invert(1);opacity:.35;pointer-events:none;z-index:0;
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
  .footer-links a:hover{color:var(--white);}
  .footer-contact{margin-top:20px;display:flex;flex-direction:column;gap:16px;}
  .footer-contact .item{display:flex;align-items:flex-start;gap:10px;color:rgba(255,255,255,.65);font-size:13px;line-height:1.6;}
  .footer-contact .item svg{width:16px;height:16px;stroke:var(--teal);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0;margin-top:1px;}
  .footer-bottom{border-top:1px solid rgba(255,255,255,.1);padding:22px 0;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;}
  .footer-bottom p{color:rgba(255,255,255,.45);font-size:12.5px;font-weight:500;}
  @media (max-width:900px){
    .footer{padding:50px 20px 0;}
    .footer::before{
      background-size:170px auto,140px auto,65px auto,55px auto,70px auto,60px auto,90px auto;
      background-position:left -40px bottom -10px,right -40px top -20px,38% 68%,35% 15%,55% 82%,75% 20%,90% 75%;
      opacity:.25;
    }
    .footer-inner{grid-template-columns:1fr 1fr;gap:36px;padding-bottom:40px;}
    .footer-brand-logo{width:150px;}
    .footer-bottom{flex-direction:column;text-align:center;padding:20px 0;}
    .article-image{height:220px;}
  }
  @media (max-width:560px){.footer-inner{grid-template-columns:1fr;}}

  /* ---------- Dark mode ---------- */
  [data-theme="dark"] html{background:#0b1720;}
  [data-theme="dark"] body{background-color:#0e1b23;background-image:none;color:#c3cdd2;}

  [data-theme="dark"] .navbar{background:rgba(11,23,32,.92);border-bottom-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .nav-links li a{color:#c3cdd2;}
  [data-theme="dark"] .nav-links li a:hover{color:#5FC0D1;}
  [data-theme="dark"] .nav-links li.active a{color:#5FC0D1;}
  [data-theme="dark"] .nav-links li.active::after{background:#5FC0D1;}
  [data-theme="dark"] .nav-dropdown{background:#122530;border-color:rgba(255,255,255,.1);box-shadow:0 24px 50px -20px rgba(0,0,0,.6);}
  [data-theme="dark"] .nav-dropdown a{color:#b7c2c7;}
  [data-theme="dark"] .nav-dropdown a:hover{background:rgba(255,255,255,.06);color:#eaf3f5;}

  [data-theme="dark"] .lang-btn,
  [data-theme="dark"] .profile-box,
  [data-theme="dark"] .logout-btn,
  [data-theme="dark"] .dl-btn,
  [data-theme="dark"] .galeri-filter,
  [data-theme="dark"] .agenda-cal-nav button{
    background:#122530;border-color:rgba(255,255,255,.14);color:#c3cdd2;
  }
  [data-theme="dark"] .lang-btn:hover{background:rgba(255,255,255,.08);border-color:#5FC0D1;color:#5FC0D1;}
  [data-theme="dark"] .btn-login{background:#5FC0D1;color:#0b1720;}
  [data-theme="dark"] .btn-login:hover{background:#7fd3e0;}
  [data-theme="dark"] .profile-name{color:#eaf3f5;}
  [data-theme="dark"] .logout-btn{color:#ff8f8a;border-color:rgba(255,143,138,.35);}
  [data-theme="dark"] .logout-btn:hover{background:#b0413e;color:#fff;border-color:#b0413e;}

  @media (max-width:900px){
    [data-theme="dark"] .nav-links{background:#0f1e28;border-bottom-color:rgba(255,255,255,.08);}
    [data-theme="dark"] .nav-links li a{border-bottom-color:rgba(255,255,255,.06);}
  }

  /* ---------- Dark mode: page-specific ---------- */
  [data-theme="dark"] .hero-profil{background:#08131b;}
  [data-theme="dark"] .hero-profil::before{background:radial-gradient(60% 60% at 85% 0%, rgba(95,192,209,.18), transparent 60%);}
  [data-theme="dark"] .breadcrumb{color:rgba(255,255,255,.45);}
  [data-theme="dark"] .breadcrumb a{color:#8ea0a8;}
  [data-theme="dark"] .breadcrumb span{color:#5FC0D1;}
  [data-theme="dark"] .hero-profil h1{color:#eaf3f5;}
  [data-theme="dark"] .article-badge{background:rgba(255,255,255,.08);color:#eaf3f5;}
  [data-theme="dark"] .article-meta{color:#8ea0a8;}

  [data-theme="dark"] .article-back{color:#5FC0D1;}
  [data-theme="dark"] .article-image{box-shadow:0 30px 60px -30px rgba(0,0,0,.6);}
  [data-theme="dark"] .article-body{color:#c3cdd2;}

  [data-theme="dark"] .footer-desc{color:rgba(255,255,255,.5);}
  [data-theme="dark"] .footer-social a{border-color:rgba(255,255,255,.14);color:rgba(255,255,255,.65);}
  [data-theme="dark"] .footer-social a:hover{background:#5FC0D1;border-color:#5FC0D1;color:#0b1720;}
  [data-theme="dark"] .footer-col .head{color:rgba(255,255,255,.8);border-bottom-color:#5FC0D1;}
  [data-theme="dark"] .footer-links a{color:rgba(255,255,255,.55);}
  [data-theme="dark"] .footer-links a .chev{color:#5FC0D1;}
  [data-theme="dark"] .footer-links a:hover{color:#eaf3f5;}
  [data-theme="dark"] .footer-contact .item{color:rgba(255,255,255,.6);}
  [data-theme="dark"] .footer-contact .item svg{stroke:#5FC0D1;}
  [data-theme="dark"] .footer-bottom{border-top-color:rgba(255,255,255,.1);}
  [data-theme="dark"] .footer-bottom p{color:rgba(255,255,255,.4);}
</style>
<script>
  if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
  }
</script>
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
      <feColorMatrix type="matrix" values="
        0 0 0 0 0.0784
        0 0 0 0 0.5137
        0 0 0 0 0.6118
        0 0 0 2.6 0"/>
    </filter>
  </svg>

  {{-- ================= NAVBAR ================= --}}
  <nav class="navbar">
    <div class="brand">
      <img src="{{ asset('images/logo_pustekinfo_landscape.png') }}" alt="Logo Pustekinfo" class="navbar-logo">
    </div>

    <ul class="nav-links">
      <li><a href="{{ route('home') }}" data-en="Home">Beranda</a></li>
      <li><a href="{{ route('profil') }}" data-en="Profile">Profil</a></li>
      <li><a href="{{ route('layanan') }}" data-en="Services">Layanan</a></li>
      <li class="active"><a href="{{ route('informasi') }}" data-en="Information">Informasi</a></li>
      <li><a href="{{ route('galeri') }}" data-en="Gallery">Galeri</a></li>
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
      <button class="burger" id="burgerBtn" aria-label="Buka menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  {{-- ================= HERO ================= --}}
  <header class="hero-profil">
    <div class="hero-profil-inner">
      <p class="breadcrumb"><a href="{{ route('home') }}" data-en="Home">Beranda</a> / <a href="{{ route('informasi') }}" data-en="Information">Informasi</a> / <span data-en="News">Berita</span></p>
      <span class="article-badge" data-en="{{ $news->category_en ?: $news->category }}">{{ $news->category }}</span>
      <h1 data-en="{{ $news->title_en ?: $news->title }}">{{ $news->title }}</h1>
      <div class="article-meta">
        <span><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> {{ $news->published_at?->format('d M Y') }}</span>
        @if($news->author)
          <span><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> {{ $news->author }}</span>
        @endif
        @if($news->reading_minutes)
          <span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> {{ $news->reading_minutes }} <span data-en="min read">menit baca</span></span>
        @endif
      </div>
    </div>
  </header>

  {{-- ================= ARTIKEL ================= --}}
  <div class="article-wrap">
    <a href="{{ route('informasi') }}" class="article-back">
      <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
      <span data-en="Back to Information">Kembali ke Informasi</span>
    </a>

    @if($news->image)
      <img src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->title }}" class="article-image">
    @endif

    <div class="article-body" data-en="{{ ($news->content_en ?: $news->excerpt_en) ?: ($news->content ?: $news->excerpt) }}">{{ $news->content ?: $news->excerpt }}</div>
  </div>

  <div class="footer-divider"></div>

  {{-- ================= FOOTER ================= --}}
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
          <a href="{{ route('profil') }}"><span class="chev">›</span> <span data-en="Profile">Profil</span></a>
          <a href="{{ route('layanan') }}"><span class="chev">›</span> <span data-en="Services">Layanan</span></a>
          <a href="{{ route('informasi') }}"><span class="chev">›</span> <span data-en="Information">Informasi</span></a>
          <a href="{{ route('galeri') }}"><span class="chev">›</span> <span data-en="Gallery">Galeri</span></a>
        </div>
      </div>

      <div class="footer-col">
        <span class="head" data-en="HELP">BANTUAN</span>
        <div class="footer-links">
          <a href="{{ route('kontak') }}"><span class="chev">›</span> <span data-en="Contact">Kontak</span></a>
        </div>
      </div>

      <div class="footer-col">
        <span class="head" data-en="CONTACT">KONTAK</span>
        <div class="footer-contact">
          <div class="item">
            <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span data-en="{{ $setting->address_en ?: ($setting->address ?? 'Address not set') }}">{{ $setting->address ?? 'Alamat belum diatur' }}</span>
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
      <p data-en="© {{ date('Y') }} Pustekinfo. All rights reserved.">© {{ date('Y') }} Pustekinfo. Seluruh hak dilindungi.</p>
      <p data-en="Mockup reference — not an official site">Referensi mockup — bukan situs resmi</p>
    </div>
  </footer>

<script>
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
</script>

@include('partials.interactive-cursor')
</body>
</html>
