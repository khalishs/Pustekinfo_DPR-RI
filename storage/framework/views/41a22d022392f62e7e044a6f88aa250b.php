
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Layanan - Pustekinfo | Pusat Teknologi Informasi DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon-bg.png')); ?>">
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
    background-image:url('<?php echo e(asset('images/group-batik.png')); ?>');
    background-repeat:no-repeat;
    background-position:center top;
    background-size:10000px auto;
    filter:url(#batikBoostLight);
    opacity:.05;
  }
  [data-theme="dark"] body::before{
    filter:url(#batikTintTeal);
    opacity:.05;
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

  h1, h2, h3, h4,
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
  .navbar-logo{height:50px;width:190px;object-fit:contain;object-position:left center;
   pointer-events:none;}
  .brand{display:flex;align-items:center;gap:12px;}
  .brand-logo{width:50px;height:50px;object-fit:contain;}
  .nav-links{display:flex;align-items:center;gap:34px;}
  .nav-links li a{font-family: 'Plus Jakarta Sans', system-ui, sans-serif;font-size:14.5px;font-weight:600;color:#3c4a52;display:flex;align-items:center;gap:4px;}
  .nav-links li.active a{color:var(--teal);}
  .nav-links li.active{position:relative;}
  .nav-links li.active::after{content:"";position:absolute;left:0;right:0;bottom:-18px;height:2px;background:var(--teal);view-transition-name:nav-underline;}

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
    .navbar-logo{height:32px;width:122px;flex-shrink:0;}
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
  @media (max-width:900px){.hero-profil{margin-top:62px;padding:70px 20px 44px;}.hero-profil h1{font-size:24px;}}

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
    position:relative;transition:color .2s ease, transform .2s ease;flex-shrink:0;
  }
  .tab-link::after{
    content:"";position:absolute;left:0;right:0;bottom:-1px;height:2px;
    background:var(--teal);border-radius:2px 2px 0 0;
    transform:scaleX(0);transform-origin:left;opacity:.5;
    transition:transform .25s ease, opacity .25s ease;
  }
  .tab-link:hover{color:var(--white);transform:translateY(-1px);}
  .tab-link:hover::after{transform:scaleX(1);}
  .tab-link.active{color:var(--white);}
  .tab-link.active::after{transform:scaleX(1);opacity:1;}

  .tabs-nav-sticky{
    position:fixed;top:-70px;left:0;width:100%;z-index:9998;
    background:#073D5F;
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
    position:relative;
    border-radius:1px 16px 1px 16px;
    background:radial-gradient(120% 120% at 20% 15%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
    overflow:hidden;
    min-height:280px;
    box-shadow:0 30px 60px -30px rgba(11,34,51,.4);
    cursor:pointer;
    transition:box-shadow .35s ease;
  }
  .svc-icon-box:hover{
    box-shadow:0 30px 60px -30px rgba(11,34,51,.4), 0 0 50px -6px rgba(20,128,140,.6);
  }
  .svc-icon-box img{
    position:absolute;inset:0;
    width:100%;height:100%;object-fit:cover;
    transition:transform .5s ease;
  }
  .svc-icon-box:hover img{transform:scale(1.08);}

  .svc-content{display:flex;flex-direction:column;justify-content:center;}
  .svc-content > .desc{color:#5b6b73;font-size:14px;line-height:1.75;}

  .svc-features{margin-top:22px;display:grid;grid-template-columns:1fr 1fr;gap:12px;}
  .svc-feature{
    display:flex;align-items:center;gap:10px;
    padding:13px 16px;border-radius:10px;
    border:1px solid #e7ecee;background:var(--white);
    font-size:13px;font-weight:700;color:var(--navy);
    transition:transform .2s ease, border-color .2s ease, box-shadow .2s ease;
  }
  .svc-feature:hover{
    transform:translateY(-2px);
    border-color:var(--teal);
    box-shadow:0 12px 24px -16px rgba(20,128,140,.5);
  }
  .svc-feature-icon{
    width:22px;height:22px;border-radius:50%;flex-shrink:0;
    background:rgba(20,128,140,.1);color:var(--teal);
    display:flex;align-items:center;justify-content:center;
    transition:transform .3s cubic-bezier(.34,1.56,.64,1), background-color .2s ease, color .2s ease;
  }
  .svc-feature-icon svg{width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2.6;stroke-linecap:round;stroke-linejoin:round;}
  .svc-feature:hover .svc-feature-icon{background:var(--teal);color:var(--white);transform:scale(1.15) rotate(-8deg);}

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
  }
  @media (max-width:560px){
    .svc-features{grid-template-columns:1fr;}
  }

  /* ================= FOOTER (sama seperti halaman lain) ================= */
  .footer-divider{height:3px;background:linear-gradient(10deg, #057888 0%, #052D46 55%, #052D46 100%);}
  .footer{position:relative;background:#052D46;padding:64px 100px 0;overflow:hidden;}
  /* Motif batik dekoratif di ujung kiri footer — sama seperti beranda */
  .footer::before{
    content:"";position:absolute;inset:-40px 0 -80px;
    background-repeat:no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat;
    background-image:url('<?php echo e(asset('images/motif-batik.png')); ?>'),url('<?php echo e(asset('images/motif-batik.png')); ?>'),url('<?php echo e(asset('images/motif-batik.png')); ?>'),url('<?php echo e(asset('images/motif-batik.png')); ?>'),url('<?php echo e(asset('images/motif-batik.png')); ?>'),url('<?php echo e(asset('images/motif-batik.png')); ?>'),url('<?php echo e(asset('images/motif-batik.png')); ?>');
    background-position:left -100px bottom -30px,right -80px top -40px,30% 68%,35% 15%,55% 82%,75% 20%,90% 75%;
    background-size:480px auto,320px auto,150px auto,130px auto,170px auto,140px auto,220px auto;
    filter:brightness(0) invert(1);opacity:.5;pointer-events:none;z-index:0;
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
      opacity:.1;
    }
    .footer-inner{grid-template-columns:1fr 1fr;gap:36px;padding-bottom:40px;}
    .footer-brand-logo{width:150px;}
    .footer-bottom{flex-direction:column;text-align:center;padding:20px 0;}
  }
  @media (max-width:560px){.footer-inner{grid-template-columns:1fr;}}

  /* ---------- Dark mode ---------- */
  [data-theme="dark"] html{background:#0b1720;}
  [data-theme="dark"] body{background-color:#0e1b23;background-image:none;color:#c3cdd2;}

  [data-theme="dark"] .navbar{background:rgba(11,23,32,.92);border-bottom-color:rgba(255,255,255,.08);}
  .navbar-logo-dark{display:none;}
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
  [data-theme="dark"] .btn-login{background:#5FC0D1;color:#0b1720;}
  [data-theme="dark"] .btn-login:hover{background:#7fd3e0;}
  [data-theme="dark"] .profile-name{color:#eaf3f5;}
  [data-theme="dark"] .logout-btn{color:#ff8f8a;border-color:rgba(255,143,138,.35);}
  [data-theme="dark"] .logout-btn:hover{background:#b0413e;color:#fff;border-color:#b0413e;}

  @media (max-width:900px){
    [data-theme="dark"] .nav-links{background:#0f1e28;border-bottom-color:rgba(255,255,255,.08);}
    [data-theme="dark"] .nav-links li a{border-bottom-color:rgba(255,255,255,.06);}
  }

  /* ---- Layanan-specific dark overrides ---- */
  [data-theme="dark"] .hero-profil{background:#071219;}
  [data-theme="dark"] .hero-profil::before{background:radial-gradient(60% 60% at 85% 0%, rgba(95,192,209,.18), transparent 60%);}
  [data-theme="dark"] .breadcrumb{color:rgba(255,255,255,.4);}
  [data-theme="dark"] .breadcrumb span{color:#5FC0D1;}
  [data-theme="dark"] .hero-profil h1{color:#eaf3f5;}
  [data-theme="dark"] .hero-profil h1 .accent{color:#5FC0D1;}
  [data-theme="dark"] .hero-profil p{color:rgba(255,255,255,.6);}

  [data-theme="dark"] .tabs-nav{border-color:transparent;}
  [data-theme="dark"] .tabs-scroll{border-bottom-color:rgba(255,255,255,.1);}
  [data-theme="dark"] .tab-link{color:rgba(255,255,255,.45);}
  [data-theme="dark"] .tab-link:hover{color:#eaf3f5;}
  [data-theme="dark"] .tab-link.active{color:#eaf3f5;}
  [data-theme="dark"] .tab-link::after{background:#5FC0D1;}
  [data-theme="dark"] .tabs-nav-sticky{background:#071219;border-bottom-color:rgba(255,255,255,.08);box-shadow:0 12px 24px -18px rgba(0,0,0,.6);}

  [data-theme="dark"] .eyebrow{color:#5FC0D1;}
  [data-theme="dark"] .eyebrow.eyebrow-dash::before{background:#5FC0D1;}
  [data-theme="dark"] section.page-section:nth-child(even){background:#0f1e28;}
  [data-theme="dark"] .section-inner > h2{color:#eaf3f5;}

  [data-theme="dark"] .svc-icon-box{
    background:radial-gradient(120% 120% at 20% 15%, #5FC0D1 0%, transparent 55%),
      linear-gradient(160deg, #0b1720 0%, #0b1720 45%, #14839C 100%);
    box-shadow:0 30px 60px -30px rgba(0,0,0,.6);
  }
  [data-theme="dark"] .svc-icon-box:hover{
    box-shadow:0 30px 60px -30px rgba(0,0,0,.6), 0 0 50px -6px rgba(95,192,209,.65);
  }
  [data-theme="dark"] .svc-content > .desc{color:#8ea0a8;}
  [data-theme="dark"] .svc-feature{background:#122530;border-color:rgba(255,255,255,.1);color:#eaf3f5;}
  [data-theme="dark"] .svc-feature:hover{border-color:#5FC0D1;box-shadow:0 12px 24px -16px rgba(95,192,209,.4);}
  [data-theme="dark"] .svc-feature-icon{background:rgba(95,192,209,.15);color:#5FC0D1;}
  [data-theme="dark"] .svc-feature:hover .svc-feature-icon{background:#5FC0D1;color:#0b1720;}
  [data-theme="dark"] .svc-cta{background:rgba(95,192,209,.1);border-color:rgba(95,192,209,.25);color:#5FC0D1;}

  [data-theme="dark"] .footer-social a{border-color:rgba(255,255,255,.1);color:rgba(255,255,255,.6);}
  [data-theme="dark"] .footer-social a:hover{background:#5FC0D1;border-color:#5FC0D1;color:#0b1720;}
  [data-theme="dark"] .footer-col .head{border-bottom-color:#5FC0D1;}
  [data-theme="dark"] .footer-links a .chev{color:#5FC0D1;}
  [data-theme="dark"] .footer-links a:hover{color:#eaf3f5;}
  [data-theme="dark"] .footer-contact .item svg{stroke:#5FC0D1;}
  [data-theme="dark"] .footer-bottom{border-top-color:rgba(255,255,255,.08);}
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

  
  <nav class="navbar">
    <div class="brand">
      <img src="<?php echo e(asset('images/logo_pustekinfo_landscape.png')); ?>" alt="Logo Pustekinfo" class="navbar-logo navbar-logo-light">
      <img src="<?php echo e(asset('images/landscape_putih.png')); ?>" alt="Logo Pustekinfo" class="navbar-logo navbar-logo-dark">
    </div>

    <ul class="nav-links">
      <li><a href="<?php echo e(route('home')); ?>" data-en="Home">Beranda</a></li>
      <li><a href="<?php echo e(route('profil')); ?>" data-en="Profile">Profil </a></li>
      <li class="active"><a href="<?php echo e(route('layanan')); ?>" data-en="Services">Layanan</a></li>
      <li><a href="<?php echo e(route('informasi')); ?>" data-en="Information">Informasi</a></li>
      <li><a href="<?php echo e(route('galeri')); ?>" data-en="Gallery">Galeri</a></li>
      <li><a href="<?php echo e(route('kontak')); ?>" data-en="Contact">Kontak</a></li>
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

  
  <header class="hero-profil" <?php if($pageBanner?->image): ?> style="background-image:linear-gradient(160deg, rgba(7,61,95,.85) 0%, rgba(7,61,95,.7) 50%, rgba(20,131,156,.55) 100%), url('<?php echo e(asset($pageBanner->image)); ?>');background-size:cover;background-position:center;" <?php endif; ?>>
    <div class="hero-profil-inner">
      <p class="breadcrumb" data-en-html="Home / &lt;span&gt;Services&lt;/span&gt;">Beranda / <span>Layanan</span></p>
      <h1 data-en-html="Information Technology <span class=&quot;accent&quot;>Services</span>">Layanan <span class="accent">Teknologi Informasi</span></h1>
      <p data-en="Six pillars of information technology services that support the institution's digital operations at all times.">Enam pilar layanan teknologi informasi yang menopang operasional digital lembaga setiap saat.</p>
    </div>

    <div class="tabs-nav">
      <div class="tabs-scroll">
        <a href="#layanan-list" class="tab-link active" data-target="layanan-list">
          <span data-en="Services">Layanan</span>
        </a>
        <a href="<?php echo e(route('layanan.ajukan')); ?>" class="tab-link">
          <span data-en="Apply for a Service">Ajukan Layanan</span>
        </a>
        <a href="<?php echo e(route('layanan.status')); ?>" class="tab-link">
          <span data-en="Check Status">Lihat Status</span>
        </a>
      </div>
    </div>
  </header>

  <div class="tabs-nav-sticky" id="tabsSticky">
    <div class="tabs-scroll">
      <a href="#layanan-list" class="tab-link active" data-target="layanan-list">
        <span data-en="Services">Layanan</span>
      </a>
      <a href="<?php echo e(route('layanan.ajukan')); ?>" class="tab-link">
        <span data-en="Apply for a Service">Ajukan Layanan</span>
      </a>
      <a href="<?php echo e(route('layanan.status')); ?>" class="tab-link">
        <span data-en="Check Status">Lihat Status</span>
      </a>
    </div>
  </div>

  
  <div id="layanan-list">
  <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <section id="<?php echo e($s['id']); ?>" class="page-section">
      <div class="section-inner">
        <div class="eyebrow eyebrow-dash" data-en="INFORMATION TECHNOLOGY SERVICES">LAYANAN TEKNOLOGI INFORMASI</div>
        <h2 data-en="<?php echo e($s['title_en'] ?: $s['title']); ?>"><?php echo e($s['title']); ?></h2>

        <div class="svc-grid">
          <div class="svc-icon-box">
            <img src="<?php echo e(asset($s['icon'])); ?>" alt="<?php echo e($s['title']); ?>">
          </div>
          <div class="svc-content">
            <p class="desc" data-en="<?php echo e($s['desc_en'] ?: $s['desc']); ?>"><?php echo e($s['desc']); ?></p>

            <div class="svc-features">
              <?php $__currentLoopData = $s['features']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="svc-feature">
                  <span class="svc-feature-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></span>
                  <span data-en="<?php echo e(($s['features_en'][$i] ?? null) ?: $f); ?>"><?php echo e($f); ?></span>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="svc-cta">
              <svg viewBox="0 0 24 24"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
              <span data-en="<?php echo e($s['cta_en'] ?: $s['cta']); ?>"><?php echo e($s['cta']); ?></span>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <div class="footer-divider"></div>

  
  <footer class="footer">
    <div class="footer-inner">
      <div class="footer-col">
        <div class="footer-brand">
          <img src="<?php echo e(asset('images/landscape_putih.png')); ?>" alt="Logo Pustekinfo" class="footer-brand-logo">
        </div>
        <p class="footer-desc" data-en="Serving work units and the public in information technology, networking, and data security.">Melayani unit kerja dan masyarakat dalam bidang teknologi informasi, jaringan, dan keamanan data.</p>
        <div class="footer-social">
          <a href="<?php echo e($setting->instagram_url ?? '#'); ?>" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/></svg></a>
          <a href="<?php echo e($setting->youtube_url ?? '#'); ?>" aria-label="YouTube"><svg viewBox="0 0 24 24"><path d="M22 8.5a4 4 0 0 0-2.8-2.8C17.4 5.2 12 5.2 12 5.2s-5.4 0-7.2.5A4 4 0 0 0 2 8.5 41 41 0 0 0 2 12a41 41 0 0 0 0 3.5 4 4 0 0 0 2.8 2.8c1.8.5 7.2.5 7.2.5s5.4 0 7.2-.5a4 4 0 0 0 2.8-2.8A41 41 0 0 0 22 12a41 41 0 0 0 0-3.5z"/><polygon points="10 9 15 12 10 15"/></svg></a>
          <a href="<?php echo e($setting->x_url ?? '#'); ?>" aria-label="X"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></a>
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
          <div class="item">
            <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span data-en="<?php echo e($setting->address_en ?: ($setting->address ?? 'Address not set')); ?>"><?php echo e($setting->address ?? 'Alamat belum diatur'); ?></span>
          </div>
          <div class="item">
            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <?php echo e($setting->phone ?? '-'); ?>

          </div>
          <div class="item">
            <svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg>
            <?php echo e($setting->email ?? '-'); ?>

          </div>
        </div>
      </div>
    </div>

    <div class="footer-inner footer-bottom">
      <p data-en="© <?php echo e(date('Y')); ?> Pustekinfo. All rights reserved.">© <?php echo e(date('Y')); ?> Pustekinfo. Seluruh hak dilindungi.</p>
      <p data-en="Mockup reference — not an official site">Referensi mockup — bukan situs resmi</p>
    </div>
  </footer>

<script>

  // ---- Dark mode toggle ----
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

<?php echo $__env->make('partials.interactive-cursor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('partials.page-loading', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/layanan.blade.php ENDPATH**/ ?>