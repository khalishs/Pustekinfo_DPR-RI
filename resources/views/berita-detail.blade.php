{{-- resources/views/berita-detail.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $news->title }} - Pustekinfo | Pusat Teknologi Informasi DPR RI</title>
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
  .footer-brand-text .name {
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
  .article-wrap{max-width:760px;margin:0 auto;padding:56px 24px 90px;}
  .article-image{width:100%;height:380px;object-fit:cover;border-radius:16px;margin-bottom:40px;box-shadow:0 30px 60px -30px rgba(11,34,51,.3);}
  .article-body{color:#354049;font-size:16px;line-height:1.9;font-weight:400;white-space:pre-line;}
  .article-body p{margin-bottom:18px;}
  .article-back{
    display:inline-flex;align-items:center;gap:8px;margin-bottom:28px;
    color:var(--teal);font-size:13.5px;font-weight:700;
  }
  .article-back svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;}

  /* ================= FOOTER ================= */
  .footer-divider{height:3px;background:linear-gradient(10deg, #057888 0%, #0b2233 55%, #0b2233 100%);}
  .footer{background:var(--navy);padding:64px 100px 0;}
  .footer-inner{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr;gap:40px;padding-bottom:50px;}
  .footer-brand{display:flex;align-items:center;gap:12px;}
  .footer-brand-text .name{font-weight:800;font-size:23px;color:var(--white);line-height:1.1;}
  .footer-brand-text .sub{font-size:10px;letter-spacing:.08em;color:var(--white);font-weight:600;}
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
    .article-image{height:220px;}
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
      <li><a href="{{ route('profil') }}">Profil</a></li>
      <li><a href="{{ route('layanan') }}">Layanan</a></li>
      <li class="active"><a href="{{ route('informasi') }}">Informasi</a></li>
      <li><a href="{{ route('galeri') }}">Galeri</a></li>
      <li><a href="{{ route('kontak') }}">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <button class="btn-login"><a href="{{ route('login') }}">Masuk</a></button>
      <button class="burger" id="burgerBtn" aria-label="Buka menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  {{-- ================= HERO ================= --}}
  <header class="hero-profil">
    <div class="hero-profil-inner">
      <p class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('informasi') }}">Informasi</a> / <span>Berita</span></p>
      <span class="article-badge">{{ $news->category }}</span>
      <h1>{{ $news->title }}</h1>
      <div class="article-meta">
        <span><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> {{ $news->published_at?->format('d M Y') }}</span>
        @if($news->author)
          <span><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> {{ $news->author }}</span>
        @endif
        @if($news->reading_minutes)
          <span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> {{ $news->reading_minutes }} menit baca</span>
        @endif
      </div>
    </div>
  </header>

  {{-- ================= ARTIKEL ================= --}}
  <div class="article-wrap">
    <a href="{{ route('informasi') }}" class="article-back">
      <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
      Kembali ke Informasi
    </a>

    @if($news->image)
      <img src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->title }}" class="article-image">
    @endif

    <div class="article-body">{{ $news->content ?: $news->excerpt }}</div>
  </div>

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
          <a href="{{ route('profil') }}"><span class="chev">›</span> Profil</a>
          <a href="{{ route('layanan') }}"><span class="chev">›</span> Layanan</a>
          <a href="{{ route('informasi') }}"><span class="chev">›</span> Informasi</a>
          <a href="{{ route('galeri') }}"><span class="chev">›</span> Galeri</a>
        </div>
      </div>

      <div class="footer-col">
        <span class="head">BANTUAN</span>
        <div class="footer-links">
          <a href="{{ route('kontak') }}"><span class="chev">›</span> Kontak</a>
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
</script>
</body>
</html>
