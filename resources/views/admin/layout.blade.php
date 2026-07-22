{{-- resources/views/admin/layout.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Dashboard') - Admin Pustekinfo</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
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
    width:264px;
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
    background:rgba(255,255,255,.1);
    border:1px solid rgba(255,255,255,.18);
    border-radius:12px;
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

  /* ---------- Off-canvas controls (tablet/mobile) ---------- */
  .menu-toggle{
    display:none;
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

  /* ---------- Main ---------- */
  .main{flex:1;margin-left:264px;display:flex;flex-direction:column;min-height:100vh;min-width:0;}
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
  th,td{text-align:left;padding:13px 14px;border-bottom:1px solid var(--line);font-size:13.5px;vertical-align:middle;}
  th{color:#8a97a0;font-weight:800;text-transform:uppercase;font-size:10.5px;letter-spacing:.06em;}
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

  .form-group{margin-bottom:18px;max-width:560px;}
  label{display:block;font-size:13px;font-weight:700;color:var(--navy);margin-bottom:7px;}
  input,textarea,select{
    width:100%;padding:11px 14px;border:1.5px solid #e2e8ec;border-radius:10px;
    font-size:14px;font-family:inherit;transition:border-color .15s ease, box-shadow .15s ease;
    background:#fff;color:var(--ink);
  }
  input:focus,textarea:focus,select:focus{outline:none;border-color:var(--teal);box-shadow:0 0 0 3px rgba(20,128,140,.12);}
  textarea{min-height:100px;resize:vertical;}
  small.error{color:var(--danger);display:block;margin-top:5px;font-weight:600;}
  small{color:#8a97a0;}

  .row-actions{display:flex;gap:8px;}
  .badge{display:inline-block;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:800;background:rgba(20,128,140,.1);color:var(--teal);border:1px solid rgba(20,128,140,.14);}

  /* ---------- Tablet ---------- */
  @media (max-width:1024px){
    .sidebar{
      transform:translateX(-100%);
      width:280px;
      box-shadow:0 0 40px rgba(0,0,0,.25);
    }
    .sidebar.open{transform:translateX(0);}
    .main{margin-left:0;}
    .menu-toggle{display:flex;}
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
    .row-actions{flex-wrap:wrap;}
  }
</style>
</head>
<body>
  <aside class="sidebar">
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
      </details>
    </nav>

    <div class="bottom">
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
      <div class="topbar-chip">
        <span class="pulse"></span>
        Situs aktif
      </div>
    </div>
    <div class="content">
      @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
      @endif
      @yield('content')
    </div>
  </div>

  <script>
    (function(){
      var sidebar = document.querySelector('.sidebar');
      var toggle = document.getElementById('sidebarToggle');
      var backdrop = document.getElementById('sidebarBackdrop');

      function closeSidebar(){
        sidebar.classList.remove('open');
        document.body.style.overflow = '';
      }
      function openSidebar(){
        sidebar.classList.add('open');
        document.body.style.overflow = 'hidden';
      }

      toggle && toggle.addEventListener('click', function(){
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
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
    })();
  </script>
</body>
</html>