{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pustekinfo - Pusat Teknologi Informasi DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --navy-900:#0b2233;
    --navy-800:#0f3a52;
    --teal-700:#0e5f6b;
    --teal-500:#14808c;
    --teal-300:#4fb3ac;
    --gold:#c9a34e;
    --ink:#0b2233;
    --white:#ffffff;
    --mist:#eef4f6;
    --line:rgba(255,255,255,.18);
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body{
    font-family:'Plus Jakarta Sans',system-ui,sans-serif;
    color:var(--ink);
    background:var(--white);
  }
  a{text-decoration:none;color:inherit;}
  ul{list-style:none;}

  /* ---------- Navbar ---------- */
  .navbar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px 48px;
    background:var(--white);
    border-bottom:1px solid #eaeaea;
    position:relative;
    z-index:20;
  }
  .brand{display:flex;align-items:center;gap:12px;}
  .brand-logo{
    width:50px;
    height:50px;
    object-fit:contain;
}
  .brand-text .name{font-weight:800;font-size:16px;color:#0A2E45;line-height:1.1;}
  .brand-text .sub{font-size:10px;letter-spacing:.08em;color: #3bc0de;;font-weight:600;}

  .nav-links{display:flex;align-items:center;gap:34px;}
  .nav-links li a{
    font-size:14.5px;font-weight:600;color:#3c4a52;
    display:flex;align-items:center;gap:4px;
  }
  .nav-links li.active a{color:var(--teal-700);}
  .nav-links li.active{position:relative;}
  .nav-links li.active::after{
    content:"";position:absolute;left:0;right:0;bottom:-18px;
    height:2px;background:var(--teal-700);
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
    background:var(--navy-900);color:var(--white);
    font-size:14px;font-weight:700;cursor:pointer;
  }

  /* ---------- Hero ---------- */
  .hero{
    position:relative;
    min-height:523px;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    overflow:hidden;
    padding:10px 24px 70px;
  }
  .hero::before{
    content:"";
    position:absolute;inset:0;
    background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSg_HiNLIbXJOwY_CD0nM_AcgONJ3gFKN_QjxlfBf5hYZ10I3Y8IBgdsC3a&s=10');
    background-size:cover;
    background-position:center 30%;
    filter:saturate(1.05);
  }
  .hero::after{
    content:"";
    position:absolute;inset:0;
    background:linear-gradient(180deg, rgba(11,49,74,.55) 0%, rgba(11,60,86,.72) 55%, rgba(9,46,58,.88) 100%);
  }
  .hero-content{position:relative;z-index:2;max-width:900px;}
  .hero-content h1{
    color:var(--white);
    font-size:38px;
    font-weight:700;
    line-height:1.22;
    letter-spacing:-.01em;
    text-shadow:0 2px 18px rgba(0,0,0,.2);
  }
  .hero-content p{
    margin:26px auto 0;
    max-width:680px;
    color:rgba(255,255,255,.88);
    font-size:16px;
    line-height:1.7;
    font-weight:500;
  }
  .hero-actions{
    margin-top:36px;
    display:flex;
    gap:16px;
    justify-content:center;
    flex-wrap:wrap;
  }
  .btn{
    padding:15px 30px;
    border-radius:5px;
    font-size:14px;
    font-weight:700;
    letter-spacing:.03em;
    cursor:pointer;
    border:1.5px solid transparent;
    transition:transform .15s ease, background .15s ease;
  }
  .btn:hover{transform:translateY(-2px);}
  .btn-primary{background:var(--teal-500);color:var(--white);}
  .btn-primary:hover{background:var(--teal-300);}
  .btn-ghost{background:transparent;color:var(--white);border-color:rgba(255,255,255,.6);}
  .btn-ghost:hover{background:rgba(255,255,255,.12);}


  /* ---------- Stats bar ---------- */
  .stats-bar{
    position:relative;
    z-index:3;
    margin:-60px 100px 0;
    background:linear-gradient(90deg, var(--navy-800), var(--teal-700));
    border-radius:14px;
    display:grid;
    grid-template-columns:repeat(4,1fr);
    box-shadow:0 20px 40px -12px rgba(11,34,51,.35);
  }
  .stat{
    display:flex;
    align-items:center;
    gap:16px;
    padding:22px 30px;
    border-right:1px solid var(--line);
    transition:all .3s ease;
    cursor:pointer;
  }

.stat:hover .stat-icon{
    transform:scale(1.15) rotate(8deg);
}


  .stat:last-child{border-right:none;}
  .stat-icon{
    width:48px;height:48px;border-radius:12px;
    background:rgba(255,255,255,.12);
    display:flex;align-items:center;justify-content:center;
    color:var(--white);font-size:20px;
    flex-shrink:0;
    transition:.3s ease;
  }
  .stat-num{color:var(--white);font-size:26px;font-weight:800;line-height:1;transition:.3s ease;}
  .stat:hover .stat-num{
    color:#ffd66b;
}
  .stat-label{color:rgba(255,255,255,.75);font-size:13px;font-weight:600;margin-top:6px;}

  .spacer{height:120px;background:var(--mist);}

  @media (max-width:900px){
    .navbar{padding:14px 20px;}
    .nav-links{display:none;}
    .hero-content h1{font-size:30px;}
    .stats-bar{grid-template-columns:repeat(2,1fr);margin:-60px 16px 0;border-radius:12px;}
    .stat{border-right:none;border-bottom:1px solid var(--line);padding:24px 20px;}
    .hero{padding:90px 20px 200px;}
  }
</style>
</head>
<body>

  <nav class="navbar">
    <div class="brand">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo Pustekinfo" class="brand-logo">
      <div class="brand-text">
        <div class="name">Pustekinfo</div>
        <div class="sub">PUSAT TEKNOLOGI INFORMASI</div>
      </div>
    </div>

    <ul class="nav-links">
      <li class="active"><a href="#">Beranda</a></li>
      <li><a href="#">Profil <span class="caret">▾</span></a></li>
      <li><a href="#">Layanan <span class="caret">▾</span></a></li>
      <li><a href="#">Informasi <span class="caret">▾</span></a></li>
      <li><a href="#">Galeri</a></li>
      <li><a href="#">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <button class="icon-btn" aria-label="Ganti tema">◐</button>
      <button class="lang-btn">EN</button>
      <button class="btn-login">Masuk</button>
    </div>
  </nav>

  <header class="hero">
    <div class="hero-content">
      <h1>Mendukung Kinerja DPR RI melalui Layanan <br> Teknologi Informasi yang <br> Terintegrasi.</h1>
      <p>Pustekinfo menyediakan layanan teknologi informasi, pengelolaan infrastruktur, aplikasi, jaringan, dan keamanan informasi untuk mendukung operasional seluruh unit kerja secara efektif, aman, dan berkelanjutan.</p>
      <div class="hero-actions">
        <button class="btn btn-primary">Ajukan Layanan IT</button>
        <button class="btn btn-ghost">Lihat Status Layanan</button>
      </div>
    </div>
  </header>

  <section class="stats-bar">
    <div class="stat">
      <div class="stat-icon">🗄</div>
      <div>
        <div class="stat-num" data-target="1250+">0</div>
        <div class="stat-label">Aplikasi Terkelola</div>
      </div>
    </div>
    <div class="stat">
      <div class="stat-icon">🖥</div>
      <div>
        <div class="stat-num" data-target="99.8%">0%</div>
        <div class="stat-label">Uptime Layanan</div>
      </div>
    </div>
    <div class="stat">
      <div class="stat-icon">👥</div>
      <div>
        <div class="stat-num" data-target="12400">0</div>
        <div class="stat-label">Pengguna Terlayani</div>
      </div>
    </div>
    <div class="stat">
      <div class="stat-icon">🏅</div>
      <div>
        <div class="stat-num" data-target="3.57">0</div>
        <div class="stat-label">Indeks SPBE</div>
      </div>
    </div>
  </section>

  <div class="spacer"></div>


  <script>
const counters = document.querySelectorAll('.stat-num');

function animateCounter(counter) {
    const target = parseFloat(counter.dataset.target);
    const duration = 1500;
    const startTime = performance.now();

    function update(currentTime) {
        const progress = Math.min((currentTime - startTime) / duration, 1);
        const value = target * progress;

        if (target === 99.8) {
            counter.innerText = value.toFixed(1) + "%";
        } else if (target === 3.57) {
            counter.innerText = value.toFixed(2).replace(".", ",");
        } else if (target === 1250) {
            counter.innerText = Math.floor(value).toLocaleString("id-ID") + "+";
        } else if (target === 12400) {
            counter.innerText = (value / 1000).toFixed(1) + "K";
        }

        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }

    requestAnimationFrame(update);
}

// Animasi pertama saat card terlihat
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target.querySelector(".stat-num"));
            observer.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.5
});

document.querySelectorAll(".stat").forEach(stat => {

    observer.observe(stat);

    // Hover = hitung ulang
    stat.addEventListener("mouseenter", () => {
        const counter = stat.querySelector(".stat-num");
        counter.innerText = "0";
        animateCounter(counter);
    });

});
</script>
</body>
</html>