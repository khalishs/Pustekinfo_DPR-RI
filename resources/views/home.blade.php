{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pustekinfo DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('images/favicon-bg.png') }}">
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
  .stat-num,
  .num,
  .layanan-card .title,
  .feature .title,
  .akses-col h2,
  .akses-item-body .title,
  .berita-featured-body h3,
  .berita-item-body .title,
  .sambutan-content h2,
  .agenda-cal-head .month,
  .agenda-event-top .title {
    font-family:'Plus Jakarta Sans', system-ui, sans-serif;
  }

  /* ---------- Navbar ---------- */
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
  .brand{display:flex;align-items:center;gap:1px;}
  .brand-logo{width:50px;height:50px;object-fit:contain;}

  
  /* width:190px dibuat tetap (bukan auto) supaya lebar kotak logo sama persis
     antara mode light & dark — mencegah navbar "geser" saat ganti tema, karena
     kedua file logo (persegi vs landscape) py rasio aspek yang beda jauh. */
  .navbar-logo{height:50px;width:190px;object-fit:contain;object-position:left center; transform:scale(4.9); /* 1.2 - 1.8 sesuaikan */
    transform-origin:left center;pointer-events:none;}

  .nav-links{display:flex;align-items:center;gap:34px;}

  .nav-links li a{
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    font-size:14.5px;font-weight:600;color:#3c4a52;
    display:flex;align-items:center;gap:4px;
    transition:color .2s ease;
  }
  .nav-links li a:hover{color:var(--teal);}
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

  .lang-btn{
    padding:8px 16px;border-radius:20px;border:1px solid #dfe4e7;
    font-size:13px;font-weight:700;color:#5b6b73;background:var(--white);
    cursor:pointer;
    transition:background .2s ease, border-color .2s ease, color .2s ease;
  }
  .lang-btn:hover{
    background:var(--mist);
    border-color:var(--teal);
    color:var(--teal);
  }
  .btn-login{
    padding:10px 22px;border-radius:20px;border:none;
    background:var(--navy);color:var(--white);
    font-size:14px;font-weight:700;cursor:pointer;
    transition:background .2s ease, transform .2s ease, box-shadow .2s ease;
  }
  .btn-login:hover{
    background:var(--teal);
    transform:translateY(-2px);
    box-shadow:0 10px 22px -10px rgba(20,128,140,.55);
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
  .burger{display: none;}


  /* ---------- Hero ---------- */
  .hero{
    margin-top: 70px;
    position:relative;
    background: var(--white);
    /* Navbar (70px) + hero = pas 1 layar penuh saat pertama dibuka, di device apa pun.
       100dvh dipakai belakangan supaya browser lama yang belum kenal dvh tetap dapat fallback 100vh. */
    min-height:calc(100vh - 70px);
    min-height:calc(100dvh - 70px);
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    overflow:hidden;
    padding:10px 24px 60px;
  }
  .hero-slider{
    position:absolute;
    left:0;right:0;
    top:-38%;
    height:176%;
    overflow:hidden;
    will-change:transform;
}

.hero-slide{
    position:absolute;
    inset:0;
    background-size:cover;
    background-position:center;
    opacity:0;
    transition:opacity 2s ease-in-out;
}

.hero-slide.active{
    opacity:1;
}

  .hero-arrow{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    z-index:3;
    width:48px;height:48px;
    border-radius:50%;
    border:1px solid transparent;
    background:transparent;
    color:#fff;
    opacity:.5;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:.25s ease;
    padding:0;
  }
  .hero-arrow:hover{
    background:rgba(11,49,74,.55);
    border-color:rgba(255,255,255,.5);
    backdrop-filter:blur(4px);
    opacity:1;
  }
  .hero-arrow svg{width:20px;height:20px;stroke:currentColor;fill:none;stroke-width:2.4;stroke-linecap:round;stroke-linejoin:round;}
  .hero-arrow-prev{left:24px;}
  .hero-arrow-next{right:24px;}

  .hero::after{
    content:"";
    position:absolute;inset:0;
    background:linear-gradient(180deg, rgba(11,49,74,.55) 0%, rgba(11,60,86,.72) 55%, rgba(9,46,58,.88) 100%);
    pointer-events:none;
  }
  .hero-content{margin-top:24px;position:relative;z-index:2;max-width:900px;}
  .hero-content .eyebrow{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:12px;
    margin-bottom:20px;
    color:#fff;
    font-family:'Plus Jakarta Sans',system-ui,sans-serif;
    font-size:12px;
    font-weight:700;
    letter-spacing:.2em;
    text-transform:uppercase;
  }
  .hero-content .eyebrow::before,
  .hero-content .eyebrow::after{
    content:"";
    width:22px;height:2px;
    background:#5FC0D1;
    display:inline-block;
  }
  .hero-content h1{
    color:var(--white);
    font-size:46px;
    font-weight:800;
    line-height:1.18;
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

  /* ---------- Hero: petunjuk scroll ---------- */
  .hero-scroll-cue{
    position:absolute;
    left:50%;
    bottom:30px;
    transform:translateX(-50%);
    z-index:2;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:10px;
    color:rgba(255,255,255,.8);
    text-decoration:none;
    transition:color .2s ease;
  }
  .hero-scroll-cue:hover{color:#fff;}
  .hero-scroll-cue .label{
    font-size:10px;
    font-weight:700;
    letter-spacing:.22em;
    text-transform:uppercase;
  }
  .hero-scroll-cue .mouse{
    width:24px;height:38px;
    border:1.5px solid rgba(255,255,255,.6);
    border-radius:14px;
    display:flex;
    justify-content:center;
    padding-top:7px;
    transition:border-color .2s ease;
  }
  .hero-scroll-cue:hover .mouse{border-color:#fff;}
  .hero-scroll-cue .dot{
    width:4px;height:8px;
    border-radius:2px;
    background:#fff;
    animation:heroScrollDot 1.8s ease-in-out infinite;
  }
  @keyframes heroScrollDot{
    0%{opacity:1;transform:translateY(0);}
    70%{opacity:0;transform:translateY(10px);}
    100%{opacity:0;transform:translateY(10px);}
  }
  @media (max-width:900px){
    .hero-scroll-cue{display:none;}
  }
  .btn{
    display:inline-block;
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
  .btn-primary{background:#067788;color:var(--white);}
  .btn-primary:hover{background:var(--teal);}
  .btn-ghost{background:transparent;color:var(--white);border-color:rgba(255,255,255,.6);}
  .btn-ghost:hover{background:rgba(255,255,255,.12);}


  /* ---------- Stats bar ---------- */
  .stats-bar{
    position:relative;
    z-index:3;
    margin:40px 100px 0;
    background: linear-gradient(150deg,#073D5F 40%,#057888 100%);
    border-radius:14px;
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
  }
  .stat{
    display:flex;
    align-items:center;
    gap:16px;
    padding:22px 30px;
    border-right:1px solid var(--line);
    transition:all .3s ease;
    cursor:pointer;
    flex:0 1 auto;
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

  .stat-icon svg{
    width:22px;height:22px;
    stroke:currentColor;
    fill:none;
    stroke-width:1.8;
    stroke-linecap:round;
    stroke-linejoin:round;
  }
  
  .stat-num{color:var(--white);font-size:26px;font-weight:700;line-height:1;transition:.3s ease;}
  .stat:hover .stat-num{
    color:#5FC0D1;
}
  .stat-label{color:rgba(255,255,255,.75);font-size:13px;font-weight:600;margin-top:6px;}

  .spacer{height:60px;background:var(--mist);display: none;}

  @media (max-width:900px){
    .navbar{padding:10px 16px;gap:8px;}

    .brand{gap:8px;min-width:0;}
    .brand-logo{width:36px;height:36px;flex-shrink:0;}
    .navbar-logo{height:32px;width:122px;flex-shrink:0;}

    .burger{
    display:flex;
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
    .lang-btn{padding:6px 12px;font-size:11.5px;}
    .btn-login{padding:8px 14px;font-size:12.5px;white-space:nowrap;}
    .profile-box{padding:4px 10px 4px 4px;gap:6px;}
    .profile-avatar{width:26px;height:26px;}
    .profile-name{font-size:11.5px;max-width:80px;}
    .logout-btn{padding:6px 12px;font-size:11px;white-space:nowrap;}

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
    .hero{
      margin-top:62px;
      min-height:calc(100vh - 62px);
      min-height:calc(100dvh - 62px);
      padding:70px 20px 60px;
    }
    .hero-content{margin-top:16px;}
    .hero-content h1{font-size:26px;}
    .hero-arrow{width:36px;height:36px;}
    .hero-arrow svg{width:16px;height:16px;}
    .hero-arrow-prev{left:10px;}
    .hero-arrow-next{right:10px;}

    .stats-bar{
      flex-wrap:wrap;
      justify-content:center;
      margin:24px 16px 0;
      border-radius:12px;
    }
    .stat{
      border-right:none;
      border-bottom:1px solid var(--line);
      gap:12px;
      flex:1 1 45%;
      justify-content:center;
    }
    .stat:last-child{border-bottom:none;}
    .stat-icon{width:38px;height:38px;border-radius:10px;}
    .stat-icon svg{width:18px;height:18px;}
    .stat-num{font-size:19px;}
    .stat-label{font-size:11px;margin-top:4px;}
  }

  @media (max-width:420px){
    .btn-login{padding:8px 10px;}
    .profile-name{display:none;}
    .profile-box{padding:4px;}
  }

  /* ---------- Profil Singkat ---------- */
  .profil{
    position:relative;
    overflow:hidden;
    padding:40px 100px 110px;
    opacity:0;
    transform:translateY(80px);
    transition:
        opacity .9s ease,
        transform .9s ease;
  }

  .profil.show{opacity:1;transform:translateY(0);}
  .profil-grid{
    position:relative;
    z-index:1;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 1px 25px 1px 25px;
    padding: 30px;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:80px;
    align-items:center;
    margin: 20px auto;
    max-width:1240px;
  }
  .profil-media{
    position: relative;
    transition:box-shadow .3s ease, border-radius .3s ease, transform .3s ease;
  }

  .profil-media:hover {
    box-shadow: 0 0 0 1px rgba(0,0,0,.15),
                0 15px 40px rgba(0,0,0,.25);
    border-radius:1px 15px 10px 15px;
    transform:scale(1.02) rotate(0.5deg);
  }

  .profil-media-frame{
    position:relative;
    padding-top:1px;
    aspect-ratio:4/4.5;
    border-radius:1px 15px 10px 15px;
    overflow:hidden;
    background:
      radial-gradient(120% 120% at 20% 15%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
  }
  .profil-slide{
    position:absolute;
    inset:0;
    background-size:cover;
    background-position:center;
    opacity:0;
    transition:opacity 2s ease-in-out;
  }
  .profil-slide.active{
    opacity:1;
  }
  .profil-badge{
    position:absolute;
    top:0px;left:0px;
    z-index:2;
    background:var(--teal);
    color:var(--white);
    font-size:11px;
    font-weight:800;
    letter-spacing:.08em;
    padding:8px 14px;
    border-radius:1px 10px 1px 10px;
  }
 
  .profil-copy .eyebrow{
    display:flex;
    align-items:center;
    font-family: plus-jakarta-sans, system-ui, sans-serif;
    gap:10px;
    color: var(--teal);
    font-size:12px;
    font-weight:600;
    letter-spacing:.12em;
  }
  .profil-copy .eyebrow::before{
    content:"";
    width:22px;height:2px;
    background:var(--teal);
    display:inline-block;
  }
  .profil-copy h2{
    margin-top:16px;
    font-size:32px;
    font-weight:800;
    color:var(--navy);
    line-height:1.28;
    letter-spacing:-.01em;
  }
  .profil-copy p{
    margin-top:18px;
    color:#5b6b73;
    font-size:15px;
    line-height:1.75;
    max-width:520px;
  }

  .profil-features{
    margin-top:8px;
  }
  .feature-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:36px;
    border-top:2px solid #D2D6DA;
    padding-top:22px;
    margin-top:22px;
  }
  .feature{transition:transform .25s ease;}
  .feature:hover{transform:translateY(-3px);}
  .feature .icon{
    width: 30px; height: 30px;
    color: var(--teal);
    stroke:currentColor;
    line-height:1;
    transition:transform .35s cubic-bezier(.34,1.56,.64,1), color .25s ease;
  }
  .feature:hover .icon{
    transform:scale(1.2) rotate(-8deg);
    color:var(--gold);
  }
  .feature .title{
    margin-top:12px;
    font-size:15px;
    font-weight:700;
    color:var(--navy);
    transition:color .25s ease;
  }
  .feature:hover .title{color:var(--teal);}
  .feature .desc{
    margin-top:6px;
    font-size:13.5px;
    line-height:1.6;
    color:#7a8a92;
  }

  @media (max-width:900px){
    .profil{padding:30px 20px 70px;}
    .profil-grid{grid-template-columns:1fr;gap:60px;}
    .feature-row{gap:24px;}
  }

  /* ---------- Layanan (Apa yang kami kerjakan) ---------- */
  .layanan{
    position:relative;
    background:#073D5F;
    padding:150px 100px 110px;
    clip-path:polygon(0 64px, 100% 0, 100% 100%, 0 100%);
    margin-top:-64px;
    opacity:0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
    overflow:hidden;
  }
  .layanan.show{opacity:1;transform:translateY(0);}

  /* Pola batik sama seperti konten-batik (bukan versi terpisah lagi) — pakai filter alpha-boost
     yang sama dipakai dark mode, supaya tetap konsisten & kontras di atas navy */
 .layanan::before{
  content:"";
  position:absolute;
  inset:0;
  background-image:url('{{ asset('images/group-batik.png') }}');
  background-repeat:repeat-y;
  /* Posisi disamakan (lewat JS) dengan pola batik .konten-batik di belakangnya,
     supaya motifnya menyambung utuh, bukan mengulang dari awal lagi di section ini. */
  background-position:center var(--batik-offset-y, top);
  background-size:10000px auto;
  filter:url(#batikTintTeal);
  opacity:.1;   /* 0 = tak terlihat, 1 = penuh — atur sesuai selera */
  pointer-events:none;
  z-index:0;
  transform:translateY(var(--parallax-layanan, 0px));
  will-change:transform;
  }
  .layanan-inner{
    position:relative;
    z-index:1;
    max-width:1240px;
    margin:0 auto;
  }
  .layanan .eyebrow{
    display:flex;
    align-items:center;
    gap:10px;
    color:var(--white);
    font-size:12px;
    font-family: plus-jakarta-sans, system-ui, sans-serif;
    font-weight:600;
    letter-spacing:.12em;
  }
  .layanan .eyebrow::before{
    content:"";
    width:22px;height:2px;
    background:var(--teal);
    display:inline-block;
  }
  .layanan h2{
    margin-top:16px;
    font-size:32px;
    font-weight:800;
    color:var(--white);
    line-height:1.28;
    letter-spacing:-.01em;
    max-width:560px;
  }

  .layanan-grid{
    margin-top:50px;
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:34px 24px;
    align-items:start;
  }

  .layanan-card::before{
    content:"";
    position:absolute;
    inset:0;
    border-radius:15px;
    background:radial-gradient(circle at top right, rgba(255,255,255,.14), transparent 45%);
    pointer-events:none;
}
  .layanan-card{
    position:relative;
    background: linear-gradient(155deg,#073D5F 40%,#057888 100%);
    border:2px solid rgba(255,255,255,.12);
    border-radius:15px;
    padding:30px 28px;
    overflow: hidden;
    transition:background .3s ease, border-color .3s ease, box-shadow .3s ease, transform .3s ease;
    will-change:transform;
  }

 


  /* posisi tiap kartu digeser beda-beda biar nggak sejajar kaku */
  .layanan-card:nth-child(1){ margin-top:10px;    animation:floatA 6.2s ease-in-out infinite; animation-delay:0s; }
  .layanan-card:nth-child(2){ margin-top:20px; animation:floatB 6.8s ease-in-out infinite; animation-delay:.9s; }
  .layanan-card:nth-child(3){ margin-top:10px; animation:floatC 5.9s ease-in-out infinite; animation-delay:1.6s; }
  .layanan-card:nth-child(4){ margin-top:10px; animation:floatB 7.1s ease-in-out infinite; animation-delay:.3s; }
  .layanan-card:nth-child(5){ margin-top:8px;animation:floatA 6.5s ease-in-out infinite; animation-delay:1.2s; }
  .layanan-card:nth-child(6){ margin-top:10px; animation:floatC 6.1s ease-in-out infinite; animation-delay:.6s; }

  @keyframes floatA{
    0%,100%{ transform:translateY(0px) rotate(-.6deg); }
    50%{ transform:translateY(-14px) rotate(.5deg); }
  }
  @keyframes floatB{
    0%,100%{ transform:translateY(-6px) rotate(.5deg); }
    50%{ transform:translateY(10px) rotate(-.5deg); }
  }
  @keyframes floatC{
    0%,100%{ transform:translateY(6px) rotate(-.4deg); }
    50%{ transform:translateY(-10px) rotate(.6deg); }
  }

  .layanan-card:hover{
    background: linear-gradient(150deg,#073D5F 20%,#057888 100%);
    border-color:#FFCE88;
    box-shadow:0 20px 40px -14px rgba(0,0,0,.45);
    animation:none;
    transform:translateY(-10px) rotate(0deg) scale(1.02);
  }
  .layanan-card .icon{
    width:26px;height:26px;
    color:var(--white);
    margin-bottom:20px;
  }
  .layanan-card .icon svg{
    width:100%;height:100%;
    stroke:currentColor;
    fill:none;
    stroke-width:1.6;
    stroke-linecap:round;
    stroke-linejoin:round;
  }
  .layanan-card .title{
    color:var(--white);
    font-size:15.5px;
    font-weight:700;
    line-height:1.35;
  }
  .layanan-card .desc{
    margin-top:8px;
    color:rgba(255,255,255,.62);
    font-size:13.5px;
    line-height:1.65;
  }

  @media (max-width:900px){
    .layanan{padding:110px 20px 70px;clip-path:polygon(0 36px, 100% 0, 100% 100%, 0 100%);margin-top:-36px;}
    .layanan-grid{grid-template-columns:1fr;gap:22px;}
    .layanan-card:nth-child(1),
    .layanan-card:nth-child(2),
    .layanan-card:nth-child(3),
    .layanan-card:nth-child(4),
    .layanan-card:nth-child(5),
    .layanan-card:nth-child(6){ margin-top:0; }
  }

  /* ---------- Sambutan Pimpinan ---------- */
  .sambutan{
    position:relative;
    overflow:hidden;
    padding:90px 100px 110px;
    opacity: 0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .sambutan.show{opacity:1;transform:translateY(0);}
  
  .sambutan-inner{
    position:relative;
    z-index:1;
    max-width:1240px;
    margin:0 auto;
  }
  .sambutan .eyebrow{
    display:flex;
    align-items:center;
    gap:10px;
    color:var(--teal);
    font-size:12px;
    font-weight:600;
    font-family: plus-jakarta-sans, system-ui, sans-serif;
    letter-spacing:.12em;
  }
  .sambutan .eyebrow::before{
    content:"";
    width:22px;height:2px;
    background:var(--teal);
    display:inline-block;
  }

  .sambutan-card{
    margin-top:34px;
    display:flex;
    background:var(--white);
    border-radius:1px 16px 1px 16px;
    overflow:hidden;
  }

  .sambutan-photo{
    flex:0 0 42%;
    position:relative;
    min-height:400px;
    display:flex;
    align-items:flex-end;
    padding:32px;
    background:
      radial-gradient(120% 120% at 25% 20%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--navy) 50%, var(--teal) 100%);
  }
  .sambutan-photo .who .role{
    margin-top:4px;
    color:rgba(255,255,255,.7);
    font-size:11px;
    font-weight:700;
    letter-spacing:.1em;
  }

  .sambutan-content{
    flex:1;
    position:relative;
    padding:56px 60px;
    display:flex;
    flex-direction:column;
    justify-content:center;
  }
  .sambutan-content .quote-mark{
    position:absolute;
    top:44px;
    right:56px;
    display:flex;
    gap:5px;
  }
  .sambutan-content .quote-mark span{
    width:6px;
    height:34px;
    border-radius:4px;
    background:var(--teal);
  }
  .sambutan-content .eyebrow{
    color:var(--teal);
  }
  .sambutan-content .eyebrow::before{
    background:var(--teal);
  }
  .sambutan-content h2{
    margin-top:14px;
    font-size:27px;
    font-weight:800;
    color:var(--navy);
    line-height:1.32;
    max-width:420px;
  }
  .sambutan-content .desc{
    border-left: 2px solid #057888 ;
    margin-top:18px;
    padding-left: 10px;
    font-style:italic;
    color:#6b7b83;
    font-size:14.5px;
    line-height:1.75;
    max-width:440px;
  }
  .sambutan-content .sign-role{
    margin-top:4px;
    color:#7a8a92;
    font-size:13px;
    font-weight:500;
  }

  @media (max-width:900px){
    .sambutan{padding:60px 20px 70px;}
    .sambutan-card{flex-direction:column;}
    .sambutan-photo{min-height:220px;}
    .sambutan-content{padding:40px 28px;}
    .sambutan-content .quote-mark{top:28px;right:28px;}
  }

  /* ---------- Berita & Kegiatan ---------- */
  .berita{
    position:relative;
    overflow:hidden;
    padding:90px 100px 120px;
    background:var(--white);
    opacity:0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .berita.show{opacity:1;transform:translateY(0);}

  .berita-inner{position:relative;z-index:1;max-width:1240px;margin:0 auto;}

  .berita-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    flex-wrap:wrap;
    gap:20px;
  }
  .berita .eyebrow{
    display:flex;
    align-items:center;
    font-family: plus-jakarta-sans, system-ui, sans-serif;
    gap:10px;
    color:var(--teal);
    font-size:12px;
    font-weight:600;
    letter-spacing:.12em;
  }
  .berita .eyebrow::before{
    content:"";
    width:22px;height:2px;
    background:var(--teal);
    display:inline-block;
  }
  .berita-head h2{
    margin-top:16px;
    font-size:32px;
    font-weight:700;
    color:var(--navy);
    letter-spacing:-.01em;
  }
  .berita-link{
    display:flex;
    align-items:center;
    gap:6px;
    color:var(--teal);
    font-size:12.5px;
    font-weight:800;
    letter-spacing:.06em;
    border-bottom:2px solid var(--teal);
    padding-bottom:4px;
    white-space:nowrap;
    transition:color .2s ease, gap .2s ease, opacity .2s ease;
  }
  .berita-link:hover{color:var(--navy);opacity:.8;gap:10px;}
  [data-theme="dark"] .berita-link:hover{color:#eaf3f5;}

  .berita-grid{
    margin-top:44px;
    display:grid;
    grid-template-columns:1.15fr 1fr;
    gap:44px;
    align-items:start;
  }

  /* --- Kartu unggulan --- */
  .berita-featured{
    position:relative;
    min-height:470px;
    border-radius:1px 16px 1px 16px;
    padding:34px;
    display:flex;
    flex-direction:column;
    overflow:hidden;
    background:
      radial-gradient(120% 120% at 15% 10%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
    transition:box-shadow .3s ease, transform .3s ease;
  }
  .berita-featured:hover{
    box-shadow:0 34px 70px -22px rgba(11,34,51,.5);
    transform:translateY(-4px);
  }
  .berita-featured .badge{
    align-self:flex-start;
    background:var(--teal);
    color:var(--white);
    font-size:11px;
    font-weight:800;
    letter-spacing:.08em;
    padding:8px 14px;
    border-radius:1px 10px 1px 10px;
  }
  .berita-featured-body{margin-top:auto; background-color: rgb(0, 0, 0, 0.5); height:220px;width: 700px;padding-left: 20px; padding-bottom:20px; margin-left: -33px;margin-bottom: -33px;}
  .berita-featured-body h3{
    color:var(--white);
    font-size:23px;
    font-weight:800;
    line-height:1.35;
    max-width:420px;
  }
  .berita-featured-body p{
    margin-top:22px;
    color:rgba(255,255,255,.72);
    font-size:10px;
    line-height:1.10;
    max-width:560px;
  }
  .berita-featured .meta{
    margin-top:22px;
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    color:rgba(255,255,255,.65);
    font-size:12.5px;
    font-weight:600;
  }
  .berita-featured .meta span{
    display:flex;
    align-items:center;
    gap:6px;
  }
  .berita-featured .meta svg{
    width:14px;height:14px;
    stroke:currentColor;
    fill:none;
    stroke-width:1.8;
  }
  .berita-featured .read-more{
    margin-top:22px;
    display:inline-block;
    color:var(--white);
    font-size:12.5px;
    font-weight:800;
    letter-spacing:.06em;
    border-bottom:2px solid var(--teal);
    padding-bottom:5px;
    width:max-content;
    transition:color .2s ease, border-color .2s ease;
  }
  .berita-featured .read-more:hover{
    color:#5FC0D1;
    border-color:#5FC0D1;
  }

  /* --- List berita kecil --- */
  .berita-list{display:flex;flex-direction:column;}
  .berita-item{
    display:flex;
    gap:18px;
    padding:20px 0;
    border-bottom:1px solid #eef1f3;
    cursor:pointer;
    transition:padding-left .2s ease;
  }
  .berita-item:first-child{padding-top:0;}
  .berita-item:last-child{border-bottom:none;padding-bottom:0;}
  .berita-item:hover{padding-left:6px;}
  .berita-item:hover .berita-item-body .title{color:var(--teal);}
  .berita-item:hover .berita-thumb{transform:scale(1.04);}

  .berita-thumb{
    flex-shrink:0;
    width:96px;
    height:76px;
    border-radius:8px;
    background:
      radial-gradient(120% 120% at 20% 15%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--teal) 100%);
    transition:transform .3s ease;
  }
  .berita-item-body .cat{
    color:var(--teal);
    font-size:11px;
    font-weight:800;
    letter-spacing:.08em;
    text-transform:uppercase;
  }
  .berita-item-body .title{
    margin-top:6px;
    font-size:14.5px;
    font-weight:700;
    color:var(--navy);
    line-height:1.4;
    transition:color .2s ease;
  }
  .berita-item-body .meta{
    margin-top:10px;
    display:flex;
    gap:16px;
    color:#8a97a0;
    font-size:12px;
    font-weight:600;
  }
  .berita-item-body .meta span{
    display:flex;
    align-items:center;
    gap:5px;
  }
  .berita-item-body .meta svg{
    width:13px;height:13px;
    stroke:currentColor;
    fill:none;
    stroke-width:1.8;
  }

  @media (max-width:900px){
    .berita{padding:60px 20px 80px;}
    .berita-grid{grid-template-columns:1fr;gap:36px;}
    .berita-featured{min-height:auto;padding:28px;}
  }

  /* ---------- Agenda Kegiatan ---------- */
  .agenda{
    padding:90px 100px 120px;
    opacity:0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .agenda.show{opacity:1;transform:translateY(0);}

  .agenda-inner{max-width:1240px;margin:0 auto;}

  .agenda .eyebrow{
    display:flex;
    align-items:center;
    font-family: plus-jakarta-sans, system-ui, sans-serif;
    gap:10px;
    color:var(--teal);
    font-size:12px;
    font-weight:600;
    letter-spacing:.12em;
  }
  .agenda .eyebrow::before{
    content:"";
    width:22px;height:2px;
    background:var(--teal);
    display:inline-block;
  }
  .agenda-inner > h2{
    margin-top:16px;
    font-size:32px;
    font-weight:700;
    color:var(--navy);
    letter-spacing:-.01em;
  }

  .agenda-grid{
    margin-top:40px;
    display:grid;
    grid-template-columns:1.55fr 1fr;
    gap:28px;
    align-items:stretch;
  }

  /* --- Kalender --- */
  .agenda-cal{
    background:var(--white);
    border-radius:16px;
    padding:28px 30px 22px;
  }
  .agenda-cal-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
  }
  .agenda-cal-head .month{
    font-size:18px;
    font-weight:800;
    color:var(--navy);
  }
  .agenda-cal-nav{
    display:flex;
    align-items:center;
    gap:8px;
  }
  .agenda-cal-nav button{
    width:30px;height:30px;
    border-radius:50%;
    border:1px solid #e2e8ec;
    background:var(--white);
    color:#5b6b73;
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;
    font-size:13px;
    transition:background .2s ease, border-color .2s ease, color .2s ease;
  }
  .agenda-cal-nav button:hover{background:var(--mist);border-color:var(--teal);color:var(--teal);}
  .agenda-cal-nav .today-btn{
    width:auto;
    border-radius:8px;
    padding:0 14px;
    height:30px;
    font-size:11.5px;
    font-weight:700;
    color:var(--teal);
    border-color:#d7e6e8;
  }

  .agenda-cal-daynames{
    margin-top:22px;
    display:grid;
    grid-template-columns:repeat(7,1fr);
    text-align:center;
  }
  .agenda-cal-daynames span{
    font-size:11px;
    font-weight:700;
    color:#9aa8af;
    letter-spacing:.04em;
  }

  .agenda-cal-days{
    margin-top:10px;
    display:grid;
    grid-template-columns:repeat(7,1fr);
    row-gap:6px;
  }
  .agenda-day{
    position:relative;
    aspect-ratio:1/1;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    font-size:13.5px;
    font-weight:600;
    color:var(--navy);
    border-radius:10px;
    cursor:pointer;
    transition:background .2s ease, color .2s ease;
  }
  .agenda-day:hover{background:rgba(20,128,140,.1);color:var(--teal);}
  .agenda-day.muted{color:#c7d0d4;font-weight:500;}
  .agenda-day.muted:hover{background:rgba(20,128,140,.06);color:#9aa8af;}
  .agenda-day.has-event:not(.today){border:1.5px solid rgba(20,128,140,.3);}
  .agenda-day.today{
    background:rgba(20,128,140,.08);
    border:1.5px solid var(--teal);
    color:var(--teal);
    font-weight:800;
  }
  .agenda-day .dots{
    display:flex;align-items:center;justify-content:center;gap:3px;margin-top:4px;flex-wrap:wrap;max-width:90%;
  }
  .agenda-day .dot{
    width:7px;height:7px;
    border-radius:50%;
    flex-shrink:0;
    box-shadow:0 0 0 1px rgba(255,255,255,.6);
  }
  .agenda-day .dot-more{font-size:9px;font-weight:800;color:#9aa8af;line-height:1;}

  .agenda-legend{
    margin-top:20px;
    padding-top:18px;
    border-top:1px solid #eef1f3;
    display:flex;
    align-items:center;
    gap:8px;
    color:#9aa8af;
    font-size:12px;
    font-weight:600;
  }
  .agenda-legend svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0;}

  /* --- Panel Hari Ini --- */
  .agenda-today{
    background: #073D5F;
    border-radius:16px;
    padding:26px 26px 30px;
    display:flex;
    flex-direction:column;
  }

  /* Tidak ada lagi pola batik terpisah di sini — cukup pakai layer .konten-batik::before */

  .agenda-today-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding-bottom:18px;
    border-bottom:1px solid rgba(255,255,255,.14);
  }
  .agenda-today-head .label{
    display:flex;
    align-items:center;
    gap:8px;
    color:var(--white);
    font-size:13px;
    font-weight:800;
  }
  .agenda-today-head .label::before{
    content:"";
    width:6px;height:6px;
    border-radius:50%;
    background:var(--teal);
  }
  .agenda-today-head .date{
    color:rgba(255,255,255,.6);
    font-size:12px;
    font-weight:600;
  }

  .agenda-event{
    margin-top:20px;
    padding:16px 0 4px;
  }
  .agenda-event-top{
    display:flex;
    align-items:flex-start;
    gap:10px;
  }
  .agenda-event-top .bullet{
    margin-top:6px;
    width:7px;height:7px;
    border-radius:50%;
    background:var(--teal);
    flex-shrink:0;
  }
  .agenda-event-top .title{
    color:var(--white);
    font-size:14.5px;
    font-weight:700;
    line-height:1.4;
  }
  .agenda-event-meta{
    margin-top:10px;
    margin-left:17px;
    display:flex;
    flex-direction:column;
    gap:8px;
  }
  .agenda-event-meta span{
    display:flex;
    align-items:center;
    gap:8px;
    color:rgba(255,255,255,.65);
    font-size:12.5px;
    font-weight:600;
  }
  .agenda-event-meta svg{
    width:14px;height:14px;
    stroke:currentColor;
    fill:none;
    stroke-width:1.8;
    flex-shrink:0;
  }

  .agenda-today-empty{
    padding-top:24px;
    text-align:center;
    color:rgba(255,255,255,.4);
    font-size:12.5px;
    font-weight:600;
  }

  .agenda-upcoming-head{
    margin-top:22px;
    padding-top:18px;
    border-top:1px solid rgba(255,255,255,.14);
    display:flex;
    align-items:center;
    gap:8px;
    color:rgba(255,255,255,.55);
    font-size:11px;
    font-weight:800;
    letter-spacing:.08em;
    text-transform:uppercase;
  }
  .agenda-event.upcoming{margin-top:16px;}
  .agenda-event.upcoming .agenda-event-top .title{color:rgba(255,255,255,.85);}
  .agenda-event.upcoming .agenda-event-top .bullet{background:rgba(255,255,255,.35);}

  @media (max-width:900px){
    .agenda{padding:60px 20px 80px;}
    .agenda-grid{grid-template-columns:1fr;gap:24px;}
    .agenda-cal{padding:22px 18px 18px;}
    .agenda-day{font-size:12.5px;}
  }
  /* ---------- Galeri Kegiatan ---------- */
.galeri{
  position:relative;
  overflow:hidden;
  padding:90px 100px 120px;
  background:var(--white);
  opacity:0;
  transform:translateY(60px);
  transition:opacity .9s ease, transform .9s ease;
}
.galeri.show{opacity:1;transform:translateY(0);}

.galeri-inner{position:relative;z-index:1;max-width:1240px;margin:0 auto;}

.galeri-head{
  display:flex;
  justify-content:space-between;
  align-items:flex-end;
  flex-wrap:wrap;
  gap:20px;
}
.galeri .eyebrow{
  display:flex;
  align-items:center;
  font-family: plus-jakarta-sans, system-ui, sans-serif;
  gap:10px;
  color:var(--teal);
  font-size:12px;
  font-weight:600;
  letter-spacing:.12em;
}
.galeri .eyebrow::before{
  content:"";
  width:22px;height:2px;
  background:var(--teal);
  display:inline-block;
}
.galeri-head h2{
  margin-top:16px;
  font-size:32px;
  font-weight:800;
  color:var(--navy);
  letter-spacing:-.01em;
}
.galeri-link{
  display:flex;
  align-items:center;
  gap:6px;
  color:var(--teal);
  font-size:12.5px;
  font-weight:800;
  letter-spacing:.06em;
  border-bottom:2px solid var(--teal);
  padding-bottom:4px;
  white-space:nowrap;
  transition:color .2s ease, gap .2s ease, opacity .2s ease;
}
.galeri-link:hover{color:var(--navy);opacity:.8;gap:10px;}
[data-theme="dark"] .galeri-link:hover{color:#eaf3f5;}

/* --- Filter pills --- */
.galeri-filters{
  margin-top:26px;
  display:flex;
  gap:10px;
  flex-wrap:wrap;
}
.galeri-filter{
  padding:10px 20px;
  border-radius:20px;
  border:1px solid #dfe4e7;
  background:var(--white);
  font-size:13px;
  font-weight:700;
  color:#5b6b73;
  cursor:pointer;
  transition:.2s ease;
  font-family:inherit;
}
.galeri-filter:hover{border-color:var(--teal);color:var(--teal);}
.galeri-filter.active{
  background:var(--navy);
  border-color:var(--navy);
  color:var(--white);
}
.galeri-filter.active:hover{color:var(--white);}

/* --- Grid bento --- */
.galeri-grid{
  margin-top:36px;
  display:grid;
  grid-template-columns:repeat(4,1fr);
  grid-template-rows:172px 172px 116px;
  gap:16px;
}
.galeri-grid.filtered{
  grid-template-rows:none;
  grid-auto-rows:150px;
}
.galeri-grid.filtered .galeri-card{
  grid-column:auto !important;
  grid-row:auto !important;
}

.galeri-card{
  position:relative;
  border-radius:14px;
  overflow:hidden;
  display:flex;
  align-items:center;
  justify-content:center;
  cursor:pointer;
  background:
    radial-gradient(120% 120% at 20% 15%, var(--teal) 0%, transparent 55%),
    linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
  transition:transform .3s ease, box-shadow .3s ease;
}
.galeri-card img{
  position:absolute;inset:0;
  width:100%;height:100%;
  object-fit:cover;
}
.galeri-card:hover{
  transform:translateY(-4px);
  box-shadow:0 20px 40px -18px rgba(11,34,51,.4);
}
.galeri-card.hide{display:none;}

.galeri-card .icon{
  width:34px;height:34px;
  color:rgba(255,255,255,.32);
  z-index:1;
  transition:color .3s ease, transform .3s ease;
}
.galeri-card:hover .icon{
  color:rgba(255,255,255,.55);
  transform:scale(1.1);
}
.galeri-card .icon svg{
  width:100%;height:100%;
  stroke:currentColor;
  fill:none;
  stroke-width:1.5;
  stroke-linecap:round;
  stroke-linejoin:round;
}

.galeri-card.big{grid-column:1/3;grid-row:1/3;}
.galeri-card.med{grid-row:1;}
.galeri-card.wide{grid-column:3/5;grid-row:2;}
.galeri-card.small{grid-row:3;}

@media (max-width:900px){
  .galeri{padding:60px 20px 80px;}
  .galeri-filters{flex-wrap:nowrap;overflow-x:auto;padding-bottom:6px;}
  .galeri-filter{white-space:nowrap;}
  .galeri-grid{
    grid-template-columns:repeat(2,1fr);
    grid-template-rows:none;
  }
  .galeri-card{min-height:130px;}
  .galeri-card.big{grid-column:1/3;grid-row:auto;min-height:200px;}
  .galeri-card.med{grid-row:auto;}
  .galeri-card.wide{grid-column:1/3;grid-row:auto;}
  .galeri-card.small{grid-row:auto;}
}

/* ---------- Akses Cepat & Dokumen ---------- */
.akses-dokumen{
  padding:90px 100px 120px;
  opacity:0;
  transform:translateY(60px);
  transition:opacity .9s ease, transform .9s ease;
}
.akses-dokumen.show{opacity:1;transform:translateY(0);}

.akses-dokumen-inner{
  max-width:1240px;
  margin:0 auto;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:60px;
}

.akses-col .eyebrow{
  display:flex;
  align-items:center;
  font-family: plus-jakarta-sans, system-ui, sans-serif;
  gap:10px;
  color:var(--teal);
  font-size:12px;
  font-weight:600;
  letter-spacing:.12em;
}
.akses-col .eyebrow::before{
  content:"";
  width:22px;height:2px;
  background:var(--teal);
  display:inline-block;
}
.akses-col h2{
  margin-top:14px;
  display:flex;
  align-items:center;
  gap:10px;
  font-size:24px;
  font-weight:800;
  color:var(--navy);
  letter-spacing:-.01em;
}
.akses-col h2 .head-icon{
  width:24px;height:24px;
  color:var(--teal);
  flex-shrink:0;
}
.akses-col h2 .head-icon svg{
  width:100%;height:100%;
  stroke:currentColor;
  fill:none;
  stroke-width:2;
  stroke-linecap:round;
  stroke-linejoin:round;
}

/* --- List item card --- */
.akses-list{
  margin-top:24px;
  display:flex;
  flex-direction:column;
  gap:14px;
}
.akses-item{
  display:flex;
  align-items:center;
  gap:16px;
  background:var(--white);
  border-radius:12px;
  padding:18px 20px;
  cursor:pointer;
  transition:transform .2s ease, box-shadow .2s ease;
}
.akses-item:hover{
  transform:translateY(-3px);
  box-shadow:0 14px 30px -14px rgba(11,34,51,.22);
}

.akses-icon{
  width:44px;height:44px;
  border-radius:10px;
  background:rgba(20,128,140,.1);
  color:var(--teal);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
}
.akses-icon svg{
  width:20px;height:20px;
  stroke:currentColor;
  fill:none;
  stroke-width:1.8;
  stroke-linecap:round;
  stroke-linejoin:round;
}

.akses-item-body{flex:1;min-width:0;}
.akses-item-body .title{
  font-size:14.5px;
  font-weight:700;
  color:var(--navy);
}
.akses-item-body .desc{
  margin-top:3px;
  font-size:12.5px;
  color:#8a97a0;
  font-weight:500;
}

.akses-arrow{
  width:16px;height:16px;
  color:#b7c2c7;
  flex-shrink:0;
  transition:.2s ease;
}
.akses-arrow svg{
  width:100%;height:100%;
  stroke:currentColor;
  fill:none;
  stroke-width:2;
  stroke-linecap:round;
  stroke-linejoin:round;
}
.akses-item:hover .akses-arrow{color:var(--teal);transform:translateX(3px);}

/* --- Dokumen (varian dengan tombol download) --- */
.akses-item.dokumen .akses-icon{
  border-radius:8px;
  background:rgba(11,34,51,.06);
  color:var(--navy);
}
.dl-btn{
  width:36px;height:36px;
  border-radius:8px;
  border:1px solid #e2e8ec;
  background:var(--white);
  color:#5b6b73;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
  cursor:pointer;
  transition:.2s ease;
}
.dl-btn svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
.dl-btn:hover{
  border-color:var(--teal);
  color:var(--teal);
  background:rgba(20,128,140,.08);
}
.akses-item:hover .dl-btn{
  border-color:var(--teal);
  color:var(--teal);
  background:rgba(20,128,140,.06);
}

@media (max-width:900px){
  .akses-dokumen{padding:60px 20px 80px;}
  .akses-dokumen-inner{grid-template-columns:1fr;gap:44px;}
}

/* ---------- Pola Batik (satu gambar besar saja, tidak diulang/ditile, ikut discroll bersama halaman) ---------- */
.konten-batik{
  position:relative;
  z-index:0;
  background-color:#14839C1A;
  /* background-image dipindah ke ::before supaya bisa diberi filter tanpa
     ikut mempengaruhi warna konten/section di dalamnya */
}

/* Layer pola batik untuk LIGHT mode — di-tile vertikal (repeat-y) supaya polanya
   ikut muncul & discroll di sepanjang section (Profil s/d Akses & Dokumen), bukan cuma sekali di atas */
.konten-batik::before{
  content:"";
  position:absolute;
  inset:0;
  opacity: .2;
  z-index:-1;
  pointer-events:none;
  background-image:url('{{ asset('images/group-batik.png') }}');
  background-repeat:repeat-y;
  background-position:center top;
  background-size:10000px auto;
  filter:url(#batikBoostLight);
  opacity:.1;
  transform:translateY(var(--parallax-batik, 0px));
  will-change:transform;
}

/* Overlay pola batik khusus DARK mode: pola aslinya alpha-nya sangat tipis (maks ~10%)
   sehingga langsung menghilang di background gelap; overlay ini menaikkan alpha lewat SVG filter
   supaya polanya tetap kelihatan tapi tidak berlebihan/menyilaukan. */
[data-theme="dark"] .konten-batik{
  background-color:#0e1b23;
}
[data-theme="dark"] .konten-batik::before{
  filter:url(#batikTintTeal);
  opacity:.1;
}

@media (max-width:900px){
  .konten-batik::before{background-size:3000px auto;}
  .layanan::before{background-size:3000px auto;}
}

/* ---------- CTA Bantuan Teknis ---------- */
.cta-bantuan{
  position:relative;
  background:linear-gradient(120deg, var(--navy) 0%, var(--navy) 55%, var(--teal) 100%);
  padding:56px 100px 30px;
  clip-path: polygon(0 0, 100% 34px, 100% 100%, 0 100%);
  margin-top:-35px;
  display:flex;
  flex-direction:column;
  align-items:center;
  border-bottom:5px solid #207E91;
}

.cta-bantuan-top{
  width:100%;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:30px;
  flex-wrap:wrap;
  padding-bottom:38px;
}

.cta-bantuan .eyebrow{
  display:flex;
  align-items:center;
  font-family: plus-jakarta-sans, system-ui, sans-serif;
  gap:10px;
  color:rgba(255,255,255,.65);
  font-size:12px;
  font-weight:600;
  letter-spacing:.12em;
}
.cta-bantuan .eyebrow::before{
  content:"";
  width:22px;height:2px;
  background:rgba(255,255,255,.65);
  display:inline-block;
}

.cta-bantuan h2{
  margin-top:14px;
  font-size:26px;
  font-weight:800;
  line-height:1.4;
  color:var(--white);
  max-width:520px;
}
.cta-bantuan h2 .accent{color:var(--teal);}

.cta-footer-img{
  display:block;
  width:480px;
  max-width:80%;
  height:auto;
  margin:0 auto;
  margin-bottom: -217px;
  margin-top: -165px;
  margin-bottom: -215px;
  pointer-events:none;
  user-select:none;
}

.cta-btn{
  display:flex;
  align-items:center;
  gap:10px;
  background:var(--white);
  color:var(--navy);
  border:none;
  padding:16px 26px;
  border-radius:24px;
  font-size:13px;
  font-weight:800;
  letter-spacing:.05em;
  cursor:pointer;
  box-shadow:0 14px 30px -12px rgba(0,0,0,.35);
  transition:transform .2s ease, box-shadow .2s ease;
  flex-shrink:0;
}
.cta-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 18px 36px -14px rgba(0,0,0,.45);
}
.cta-btn .icon{
  width:16px;height:16px;
  color:var(--teal);
}
.cta-btn .icon svg{
  width:100%;height:100%;
  stroke:currentColor;
  fill:none;
  stroke-width:2;
  stroke-linecap:round;
  stroke-linejoin:round;
}

@media (max-width:900px){
  .cta-bantuan{
    padding:60px 20px 24px;
    clip-path:polygon(0 20px, 100% 0, 100% 100%, 0 100%);
  }
  .cta-bantuan-top{
    flex-direction:column;
    align-items:flex-start;
    padding-bottom:28px;
  }
  .cta-bantuan h2{font-size:20px;}
  .cta-btn{width:100%;justify-content:center;}
  .cta-footer-img{width:220px;max-width:70%;margin-top:-75px;margin-bottom:-100px;}
}

/* ---------- Footer ---------- */
.footer{
  position:relative;
  background:#052D46;
  padding:64px 100px 0;
  overflow:hidden;
}

/* Motif batik dekoratif di footer — beberapa salinan ukuran acak (aspect ratio tetap terjaga,
   background-size cuma pakai lebar + "auto" biar gak gepeng), diinvert ke putih supaya kontras
   dengan navy, sama seperti trik di section Layanan */
.footer::before{
  content:"";
  position:absolute;
  inset:-40px 0 -80px;
  background-repeat:no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat;
  background-image:
    url('{{ asset('images/motif-batik.png') }}'),
    url('{{ asset('images/motif-batik.png') }}'),
    url('{{ asset('images/motif-batik.png') }}'),
    url('{{ asset('images/motif-batik.png') }}'),
    url('{{ asset('images/motif-batik.png') }}'),
    url('{{ asset('images/motif-batik.png') }}'),
    url('{{ asset('images/motif-batik.png') }}');
  background-position:
    left -100px bottom -30px,
    right -80px top -40px,
    30% 68%,
    35% 15%,
    55% 82%,
    75% 20%,
    90% 75%;
  background-size:
    480px auto,
    320px auto,
    150px auto,
    130px auto,
    170px auto,
    140px auto,
    220px auto;
  filter:brightness(0) invert(1);
  opacity:.5;
  pointer-events:none;
  z-index:0;
}

.footer-inner{
  position:relative;
  z-index:1;
  max-width:1240px;
  margin:0 auto;
  display:grid;
  grid-template-columns:1.4fr 1fr 1fr 1fr;
  gap:40px;
  padding-bottom:50px;
}

/* --- Kolom brand --- */
.footer-brand{display:flex;align-items:center;gap:12px;}
.footer-brand-logo{
  width:190px;
  height:auto;
  object-fit:contain;
}

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
  background:var(--teal, var(--teal));
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

/* --- Kolom link --- */
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
.footer-links a:hover{color:var(--white);gap:10px;}

/* --- Kolom kontak --- */
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

/* --- Bottom bar --- */
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
  .footer::before{
    background-size:170px auto, 140px auto, 65px auto, 55px auto, 70px auto, 60px auto, 90px auto;
    background-position:left -40px bottom -10px, right -40px top -20px, 38% 68%, 35% 15%, 55% 82%, 75% 20%, 90% 75%;
    opacity:.1;
  }
  .footer-inner{grid-template-columns:1fr 1fr;gap:36px;padding-bottom:40px;}
  .footer-brand-logo{width:150px;}
  .footer-bottom{flex-direction:column;text-align:center;padding:20px 0;}
}
@media (max-width:560px){
  .footer-inner{grid-template-columns:1fr;}
}

/* ---------- Dark mode ---------- */
[data-theme="dark"] html{background:#0b1720;}
[data-theme="dark"] body{background:#0b1720;color:#c3cdd2;}

[data-theme="dark"] .navbar{background:rgba(11,23,32,.92);border-bottom-color:rgba(255,255,255,.08);}
.navbar-logo-dark{display:none;transform:scale(1);}
[data-theme="dark"] .navbar-logo-light{display:none;}
[data-theme="dark"] .navbar-logo-dark{display:block;}
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
[data-theme="dark"] .agenda-cal-nav button:hover{background:rgba(255,255,255,.08);border-color:#5FC0D1;color:#5FC0D1;}
[data-theme="dark"] .profil-grid{background-color: rgba(0, 0, 0, 0.8);}
[data-theme="dark"] .agenda-cal-nav .today-btn{color:#5FC0D1;border-color:rgba(95,192,209,.35);}
[data-theme="dark"] .galeri-filter:hover{border-color:#5FC0D1;color:#5FC0D1;}
[data-theme="dark"] .btn-login{background:#5FC0D1;color:#0b1720;}
[data-theme="dark"] .btn-login:hover{background:#7fd3e0;}
[data-theme="dark"] .profile-name{color:#eaf3f5;}
[data-theme="dark"] .logout-btn{color:#ff8f8a;border-color:rgba(255,143,138,.35);}
[data-theme="dark"] .logout-btn:hover{background:#b0413e;color:#fff;border-color:#b0413e;}

@media (max-width:900px){
  [data-theme="dark"] .nav-links{background:#0f1e28;border-bottom-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .nav-links li a{border-bottom-color:rgba(255,255,255,.06);}
}

[data-theme="dark"] .profil .eyebrow,
[data-theme="dark"] .sambutan .eyebrow,
[data-theme="dark"] .berita .eyebrow,
[data-theme="dark"] .agenda .eyebrow,
[data-theme="dark"] .galeri .eyebrow,
[data-theme="dark"] .akses-dokumen .eyebrow{
  color:#5FC0D1;
}

[data-theme="dark"] .profil .eyebrow::before,
[data-theme="dark"] .sambutan .eyebrow::before,
[data-theme="dark"] .berita .eyebrow::before,
[data-theme="dark"] .agenda .eyebrow::before,
[data-theme="dark"] .galeri .eyebrow::before,
[data-theme="dark"] .akses-dokumen .eyebrow::before{
  background:#5FC0D1;
}

[data-theme="dark"] .profil-copy h2,
[data-theme="dark"] .sambutan-content h2,
[data-theme="dark"] .berita-head h2,
[data-theme="dark"] .agenda-inner > h2,
[data-theme="dark"] .galeri-head h2,
[data-theme="dark"] .akses-col h2{
  color:#eaf3f5;
}
[data-theme="dark"] .profil-copy p{color:#8ea0a8;}
[data-theme="dark"] .feature-row{border-top-color:rgba(255,255,255,.1);}
[data-theme="dark"] .feature .title{color:#eaf3f5;}
[data-theme="dark"] .feature .desc{color:#8ea0a8;}
[data-theme="dark"] .feature:hover .icon{color:#e0b869;}
[data-theme="dark"] .feature:hover .title{color:#5FC0D1;}

[data-theme="dark"] .sambutan-card{background:#122530;}
[data-theme="dark"] .sambutan-content .desc{color:#8ea0a8;}
[data-theme="dark"] .sambutan-content .sign-role{color:#8ea0a8;}

[data-theme="dark"] .berita{background-color: rgba(0, 0, 0, 0.8);}
[data-theme="dark"] .berita-item{border-bottom-color:rgba(255,255,255,.08);}
[data-theme="dark"] .berita-item-body .title{color:#eaf3f5;}
[data-theme="dark"] .berita-item:hover .berita-item-body .title{color:#5FC0D1;}
[data-theme="dark"] .berita-item-body .meta{color:#8ea0a8;}
[data-theme="dark"] .berita-link{color:#5FC0D1;border-bottom-color:#5FC0D1;}

[data-theme="dark"] .agenda-cal{background:#122530;}
[data-theme="dark"] .agenda-cal-daynames span{color:#6d8189;}
[data-theme="dark"] .agenda-day{color:#eaf3f5;}
[data-theme="dark"] .agenda-day:hover{background:rgba(95,192,209,.12);color:#5FC0D1;}
[data-theme="dark"] .agenda-day.muted{color:#3d4d54;}
[data-theme="dark"] .agenda-day.has-event:not(.today){border-color:rgba(95,192,209,.3);}
[data-theme="dark"] .agenda-day.today{background:rgba(95,192,209,.12);}
[data-theme="dark"] .agenda-day .dot{box-shadow:0 0 0 1px rgba(18,37,48,.8);}
[data-theme="dark"] .agenda-legend{border-top-color:rgba(255,255,255,.08);color:#6d8189;}

[data-theme="dark"] .galeri{background-color: rgba(0, 0, 0, 0.8);}
[data-theme="dark"] .galeri-link{color:#5FC0D1;border-bottom-color:#5FC0D1;}

[data-theme="dark"] .akses-item{background:#122530;}
[data-theme="dark"] .akses-item-body .title{color:#eaf3f5;}
[data-theme="dark"] .akses-item-body .desc{color:#8ea0a8;}
[data-theme="dark"] .akses-item.dokumen .akses-icon{background:rgba(255,255,255,.08);color:#c3cdd2;}
[data-theme="dark"] .dl-btn:hover{background:rgba(255,255,255,.1);border-color:#5FC0D1;color:#5FC0D1;}
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
        0 0 0 5.5 0"/>   
    </filter>  
      <filter id="batikBoostLight">
        <feColorMatrix type="matrix" values="
          0 0 0 0 0.0784
          0 0 0 0 0.5137
          0 0 0 0 0.6118
          0 0 0 3.4 0"/>
      </filter>
    </svg>

    <nav class="navbar">
      <div class="brand">
        <img src="{{ asset('images/logo_pustekinfo_landscape.png') }}" alt="Logo Pustekinfo" class="navbar-logo navbar-logo-light">
        <img src="{{ asset('images/landscape_putih.png') }}" alt="Logo Pustekinfo" class="navbar-logo navbar-logo-dark">
      </div>

      <ul class="nav-links">
        <li class="active"><a href="{{ route('home') }}" data-en="Home">Beranda</a></li>
        <li><a href="{{ route('profil') }}" data-en="Profile">Profil </a></li>
        <li><a href="{{ route('layanan') }}" data-en="Services">Layanan</a></li>
        <li><a href="{{ route('informasi') }}" data-en="Information">Informasi</a></li>
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

    <div class="konten-batik">

    <header class="hero">
      <div class="hero-slider">
        @forelse($heroSlides as $slide)
          <div class="hero-slide {{ $loop->first ? 'active' : '' }}" style="background-image:url('{{ asset('storage/'.$slide->image) }}')"></div>
        @empty
          <div class="hero-slide" style="background-image:url('{{ asset('images/hero-gedung-dpr.jpg') }}')"></div>
        @endforelse
      </div>
      @if($heroSlides->count() > 1)
        <button type="button" class="hero-arrow hero-arrow-prev" aria-label="Gambar sebelumnya">
          <svg viewBox="0 0 24 24"><polyline points="15 6 9 12 15 18"/></svg>
        </button>
        <button type="button" class="hero-arrow hero-arrow-next" aria-label="Gambar berikutnya">
          <svg viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg>
        </button>
      @endif
      <div class="hero-content">
        <div class="eyebrow" data-en="Center for Information &amp; Communication Technology">Pusat Teknologi Informasi dan Komunikasi</div>
        <h1 data-en-html="Supporting DPR RI's Performance Through Integrated <br> Information Technology <br> Services.">Mendukung Kinerja DPR RI Melalui Layanan <br> Teknologi Informasi Yang <br> Terintegrasi.</h1>
        <p data-en="Pustekinfo provides information technology services, infrastructure management, applications, networks, and information security to support the operations of all work units effectively, securely, and sustainably.">Pustekinfo menyediakan layanan teknologi informasi, pengelolaan infrastruktur, aplikasi, jaringan, dan keamanan informasi untuk mendukung operasional seluruh unit kerja secara efektif, aman, dan berkelanjutan.</p>
        <div class="hero-actions">
          <a href="{{ route('layanan.ajukan') }}" class="btn btn-primary" data-en="Request IT Service">Ajukan Layanan IT</a>
          <a href="{{ route('layanan.status') }}" class="btn btn-ghost" data-en="View Service Status">Lihat Status Layanan</a>
        </div>
      </div>

      <a href="#profil" class="hero-scroll-cue" aria-label="Gulir ke bawah">
        <span class="mouse"><span class="dot"></span></span>
        <span class="label" data-en="Scroll">Scroll</span>
      </a>
    </header>

    @if($stats->count())
      <section class="stats-bar">
        @foreach($stats as $stat)
          <div class="stat">
            <div class="stat-icon"><svg viewBox="0 0 24 24">{!! $stat->icon_svg !!}</svg></div>
            <div>
              <div class="stat-num" data-target="{{ $stat->value }}" data-suffix="{{ $stat->suffix }}" data-decimals="{{ $stat->decimals }}">0</div>
              <div class="stat-label" data-en="{{ $stat->label_en ?: $stat->label }}">{{ $stat->label }}</div>
            </div>
          </div>
        @endforeach
      </section>
    @endif
        <div class="spacer"></div>

        {{-- Pembungkus: satu pola batik menyatu untuk seluruh section di bawah ini (Profil s/d Akses & Dokumen) --}}

        {{-- ================= PROFIL SINGKAT ================= --}}
        <section id="profil" class="profil">
          <div class="profil-grid">

            <div class="profil-media">
              <div class="profil-media-frame">
                @foreach($profilPhotos as $photo)
                  <div class="profil-slide {{ $loop->first ? 'active' : '' }}" style="background-image:url('{{ asset('storage/'.$photo->image) }}')"></div>
                @endforeach
                <span class="profil-badge" data-en="ABOUT US">TENTANG KAMI</span>
              </div>
            </div>

            <div class="profil-copy">
              <div class="eyebrow" data-en="SHORT PROFILE">PROFIL SINGKAT</div>
              <h2 data-en="The Institution's Information Technology Support Unit">Unit Pendukung Teknologi Informasi Lembaga</h2>
              <p data-en="Responsible for managing the network, information systems, data, and cyber security within the institution, so that all work processes run efficiently and accountably.">Bertanggung jawab atas pengelolaan jaringan, sistem informasi, data, dan keamanan siber di lingkungan lembaga, agar seluruh proses kerja berjalan efisien dan akuntabel.</p>

              <div class="profil-features">
                <div class="feature-row">
                  <div class="feature">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round">
                          <polyline points="4 6 5.5 7.5 8 5"></polyline>
                          <line x1="10" y1="6" x2="20" y2="6"></line><polyline points="4 12 5.5 13.5 8 11"></polyline><line x1="10" y1="12" x2="20" y2="12"></line>
                          <polyline points="4 18 5.5 19.5 8 17"></polyline><line x1="10" y1="18" x2="20" y2="18"></line>
                      </svg>
                  </div>
                  <div class="title" data-en="Main Duties">Tugas Pokok</div>
                  <div class="desc" data-en="Managing IT infrastructure, networks, and data centers.">Mengelola infrastruktur TI, jaringan, dan pusat data.</div>
                </div>
                <div class="feature">
                  <div class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="7" height="7"></rect><rect x="14" y="13" width="7" height="7"></rect><line x1="10" y1="7.5" x2="14" y2="7.5"></line><line x1="14" y1="7.5" x2="14" y2="16.5"></line></svg>
                  </div>
                  <div class="title" data-en="Main Functions">Fungsi Utama</div>
                  <div class="desc" data-en="Developing and maintaining cross-unit systems.">Mengembangkan dan memelihara sistem lintas unit kerja.</div>
                </div>
              </div>
              <div class="feature-row">
                <div class="feature">
                  <div class="icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L5 5v6c0 5 3.5 9.5 7 11 3.5-1.5 7-6 7-11V5l-7-3z"></path><polyline points="9.5 11.5 11.5 13.5 15 10"></polyline></svg>
                  </div>
                  <div class="title" data-en="Security">Keamanan</div>
                  <div class="desc" data-en="Keeping data secure to ISO 27001 standards.">Menjaga data sesuai standar ISO 27001.</div>
                </div>
                <div class="feature">
                  <div class="icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"></circle><circle cx="17" cy="8" r="3"></circle><path d="M4 19c0-3 2.5-5 5-5s5 2 5 5"></path><path d="M13 19c0-2.5 2-4.5 5-4.5"></path></svg>
                  </div>
                  <div class="title" data-en="Service">Pelayanan</div>
                  <div class="desc" data-en="Responsive technical support for all users.">Dukungan teknis responsif untuk seluruh pengguna.</div>
                </div>
              </div>
          </div>

        </div>
        </div>
      </section>

  {{-- ================= APA YANG KAMI KERJAKAN (LAYANAN) ================= --}}
  <section id="layanan" class="layanan">
    <div class="layanan-inner">
      <div class="eyebrow" data-en="WHAT WE DO">APA YANG KAMI KERJAKAN</div>
      <h2 data-en="Information Technology Services">Layanan Teknologi Informasi</h2>

      <div class="layanan-grid">
        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg>
          </div>
          <div class="title" data-en="Network &amp; Internet">Jaringan &amp; Internet</div>
          <div class="desc" data-en="Management of connectivity and network infrastructure.">Pengelolaan konektivitas dan infrastruktur jaringan.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </div>
          <div class="title" data-en="Information Systems">Sistem Informasi</div>
          <div class="desc" data-en="Development and integration of internal and public service applications.">Pengembangan dan integrasi aplikasi layanan internal maupun publik.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
          </div>
          <div class="title" data-en="Helpdesk &amp; Complaints">Helpdesk &amp; Aduan</div>
          <div class="desc" data-en="Complaint and technical support services for device or system issues.">Layanan pengaduan dan bantuan teknis untuk kendala perangkat maupun sistem.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5.2 3.4 9.9 8 11 4.6-1.1 8-5.8 8-11V5l-8-3z"/></svg>
          </div>
          <div class="title" data-en="Information Security">Keamanan Informasi</div>
          <div class="desc" data-en="Protection of data and systems from cyber threats according to security standards.">Perlindungan data dan sistem dari ancaman siber sesuai standar keamanan.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>
          </div>
          <div class="title" data-en="Data Center &amp; Cloud">Data Center &amp; Cloud</div>
          <div class="desc" data-en="Providing secure and reliable data storage infrastructure.">Penyediaan infrastruktur penyimpanan data yang aman dan andal.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </div>
          <div class="title" data-en="Website Management">Pengelolaan Website</div>
          <div class="desc" data-en="Maintenance and updates of the official portal and work unit subdomains.">Pemeliharaan dan pembaruan portal resmi serta subdomain unit kerja.</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= SAMBUTAN PIMPINAN ================= --}}
  <section id="sambutan" class="sambutan">
    <div class="sambutan-inner">
      <div class="eyebrow" data-en="LEADERSHIP MESSAGE">SAMBUTAN PIMPINAN</div>

      <div class="sambutan-card">
                <div class="sambutan-photo" @if($leadership?->photo) style="background-image:url('{{ asset('storage/'.$leadership->photo) }}');background-size:cover;background-position:center;" @endif>
          <div class="who">
            <div class="role">{{ $leadership->position ?? 'KEPALA PUSTEKINFO' }}</div>
          </div>
        </div>

        <div class="sambutan-content">
          <div class="quote-mark"><span></span><span></span></div>

          <div class="eyebrow" data-en="WELCOME">SELAMAT DATANG</div>
          <h2 data-en="{{ ($leadership->welcome_title_en ?? null) ?: ($leadership->welcome_title ?? 'Technology for better service') }}">{{ $leadership->welcome_title ?? 'Teknologi untuk pelayanan yang lebih baik' }}</h2>
          <p class="desc" data-en="{{ ($leadership->description_en ?? null) ?: ($leadership->description ?? 'The leadership message has not been filled in via the admin panel.') }}">{{ $leadership->description ?? 'Sambutan pimpinan belum diisi lewat panel admin.' }}</p>

          <div class="sign-role" data-en="{{ ($leadership->signature_role_en ?? null) ?: ($leadership->signature_role ?? 'Head of Information Technology Center') }}">{{ $leadership->signature_role ?? 'Kepala Pusat Teknologi Informasi' }}</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= BERITA & KEGIATAN ================= --}}
  <section id="berita" class="berita">
    <div class="berita-inner">

      <div class="berita-head">
        <div>
          <div class="eyebrow" data-en="LATEST NEWS">KABAR TERBARU</div>
          <h2 data-en="News &amp; Activities">Berita &amp; Kegiatan</h2>
        </div>
        <a href="{{ route('informasi') }}" class="berita-link"><span data-en="ALL NEWS">SEMUA BERITA</span> <span>→</span></a>
      </div>

      <div class="berita-grid">

        <div class="berita-featured" @if($featuredNews?->image) style="background-image:url('{{ asset('storage/'.$featuredNews->image) }}');background-size:cover;background-position:center;" @endif>
          <span class="badge" data-en="{{ ($featuredNews->category_en ?? null) ?: ($featuredNews->category ?? 'NEWS') }}">{{ $featuredNews->category ?? 'BERITA' }}</span>

          <div class="berita-featured-body">
            <h3 data-en="{{ ($featuredNews->title_en ?? null) ?: ($featuredNews->title ?? 'No featured news yet') }}">{{ $featuredNews->title ?? 'Belum ada berita utama' }}</h3>
            @if($featuredNews)
              <p data-en="{{ $featuredNews->excerpt_en ?: $featuredNews->excerpt }}">{{ $featuredNews->excerpt }}</p>
              <div class="meta">
                <span><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> {{ $featuredNews->published_at?->format('d M Y') }}</span>
                <span><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> {{ $featuredNews->author }}</span>
                <span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> {{ $featuredNews->reading_minutes }} <span data-en="min read">menit baca</span></span>
              </div>
              <a href="{{ route('berita.show', $featuredNews) }}" class="read-more" data-en="READ MORE">BACA SELENGKAPNYA</a>
            @endif
          </div>
        </div>

        <div class="berita-list">
          @forelse($latestNews as $news)
            <a href="{{ route('berita.show', $news) }}" class="berita-item">
              <div class="berita-thumb" @if($news->image) style="background-image:url('{{ asset('storage/'.$news->image) }}');background-size:cover;background-position:center;" @endif></div>
              <div class="berita-item-body">
                <div class="cat" data-en="{{ $news->category_en ?: $news->category }}">{{ $news->category }}</div>
                <div class="title" data-en="{{ $news->title_en ?: $news->title }}">{{ $news->title }}</div>
                <div class="meta">
                  <span><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> {{ $news->published_at?->format('d M Y') }}</span>
                  <span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> {{ $news->reading_minutes }} mnt</span>
                </div>
              </div>
            </a>
          @empty
            <p style="color:#8a97a0;font-size:13.5px;" data-en="No other news yet.">Belum ada berita lain.</p>
          @endforelse
        </div>
        </div>
      </div>
  </section>

  {{-- ================= AGENDA KEGIATAN ================= --}}
  <section id="agenda" class="agenda">
    <div class="agenda-inner">

      <div class="eyebrow" data-en="SCHEDULE">JADWAL</div>
      <h2 data-en="Activity Agenda">Agenda Kegiatan</h2>

      <div class="agenda-grid">

        {{-- Kalender --}}
        <div class="agenda-cal">
          <div class="agenda-cal-head">
            <div class="month">{{ $monthLabel }}</div>
            <div class="agenda-cal-nav">
              <button aria-label="Bulan sebelumnya">‹</button>
              <button aria-label="Bulan berikutnya">›</button>
              <button class="today-btn" data-en="Today">Hari Ini</button>
            </div>
          </div>

          <div class="agenda-cal-daynames">
            <span data-en="Mon">Senin</span><span data-en="Tue">Selasa</span><span data-en="Wed">Rabu</span><span data-en="Thu">Kamis</span><span data-en="Fri">Jumat</span><span data-en="Sat">Sabtu</span><span data-en="Sun">Minggu</span>
          </div>

          <div class="agenda-cal-days">
            @foreach($calendarDays as $day)
              <div class="agenda-day {{ $day['muted'] ? 'muted' : '' }} {{ $day['today'] ? 'today' : '' }} {{ $day['events']->isNotEmpty() ? 'has-event' : '' }}">
                {{ $day['day'] }}
                @if($day['events']->isNotEmpty())
                  <span class="dots">
                    @foreach($day['events']->take(5) as $ev)
                      <span class="dot" style="background:{{ $ev->color }};" title="{{ $ev->title }}"></span>
                    @endforeach
                    @if($day['events']->count() > 5)
                      <span class="dot-more">+{{ $day['events']->count() - 5 }}</span>
                    @endif
                  </span>
                @endif
              </div>
            @endforeach
          </div>
          <div class="agenda-legend">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            <span data-en="Dot color marks the event category set by the admin">Warna titik menandakan kategori kegiatan yang diatur admin</span>
          </div>
        </div>

        {{-- Panel Hari Ini --}}
        <div class="agenda-today">
          <div class="agenda-today-head">
              <div class="label" data-en="Today">Hari Ini</div>
              <div class="date">{{ now()->format('d M Y') }}</div>
            </div>

            @forelse($todayEvents as $event)
              <div class="agenda-event">
                <div class="agenda-event-top">
                  <span class="bullet"></span>
                  <div class="title" data-en="{{ $event->title_en ?: $event->title }}">{{ $event->title }}</div>
                </div>
                <div class="agenda-event-meta">
                  @if($event->event_time)
                    <span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> {{ \Carbon\Carbon::parse($event->event_time)->format('H.i') }} WIB</span>
                  @endif
                  @if($event->location)
                    <span><svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> {{ $event->location }}</span>
                  @endif
                </div>
              </div>
            @empty
              <div class="agenda-today-empty" data-en="No agenda today">Tidak ada agenda hari ini</div>
            @endforelse

            @if($upcomingEvents->isNotEmpty())
              <div class="agenda-upcoming-head" data-en="Upcoming Agenda">Agenda Berikutnya</div>
              @foreach($upcomingEvents as $event)
                <div class="agenda-event upcoming">
                  <div class="agenda-event-top">
                    <span class="bullet"></span>
                    <div class="title" data-en="{{ $event->title_en ?: $event->title }}">{{ $event->title }}</div>
                  </div>
                  <div class="agenda-event-meta">
                    <span><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> {{ $event->event_date->format('d M Y') }}</span>
                    @if($event->event_time)
                      <span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> {{ \Carbon\Carbon::parse($event->event_time)->format('H.i') }} WIB</span>
                    @endif
                    @if($event->location)
                      <span><svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> {{ $event->location }}</span>
                    @endif
                  </div>
                </div>
              @endforeach
            @endif
        </div>

      </div>
    </div>
  </section>

 {{-- ================= GALERI KEGIATAN ================= --}}
<section id="galeri" class="galeri">
  <div class="galeri-inner">

    <div class="galeri-head">
      <div>
        <div class="eyebrow" data-en="DOCUMENTATION">DOKUMENTASI</div>
        <h2 data-en="Activity Gallery">Galeri Kegiatan</h2>
      </div>
      <a href="{{ route('galeri') }}" class="galeri-link"><span data-en="VIEW ALL GALLERY">LIHAT SEMUA GALERI</span> <span>→</span></a>
    </div>


    <div class="galeri-grid" id="galeriGrid">
      @forelse($galleries as $item)
        <div class="galeri-card {{ $item->size }}" data-category="{{ $item->category->slug ?? '' }}">
          <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
        </div>
      @empty
        <p style="color:#8a97a0;" data-en="No gallery photos yet.">Belum ada foto galeri.</p>
      @endforelse
    </div>
  </div>
</section>

{{-- ================= AKSES CEPAT & DOKUMEN ================= --}}
<section id="akses" class="akses-dokumen">
  <div class="akses-dokumen-inner">

    {{-- Kolom kiri: Layanan populer --}}
    <div class="akses-col">
      <div class="eyebrow" data-en="QUICK ACCESS">AKSES CEPAT</div>
      <h2>
        <span class="head-icon"><svg viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
        <span data-en="Popular Services">Layanan Populer</span>
      </h2>

      <div class="akses-list">
        <div class="akses-item">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18"/><path d="M8 2v4"/><path d="M16 2v4"/></svg></div>
          <div class="akses-item-body">
            <div class="title" data-en="Submit a Help Ticket">Ajukan Tiket Bantuan</div>
            <div class="desc" data-en="Report your technical issue">Laporkan kendala teknis Anda</div>
          </div>
          <div class="akses-arrow"><svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
        </div>

        <div class="akses-item">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><circle cx="8" cy="15" r="4"/><path d="M10.5 12.5 19 4"/><path d="M17 6l2 2"/><path d="M14 9l2 2"/></svg></div>
          <div class="akses-item-body">
            <div class="title" data-en="Reset Password">Reset Kata Sandi</div>
            <div class="desc" data-en="Recover access to your account">Pulihkan akses akun Anda</div>
          </div>
          <div class="akses-arrow"><svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
        </div>

        <div class="akses-item">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg></div>
          <div class="akses-item-body">
            <div class="title" data-en="Institutional Email Request">Permintaan Email Lembaga</div>
            <div class="desc" data-en="Create an official email account">Buat akun email resmi</div>
          </div>
          <div class="akses-arrow"><svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
        </div>

        <div class="akses-item">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg></div>
          <div class="akses-item-body">
            <div class="title" data-en="Network &amp; WiFi Access">Akses Jaringan &amp; WiFi</div>
            <div class="desc" data-en="Register a device on the network">Daftarkan perangkat ke jaringan</div>
          </div>
          <div class="akses-arrow"><svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
        </div>
      </div>
    </div>

    {{-- Kolom kanan: Publikasi & unduhan --}}
    <div class="akses-col">
      <div class="eyebrow">DOKUMEN</div>
      <h2>
        <span class="head-icon"><svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg></span>
        Publikasi &amp; Unduhan
      </h2>

      <div class="akses-list">
        <div class="akses-item dokumen">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
          <div class="akses-item-body">
            <div class="title">Laporan Kinerja 2025</div>
            <div class="desc">12 Jan 2026 · 2.4 MB</div>
          </div>
          <button class="dl-btn" aria-label="Unduh"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></button>
        </div>

        <div class="akses-item dokumen">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
          <div class="akses-item-body">
            <div class="title">Kebijakan Keamanan Informasi</div>
            <div class="desc">03 Nov 2025 · 1.1 MB</div>
          </div>
          <button class="dl-btn" aria-label="Unduh"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></button>
        </div>

        <div class="akses-item dokumen">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
          <div class="akses-item-body">
            <div class="title">Rencana Strategis TI 2025–2029</div>
            <div class="desc">20 Agu 2025 · 3.8 MB</div>
          </div>
          <button class="dl-btn" aria-label="Unduh"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></button>
        </div>

        <div class="akses-item dokumen">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
          <div class="akses-item-body">
            <div class="title">Panduan Layanan Mandiri</div>
            <div class="desc">15 Jul 2025 · 0.9 MB</div>
          </div>
          <button class="dl-btn" aria-label="Unduh"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></button>
        </div>
      </div>
    </div>
  </div>
  </section>
  </div>
  {{-- /.konten-batik --}}

{{-- ================= CTA BANTUAN TEKNIS ================= --}}
<section class="cta-bantuan">
  <div class="cta-bantuan-top">
    <div>
      <div class="eyebrow" data-en="NEED TECHNICAL HELP?">BUTUH BANTUAN TEKNIS?</div>
      <h2 data-en-html="Our team is ready to help <br> with your technical issues, <span class=&quot;accent&quot;>anytime.</span>">Tim kami siap membantu <br> kendala teknis Anda, <span class="accent">kapan saja.</span></h2>
    </div>

    <button class="cta-btn">
      <span class="icon"><svg viewBox="0 0 24 24"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg></span>
      <span data-en="VIEW SERVICE STATUS">LIHAT STATUS LAYANAN</span>
    </button>
  </div>

  <img src="{{ asset('images/dpr-footer.png') }}" alt="Gedung DPR RI" class="cta-footer-img">
</section>

{{-- ================= FOOTER ================= --}}
<footer class="footer">
  <div class="footer-inner">

    {{-- Kolom brand --}}
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

    {{-- Kolom tautan --}}
    <div class="footer-col">
      <span class="head" data-en="LINKS">TAUTAN</span>
      <div class="footer-links">
        <a href=""><span class="chev">›</span> <span data-en="Academic System">Sistem Akademik</span></a>
        <a href="#"><span class="chev">›</span> <span data-en="HR System">Sistem Kepegawaian</span></a>
        <a href="#"><span class="chev">›</span> <span data-en="Finance System">Sistem Keuangan</span></a>
        <a href="#"><span class="chev">›</span> PPID</a>
      </div>
    </div>

    {{-- Kolom bantuan --}}
    <div class="footer-col">
      <span class="head" data-en="HELP">BANTUAN</span>
      <div class="footer-links">
        <a href="#"><span class="chev">›</span> Helpdesk</a>
        <a href="#"><span class="chev">›</span> <span data-en="Complaints">Pengaduan</span></a>
        <a href="#"><span class="chev">›</span> FAQ</a>
        <a href="#"><span class="chev">›</span> Whistleblowing</a>
      </div>
    </div>

    {{-- Kolom kontak --}}
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
    <p data-en="© 2026 Pustekinfo. All rights reserved.">© 2026 Pustekinfo. Seluruh hak dilindungi.</p>
    <p data-en="Mockup reference — not an official site">Referensi mockup — bukan situs resmi</p>
  </div>
</footer>

<script>



const profilDropdown = document.getElementById("profilDropdown");
if (window.innerWidth <= 900) {
    profilDropdown.querySelector("a").addEventListener("click", (e) => {
        e.preventDefault();
        profilDropdown.classList.toggle("open");
    });
}
const counters = document.querySelectorAll('.stat-num');

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

// Tutup menu kalau salah satu link diklik
navLinks.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", () => {
        burgerBtn.classList.remove("open");
        navLinks.classList.remove("open");
    });
});



function animateCounter(counter) {
    const target = parseFloat(counter.dataset.target);
    const suffix = counter.dataset.suffix || '';
    const decimals = parseInt(counter.dataset.decimals || '0');
    const duration = 1500;
    const startTime = performance.now();

    function update(currentTime) {
        const progress = Math.min((currentTime - startTime) / duration, 1);
        const value = target * progress;
        counter.innerText = value.toLocaleString("id-ID", {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals
        }) + suffix;

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
    stat.addEventListener("click", () => {
        const counter = stat.querySelector(".stat-num");
        counter.innerText = "0";
        animateCounter(counter);
    });

});

const profileCounter = document.querySelector(".profil-media .num");
const profileCard = document.querySelector(".profil-media");

// Counter badge ".num" sudah tidak ada di markup saat ini (dihapus saat redesign) —
// guard ini mencegah error null reference selama elemennya belum dikembalikan.
if (profileCounter && profileCard) {

    function animateProfileCounter() {

        const target = parseInt(profileCounter.dataset.target);
        const duration = 1200;
        const startTime = performance.now();

        profileCounter.style.color = "var(--teal)"; // Reset warna saat animasi dimulai

        function update(currentTime){

            const progress = Math.min((currentTime - startTime) / duration, 1);
            const value = Math.floor(target * progress);

            profileCounter.innerText = value + "+";

            if(progress < 1){
                requestAnimationFrame(update);
            }else{
              profileCounter.style.color = "#0a2e45";
              profileCounter.style.textShadow = "0 0 15px rgba(212,179,120,.6)";
            }
        }

        requestAnimationFrame(update);
    }

    // Animasi saat pertama kali muncul
    const profileObserver = new IntersectionObserver(entries => {

        entries.forEach(entry => {

            if(entry.isIntersecting){
                animateProfileCounter();
                profileObserver.unobserve(entry.target);
            }

        });

    },{
        threshold:0.5
    });

    profileObserver.observe(profileCard);

    // Hover = hitung ulang
    profileCard.addEventListener("click",()=>{

        profileCounter.innerText = "0";
        animateProfileCounter();

    });
}

const profilSection = document.querySelector(".profil");

const profilObserver = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){
            entry.target.classList.add("show");
            profilObserver.unobserve(entry.target);
        }

    });

},{
    threshold:0.2
});

profilObserver.observe(profilSection);

const layananSection = document.querySelector(".layanan");

const layananObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            layananObserver.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.15
});

layananObserver.observe(layananSection);

const sambutanSection = document.querySelector(".sambutan");

const sambutanObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            sambutanObserver.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.2
});

sambutanObserver.observe(sambutanSection);


const beritaSection = document.querySelector(".berita");

const beritaObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            beritaObserver.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.15
});

beritaObserver.observe(beritaSection);

const agendaSection = document.querySelector(".agenda");

const agendaObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            agendaObserver.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.15
});

agendaObserver.observe(agendaSection);


const slides = document.querySelectorAll(".hero-slide");
const heroPrevBtn = document.querySelector(".hero-arrow-prev");
const heroNextBtn = document.querySelector(".hero-arrow-next");

let currentSlide = 0;
let heroAutoplay;

function setHeroSlide(index){
    slides[currentSlide].classList.remove("active");
    currentSlide = (index + slides.length) % slides.length;
    slides[currentSlide].classList.add("active");
}

function startHeroAutoplay(){
    heroAutoplay = setInterval(() => setHeroSlide(currentSlide + 1), 4000);
}

function restartHeroAutoplay(){
    clearInterval(heroAutoplay);
    startHeroAutoplay();
}

if (slides.length > 1) {
    startHeroAutoplay();

    heroNextBtn && heroNextBtn.addEventListener("click", () => {
        setHeroSlide(currentSlide + 1);
        restartHeroAutoplay();
    });

    heroPrevBtn && heroPrevBtn.addEventListener("click", () => {
        setHeroSlide(currentSlide - 1);
        restartHeroAutoplay();
    });
}

const profilSlides = document.querySelectorAll(".profil-slide");

if (profilSlides.length > 1) {

    let currentProfilSlide = 0;

    setInterval(() => {

        profilSlides[currentProfilSlide].classList.remove("active");

        currentProfilSlide = (currentProfilSlide + 1) % profilSlides.length;

        profilSlides[currentProfilSlide].classList.add("active");

    }, 3000);

}

const galeriFilters = document.querySelectorAll(".galeri-filter");
const galeriCards = document.querySelectorAll(".galeri-card");
const galeriGrid = document.getElementById("galeriGrid");

galeriFilters.forEach(btn => {
    btn.addEventListener("click", () => {
        galeriFilters.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const filter = btn.dataset.filter;
        galeriGrid.classList.toggle("filtered", filter !== "semua");

        galeriCards.forEach(card => {
            const match = filter === "semua" || card.dataset.category === filter;
            card.classList.toggle("hide", !match);
        });
    });
});

const galeriSection = document.querySelector(".galeri");
const galeriObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            galeriObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.15 });
galeriObserver.observe(galeriSection);

const aksesSection = document.querySelector(".akses-dokumen");
const aksesObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            aksesObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.15 });
aksesObserver.observe(aksesSection);

// ---- Samakan posisi pola batik section Layanan dengan pola batik di belakangnya (.konten-batik),
// supaya motifnya menyambung jadi satu, bukan mengulang terpisah dari section-nya sendiri. ----
(function () {
    const wrap = document.querySelector(".konten-batik");
    const layanan = document.querySelector(".layanan");
    if (!wrap || !layanan) return;

    function syncBatikOffset() {
        const offset = layanan.getBoundingClientRect().top - wrap.getBoundingClientRect().top;
        layanan.style.setProperty("--batik-offset-y", (-offset).toFixed(1) + "px");
    }

    syncBatikOffset();
    window.addEventListener("resize", syncBatikOffset);
    window.addEventListener("load", syncBatikOffset);

    // .layanan masih punya animasi reveal (translateY 60px -> 0) yang baru jalan belakangan
    // saat section-nya discroll ke viewport — posisi di atas dihitung sebelum animasi itu selesai,
    // jadi begitu section-nya bergeser naik, pola batiknya jadi tidak nyambung lagi. Resync tiap
    // frame selama animasi reveal berlangsung supaya polanya tetap menyambung sampai posisi akhir.
    const revealObserver = new MutationObserver(() => {
        if (!layanan.classList.contains("show")) return;
        revealObserver.disconnect();
        const start = performance.now();
        (function tick(now) {
            syncBatikOffset();
            if (now - start < 950) requestAnimationFrame(tick);
        })(start);
    });
    revealObserver.observe(layanan, { attributes: true, attributeFilter: ["class"] });
})();

// ---- Parallax: dari hero sampai galeri, dengan easing supaya gerakannya halus & natural ----
(function () {
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

    const heroEl = document.querySelector(".hero");
    const heroSlider = document.querySelector(".hero-slider");
    const heroContent = document.querySelector(".hero-content");

    if (!heroSlider) return;

    // Semakin kecil, gerakannya semakin "berat"/mengejar dengan lambat (terasa halus, bukan kaku).
    const EASE = 0.085;
    let heroCurrent = 0;
    let heroContentCurrent = 0;

    function frame() {
        if (heroEl && heroSlider) {
            const heroRect = heroEl.getBoundingClientRect();
            const heroHeight = heroEl.offsetHeight || 650;
            // 0 = hero baru terlihat, 1 = hero baru saja meninggalkan viewport bagian atas.
            const progress = Math.max(0, Math.min(1, -heroRect.top / heroHeight));

            const heroTarget = Math.max(-260, Math.min(260, -heroRect.top * 0.45));
            heroCurrent += (heroTarget - heroCurrent) * EASE;
            const scale = 1 + progress * 0.09;
            heroSlider.style.transform = `translateY(${heroCurrent.toFixed(1)}px) scale(${scale.toFixed(3)})`;

            if (heroContent) {
                const contentTarget = Math.max(-70, Math.min(70, -heroRect.top * 0.16));
                heroContentCurrent += (contentTarget - heroContentCurrent) * EASE;
                const fade = Math.max(0, 1 - progress * 1.7);
                heroContent.style.transform = `translateY(${heroContentCurrent.toFixed(1)}px)`;
                heroContent.style.opacity = fade.toFixed(2);
            }
        }

        requestAnimationFrame(frame);
    }

    requestAnimationFrame(frame);
})();

</script>

@include('partials.interactive-cursor')
</body>
</html>