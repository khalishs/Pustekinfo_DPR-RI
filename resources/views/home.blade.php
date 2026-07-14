{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pustekinfo - Pusat Teknologi Informasi DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">
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
  .stat-num,
  .profil-stat-card .num,
  .layanan-card .title,
  .feature .title,
  .akses-col h2,
  .akses-item-body .title,
  .berita-featured-body h3,
  .berita-item-body .title,
  .sambutan-content h2,
  .sambutan-photo .who .name,
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
 

  /* ---------- Hero ---------- */
  .hero{
    margin-top: 70px;
    position:relative;
    background: var(--white);
    min-height:523px;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    overflow:hidden;
    padding:10px 24px 70px;
  }
  .hero-slider{
    position:absolute;
    inset:0;
    overflow:hidden;
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
  .btn-primary{background:#067788;color:var(--white);}
  .btn-primary:hover{background:var(--teal);}
  .btn-ghost{background:transparent;color:var(--white);border-color:rgba(255,255,255,.6);}
  .btn-ghost:hover{background:rgba(255,255,255,.12);}


  /* ---------- Stats bar ---------- */
  .stats-bar{
    position:relative;
    z-index:3;
    margin:-60px 100px 0;
    background: linear-gradient(150deg,#073D5F 40%,#057888 100%);
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
    .nav-links{display:none;}

    .brand{gap:8px;min-width:0;}
    .brand-logo{width:36px;height:36px;flex-shrink:0;}
    .brand-text{min-width:0;}
    .brand-text .name{font-size:15px;white-space:nowrap;}
    .brand-text .sub{font-size:6.5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}


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
    .hero{margin-top:62px;padding:90px 20px 200px;}
    .hero-content h1{font-size:26px;}

    .stats-bar{
      grid-template-columns:repeat(2,1fr);
      margin:-90px 16px 0;
      border-radius:12px;
    }
    .stat{
      border-right:none;
      border-bottom:1px solid var(--line);
      gap:12px;
    }
    .stat:nth-last-child(-n+2){border-bottom:none;}
    .stat-icon{width:38px;height:38px;border-radius:10px;}
    .stat-icon svg{width:18px;height:18px;}
    .stat-num{font-size:19px;}
    .stat-label{font-size:11px;margin-top:4px;}
  }

  @media (max-width:420px){
    .btn-login{padding:8px 10px;}
  }

  /* ---------- Profil Singkat ---------- */
  .profil{
    background:var(--white);
    padding:70px 100px 110px;
    opacity:0;
    transform:translateY(80px);
    transition:
        opacity .9s ease,
        transform .9s ease;
  }

  .profil.show{opacity:1;transform:translateY(0);}
  .profil-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:80px;
    align-items:center;
    margin: 40px auto;
    max-width:1240px;
  }
  .profil-media{
    position: relative;
  }

  .profil-media:hover {
    transition:.3s;
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
  .profil-badge{
    position:absolute;
    top:0px;left:0px;
    background:var(--teal);
    color:var(--white);
    font-size:11px;
    font-weight:800;
    letter-spacing:.08em;
    padding:8px 14px;
    border-radius:1px 10px 1px 10px;
  }
  .profil-stat-card{
    position:absolute;
    right:-28px;
    bottom:-28px;
    background:var(--white);
    border-radius:8px 8px 1px 8px;
    padding:22px 26px;
    box-shadow:10px 10px 34px -14px rgba(11,34,51,.3);
    min-width:150px;
  }
  .profil-stat-card .num{
    color:#D4B378;
    font-size:28px;
    font-weight:800;
    line-height:1;
  }
  .profil-stat-card .label{
    margin-top:8px;
    color:#7a8a92;
    font-size:12.5px;
    font-weight:600;
  }

  .profil-copy .eyebrow{
    display:flex;
    align-items:center;
    gap:10px;
    color: var(--teal);
    font-size:12px;
    font-weight:800;
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
  .feature .icon{
    width: 30px; height: 30px;
    color: var(--teal);
    stroke:currentColor;
    line-height:1;
  }
  .feature .title{
    margin-top:12px;
    font-size:15px;
    font-weight:700;
    color:var(--navy);
  }
  .feature .desc{
    margin-top:6px;
    font-size:13.5px;
    line-height:1.6;
    color:#7a8a92;
  }

  @media (max-width:900px){
    .profil{padding:50px 20px 70px;}
    .profil-grid{grid-template-columns:1fr;gap:60px;}
    .profil-stat-card{right:16px;bottom:-24px;}
    .feature-row{gap:24px;}
  }

  /* ---------- Layanan (Apa yang kami kerjakan) ---------- */
  .layanan{
    position:relative;
    background:var(--navy);
    padding:150px 100px 110px;
    clip-path:polygon(0 64px, 100% 0, 100% 100%, 0 100%);
    margin-top:-64px;
    opacity:0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .layanan.show{opacity:1;transform:translateY(0);}

  .layanan-inner{
    max-width:1240px;
    margin:0 auto;
  }
  .layanan .eyebrow{
    display:flex;
    align-items:center;
    gap:10px;
    color:#D4B378;
    font-size:12px;
    font-weight:800;
    letter-spacing:.12em;
  }
  .layanan .eyebrow::before{
    content:"";
    width:22px;height:2px;
    background:#D4B378;
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
    background:radial-gradient(circle at top right, rgba(255,255,255,.14), transparent 45%);
    pointer-events:none;
}
  .layanan-card{
    background: linear-gradient(155deg,#073D5F 40%,#057888 100%);
    border:2px solid rgba(255,255,255,.12);
    border-radius:15px;
    padding:30px 28px;
    transition:background .3s ease, border-color .3s ease, box-shadow .3s ease;
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
    animation-play-state:paused;
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
    background:var(--mist);
    padding:90px 100px 110px;
    opacity: 0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .sambutan.show{opacity:1;transform:translateY(0);}
  
  .sambutan-inner{
    max-width:1240px;
    margin:0 auto;
  }
  .sambutan .eyebrow{
    display:flex;
    align-items:center;
    gap:10px;
    color:var(--teal);
    font-size:12px;
    font-weight:800;
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
    box-shadow:0 40px 70px -30px rgba(11,34,51,.35);
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
  .sambutan-photo .who .name{
    color:var(--white);
    font-size:16px;
    font-weight:700;
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
    margin-top:18px;
    font-style:italic;
    color:#6b7b83;
    font-size:14.5px;
    line-height:1.75;
    max-width:440px;
  }
  .sambutan-content .signature{
    margin-top:30px;
    font-family:'Dancing Script', cursive;
    font-weight:700;
    font-size:30px;
    color:var(--navy);
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
    background:var(--white);
    padding:90px 100px 120px;
    opacity:0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .berita.show{opacity:1;transform:translateY(0);}

  .berita-inner{max-width:1240px;margin:0 auto;}

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
    gap:10px;
    color:var(--teal);
    font-size:12px;
    font-weight:800;
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
    font-weight:800;
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
  }

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
    box-shadow:0 30px 60px -24px rgba(11,34,51,.35);
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
  .berita-featured-body{margin-top:auto;}
  .berita-featured-body h3{
    color:var(--white);
    font-size:23px;
    font-weight:800;
    line-height:1.35;
    max-width:420px;
  }
  .berita-featured-body p{
    margin-top:14px;
    color:rgba(255,255,255,.72);
    font-size:14px;
    line-height:1.75;
    max-width:420px;
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
  }

  /* --- List berita kecil --- */
  .berita-list{display:flex;flex-direction:column;}
  .berita-item{
    display:flex;
    gap:18px;
    padding:20px 0;
    border-bottom:1px solid #eef1f3;
  }
  .berita-item:first-child{padding-top:0;}
  .berita-item:last-child{border-bottom:none;padding-bottom:0;}

  .berita-thumb{
    flex-shrink:0;
    width:96px;
    height:76px;
    border-radius:8px;
    background:
      radial-gradient(120% 120% at 20% 15%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--teal) 100%);
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
    background:var(--mist);
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
    gap:10px;
    color:var(--teal);
    font-size:12px;
    font-weight:800;
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
    font-weight:800;
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
    box-shadow:0 30px 60px -30px rgba(11,34,51,.25);
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
  }
  .agenda-cal-nav button:hover{background:var(--mist);}
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
  }
  .agenda-day.muted{color:#c7d0d4;font-weight:500;}
  .agenda-day.today{
    background:rgba(20,128,140,.08);
    border:1.5px solid var(--teal);
    color:var(--teal);
    font-weight:800;
  }
  .agenda-day .dot{
    width:4px;height:4px;
    border-radius:50%;
    margin-top:3px;
  }
  .agenda-day .dot.c1{background:#e0a340;}
  .agenda-day .dot.c2{background:#b0413e;}
  .agenda-day .dot.c3{background:#1f9d7c;}

  .agenda-legend{
    margin-top:20px;
    padding-top:18px;
    border-top:1px solid #eef1f3;
    display:flex;
    gap:22px;
    flex-wrap:wrap;
  }
  .agenda-legend span{
    display:flex;
    align-items:center;
    gap:7px;
    font-size:12px;
    font-weight:600;
    color:#7a8a92;
  }
  .agenda-legend i{
    width:7px;height:7px;
    border-radius:50%;
    display:inline-block;
  }
  .agenda-legend i.c1{background:#e0a340;}
  .agenda-legend i.c2{background:#b0413e;}
  .agenda-legend i.c3{background:#1f9d7c;}

  /* --- Panel Hari Ini --- */
  .agenda-today{
    background:linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
    border-radius:16px;
    padding:26px 26px 30px;
    display:flex;
    flex-direction:column;
    box-shadow:0 30px 60px -30px rgba(11,34,51,.35);
  }
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
    margin-top:auto;
    padding-top:40px;
    text-align:center;
    color:rgba(255,255,255,.4);
    font-size:12.5px;
    font-weight:600;
  }

  @media (max-width:900px){
    .agenda{padding:60px 20px 80px;}
    .agenda-grid{grid-template-columns:1fr;gap:24px;}
    .agenda-cal{padding:22px 18px 18px;}
    .agenda-day{font-size:12.5px;}
  }
  /* ---------- Galeri Kegiatan ---------- */
.galeri{
  background:var(--white);
  padding:90px 100px 120px;
  opacity:0;
  transform:translateY(60px);
  transition:opacity .9s ease, transform .9s ease;
}
.galeri.show{opacity:1;transform:translateY(0);}

.galeri-inner{max-width:1240px;margin:0 auto;}

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
  gap:10px;
  color:var(--teal);
  font-size:12px;
  font-weight:800;
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
}

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
  background:var(--mist);
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
  gap:10px;
  color:var(--teal);
  font-size:12px;
  font-weight:800;
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
  box-shadow:0 6px 20px -10px rgba(11,34,51,.12);
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
.dl-btn svg{
  width:16px;height:16px;
  stroke:currentColor;
  fill:none;
  stroke-width:2;
  stroke-linecap:round;
  stroke-linejoin:round;
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

/* ---------- CTA Bantuan Teknis ---------- */
.cta-bantuan{
  position:relative;
  background:linear-gradient(120deg, var(--navy) 0%, var(--navy) 55%, var(--teal) 100%);
  padding:56px 100px;
  clip-path: polygon(0 0, 100% 34px, 100% 100%, 0 100%);
  margin-top:-35px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:30px;
  flex-wrap:wrap;
}

.cta-bantuan .eyebrow{
  display:flex;
  align-items:center;
  gap:10px;
  color:rgba(255,255,255,.65);
  font-size:12px;
  font-weight:800;
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
    padding:60px 20px 40px;
    clip-path:polygon(0 20px, 100% 0, 100% 100%, 0 100%);
    flex-direction:column;
    align-items:flex-start;
  }
  .cta-bantuan h2{font-size:20px;}
  .cta-btn{width:100%;justify-content:center;}
}

.footer-divider{
  margin-top: -1px;
    height: 3px;
    background:linear-gradient(10deg, #057888 0%, #0b2233 55% ,#0b2233 100%);
}
/* ---------- Footer ---------- */
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

/* --- Kolom brand --- */
.footer-brand{display:flex;align-items:center;gap:12px;}
.footer-brand-logo{
  width:50px;
  object-fit:contain;
}

.footer-brand-text .name{font-weight:800;font-size:23px;color:var(--white);line-height:1.1;}

.footer-brand-text .sub{font-size:10px;letter-spacing:.08em;color: var(--white);;font-weight:600;}

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
.footer-links a:hover{color:var(--white);}

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

  <nav class="navbar">
    <div class="brand">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo Pustekinfo" class="brand-logo">
      <div class="brand-text">
        <div class="name">PUSTEKINFO</div>
        <div class="sub">Sekretariat Jendral DPR RI</div>
      </div>
    </div>

    <ul class="nav-links">
      <li class="active"><a href="#">Beranda</a></li>
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
      <li><a href="#layanan">Layanan <span class="caret"></span></a></li>
      <li><a href="#">Informasi <span class="caret"></span></a></li>
      <li><a href="#">Galeri</a></li>
      <li><a href="#">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <button class="icon-btn" aria-label="Ganti tema">◐</button>
      <button class="lang-btn">EN</button>
      <button class="btn-login">Masuk</button>
      <button class="burger" id="burgerBtn" aria-label="Buka menu">
         <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  <header class="hero">
    <div class="hero-slider">
      <div class="hero-slide active" style="background-image:url('{{ asset('images/Hero-Pict1.jpeg') }}')"></div>
      <div class="hero-slide" style="background-image:url('{{ asset('images/Hero-Pict2.jpg') }}')"></div>
      <div class="hero-slide" style="background-image:url('{{ asset('images/Hero-Pict3.jpg') }}')"></div>
    </div>
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
      <div class="stat-icon">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
      </div>
      <div>
        <div class="stat-num" data-target="1250+">0</div>
        <div class="stat-label">Aplikasi Terkelola</div>
      </div>
    </div>
    <div class="stat">
      <div class="stat-icon">
        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/></svg>
      </div>
      <div>
        <div class="stat-num" data-target="135">0</div>
        <div class="stat-label">Karyawan Pustekinfo</div>
      </div>
    </div>
    <div class="stat">
      <div class="stat-icon">
        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <div>
        <div class="stat-num" data-target="12400">0</div>
        <div class="stat-label">Pengguna Terlayani</div>
      </div>
    </div>
    <div class="stat">
      <div class="stat-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
      </div>
      <div>
        <div class="stat-num" data-target="3.57">0</div>
        <div class="stat-label">Indeks SPBE</div>
      </div>
    </div>
  </section>

  <div class="spacer"></div>

  {{-- ================= PROFIL SINGKAT ================= --}}
  <section id="profil" class="profil">
    <div class="profil-grid">

      <div class="profil-media">
        <div class="profil-media-frame">
          <span class="profil-badge">TENTANG KAMI</span>
        </div>
        <div class="profil-stat-card">
          <div class="num" data-target="40+">0</div>
          <div class="label">Tahun melayani</div>
        </div>
      </div>

      <div class="profil-copy">
        <div class="eyebrow">PROFIL SINGKAT</div>
        <h2>Unit pendukung teknologi informasi lembaga</h2>
        <p>Bertanggung jawab atas pengelolaan jaringan, sistem informasi, data, dan keamanan siber di lingkungan lembaga, agar seluruh proses kerja berjalan efisien dan akuntabel.</p>

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
              <div class="title">Tugas pokok</div>
              <div class="desc">Mengelola infrastruktur TI, jaringan, dan pusat data.</div>
            </div>
            <div class="feature">
              <div class="icon">
                 <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="7" height="7"></rect><rect x="14" y="13" width="7" height="7"></rect><line x1="10" y1="7.5" x2="14" y2="7.5"></line><line x1="14" y1="7.5" x2="14" y2="16.5"></line></svg>
              </div>
              <div class="title">Fungsi utama</div>
              <div class="desc">Mengembangkan dan memelihara sistem lintas unit kerja.</div>
            </div>
          </div>
          <div class="feature-row">
            <div class="feature">
              <div class="icon">
               <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L5 5v6c0 5 3.5 9.5 7 11 3.5-1.5 7-6 7-11V5l-7-3z"></path><polyline points="9.5 11.5 11.5 13.5 15 10"></polyline></svg>
               </div>
              <div class="title">Keamanan</div>
              <div class="desc">Menjaga data sesuai standar ISO 27001.</div>
            </div>
            <div class="feature">
              <div class="icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"></circle><circle cx="17" cy="8" r="3"></circle><path d="M4 19c0-3 2.5-5 5-5s5 2 5 5"></path><path d="M13 19c0-2.5 2-4.5 5-4.5"></path></svg>
              </div>
              <div class="title">Pelayanan</div>
              <div class="desc">Dukungan teknis responsif untuk seluruh pengguna.</div>
            </div>
          </div>
      </div>

    </div>
  </section>

  {{-- ================= APA YANG KAMI KERJAKAN (LAYANAN) ================= --}}
  <section id="layanan" class="layanan">
    <div class="layanan-inner">
      <div class="eyebrow">APA YANG KAMI KERJAKAN</div>
      <h2>Layanan teknologi informasi menyeluruh</h2>

      <div class="layanan-grid">
        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg>
          </div>
          <div class="title">Jaringan &amp; internet</div>
          <div class="desc">Pengelolaan konektivitas dan infrastruktur jaringan di seluruh area kerja.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </div>
          <div class="title">Sistem informasi</div>
          <div class="desc">Pengembangan dan integrasi aplikasi layanan internal maupun publik.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
          </div>
          <div class="title">Helpdesk &amp; aduan</div>
          <div class="desc">Layanan pengaduan dan bantuan teknis untuk kendala perangkat maupun sistem.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5.2 3.4 9.9 8 11 4.6-1.1 8-5.8 8-11V5l-8-3z"/></svg>
          </div>
          <div class="title">Keamanan informasi</div>
          <div class="desc">Perlindungan data dan sistem dari ancaman siber sesuai standar keamanan.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>
          </div>
          <div class="title">Data center &amp; cloud</div>
          <div class="desc">Penyediaan infrastruktur penyimpanan data yang aman dan andal.</div>
        </div>

        <div class="layanan-card">
          <div class="icon">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </div>
          <div class="title">Pengelolaan website</div>
          <div class="desc">Pemeliharaan dan pembaruan portal resmi serta subdomain unit kerja.</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= SAMBUTAN PIMPINAN ================= --}}
  <section id="sambutan" class="sambutan">
    <div class="sambutan-inner">
      <div class="eyebrow">SAMBUTAN PIMPINAN</div>

      <div class="sambutan-card">
        <div class="sambutan-photo">
          {{-- ganti dengan foto asli kepala unit --}}
          {{-- <img src="{{ asset('images/kepala-unit.jpg') }}" alt="Kepala Pustekinfo"> --}}
          <div class="who">
            <div class="name">Nama Kepala Unit</div>
            <div class="role">KEPALA PUSTEKINFO</div>
          </div>
        </div>

        <div class="sambutan-content">
          <div class="quote-mark"><span></span><span></span></div>

          <div class="eyebrow">SELAMAT DATANG</div>
          <h2>Teknologi untuk pelayanan yang lebih baik</h2>
          <p class="desc">Kami berkomitmen menghadirkan layanan teknologi informasi yang andal untuk mendukung seluruh kegiatan lembaga, dari sistem akademik hingga keamanan data.</p>

          <div class="signature">Nama Kepala Unit</div>
          <div class="sign-role">Kepala Pusat Teknologi Informasi</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= BERITA & KEGIATAN ================= --}}
  <section id="berita" class="berita">
    <div class="berita-inner">

      <div class="berita-head">
        <div>
          <div class="eyebrow">KABAR TERBARU</div>
          <h2>Berita &amp; kegiatan</h2>
        </div>
        <a href="#" class="berita-link">SEMUA BERITA <span>→</span></a>
      </div>

      <div class="berita-grid">

        <div class="berita-featured">
          <span class="badge">SERTIFIKASI</span>

          <div class="berita-featured-body">
            <h3>Sertifikasi ISO 27001:2022 resmi diperoleh Pustekinfo</h3>
            <p>Setelah melalui proses audit menyeluruh selama enam bulan, sistem manajemen keamanan informasi Pustekinfo dinyatakan memenuhi standar internasional ISO 27001:2022.</p>

            <div class="meta">
              <span>
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                09 Juli 2025
              </span>
              <span>
                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Humas Pustekinfo
              </span>
              <span>
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                4 menit baca
              </span>
            </div>

            <a href="#" class="read-more">BACA SELENGKAPNYA</a>
          </div>
        </div>

        <div class="berita-list">

          <div class="berita-item">
            <div class="berita-thumb"></div>
            <div class="berita-item-body">
              <div class="cat">Pengumuman</div>
              <div class="title">Sosialisasi penerapan indeks PMD 2026</div>
              <div class="meta">
                <span>
                  <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  17 Nov 2025
                </span>
                <span>
                  <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  3 mnt
                </span>
              </div>
            </div>
          </div>

          <div class="berita-item">
            <div class="berita-thumb"></div>
            <div class="berita-item-body">
              <div class="cat">Sistem</div>
              <div class="title">Pembaruan sistem informasi terintegrasi</div>
              <div class="meta">
                <span>
                  <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  30 Okt 2025
                </span>
                <span>
                  <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  2 mnt
                </span>
              </div>
            </div>
          </div>

          <div class="berita-item">
            <div class="berita-thumb"></div>
            <div class="berita-item-body">
              <div class="cat">Pelatihan</div>
              <div class="title">Pelatihan literasi digital bagi staf</div>
              <div class="meta">
                <span>
                  <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  12 Okt 2025
                </span>
                <span>
                  <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  5 mnt
                </span>
              </div>
            </div>
          </div>

          <div class="berita-item">
            <div class="berita-thumb"></div>
            <div class="berita-item-body">
              <div class="cat">Layanan</div>
              <div class="title">Peluncuran portal layanan mandiri</div>
              <div class="meta">
                <span>
                  <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  28 Sep 2025
                </span>
                <span>
                  <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  3 mnt
                </span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  {{-- ================= AGENDA KEGIATAN ================= --}}
  <section id="agenda" class="agenda">
    <div class="agenda-inner">

      <div class="eyebrow">JADWAL</div>
      <h2>Agenda kegiatan</h2>

      <div class="agenda-grid">

        {{-- Kalender --}}
        <div class="agenda-cal">
          <div class="agenda-cal-head">
            <div class="month">Juli 2026</div>
            <div class="agenda-cal-nav">
              <button aria-label="Bulan sebelumnya">‹</button>
              <button aria-label="Bulan berikutnya">›</button>
              <button class="today-btn">Hari Ini</button>
            </div>
          </div>

          <div class="agenda-cal-daynames">
            <span>Senin</span><span>Selasa</span><span>Rabu</span><span>Kamis</span><span>Jumat</span><span>Sabtu</span><span>Minggu</span>
          </div>

          <div class="agenda-cal-days">
            <div class="agenda-day muted">29</div>
            <div class="agenda-day muted">30</div>
            <div class="agenda-day">1</div>
            <div class="agenda-day">2</div>
            <div class="agenda-day">3</div>
            <div class="agenda-day">4</div>
            <div class="agenda-day">5</div>

            <div class="agenda-day">6</div>
            <div class="agenda-day">7</div>
            <div class="agenda-day">8</div>
            <div class="agenda-day">9</div>
            <div class="agenda-day today">10<span class="dot c3"></span></div>
            <div class="agenda-day">11</div>
            <div class="agenda-day">12</div>

            <div class="agenda-day">13</div>
            <div class="agenda-day">14<span class="dot c1"></span></div>
            <div class="agenda-day">15</div>
            <div class="agenda-day">16</div>
            <div class="agenda-day">17</div>
            <div class="agenda-day">18</div>
            <div class="agenda-day">19</div>

            <div class="agenda-day">20</div>
            <div class="agenda-day">21</div>
            <div class="agenda-day">22<span class="dot c2"></span></div>
            <div class="agenda-day">23</div>
            <div class="agenda-day">24</div>
            <div class="agenda-day">25</div>
            <div class="agenda-day">26</div>

            <div class="agenda-day">27</div>
            <div class="agenda-day">28<span class="dot c3"></span></div>
            <div class="agenda-day">29</div>
            <div class="agenda-day">30</div>
            <div class="agenda-day">31</div>
            <div class="agenda-day muted">1</div>
            <div class="agenda-day muted">2</div>
          </div>

          <div class="agenda-legend">
            <span><i class="c1"></i>Tujuan Agenda 1</span>
            <span><i class="c2"></i>Tujuan Agenda 2</span>
            <span><i class="c3"></i>Tujuan Agenda 3</span>
          </div>
        </div>

        {{-- Panel Hari Ini --}}
        <div class="agenda-today">
          <div class="agenda-today-head">
            <div class="label">Hari Ini</div>
            <div class="date">10 Jul 2026</div>
          </div>

          <div class="agenda-event">
            <div class="agenda-event-top">
              <span class="bullet"></span>
              <div class="title">Rapat Koordinasi Tim TI</div>
            </div>
            <div class="agenda-event-meta">
              <span>
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                10.00 WIB
              </span>
              <span>
                <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Ruang rapat lantai 5
              </span>
            </div>
          </div>

          {{-- Kalau tidak ada agenda, tampilkan ini dan hapus .agenda-event di atas --}}
          {{-- <div class="agenda-today-empty">Tidak ada agenda hari ini</div> --}}
        </div>

      </div>
    </div>
  </section>

 {{-- ================= GALERI KEGIATAN ================= --}}
<section id="galeri" class="galeri">
  <div class="galeri-inner">

    <div class="galeri-head">
      <div>
        <div class="eyebrow">DOKUMENTASI</div>
        <h2>Galeri kegiatan</h2>
      </div>
      <a href="#" class="galeri-link">LIHAT SEMUA GALERI <span>→</span></a>
    </div>

    <div class="galeri-filters">
      <button class="galeri-filter active" data-filter="semua">Semua</button>
      <button class="galeri-filter" data-filter="pelatihan">Pelatihan</button>
      <button class="galeri-filter" data-filter="kegiatan">Kegiatan</button>
      <button class="galeri-filter" data-filter="kerjasama">Kerjasama</button>
      <button class="galeri-filter" data-filter="seremoni">Seremoni</button>
    </div>

    <div class="galeri-grid" id="galeriGrid">

      <div class="galeri-card big" data-category="seremoni">
        {{-- <img src="{{ asset('images/galeri-1.jpg') }}" alt="Penghargaan SPBE"> --}}
        <div class="icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg></div>
      </div>

      <div class="galeri-card med" data-category="kegiatan">
        {{-- <img src="{{ asset('images/galeri-2.jpg') }}" alt="Rapat Koordinasi"> --}}
        <div class="icon"><svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
      </div>

      <div class="galeri-card med" data-category="kerjasama">
        {{-- <img src="{{ asset('images/galeri-3.jpg') }}" alt="Kunjungan Kerja"> --}}
        <div class="icon"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
      </div>

      <div class="galeri-card wide" data-category="kerjasama">
        {{-- <img src="{{ asset('images/galeri-4.jpg') }}" alt="Penandatanganan MoU"> --}}
        <div class="icon"><svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
      </div>

      <div class="galeri-card small" data-category="kegiatan">
        {{-- <img src="{{ asset('images/galeri-5.jpg') }}" alt="Sosialisasi Indeks SPBE"> --}}
        <div class="icon"><svg viewBox="0 0 24 24"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/></svg></div>
      </div>

      <div class="galeri-card small" data-category="pelatihan">
        {{-- <img src="{{ asset('images/galeri-6.jpg') }}" alt="Pelatihan Keamanan Siber"> --}}
        <div class="icon"><svg viewBox="0 0 24 24"><path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1 3 3 6 3s6-2 6-3v-5"/></svg></div>
      </div>

      <div class="galeri-card small" data-category="kegiatan">
        {{-- <img src="{{ asset('images/galeri-7.jpg') }}" alt="Peluncuran Portal"> --}}
        <div class="icon"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg></div>
      </div>

      <div class="galeri-card small" data-category="seremoni">
        {{-- <img src="{{ asset('images/galeri-8.jpg') }}" alt="Audit ISO 27001"> --}}
        <div class="icon"><svg viewBox="0 0 24 24"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><line x1="9" y1="9" x2="9" y2="9.01"/><line x1="9" y1="13" x2="9" y2="13.01"/><line x1="15" y1="9" x2="15" y2="9.01"/><line x1="15" y1="13" x2="15" y2="13.01"/></svg></div>
      </div>

    </div>
  </div>
</section>

{{-- ================= AKSES CEPAT & DOKUMEN ================= --}}
<section id="akses" class="akses-dokumen">
  <div class="akses-dokumen-inner">

    {{-- Kolom kiri: Layanan populer --}}
    <div class="akses-col">
      <div class="eyebrow">AKSES CEPAT</div>
      <h2>
        <span class="head-icon"><svg viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
        Layanan populer
      </h2>

      <div class="akses-list">
        <div class="akses-item">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18"/><path d="M8 2v4"/><path d="M16 2v4"/></svg></div>
          <div class="akses-item-body">
            <div class="title">Ajukan tiket bantuan</div>
            <div class="desc">Laporkan kendala teknis Anda</div>
          </div>
          <div class="akses-arrow"><svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
        </div>

        <div class="akses-item">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><circle cx="8" cy="15" r="4"/><path d="M10.5 12.5 19 4"/><path d="M17 6l2 2"/><path d="M14 9l2 2"/></svg></div>
          <div class="akses-item-body">
            <div class="title">Reset kata sandi</div>
            <div class="desc">Pulihkan akses akun Anda</div>
          </div>
          <div class="akses-arrow"><svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
        </div>

        <div class="akses-item">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg></div>
          <div class="akses-item-body">
            <div class="title">Permintaan email lembaga</div>
            <div class="desc">Buat akun email resmi</div>
          </div>
          <div class="akses-arrow"><svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
        </div>

        <div class="akses-item">
          <div class="akses-icon"><svg viewBox="0 0 24 24"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg></div>
          <div class="akses-item-body">
            <div class="title">Akses jaringan &amp; WiFi</div>
            <div class="desc">Daftarkan perangkat ke jaringan</div>
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
        Publikasi &amp; unduhan
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

{{-- ================= CTA BANTUAN TEKNIS ================= --}}
<section class="cta-bantuan">
  <div>
    <div class="eyebrow">BUTUH BANTUAN TEKNIS?</div>
    <h2>Tim kami siap membantu <br> kendala teknis Anda, <span class="accent">kapan saja.</span></h2>
  </div>

  <button class="cta-btn">
    <span class="icon"><svg viewBox="0 0 24 24"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg></span>
    LIHAT STATUS LAYANAN
  </button>
</section>

<div class="footer-divider"></div>

{{-- ================= FOOTER ================= --}}
<footer class="footer">
  <div class="footer-inner">

    {{-- Kolom brand --}}
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
        <a href="https://www.instagram.com/pustekinfo.dprri?igsh=MTY1cDdvY21seThxMQ==" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/></svg></a>
        <a href="https://youtube.com/@pustekinfodprri?si=eZ7oP2mQUjhabPSB" aria-label="YouTube"><svg viewBox="0 0 24 24"><path d="M22 8.5a4 4 0 0 0-2.8-2.8C17.4 5.2 12 5.2 12 5.2s-5.4 0-7.2.5A4 4 0 0 0 2 8.5 41 41 0 0 0 2 12a41 41 0 0 0 0 3.5 4 4 0 0 0 2.8 2.8c1.8.5 7.2.5 7.2.5s5.4 0 7.2-.5a4 4 0 0 0 2.8-2.8A41 41 0 0 0 22 12a41 41 0 0 0 0-3.5z"/><polygon points="10 9 15 12 10 15"/></svg></a>
        <a href="#" aria-label="X"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></a>
      </div>
    </div>

    {{-- Kolom tautan --}}
    <div class="footer-col">
      <span class="head">TAUTAN</span>
      <div class="footer-links">
        <a href=""><span class="chev">›</span> Sistem Akademik</a>
        <a href="#"><span class="chev">›</span> Sistem Kepegawaian</a>
        <a href="#"><span class="chev">›</span> Sistem Keuangan</a>
        <a href="#"><span class="chev">›</span> PPID</a>
      </div>
    </div>

    {{-- Kolom bantuan --}}
    <div class="footer-col">
      <span class="head">BANTUAN</span>
      <div class="footer-links">
        <a href="#"><span class="chev">›</span> Helpdesk</a>
        <a href="#"><span class="chev">›</span> Pengaduan</a>
        <a href="#"><span class="chev">›</span> FAQ</a>
        <a href="#"><span class="chev">›</span> Whistleblowing</a>
      </div>
    </div>

    {{-- Kolom kontak --}}
    <div class="footer-col">
      <span class="head">KONTAK</span>
      <div class="footer-contact">
        <div class="item">
          <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          Gedung Setjen DPR RI Lantai 4, Jalan Jenderal Gatot Subroto, Senayan, Jakarta Pusat
        </div>
        <div class="item">
          <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          (021) 555-0172
        </div>
        <div class="item">
          <svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg>
          pustekinfo@lembaga.go.id
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

// Tutup menu kalau salah satu link diklik
navLinks.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", () => {
        burgerBtn.classList.remove("open");
        navLinks.classList.remove("open");
    });
});



function animateCounter(counter) {
    const target = parseFloat(counter.dataset.target);
    const duration = 1500;
    const startTime = performance.now();

    function update(currentTime) {
        const progress = Math.min((currentTime - startTime) / duration, 1);
        const value = target * progress;

        if (target === 135) {
            counter.innerText = Math.floor(value).toLocaleString("id-ID");
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
    stat.addEventListener("click", () => {
        const counter = stat.querySelector(".stat-num");
        counter.innerText = "0";
        animateCounter(counter);
    });

});

const profileCounter = document.querySelector(".profil-media .num");
const profileCard = document.querySelector(".profil-media");

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

let currentSlide = 0;

setInterval(() => {

    slides[currentSlide].classList.remove("active");

    currentSlide++;

    if(currentSlide >= slides.length){
        currentSlide = 0;
    }

    slides[currentSlide].classList.add("active");

}, 4000);

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

</script>
</body>
</html>