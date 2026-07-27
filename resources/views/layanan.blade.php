{{-- resources/views/layanan.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Layanan - Pustekinfo | Pusat Teknologi Informasi DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
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
    background:var(--white);
  }
  a{text-decoration:none;color:inherit;}
  ul{list-style:none;}
  img{max-width:100%;display:block;}

  h1, h2, h3, h4,
  .brand-text .name,
  .footer-brand-text .name,
  .section-inner > h2,
  .svc-feature,
  .svc-cta {
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
  .brand{display:flex;align-items:center;gap:12px;}
  .brand-logo{width:50px;height:50px;object-fit:contain;}
  .brand-text .name{font-weight:800;font-size:23px;color:#073D5F;line-height:1.1;}
  .brand-text .sub{font-size:9.5px;letter-spacing:.08em;color:#0F6B7F;font-weight:600;}
  .nav-links{display:flex;align-items:center;gap:34px;}
  .nav-links li a{font-family: 'Plus Jakarta Sans', system-ui, sans-serif;font-size:14.5px;font-weight:600;color:#3c4a52;display:flex;align-items:center;gap:4px;}
  .nav-links li.active a{color:var(--teal);}
  .nav-links li.active{position:relative;}
  .nav-links li.active::after{content:"";position:absolute;left:0;right:0;bottom:-18px;height:2px;background:var(--teal);}

  .nav-item-dropdown{position:relative;}
  .nav-dropdown{
    position:absolute;top:calc(100% + 22px);left:50%;
    transform:translateX(-50%) translateY(8px);
    min-width:220px;background:var(--white);
    border:1px solid #e7dcc6;border-radius:12px;padding:10px;
    box-shadow:0 24px 50px -20px rgba(11,34,51,.25);
    opacity:0;visibility:hidden;
    transition:opacity .2s ease, transform .2s ease, visibility .2s ease;
    z-index:20;
  }
  .nav-item-dropdown:hover .nav-dropdown{opacity:1;visibility:visible;transform:translateX(-50%) translateY(0);}
  .nav-dropdown a{display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:8px;font-size:14px;font-weight:600;color:#5b6b73;transition:.15s ease;}
  .nav-dropdown a:hover{background:var(--mist);color:var(--navy);}
  @media (max-width:900px){
    .nav-dropdown{position:static;transform:none;opacity:1;visibility:visible;display:none;box-shadow:none;border:none;padding:0 0 0 14px;margin-top:4px;}
    .nav-item-dropdown.open .nav-dropdown{display:block;}
    .nav-dropdown a{padding:10px 4px;border-bottom:1px solid #f1f4f5;border-radius:0;}
  }
  .caret{font-size:10px;opacity:.6;}
  .nav-actions{display:flex;align-items:center;gap:12px;}
  .icon-btn{width:36px;height:36px;border-radius:50%;border:1px solid #dfe4e7;display:flex;align-items:center;justify-content:center;font-size:14px;color:#5b6b73;background:var(--white);cursor:pointer;}
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
    .brand-text{min-width:0;}
    .nav-actions{gap:6px;flex-shrink:0;}
    .icon-btn{width:30px;height:30px;font-size:12px;}
    .lang-btn{padding:6px 12px;font-size:11.5px;}
    .btn-login{padding:8px 14px;font-size:12.5px;white-space:nowrap;}
    .burger{display:flex;}
    .nav-links{display:none;position:fixed;top:62px;left:0;right:0;flex-direction:column;gap:0;background:var(--white);border-bottom:1px solid #eaeaea;box-shadow:0 20px 30px -20px rgba(11,34,51,.25);padding:8px 20px 16px;z-index:9998;}
    .nav-links.open{display:flex;}
    .nav-links li{width:100%;}
    .nav-links li a{padding:14px 4px;width:100%;justify-content:space-between;border-bottom:1px solid #f1f4f5;}
    .nav-links li.active::after{display:none;}
  }

  /* ================= HERO LAYANAN (sama pola seperti hero profil) ================= */
  .hero-profil{
    margin-top:70px;
    position:relative;
    background:#073D5F;
    padding:90px 24px 0;
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

  /* ================= STICKY TABS (SCROLLSPY) ================= */
  .tabs-nav{position:relative;z-index:5;margin-top:46px;}
  .tabs-scroll{
    display:flex;gap:0;max-width:1240px;margin:0 auto;padding:0 24px;
    overflow-x:auto;scrollbar-width:none;
    border-bottom:1px solid rgba(255,255,255,.14);
  }
  .tabs-scroll::-webkit-scrollbar{display:none;}
  .tab-link{
    display:flex;align-items:center;gap:7px;
    white-space:nowrap;padding:18px 6px;margin-right:36px;
    color:rgba(255,255,255,.55);font-weight:700;font-size:13.5px;
    position:relative;transition:color .2s ease;flex-shrink:0;
  }
  .tab-link .tab-icon{width:15px;height:15px;flex-shrink:0;}
  .tab-link .tab-icon svg{width:100%;height:100%;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
  .tab-link::after{
    content:"";position:absolute;left:0;right:0;bottom:-1px;height:2px;
    background:var(--teal);border-radius:2px 2px 0 0;
    transform:scaleX(0);transform-origin:left;transition:transform .25s ease;
  }
  .tab-link.active{color:var(--white);}
  .tab-link.active::after{transform:scaleX(1);}

  .tabs-nav-sticky{
    position:fixed;top:-70px;left:0;width:100%;z-index:9998;
    background:var(--navy);
    border-bottom:1px solid rgba(255,255,255,.1);
    box-shadow:0 12px 24px -18px rgba(11,34,51,.5);
    transition:.35s ease;
  }
  .tabs-nav-sticky.show{top:70px;}
  .tabs-nav-sticky .tabs-scroll{border-bottom:none;}

  /* ================= GENERIC SECTION ================= */
  .eyebrow{
    display:flex;align-items:center;gap:10px;
    font-family: 'Work Sans', system-ui, sans-serif;
    color:var(--teal);font-size:12px;font-weight:700;letter-spacing:.12em;
  }
  .eyebrow.eyebrow-dash::before{content:"";width:22px;height:2px;background:var(--teal);display:inline-block;flex-shrink:0;}

  section.page-section{
    padding:80px 100px;
    scroll-margin-top:150px;
    opacity:0;transform:translateY(50px);
    transition:opacity .8s ease, transform .8s ease;
  }
  section.page-section.show{opacity:1;transform:translateY(0);}
  section.page-section:nth-child(even){background:var(--mist);}
  .section-inner{max-width:1240px;margin:0 auto;}
  .section-inner > h2{
    margin-top:14px;font-size:30px;font-weight:800;color:var(--navy);
    letter-spacing:-.01em;max-width:640px;
  }

  @media (max-width:900px){
    section.page-section{padding:60px 20px;}
    .tabs-nav-sticky.show{top:56px;}
    .tabs-scroll{overflow-x:auto;}
  }

  /* ================= KARTU LAYANAN ================= */
  .svc-grid{display:grid;grid-template-columns:38% 1fr;gap:40px;margin-top:40px;align-items:stretch;}
  .svc-icon-box{
    border-radius:1px 16px 1px 16px;
    background:radial-gradient(120% 120% at 20% 15%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
    display:flex;align-items:center;justify-content:center;
    min-height:280px;
    box-shadow:0 30px 60px -30px rgba(11,34,51,.4);
  }
  .svc-icon-box svg{width:76px;height:76px;stroke:rgba(255,255,255,.85);fill:none;stroke-width:1.3;stroke-linecap:round;stroke-linejoin:round;}

  .svc-content{display:flex;flex-direction:column;justify-content:center;}
  .svc-content > .desc{color:#5b6b73;font-size:14px;line-height:1.75;}

  .svc-features{margin-top:22px;display:grid;grid-template-columns:1fr 1fr;gap:12px;}
  .svc-feature{
    display:flex;align-items:center;gap:10px;
    padding:13px 16px;border-radius:10px;
    border:1px solid #e7ecee;background:var(--white);
    font-size:13px;font-weight:700;color:var(--navy);
  }
  .svc-feature-icon{
    width:22px;height:22px;border-radius:50%;flex-shrink:0;
    background:rgba(20,128,140,.1);color:var(--teal);
    display:flex;align-items:center;justify-content:center;
  }
  .svc-feature-icon svg{width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2.6;stroke-linecap:round;stroke-linejoin:round;}

  .svc-cta{
    margin-top:18px;display:flex;align-items:center;gap:10px;
    padding:14px 18px;border-radius:12px;
    background:rgba(20,128,140,.08);border:1px solid rgba(20,128,140,.16);
    color:var(--teal);font-size:13.5px;font-weight:700;
  }
  .svc-cta svg{width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0;}

  @media (max-width:900px){
    .svc-grid{grid-template-columns:1fr;gap:24px;}
    .svc-icon-box{min-height:180px;}
    .svc-icon-box svg{width:56px;height:56px;}
  }
  @media (max-width:560px){
    .svc-features{grid-template-columns:1fr;}
  }

  /* ================= FOOTER (sama seperti halaman lain) ================= */
  .footer-divider{height:3px;background:linear-gradient(10deg, #057888 0%, #0b2233 55%, #0b2233 100%);}
  .footer{background:var(--navy);padding:64px 100px 0;}
  .footer-inner{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr;gap:40px;padding-bottom:50px;}
  .footer-brand{display:flex;align-items:center;gap:12px;}
  .footer-brand-logo{width:50px;height:50px;object-fit:contain;}
  .footer-brand-text .name{font-family: 'Plus Jakarta Sans', system-ui, sans-serif;font-weight:800;font-size:23px;color:var(--white);line-height:1.1;}
  .footer-brand-text .sub{font-family: 'Plus Jakarta Sans', system-ui, sans-serif;font-size:10px;letter-spacing:.08em;color:var(--white);font-weight:600;}
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
    .footer-inner{grid-template-columns:1fr 1fr;gap:36px;padding-bottom:40px;}
    .footer-bottom{flex-direction:column;text-align:center;padding:20px 0;}
  }
  @media (max-width:560px){.footer-inner{grid-template-columns:1fr;}}
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
          <a href="{{ route('profil') }}#tentang-kami">
            <span class="dd-icon"><svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></span>
            Tentang Kami
          </a>
          <a href="{{ route('profil') }}#profil-pimpinan">
            <span class="dd-icon"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
            Profil Pimpinan
          </a>
          <a href="{{ route('profil') }}#struktur-organisasi">
            <span class="dd-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><path d="M5 17v-2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><circle cx="12" cy="19" r="2"/></svg></span>
            Struktur Organisasi
          </a>
          <a href="{{ route('profil') }}#visi-misi">
            <span class="dd-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/></svg></span>
            Visi dan Misi
          </a>
        </div>
      </li>
      <li class="active"><a href="{{ route('layanan') }}">Layanan</a></li>
      <li><a href="{{ route('informasi') }}">Informasi</a></li>
      <li><a href="{{ route('galeri') }}">Galeri</a></li>
      <li><a href="{{ route('kontak') }}">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <button class="icon-btn" aria-label="Ganti tema">◐</button>
      <button class="lang-btn">EN</button>
      <button class="btn-login"><a href="{{ route('login') }}">Masuk</a></button>
      <button class="burger" id="burgerBtn" aria-label="Buka menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  {{-- ================= HERO ================= --}}
  <header class="hero-profil">
    <div class="hero-profil-inner">
      <p class="breadcrumb">Beranda / <span>Layanan</span></p>
      <h1>Layanan <span class="accent">Teknologi Informasi</span></h1>
      <p>Enam pilar layanan teknologi informasi yang menopang operasional digital lembaga setiap saat.</p>
    </div>

    <div class="tabs-nav">
      <div class="tabs-scroll">
        @foreach($services as $i => $s)
          <a href="#{{ $s['id'] }}" class="tab-link {{ $i === 0 ? 'active' : '' }}" data-target="{{ $s['id'] }}">
            <span class="tab-icon"><svg viewBox="0 0 24 24">{!! $s['icon'] !!}</svg></span>
            {{ $s['title'] }}
          </a>
        @endforeach
      </div>
    </div>
  </header>

  <div class="tabs-nav-sticky" id="tabsSticky">
    <div class="tabs-scroll">
      @foreach($services as $i => $s)
        <a href="#{{ $s['id'] }}" class="tab-link {{ $i === 0 ? 'active' : '' }}" data-target="{{ $s['id'] }}">
          <span class="tab-icon"><svg viewBox="0 0 24 24">{!! $s['icon'] !!}</svg></span>
          {{ $s['title'] }}
        </a>
      @endforeach
    </div>
  </div>

  {{-- ================= PILAR LAYANAN ================= --}}
  @foreach($services as $s)
    <section id="{{ $s['id'] }}" class="page-section">
      <div class="section-inner">
        <div class="eyebrow eyebrow-dash">LAYANAN TEKNOLOGI INFORMASI</div>
        <h2>{{ $s['title'] }}</h2>

        <div class="svc-grid">
          <div class="svc-icon-box">
            <svg viewBox="0 0 24 24">{!! $s['icon'] !!}</svg>
          </div>
          <div class="svc-content">
            <p class="desc">{{ $s['desc'] }}</p>

            <div class="svc-features">
              @foreach($s['features'] as $f)
                <div class="svc-feature">
                  <span class="svc-feature-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></span>
                  {{ $f }}
                </div>
              @endforeach
            </div>

            <div class="svc-cta">
              <svg viewBox="0 0 24 24"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
              {{ $s['cta'] }}
            </div>
          </div>
        </div>
      </div>
    </section>
  @endforeach

  <div class="footer-divider"></div>

  {{-- ================= FOOTER ================= --}}
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
          <a href="#"><span class="chev">›</span> Sistem Akademik</a>
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
      <p>© {{ date('Y') }} Pustekinfo. Seluruh hak dilindungi.</p>
      <p>Referensi mockup — bukan situs resmi</p>
    </div>
  </footer>

<script>
  // ---- Dropdown Profil di mobile ----
  const profilDropdown = document.getElementById("profilDropdown");
  if (window.innerWidth <= 900) {
    profilDropdown.querySelector("a").addEventListener("click", (e) => {
      e.preventDefault();
      profilDropdown.classList.toggle("open");
    });
  }

  // ---- Burger menu ----
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

  document.addEventListener('DOMContentLoaded', () => {

    // ---- Reveal animasi tiap section ----
    const sections = document.querySelectorAll('section.page-section');
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    sections.forEach(sec => revealObserver.observe(sec));

    // ---- Scrollspy: sinkronkan tab hero + sticky ----
    const allTabTriggers = document.querySelectorAll('.tab-link');
    const setActiveTab = (id) => {
      allTabTriggers.forEach(link => link.classList.toggle('active', link.dataset.target === id));
    };
    const spyObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => { if (entry.isIntersecting) setActiveTab(entry.target.id); });
    }, { root: null, rootMargin: '-30% 0px -60% 0px', threshold: 0 });
    sections.forEach(sec => spyObserver.observe(sec));

    // ---- Munculkan tab sticky setelah melewati hero ----
    const heroProfil = document.querySelector(".hero-profil");
    const tabsSticky = document.getElementById("tabsSticky");

    window.addEventListener("scroll", () => {
      const heroBottom = heroProfil.offsetTop + heroProfil.offsetHeight;
      if (window.scrollY > heroBottom - 70) {
        tabsSticky.classList.add("show");
      } else {
        tabsSticky.classList.remove("show");
      }
    });

    // ---- Smooth scroll untuk semua trigger tab ----
    document.querySelectorAll('.tab-link').forEach(link => {
      link.addEventListener('click', (e) => {
        const hash = link.getAttribute('href').split('#')[1];
        const target = document.getElementById(hash);
        if (target) {
          e.preventDefault();
          const offset = 150;
          const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
          window.scrollTo({ top, behavior: 'smooth' });
        }
      });
    });

  });
</script>
</body>
</html>
