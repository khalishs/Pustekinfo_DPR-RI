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
    --teal:#14839C;
    --ink:#0b2233;
    --white:#ffffff;
    --mist:#eef4f6;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body{
    font-family:'Work Sans',system-ui,sans-serif;
    background:var(--mist);
    color:var(--ink);
    display:flex;
    min-height:100vh;
  }
  h1,h2,.brand-text .name,.sidebar nav a,.btn,.card h3{
    font-family:'Plus Jakarta Sans',system-ui,sans-serif;
  }

  /* ---------- Sidebar ---------- */
  .sidebar{
    width:250px;
    background:linear-gradient(180deg,#073D5F 0%,#0b2233 100%);
    color:#fff;
    flex-shrink:0;
    display:flex;
    flex-direction:column;
    position:fixed;
    top:0;bottom:0;left:0;
  }
  .sidebar .brand{
    display:flex;align-items:center;gap:10px;
    padding:22px 20px;
    border-bottom:1px solid rgba(255,255,255,.1);
  }
  .sidebar .brand img{width:36px;height:36px;object-fit:contain;flex-shrink:0;}
  .sidebar .brand .name{font-weight:800;font-size:16px;color:#fff;line-height:1.2;}
  .sidebar .brand .sub{font-size:9.5px;letter-spacing:.08em;color:#5FC0D1;font-weight:600;margin-top:2px;}

  .sidebar nav{flex:1;padding:14px 12px;overflow-y:auto;}
  .sidebar nav a{
    display:flex;align-items:center;gap:10px;
    padding:11px 14px;
    margin-bottom:2px;
    border-radius:10px;
    color:rgba(255,255,255,.68);
    text-decoration:none;
    font-size:13.5px;font-weight:600;
    transition:.18s ease;
  }
  .sidebar nav a:hover{background:rgba(255,255,255,.07);color:#fff;}
  .sidebar nav a.active{
    background:var(--teal);
    color:#fff;
    box-shadow:0 8px 18px -8px rgba(20,128,140,.6);
  }
  .sidebar nav .dot{width:6px;height:6px;border-radius:50%;background:currentColor;opacity:.5;flex-shrink:0;}
  .sidebar nav a.active .dot{opacity:1;}

  .sidebar .bottom{padding:14px 20px 20px;border-top:1px solid rgba(255,255,255,.1);display:flex;flex-direction:column;gap:8px;}
  .sidebar .bottom a{
    font-size:12.5px;font-weight:700;color:rgba(255,255,255,.55);
    text-decoration:none;display:flex;align-items:center;gap:6px;
  }
  .sidebar .bottom a:hover{color:#fff;}
  .sidebar .bottom form button{
    width:100%;padding:10px;border-radius:10px;
    border:1px solid rgba(255,143,138,.35);
    background:rgba(176,65,62,.12);
    color:#ff8f8a;font-weight:700;font-size:13px;cursor:pointer;
    transition:.2s ease;
  }
  .sidebar .bottom form button:hover{background:#b0413e;color:#fff;border-color:#b0413e;}

  /* ---------- Main ---------- */
  .main{flex:1;margin-left:250px;display:flex;flex-direction:column;min-height:100vh;}
  .topbar{
    background:#fff;
    padding:18px 36px;
    border-bottom:1px solid #e7ecee;
    position:sticky;top:0;z-index:5;
  }
  .topbar h1{font-size:21px;font-weight:800;color:var(--navy);}
  .content{padding:28px 36px 60px;}

  .flash{
    margin-bottom:18px;padding:13px 18px;border-radius:10px;
    font-size:13.5px;font-weight:700;
    background:#e6f7ee;color:#1f9d7c;
    border:1px solid #c9ecd9;
  }

  .card{
    background:#fff;border-radius:16px;padding:26px;
    box-shadow:0 6px 24px -12px rgba(11,34,51,.14);
    border:1px solid #eef1f3;
  }
  .card + .card{margin-top:20px;}

  .page-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
  .page-head h2{font-size:18px;font-weight:800;color:var(--navy);}

  table{width:100%;border-collapse:collapse;}
  th,td{text-align:left;padding:12px 14px;border-bottom:1px solid #eef1f3;font-size:13.5px;vertical-align:middle;}
  th{color:#8a97a0;font-weight:800;text-transform:uppercase;font-size:10.5px;letter-spacing:.05em;}
  tr:hover td{background:#fbfdfe;}

  .btn{
    display:inline-flex;align-items:center;gap:6px;
    padding:10px 20px;border-radius:22px;
    font-size:13px;font-weight:700;letter-spacing:.01em;
    text-decoration:none;cursor:pointer;border:1.5px solid transparent;
    transition:transform .15s ease, box-shadow .15s ease, background .15s ease;
  }
  .btn:hover{transform:translateY(-2px);}
  .btn-primary{background:var(--teal);color:#fff;}
  .btn-primary:hover{background:#0f6b7f;box-shadow:0 10px 20px -10px rgba(20,128,140,.6);}
  .btn-danger{background:#fff;color:#b0413e;border-color:#e3b8b8;}
  .btn-danger:hover{background:#b0413e;color:#fff;border-color:#b0413e;}
  .btn-outline{background:#fff;border-color:#dfe4e7;color:#5b6b73;}
  .btn-outline:hover{border-color:var(--teal);color:var(--teal);}

  .form-group{margin-bottom:18px;max-width:560px;}
  label{display:block;font-size:13px;font-weight:700;color:var(--navy);margin-bottom:7px;}
  input,textarea,select{
    width:100%;padding:11px 14px;border:1.5px solid #e2e8ec;border-radius:10px;
    font-size:14px;font-family:inherit;transition:border-color .15s ease;
  }
  input:focus,textarea:focus,select:focus{outline:none;border-color:var(--teal);}
  textarea{min-height:100px;resize:vertical;}
  small.error{color:#b0413e;display:block;margin-top:5px;font-weight:600;}
  small{color:#8a97a0;}

  .row-actions{display:flex;gap:8px;}
  .badge{display:inline-block;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:800;background:rgba(20,128,140,.1);color:var(--teal);}

  @media (max-width:900px){
    .sidebar{position:static;width:100%;}
    .main{margin-left:0;}
  }
</style>
</head>
<body>
  <aside class="sidebar">
    <div class="brand">
      <img src="{{ asset('images/Logo.png') }}" alt="Logo">
      <div>
        <div class="name">PUSTEKINFO</div>
        <div class="sub">ADMIN PANEL</div>
      </div>
    </div>
    <nav>
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><span class="dot"></span> Dashboard</a>
      <a href="{{ route('admin.statistics.index') }}" class="{{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}"><span class="dot"></span> Statistik</a>
      <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}"><span class="dot"></span> Berita</a>
      <a href="{{ route('admin.agenda.index') }}" class="{{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}"><span class="dot"></span> Agenda</a>
      <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}"><span class="dot"></span> Galeri</a>
      <a href="{{ route('admin.leadership.edit') }}" class="{{ request()->routeIs('admin.leadership.*') ? 'active' : '' }}"><span class="dot"></span> Sambutan Pimpinan</a>
      <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><span class="dot"></span> Pengaturan Footer</a>
    </nav>
    <div class="bottom">
      <a href="{{ route('home') }}">← Lihat Website</a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <h1>@yield('title', 'Dashboard')</h1>
    </div>
    <div class="content">
      @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
      @endif
      @yield('content')
    </div>
  </div>
</body>
</html>