{{-- resources/views/galeri.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Galeri Kegiatan - Pustekinfo DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<style>
  :root{
    --navy:#12242E; --teal:#14839C; --ink:#0b2233;
    --white:#ffffff; --mist:#eef4f6; --line:rgba(255,255,255,.18);
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  html{scroll-behavior:smooth;}
  body{font-family:'Work Sans',system-ui,sans-serif;color:var(--ink);background:var(--mist);}
  a{text-decoration:none;color:inherit;}
  ul{list-style:none;}
  h1,h2,.brand-text .name,.footer-brand-text .name,.stat-num,.sorotan-title{font-family:'Plus Jakarta Sans',system-ui,sans-serif;}

  .navbar{display:flex;align-items:center;justify-content:space-between;padding:10px 48px;background:rgba(255,255,255,.95);backdrop-filter:blur(12px);border-bottom:1px solid #eaeaea;position:fixed;top:0;left:0;width:100%;z-index:9999;}
  .brand{display:flex;align-items:center;gap:12px;}
  .brand-logo{width:50px;height:50px;object-fit:contain;}
  .brand-text .name{font-weight:800;font-size:23px;color:#073D5F;line-height:1.1;}
  .brand-text .sub{font-size:9.5px;letter-spacing:.08em;color:#0F6B7F;font-weight:600;}
  .nav-links{display:flex;align-items:center;gap:34px;}
  .nav-links li a{font-family:'Plus Jakarta Sans',system-ui,sans-serif;font-size:14.5px;font-weight:600;color:#3c4a52;display:flex;align-items:center;gap:4px;transition:color .2s ease;}
  .nav-links li a:hover{color:var(--teal);}
  .nav-links li.active a{color:var(--teal);}
  .nav-links li.active{position:relative;}
  .nav-links li.active::after{content:"";position:absolute;left:0;right:0;bottom:-18px;height:2px;background:var(--teal);}
  .nav-item-dropdown{position:relative;}
  .nav-dropdown{position:absolute;top:calc(100% + 22px);left:50%;transform:translateX(-50%) translateY(8px);min-width:220px;background:var(--white);border:1px solid #e7dcc6;border-radius:12px;padding:10px;box-shadow:0 24px 50px -20px rgba(11,34,51,.25);opacity:0;visibility:hidden;transition:.2s ease;z-index:20;}
  .nav-item-dropdown:hover .nav-dropdown{opacity:1;visibility:visible;transform:translateX(-50%) translateY(0);}
  .nav-dropdown a{display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:8px;font-size:14px;font-weight:600;color:#5b6b73;transition:.15s ease;}
  .nav-dropdown a:hover{background:var(--mist);color:var(--navy);}
  .nav-dropdown a .dd-icon{width:18px;height:18px;color:var(--teal);flex-shrink:0;}
  .nav-dropdown a .dd-icon svg{width:100%;height:100%;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
  .caret{font-size:10px;opacity:.6;}
  .nav-actions{display:flex;align-items:center;gap:12px;}
  .icon-btn{width:36px;height:36px;border-radius:50%;border:1px solid #dfe4e7;display:flex;align-items:center;justify-content:center;font-size:14px;color:#5b6b73;background:var(--white);cursor:pointer;transition:.2s ease;}
  .icon-btn:hover{background:var(--mist);border-color:var(--teal);color:var(--teal);transform:translateY(-2px);}
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
    .nav-links{display:none;position:fixed;top:62px;left:0;right:0;flex-direction:column;gap:0;background:var(--white);border-bottom:1px solid #eaeaea;box-shadow:0 20px 30px -20px rgba(11,34,51,.25);padding:8px 20px 16px;z-index:9998;}
    .nav-links.open{display:flex;}
    .nav-links li{width:100%;}
    .nav-links li a{padding:14px 4px;width:100%;justify-content:space-between;border-bottom:1px solid #f1f4f5;}
    .nav-links li.active::after{display:none;}
    .burger{display:flex;}
    .brand-logo{width:36px;height:36px;}
    .brand-text .name{font-size:15px;}
    .brand-text .sub{font-size:6.5px;}
  }

  .page-header{
    margin-top:70px;
    background:#073D5F;
    padding:60px 100px 90px;
  }
  .page-header .crumb{color:rgba(255,255,255,.6);font-size:13px;font-weight:600;}
  .page-header .crumb a{color:#5FC0D1;}
  .page-header h1{color:#fff;font-size:32px;font-weight:800;margin-top:12px;}
  .page-header h1 .accent{color:#5FC0D1;}
  .page-header p{color:rgba(255,255,255,.7);margin-top:12px;font-size:14.5px;max-width:600px;}

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
    .page-header{padding:90px 20px 70px;}
    .page-header h1{font-size:24px;}
  }
  .stat-num{font-size:26px;font-weight:800;color:var(--navy);}
  .stat-label{margin-top:6px;font-size:12px;font-weight:600;color:#7a8a92;}

  @media (max-width:900px){
    .stats-bar{grid-template-columns:repeat(2,1fr);padding:0 20px;margin-top:-40px;}
    .page-header{padding:90px 20px 70px;}
    .page-header h1{font-size:24px;}
  }

  .galeri-page{padding:50px 100px 100px;max-width:1240px;margin:0 auto;}

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

  .galeri-filters{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:32px;}
  .galeri-filter{display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border-radius:20px;border:1px solid #dfe4e7;background:var(--white);font-size:13px;font-weight:700;color:#5b6b73;cursor:pointer;transition:.2s ease;}
  .galeri-filter:hover{border-color:var(--teal);color:var(--teal);}
  .galeri-filter.active{background:var(--navy);border-color:var(--navy);color:var(--white);}
  .galeri-filter .count{opacity:.6;font-weight:600;}

  .galeri-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
  .galeri-card{position:relative;border-radius:14px;overflow:hidden;aspect-ratio:4/3;background:linear-gradient(160deg,var(--navy) 0%,var(--teal) 100%);transition:transform .3s ease, box-shadow .3s ease;}
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
    .galeri-grid{grid-template-columns:repeat(2,1fr);gap:14px;}
    .sorotan-card{padding:26px 24px;}
    .sorotan-title{font-size:18px;}
  }

  .footer{background:var(--navy);padding:64px 100px 0;margin-top:20px;}
  .footer-inner{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr;gap:40px;padding-bottom:50px;}
  .footer-brand{display:flex;align-items:center;gap:12px;}
  .footer-brand-logo{width:50px;object-fit:contain;}
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
  .footer-links a:hover{color:var(--white);gap:10px;}
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

  [data-theme="dark"] body{background:#0b1720;color:#c3cdd2;}
  [data-theme="dark"] .navbar{background:rgba(11,23,32,.92);border-bottom-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .brand-text .name{color:#eaf3f5;}
  [data-theme="dark"] .nav-links li a{color:#c3cdd2;}
  [data-theme="dark"] .icon-btn,[data-theme="dark"] .lang-btn,[data-theme="dark"] .galeri-filter,[data-theme="dark"] .load-more a{background:#122530;border-color:rgba(255,255,255,.14);color:#c3cdd2;}
  [data-theme="dark"] .btn-login{background:#5FC0D1;color:#0b1720;}
  [data-theme="dark"] .stat-card{background:#122530;}
  [data-theme="dark"] .stat-num{color:#eaf3f5;}
  [data-theme="dark"] .galeri-empty{color:#6d8189;}
</style>
</head>
<body>

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
          <a href="{{ route('profil') }}#tentang"><span class="dd-icon"><svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg></span>Tentang</a>
          <a href="{{ route('profil') }}#pimpinan"><span class="dd-icon"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>Pimpinan</a>
          <a href="{{ route('profil') }}#struktur"><span class="dd-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><path d="M5 17v-2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><circle cx="12" cy="19" r="2"/></svg></span>Struktur Organisasi</a>
          <a href="{{ route('profil') }}#visi-misi"><span class="dd-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/></svg></span>Visi dan Misi</a>
        </div>
      </li>
      <li><a href="{{ route('layanan') }}">Layanan</a></li>
      <li><a href="{{ route('informasi') }}">Informasi</a></li>
      <li class="active"><a href="{{ route('galeri') }}">Galeri</a></li>
      <li><a href="{{ route('kontak') }}">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <button class="icon-btn" id="themeToggle" aria-label="Ganti tema" aria-pressed="false">◐</button>
      <button class="lang-btn">EN</button>
      <a href="{{ route('login') }}" class="btn-login">Masuk</a>
      <button class="burger" id="burgerBtn" aria-label="Buka menu"><span></span><span></span><span></span></button>
    </div>
  </nav>

  <header class="page-header">
    <div class="crumb"><a href="{{ route('home') }}">Beranda</a> / Galeri</div>
    <h1>Dokumentasi <span class="accent">Kegiatan Kami</span></h1>
    <p>Kumpulan momen kegiatan, pelatihan, dan kerja sama Pustekinfo dalam mendukung layanan teknologi informasi lembaga.</p>
  </header>

  <div class="stats-bar">
    <div class="stats-bar-inner">
      <div class="stat-card">
        <div>
          <div class="stat-num">{{ $totalFoto }}+</div>
          <div class="stat-label">Total Foto</div>
        </div>
      </div>
      <div class="stat-card">
        <div>
          <div class="stat-num">{{ $kegiatanTerdokumentasi }}</div>
          <div class="stat-label">Kegiatan Terdokumentasi</div>
        </div>
      </div>
      <div class="stat-card">
        <div>
          <div class="stat-num">{{ $totalKategori }}</div>
          <div class="stat-label">Kategori</div>
        </div>
      </div>
      <div class="stat-card">
        <div>
          <div class="stat-num">{{ $rentangWaktu }}</div>
          <div class="stat-label">Rentang Waktu</div>
        </div>
      </div>
    </div>
  </div>

  <main class="galeri-page">

    @if($featured)
      <div class="sorotan-card">
        <img src="{{ asset('storage/'.$featured->image) }}" alt="{{ $featured->title }}">
        <div class="inner">
          <span class="sorotan-badge">SOROTAN</span>
          <div class="sorotan-title">{{ $featured->title }}</div>
          @if($featured->description)
            <p class="sorotan-desc">{{ $featured->description }}</p>
          @endif
        </div>
      </div>
    @endif

    <div class="galeri-filters">
      <a href="{{ route('galeri') }}" class="galeri-filter {{ !$activeCategory ? 'active' : '' }}">Semua <span class="count">{{ $totalFoto }}</span></a>
      @foreach($categories as $cat)
        <a href="{{ route('galeri', ['kategori' => $cat->slug]) }}" class="galeri-filter {{ $activeCategory == $cat->slug ? 'active' : '' }}">
          {{ $cat->name }} <span class="count">{{ $cat->items_count }}</span>
        </a>
      @endforeach
    </div>

    <div class="galeri-grid">
      @forelse($items as $item)
        <div class="galeri-card">
          <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
          @if($item->category)
            <span class="cat-badge">{{ $item->category->name }}</span>
          @endif
          @if($item->title)
            <div class="overlay"><span>{{ $item->title }}</span></div>
          @endif
        </div>
      @empty
        <div class="galeri-empty">Belum ada foto pada kategori ini.</div>
      @endforelse
    </div>

    @if($items->hasMorePages())
      <div class="load-more">
        <a href="{{ $items->nextPageUrl() }}">Muat lebih banyak</a>
      </div>
    @endif

  </main>

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
          <div class="item"><svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>{{ $setting->address ?? 'Alamat belum diatur' }}</div>
          <div class="item"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>{{ $setting->phone ?? '-' }}</div>
          <div class="item"><svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg>{{ $setting->email ?? '-' }}</div>
        </div>
      </div>
    </div>

    <div class="footer-inner footer-bottom">
      <p>© 2026 Pustekinfo. Seluruh hak dilindungi.</p>
      <p>Referensi mockup — bukan situs resmi</p>
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
    themeToggle.textContent = isDark ? "◑" : "◐";
  }
  applyTheme(document.documentElement.getAttribute("data-theme") === "dark");
  themeToggle.addEventListener("click", () => {
    const isDark = document.documentElement.getAttribute("data-theme") !== "dark";
    localStorage.setItem("theme", isDark ? "dark" : "light");
    applyTheme(isDark);
  });

  const profilDropdown = document.getElementById("profilDropdown");
  if (window.innerWidth <= 900) {
    profilDropdown.querySelector("a").addEventListener("click", (e) => {
      e.preventDefault();
      profilDropdown.classList.toggle("open");
    });
  }
</script>
</body>
</html>