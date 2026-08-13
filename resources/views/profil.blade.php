{{-- resources/views/profil.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil - Pustekinfo | Pusat Teknologi Informasi DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">
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
    background:var(--white);
  }
  [data-theme="dark"] body::before{
    content:"";
    position:absolute;
    inset:0;
    z-index:-1;
    pointer-events:none;
    background-image:url('{{ asset('images/group-batik.png') }}');
    background-repeat:no-repeat;
    background-position:center top;
    background-size:10000px auto;
    filter:url(#batikTintTeal);
    opacity:.05;
  }
  @media (max-width:900px){
    body{background-size:3000px auto;}
    [data-theme="dark"] body::before{background-size:3000px auto;}
  }
  @view-transition{
    navigation:auto;
  }
  a{text-decoration:none;color:inherit;}
  ul{list-style:none;}
  img{max-width:100%;display:block;}

  h1, h2, h3, h4,
  .section-inner > h2,
  .dark-head h2,
  .timeline-year,
  .timeline-item h4,
  .info-card h4,
  .bio-dark-item span,
  .org-node strong,
  .unit-card h4,
  .vm-card h3,
  .value-card h4 {
    font-family:'Plus Jakarta Sans', system-ui, sans-serif;
  }

  /* ================= NAVBAR (sama seperti beranda) ================= */
  .navbar{
    display:flex;align-items:center;justify-content:space-between;
    padding:10px 48px;
    background:rgba(255,255,255,.95);
    backdrop-filter:blur(12px);
    border-bottom:1px solid #eaeaea;
    position:fixed;top:0;left:0;width:100%;z-index:9999;
    transform:translateY(0);
    transition:transform .35s ease;
  }
  .navbar-logo{height:50px;width:190px;object-fit:contain;object-position:left center;pointer-events:none;}
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
  .nav-dropdown a.active{background:var(--mist);color:var(--teal);}
  .nav-dropdown a .dd-icon{width:18px;height:18px;color:var(--gold);flex-shrink:0;}
  .nav-dropdown a .dd-icon svg{width:100%;height:100%;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
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

  /* ================= HERO PROFIL ================= */
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
  .hero-profil p{
    margin:20px auto 0;max-width:600px;color:rgba(255,255,255,.7);font-size:15px;line-height:1.75;font-weight:500;
  }
  @media (max-width:900px){.hero-profil{margin-top:62px;padding:70px 20px 44px;}.hero-profil h1{font-size:24px;}}

  /* ================= STICKY TABS (SCROLLSPY) ================= */
  .tabs-nav{
    position:relative;z-index:5;
    margin-top:46px;
  }
  .tabs-scroll{
    display:flex;gap:0;max-width:1240px;margin:0 auto;padding:0 24px;
    overflow-x:auto;scrollbar-width:none;
    border-bottom:1px solid rgba(255,255,255,.14);
  }
  .tabs-scroll::-webkit-scrollbar{display:none;}
  .tab-link{
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

  /* sticky pill saat sudah lewat hero */
  .tabs-nav-sticky{
    position:fixed;
    top:-70px;
    left:0;
    width:100%;
    z-index:9998;

    background:#073D5F;
    border-bottom:1px solid rgba(255,255,255,.1);
    box-shadow:0 12px 24px -18px rgba(11,34,51,.5);

    transition:.35s ease;
}

.tabs-nav-sticky.show{
    top:70px; /* tinggi navbar */
}
  .tabs-nav-sticky .tabs-scroll{border-bottom:none;}

  /* ================= GENERIC SECTION ================= */
  .eyebrow{
    display:flex;align-items:center;gap:8px;
    font-family: 'Work Sans', system-ui, sans-serif;
    color:var(--teal);font-size:12px;font-weight:700;letter-spacing:.12em;
  }
  .eyebrow svg{
    width:16px;height:16px;flex-shrink:0;
    stroke:currentColor;fill:none;stroke-width:2;
    stroke-linecap:round;stroke-linejoin:round;
  }
  .eyebrow.on-dark{color:var(--gold);}

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
  .section-inner > .desc{
    margin-top:16px;color:#5b6b73;font-size:14.5px;line-height:1.75;max-width:640px;
  }

  @media (max-width:900px){
    section.page-section{padding:60px 20px;}
    .tabs-nav-sticky.show{
        top:56px; /* sesuaikan dengan tinggi navbar mobile */
    }

    .tabs-scroll{    
    display:flex;
    justify-content:space-between;
    gap:0;
    padding:0;
    overflow-x:hidden;
}

.tab-link{
    flex:1;
    margin:0;
    padding:16px 4px;
    text-align:center;
    font-size:11px;
    white-space:normal;
    line-height:1.3;
}
  }

  /* ================= TIMELINE (Sejarah) ================= */
  .timeline{position:relative;padding-left:40px;margin-top:44px;}
  .timeline::before{
    content:"";position:absolute;left:9px;top:6px;bottom:6px;width:2px;
    background:linear-gradient(var(--teal), rgba(20,128,140,.15));
  }
  .timeline-item{position:relative;padding-bottom:38px;}
  .timeline-item:last-child{padding-bottom:0;}
  .timeline-dot{
    position:absolute;left:-40px;top:2px;width:20px;height:20px;border-radius:50%;
    background:var(--navy);border:3px solid var(--gold);
  }
  .timeline-year{
    display:inline-block;font-weight:800;color:var(--teal);font-size:18px;margin-bottom:6px;
  }
  .timeline-item h4{font-size:16px;font-weight:700;color:var(--navy);margin-bottom:6px;}
  .timeline-item p{color:#7a8a92;font-size:13.5px;line-height:1.65;max-width:520px;}

  .two-col{display:grid;grid-template-columns:1fr 1fr;gap:28px;margin-top:48px;}
  .info-card{
    background:var(--white);border-radius:1px 16px 1px 16px;padding:28px 30px;
    box-shadow:0 20px 40px -24px rgba(11,34,51,.2);
  }
  .info-card .eyebrow{margin-bottom:14px;}
  .info-card p{color:#5b6b73;font-size:13.5px;line-height:1.75;margin-bottom:12px;}
  .info-card p:last-child{margin-bottom:0;}

  .overview-card{
    margin-top:28px;
    background:linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
    border-radius:1px 16px 1px 16px;padding:34px;color:#fff;
    box-shadow:0 30px 60px -30px rgba(11,34,51,.4);
  }
  .overview-card .eyebrow{color:var(--gold);}
  .overview-card p{color:rgba(255,255,255,.72);font-size:13.5px;line-height:1.75;margin-top:14px;max-width:640px;}

  /* ================= SAMBUTAN PIMPINAN ================= */
  .sambutan-card{
    margin-top:34px;display:flex;background:var(--white);
    border-radius:1px 16px 1px 16px;overflow:hidden;
    box-shadow:0 40px 70px -30px rgba(11,34,51,.35);
  }
  .sambutan-photo{
    flex:0 0 38%;position:relative;min-height:360px;
    display:flex;align-items:flex-end;padding:32px;
    background:radial-gradient(120% 120% at 25% 20%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--navy) 50%, var(--teal) 100%);
  }
  .sambutan-photo .who .name{color:#fff;font-size:17px;font-weight:700;letter-spacing:-.005em;text-shadow:0 2px 10px rgba(0,0,0,.65), 0 1px 3px rgba(0,0,0,.6);}
  .sambutan-photo .who .role{margin-top:4px;color:rgba(255,255,255,.85);font-size:11px;font-weight:700;letter-spacing:.1em;text-shadow:0 2px 10px rgba(0,0,0,.65), 0 1px 3px rgba(0,0,0,.6);}
  .sambutan-content{flex:1;position:relative;padding:50px 56px;display:flex;flex-direction:column;justify-content:center;}
  .sambutan-content .quote-mark{position:absolute;top:40px;right:48px;display:flex;gap:5px;}
  .sambutan-content .eyebrow{color:var(--teal);}
  .sambutan-content .desc{margin-top:16px;font-style:italic;color:#6b7b83;font-size:14px;line-height:1.75;border-left: 2px solid #057888 ;max-width:440px; padding-left: 10px;}
  .sambutan-content .sign-role{margin-top:16px;color:#7a8a92;font-size:13px;font-weight:500;}
  @media (max-width:900px){
    .sambutan-card{flex-direction:column;}
    .sambutan-photo{min-height:200px;}
    .sambutan-content{padding:36px 26px;}
  }

  /* ================= POLA BATIK (sama seperti beranda) ================= */
  .konten-batik{
    position:relative;
    z-index:0;
    background-color:#14839C1A;
  }
  .konten-batik::before{
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
    opacity:.05;
  }
  [data-theme="dark"] .konten-batik{background-color:#0e1b23;}
  [data-theme="dark"] .konten-batik::before{filter:url(#batikTintTeal);opacity:.05;}

  /* section putih/mist bergantian dimatikan di dalam area batik, supaya
     polanya tetap terlihat sampai bawah — sama seperti di beranda */
  .konten-batik section.page-section:nth-child(even){background:transparent;}
  @media (max-width:900px){
    .konten-batik::before{background-size:3000px auto;}
  }

  /* ================= SECTION NAVY (dark) — sama seperti section navy di beranda ================= */
  section.page-section.dark{
    position:relative;
    background:linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%) !important;
    overflow:hidden;
  }
  section.page-section.dark::before{
    content:"";
    position:absolute;inset:0;
    background-image:url('{{ asset('images/group-batik.png') }}');
    background-repeat:no-repeat;
    background-position:center top;
    background-size:10000px auto;
    filter:brightness(0) invert(1);
    opacity:.1;
    pointer-events:none;
    z-index:0;
  }
  section.page-section.dark .section-inner{position:relative;z-index:1;}
  @media (max-width:900px){
    section.page-section.dark::before{background-size:1600px auto;}
  }
  .dark-head{
    display:flex;align-items:center;gap:14px;margin-bottom:8px;
  }
  .dark-head .badge{
    width:38px;height:38px;border-radius:10px;flex-shrink:0;
    background:rgba(20,128,140,.1);
    display:flex;align-items:center;justify-content:center;
  }
  .dark-head .badge svg{
    width:18px;height:18px;stroke:var(--teal);fill:none;stroke-width:2;
    stroke-linecap:round;stroke-linejoin:round;
  }
  .dark-head h2{
    margin:0;font-size:22px;font-weight:800;color:var(--navy);letter-spacing:-.01em;
  }

  /* ================= BIODATA (versi navy, tanpa kartu putih) ================= */
  .bio-card{
    margin-top:36px;
    background:var(--white);
    border-radius:16px;
    padding:8px 32px;
    box-shadow:0 16px 32px -22px rgba(11,34,51,.2);
  }
  .bio-dark-grid{
    display:grid;grid-template-columns:1fr 1fr;
    column-gap:56px;
  }
  .bio-dark-item{
    display:flex;align-items:center;justify-content:space-between;gap:24px;
    padding:18px 0;border-bottom:1px solid #e7ecee;
  }
  .bio-dark-item:nth-child(n+5){border-bottom:none;}
  .bio-dark-item label{font-size:13px;color:#8a97a0;font-weight:600;}
  .bio-dark-item span{font-size:14px;font-weight:700;color:var(--navy);text-align:right;}
  @media (max-width:700px){
    .bio-card{padding:6px 20px;}
    .bio-dark-grid{grid-template-columns:1fr;column-gap:0;}
    .bio-dark-item:nth-child(n+5){border-bottom:1px solid #e7ecee;}
    .bio-dark-item:last-child{border-bottom:none;}
  }

  /* ================= BAGAN ORGANISASI ================= */
  .org-chart{margin-top:48px;display:flex;flex-direction:column;align-items:center;}
  .org-node{
    background:var(--white);border-radius:16px;padding:22px 26px;text-align:center;
    box-shadow:0 16px 32px -20px rgba(11,34,51,.2);min-width:220px;max-width:280px;
    border:1.5px solid rgba(20,131,156,.22);
    transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
  }
  .org-row .org-node{position:relative;}
  .org-row .org-node:hover{transform:translateY(-5px);box-shadow:0 22px 40px -18px rgba(11,34,51,.28);border-color:rgba(20,131,156,.45);}
  .org-node-photo{
    width:60px;height:60px;border-radius:50%;margin:0 auto 14px;
    background:radial-gradient(120% 120% at 20% 15%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
    background-size:cover;background-position:center;
    border:3px solid rgba(20,131,156,.3);
    box-shadow:0 6px 16px -6px rgba(11,34,51,.35);
  }
  .org-node strong{display:block;font-size:15px;font-weight:800;color:var(--navy);letter-spacing:-.005em;}
  .org-node .org-node-name{display:block;margin-top:5px;font-size:12.5px;font-weight:700;color:var(--teal);}
  .org-node .org-node-desc{display:block;margin-top:8px;font-size:12px;line-height:1.55;color:#8a97a0;}
  .org-node.top{
    background:linear-gradient(150deg,var(--navy) 40%,var(--teal) 100%);
    border-color:transparent;
    padding:26px 32px;
    box-shadow:0 22px 44px -18px rgba(11,34,51,.4);
  }
  .org-node.top strong{color:#fff;font-size:16px;}
  .org-node.top .org-node-name{color:#bfe9f1;}
  .org-node.top .org-node-desc{color:rgba(255,255,255,.68);}
  .org-node.top .org-node-photo{border-color:rgba(255,255,255,.55);}

  .org-connector{width:2px;height:32px;background:linear-gradient(180deg, rgba(20,131,156,.55), rgba(20,131,156,.15));}

  .org-row{
    position:relative;display:flex;gap:30px;flex-wrap:wrap;justify-content:center;
    margin-top:0;padding-top:26px;
  }
  .org-row::before{
    content:"";position:absolute;top:0;left:10%;right:10%;height:2px;
    background:rgba(20,131,156,.28);
  }
  .org-row .org-node::before{
    content:"";position:absolute;top:-26px;left:50%;width:2px;height:26px;
    background:rgba(20,131,156,.28);transform:translateX(-50%);
  }
  @media (max-width:640px){
    .org-row{flex-direction:column;align-items:center;padding-top:0;}
    .org-row::before{display:none;}
    .org-row .org-node::before{content:"";position:static;display:block;width:2px;height:26px;margin:0 auto;background:rgba(20,131,156,.28);transform:none;}
  }

  .unit-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:44px;}
  .unit-card{
    background:var(--white);border-radius:14px;padding:26px 22px;
    box-shadow:0 16px 32px -22px rgba(11,34,51,.2);
    transition:transform .25s ease, box-shadow .25s ease;
  }
  .unit-card:hover{transform:translateY(-6px);box-shadow:0 22px 38px -18px rgba(11,34,51,.3);}
  .unit-icon{
    width:44px;height:44px;border-radius:10px;background:rgba(20,128,140,.1);color:var(--teal);
    display:flex;align-items:center;justify-content:center;
  }
  .unit-icon svg{width:20px;height:20px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
  .unit-card h4{margin-top:16px;font-size:14.5px;font-weight:700;color:var(--navy);}
  .unit-card p{margin-top:8px;font-size:12.5px;color:#8a97a0;line-height:1.6;}
  @media (max-width:900px){.unit-grid{grid-template-columns:1fr 1fr;}}
  @media (max-width:560px){.unit-grid{grid-template-columns:1fr;}}

  /* ================= VISI MISI ================= */
  .vm-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:44px;}
  .vm-card{
    background:var(--white);border-radius:1px 16px 1px 16px;padding:32px;
    box-shadow:0 20px 40px -24px rgba(11,34,51,.2);
  }
  .vm-card.dark{
    background:linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
    color:#fff;
  }
  .vm-card.dark .eyebrow{color:var(--teal);}
  .vm-card h3{margin-top:16px;font-size:18px;font-weight:800;}
  .vm-card.dark h3{color:#fff;}
  .vm-card:not(.dark) h3{color:var(--navy);}
  .vm-card p{margin-top:12px;color:rgba(255,255,255,.75);font-size:14px;line-height:1.75;}
  .vm-card ol{margin-top:14px;padding-left:18px;color:#5b6b73;font-size:13.5px;line-height:1.7;}
  .vm-card ol li{margin-bottom:10px;padding-left:4px;}
  @media (max-width:900px){.vm-grid{grid-template-columns:1fr;}}

  .values-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:44px;}
  .value-card{
    background:var(--white);border-radius:14px;padding:24px 22px;
    box-shadow:0 16px 32px -22px rgba(11,34,51,.2);
    transition:transform .25s ease, box-shadow .25s ease;
    text-align: center;
  }
  .value-card:hover{transform:translateY(-6px);box-shadow:0 22px 38px -18px rgba(11,34,51,.3);}
  .value-icon{
    width:40px;height:40px;border-radius:10px;background:rgba(201,163,78,.14);color:var(--teal);
    display:flex;align-items:center;justify-content:center;
    margin: 0 auto;
  }
  .value-icon svg{width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
  .value-card h4{margin-top:14px;font-size:14.5px;font-weight:700;color:var(--navy);}
  .value-card p{padding:10px 10px 30px;margin-top:6px;font-size:12.5px;color:#8a97a0;line-height:1.6;}
  .values-section{
    background:var(--ink) !important;
  }
  .values-section .eyebrow{
    color:#fff;
  }
  @media (max-width:900px){.values-grid{grid-template-columns:1fr 1fr;}}
  @media (max-width:560px){.values-grid{grid-template-columns:1fr;}}

  /* ================= FOOTER (sama seperti beranda) ================= */
  .footer-divider{height:3px;background:linear-gradient(10deg, #057888 0%, #052D46 55%, #052D46 100%);}
  .footer{position:relative;background:#052D46;padding:64px 100px 0;overflow:hidden;}
  .footer::before{
    content:"";position:absolute;inset:0;z-index:0;pointer-events:none;
    background-image:url('{{ asset('images/batik_footer.png') }}');
    background-repeat:no-repeat;background-position:center center;background-size:cover;
    opacity:.08;filter:brightness(0) invert(1);
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
      background-size:180% auto;
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

  /* ---------- Dark mode: halaman Profil ---------- */

  /* Section umum (Tentang Kami, Profil Pimpinan, Struktur Organisasi, Visi & Misi) */
  [data-theme="dark"] section.page-section:nth-child(even){background:#122530;}
  [data-theme="dark"] .section-inner > h2{color:#eaf3f5;}
  [data-theme="dark"] .section-inner > .desc{color:#8ea0a8;}

  /* Header ber-badge (dark-head) & biodata singkat */
  [data-theme="dark"] .dark-head h2{color:#eaf3f5;}
  [data-theme="dark"] .bio-card{background:#122530;box-shadow:0 16px 32px -20px rgba(0,0,0,.5);}
  [data-theme="dark"] .bio-dark-item{border-bottom-color:rgba(255,255,255,.1);}
  [data-theme="dark"] .bio-dark-item label{color:#8ea0a8;}
  [data-theme="dark"] .bio-dark-item span{color:#eaf3f5;}

  [data-theme="dark"] #tentang-kami > .section-inner > .eyebrow,
  [data-theme="dark"] #profil-pimpinan > .section-inner > .eyebrow,
  [data-theme="dark"] #struktur-organisasi > .section-inner > .eyebrow,
  [data-theme="dark"] #visi-misi > .section-inner > .eyebrow,
  [data-theme="dark"] .sambutan-content .eyebrow,
  [data-theme="dark"] .vm-card:not(.dark) .eyebrow{
    color:#5FC0D1;
  }

  /* Timeline (Sejarah) */
  [data-theme="dark"] .timeline-year{color:#5FC0D1;}
  [data-theme="dark"] .timeline-item h4{color:#eaf3f5;}
  [data-theme="dark"] .timeline-item p{color:#8ea0a8;}
  [data-theme="dark"] .timeline-dot{background:#122530;}

  /* Sambutan Pimpinan (kartu putih) */
  [data-theme="dark"] .sambutan-card{background:#122530;box-shadow:0 40px 70px -30px rgba(0,0,0,.6);}
  [data-theme="dark"] .sambutan-content .desc{color:#8ea0a8;}
  [data-theme="dark"] .sambutan-content .sign-role{color:#8ea0a8;}

  /* Bagan organisasi */
  [data-theme="dark"] .org-node{background:#122530;box-shadow:0 16px 32px -20px rgba(0,0,0,.5);border-color:rgba(255,255,255,.1);}
  [data-theme="dark"] .org-row .org-node:hover{border-color:rgba(95,192,209,.4);}
  [data-theme="dark"] .org-node strong{color:#eaf3f5;}
  [data-theme="dark"] .org-node .org-node-name{color:#5FC0D1;}
  [data-theme="dark"] .org-node .org-node-desc{color:#8ea0a8;}
  [data-theme="dark"] .org-node-photo{border-color:rgba(255,255,255,.14);}
  [data-theme="dark"] .org-connector{background:rgba(255,255,255,.14);}
  [data-theme="dark"] .org-row::before,
  [data-theme="dark"] .org-row .org-node::before{background:rgba(255,255,255,.14);}

  /* Visi & Misi (kartu MISI, versi terang) */
  [data-theme="dark"] .vm-card:not(.dark){background:#122530;box-shadow:0 20px 40px -24px rgba(0,0,0,.5);}
  [data-theme="dark"] .vm-card:not(.dark) h3{color:#eaf3f5;}
  [data-theme="dark"] .vm-card ol{color:#c3cdd2;}
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
      <img src="{{ asset('images/logo_pustekinfo_landscape.png') }}" alt="Logo Pustekinfo" class="navbar-logo navbar-logo-light">
      <img src="{{ asset('images/landscape_putih.png') }}" alt="Logo Pustekinfo" class="navbar-logo navbar-logo-dark">
    </div>

    <ul class="nav-links">
      <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}" data-en="Home">Beranda</a></li>
      <li class="{{ request()->routeIs('profil') ? 'active' : '' }}"><a href="{{ route('profil') }}" data-en="Profile">Profil</a></li>
      <li class="{{ request()->routeIs('layanan') ? 'active' : '' }}"><a href="{{ route('layanan') }}" data-en="Services">Layanan</a></li>
      <li class="{{ request()->routeIs('informasi') ? 'active' : '' }}"><a href="{{ route('informasi') }}" data-en="Information">Informasi</a></li>
      <li class="{{ request()->routeIs('galeri') ? 'active' : '' }}"><a href="{{ route('galeri') }}" data-en="Gallery">Galeri</a></li>
      <li class="{{ request()->routeIs('kontak') ? 'active' : '' }}"><a href="{{ route('kontak') }}" data-en="Contact">Kontak</a></li>
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
  <header class="hero-profil" @if($pageBanner?->image) style="background-image:linear-gradient(160deg, rgba(7,61,95,.85) 0%, rgba(7,61,95,.7) 50%, rgba(20,131,156,.55) 100%), url('{{ asset($pageBanner->image) }}');background-size:cover;background-position:center;" @endif>
    <div class="hero-profil-inner">
      <p class="breadcrumb" data-en-html="Home / &lt;span&gt;Profile&lt;/span&gt;">Beranda / <span>Profil</span></p>
      <h1 data-en="Getting to know Pustekinfo better">Mengenal lebih dekat Pustekinfo</h1>
      <p data-en="Center for Information Technology — the unit that supports the institution's digital services, network, data, and information security.">Pusat Teknologi Informasi — unit yang menopang layanan digital, jaringan, data, dan keamanan informasi lembaga.</p>
    </div>

    {{-- Tab nav utama (di dalam hero) --}}
    <div class="tabs-nav">
      <div class="tabs-scroll">
        <a href="#tentang-kami" class="tab-link active" data-target="tentang-kami" data-en="About Us">Tentang Kami</a>
        <a href="#profil-pimpinan" class="tab-link" data-target="profil-pimpinan" data-en="Leadership Profile">Profil Pimpinan</a>
        <a href="#struktur-organisasi" class="tab-link" data-target="struktur-organisasi" data-en="Organizational Structure">Struktur Organisasi</a>
        <a href="#visi-misi" class="tab-link" data-target="visi-misi" data-en="Vision &amp; Mission">Visi &amp; Misi</a>
      </div>
    </div>
  </header>

  {{-- Tab nav sticky (muncul saat sudah scroll melewati hero) --}}
  <div class="tabs-nav-sticky" id="tabsSticky">
    <div class="tabs-scroll">
      <a href="#tentang-kami" class="tab-link active" data-target="tentang-kami" data-en="About Us">Tentang Kami</a>
      <a href="#profil-pimpinan" class="tab-link" data-target="profil-pimpinan" data-en="Leadership Profile">Profil Pimpinan</a>
      <a href="#struktur-organisasi" class="tab-link" data-target="struktur-organisasi" data-en="Organizational Structure">Struktur Organisasi</a>
      <a href="#visi-misi" class="tab-link" data-target="visi-misi" data-en="Vision &amp; Mission">Visi &amp; Misi</a>
    </div>
  </div>

  <div class="konten-batik">

  {{-- ================= TENTANG KAMI ================= --}}
  <section id="tentang-kami" class="page-section">
    <div class="section-inner">
      <div class="eyebrow">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 14"/></svg>
        <span data-en="AGENCY HISTORY">SEJARAH INSTANSI</span>
      </div>
      <h2 data-en="Pustekinfo's Long Journey">Perjalanan Panjang Pustekinfo</h2>
      <p class="desc" data-en="Pustekinfo has gone through a long journey following technological developments, from a simple data processing unit to an information technology center that manages the institution's digital infrastructure.">
        Pustekinfo telah melalui perjalanan panjang mengikuti perkembangan teknologi, dari unit
        pengolahan data sederhana hingga menjadi pusat teknologi informasi yang mengelola
        infrastruktur digital lembaga.
      </p>

      <div class="timeline">
        @forelse($timeline as $t)
          <div class="timeline-item">
            <span class="timeline-dot"></span>
            <span class="timeline-year">{{ $t->year }}</span>
            <h4 data-en="{{ $t->title_en ?: $t->title }}">{{ $t->title }}</h4>
            <p data-en="{{ $t->description_en ?: $t->description }}">{{ $t->description }}</p>
          </div>
        @empty
          <p style="color:#8a97a0;" data-en="No agency history data yet.">Belum ada data sejarah instansi.</p>
        @endforelse
      </div>
  </div>
  </section>
  <section id="profil-pimpinan" class="page-section">
    <div class="section-inner">
      <div class="eyebrow">
        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <span data-en="LEADERSHIP MESSAGE">SAMBUTAN PIMPINAN</span>
      </div>
      <h2 data-en="A Message from the Head of Pustekinfo">Kata Sambutan Kepala Pustekinfo</h2>

      <div class="sambutan-card">
        <div class="sambutan-photo" @if($leadership?->photo) style="background-image:url('{{ asset($leadership->photo) }}');background-size:cover;background-position:center;" @endif>
        <div class="who">
          @if($leadership?->show_name && $leadership?->name)
            <div class="name">{{ $leadership->name }}</div>
          @endif
          <div class="role">{{ $leadership->position ?? 'KEPALA PUSTEKINFO' }}</div>
        </div>
      </div>
      <div class="sambutan-content">
        <div class="eyebrow">
          <svg viewBox="0 0 24 24"><path d="M8 12a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/><path d="M12 21c0-4-3-7-3-7s-3 3-3 7"/></svg>
          <span data-en="WELCOME">SELAMAT DATANG</span>
        </div>
        <p class="desc" data-en="{{ ($leadership->description_en ?? null) ?: ($leadership->description ?? 'The leadership message has not been filled in via the admin panel.') }}">{{ $leadership->description ?? 'Sambutan pimpinan belum diisi lewat panel admin.' }}</p>
        <div class="sign-role" data-en="{{ ($leadership->signature_role_en ?? null) ?: ($leadership->signature_role ?? 'Head of Information Technology Center') }}">{{ $leadership->signature_role ?? 'Kepala Pusat Teknologi Informasi' }}</div>
      </div>
    </div>
    </div>
  </section>

  {{-- ================= BIODATA SINGKAT (section navy tersendiri) ================= --}}
  <section id="biodata-singkat" class="page-section">
    <div class="section-inner">
      <div class="dark-head">
        <span class="badge">
          <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="7" y1="9" x2="17" y2="9"/><line x1="7" y1="13" x2="13" y2="13"/></svg>
        </span>
        <h2 data-en="Short Biodata">Biodata Singkat</h2>
      </div>

      <div class="bio-card">
        <div class="bio-dark-grid">
          <div class="bio-dark-item"><label data-en="Position">Jabatan</label><span>{{ $leadership->position ?? '-' }}</span></div>
          <div class="bio-dark-item"><label data-en="Education">Pendidikan</label><span data-en="{{ ($leadership->education_en ?? null) ?: ($leadership->education ?? '-') }}">{{ $leadership->education ?? '-' }}</span></div>
          <div class="bio-dark-item"><label data-en="Term of office">Masa jabatan</label><span data-en="{{ ($leadership->term_en ?? null) ?: ($leadership->term ?? '-') }}">{{ $leadership->term ?? '-' }}</span></div>
          <div class="bio-dark-item"><label data-en="Area of expertise">Bidang keahlian</label><span data-en="{{ ($leadership->expertise_en ?? null) ?: ($leadership->expertise ?? '-') }}">{{ $leadership->expertise ?? '-' }}</span></div>
          <div class="bio-dark-item"><label data-en="Email">Email</label><span>{{ $leadership->email ?? '-' }}</span></div>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= STRUKTUR ORGANISASI ================= --}}
  <section id="struktur-organisasi" class="page-section">
    <div class="section-inner">
      <div class="eyebrow">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><path d="M5 17v-2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><circle cx="12" cy="19" r="2"/></svg>
        <span data-en="ORGANIZATIONAL CHART">BAGAN ORGANISASI</span>
      </div>
      <h2 data-en="Pustekinfo's Organizational Structure">Struktur Organisasi Pustekinfo</h2>

      <div class="org-chart">
        <div class="org-node top">
          @if($kepala?->show_photo && $kepala->photo)
            <div class="org-node-photo" style="background-image:url('{{ asset($kepala->photo) }}');"></div>
          @endif
          <strong data-en="{{ ($kepala->position_en ?? null) ?: ($kepala->position ?? 'Unit Head') }}">{{ $kepala->position ?? 'Pimpinan Unit' }}</strong>
          @if($kepala?->show_name && $kepala->name)
            <span class="org-node-name">{{ $kepala->name }}</span>
          @endif
          @if($kepala?->unit_description)
            <span class="org-node-desc" data-en="{{ $kepala->unit_description_en ?: $kepala->unit_description }}">{{ $kepala->unit_description }}</span>
          @endif
        </div>

        <div class="org-connector"></div>
        <div class="org-row">
          @forelse($bidangList as $b)
            <div class="org-node">
              @if($b->show_photo && $b->photo)
                <div class="org-node-photo" style="background-image:url('{{ asset($b->photo) }}');"></div>
              @endif
              <strong data-en="{{ $b->position_en ?: $b->position }}">{{ $b->position }}</strong>
              @if($b->show_name && $b->name)
                <span class="org-node-name">{{ $b->name }}</span>
              @endif
              @if($b->unit_description)
                <span class="org-node-desc" data-en="{{ $b->unit_description_en ?: $b->unit_description }}">{{ $b->unit_description }}</span>
              @endif
            </div>
          @empty
            <p style="color:#8a97a0;" data-en="No division data yet.">Belum ada data bidang.</p>
          @endforelse
        </div>
      </div>
    </div>
  </section>

  {{-- ================= URAIAN UNIT KERJA (section navy tersendiri) ================= --}}
  <section id="uraian-unit-kerja" class="page-section">
    <div class="section-inner">
      <div class="dark-head">
        <span class="badge">
          <svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
        </span>
        <h2 data-en="Work Unit Description">Uraian Unit Kerja</h2>
      </div>

      <div class="unit-grid">
        <div class="unit-card">
          <div class="unit-icon"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/></svg></div>
          <h4 data-en="Secretariat">Sekretariat</h4>
          <p data-en="Handles administration, general affairs, personnel, and daily operational support for the unit.">Menangani administrasi, tata usaha, kepegawaian, dan dukungan operasional harian unit.</p>
        </div>
        <div class="unit-card">
          <div class="unit-icon"><svg viewBox="0 0 24 24"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg></div>
          <h4 data-en="Infrastructure Division">Bidang Infrastruktur</h4>
          <p data-en="Manages networks, data centers, hardware, and connectivity across the institution.">Mengelola jaringan, pusat data, perangkat keras, dan konektivitas di seluruh lingkungan lembaga.</p>
        </div>
        <div class="unit-card">
          <div class="unit-icon"><svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
          <h4 data-en="Information Systems Division">Bidang Sistem Informasi</h4>
          <p data-en="Develops, integrates, and maintains the institution's applications and information systems.">Mengembangkan, mengintegrasikan, dan memelihara aplikasi serta sistem informasi lembaga.</p>
        </div>
        <div class="unit-card">
          <div class="unit-icon"><svg viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5.2 3.4 9.9 8 11 4.6-1.1 8-5.8 8-11V5l-8-3z"/></svg></div>
          <h4 data-en="Data &amp; Security Division">Bidang Data &amp; Keamanan</h4>
          <p data-en="Maintains information security, manages databases, and ensures the institution's data protection.">Menjaga keamanan informasi, mengelola pangkalan data, dan memastikan perlindungan data lembaga.</p>
        </div>
      </div>
    </div>
  </section>

 {{-- ================= VISI & MISI ================= --}}
  <section id="visi-misi" class="page-section">
    <div class="section-inner">
      <div class="eyebrow">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/></svg>
        <span data-en="VISION &amp; MISSION">VISI &amp; MISI</span>
      </div>
      <h2 data-en="Our Direction and Commitment">Arah dan Komitmen Kami</h2>

      <div class="vm-grid">
        <div class="vm-card dark">
          <div class="eyebrow">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/></svg>
            <span data-en="VISION">VISI</span>
          </div>
          <h3 data-en="Pustekinfo's Vision">Visi Pustekinfo</h3>
          <p data-en="{{ ($visionMission->vision_text_en ?? null) ?: ($visionMission->vision_text ?? 'The vision has not been filled in via the admin panel.') }}">{{ $visionMission->vision_text ?? 'Visi belum diisi lewat panel admin.' }}</p>
        </div>
        <div class="vm-card">
          <div class="eyebrow">
            <svg viewBox="0 0 24 24"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            <span data-en="MISSION">MISI</span>
          </div>
          <h3 data-en="Our Strategic Steps">Langkah Strategis Kami</h3>
          @php $misiEn = $visionMission?->missionListEn() ?? []; @endphp
          <ol>
            @forelse($visionMission?->missionList() ?? [] as $i => $poin)
              <li data-en="{{ ($misiEn[$i] ?? null) ?: $poin }}">{{ $poin }}</li>
            @empty
              <li data-en="Mission has not been filled in via the admin panel.">Misi belum diisi lewat panel admin.</li>
            @endforelse
          </ol>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= NILAI-NILAI ORGANISASI (CORE VALUES) ================= --}}
  <section id="nilai-organisasi" class="page-section values-section">
    <div class="section-inner">
      <div class="eyebrow">
        <svg viewBox="0 0 24 24"><path d="M12 2l3 7h7l-5.5 4.5L18 21l-6-4-6 4 1.5-7.5L2 9h7z"/></svg>
        <span data-en="ORGANIZATIONAL VALUES (CORE VALUES)">NILAI-NILAI ORGANISASI (CORE VALUES)</span>
      </div>
      @php
        $valueIcons = [
          'integrity'     => '<path d="M12 2l3 7h7l-5.5 4.5L18 21l-6-4-6 4 1.5-7.5L2 9h7z"/>',
          'innovative'    => '<path d="M9 18h6M10 22h4M12 2a6 6 0 00-4 10.5c.6.6 1 1.4 1 2.5h6c0-1.1.4-1.9 1-2.5A6 6 0 0012 2z"/>',
          'professional'  => '<path d="M12 15a4 4 0 100-8 4 4 0 000 8z"/><path d="M8.5 13.5L6 21l6-3 6 3-2.5-7.5"/>',
          'collaborative' => '<circle cx="9" cy="8" r="3"/><circle cx="17" cy="8" r="3"/><path d="M2 21v-1a6 6 0 016-6M13 14a6 6 0 016 6v1"/>',
          'service'       => '<path d="M4 21v-1a4 4 0 014-4h8a4 4 0 014 4v1"/><circle cx="12" cy="7" r="4"/>',
          'accountable'   => '<rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 018 0v3"/>',
        ];
      @endphp
      <div class="values-grid">
        @forelse($coreValues as $v)
          <div class="value-card">
            <div class="value-icon"><svg viewBox="0 0 24 24">{!! $valueIcons[$v->icon] ?? $valueIcons['integrity'] !!}</svg></div>
            <h4 data-en="{{ $v->title_en ?: $v->title }}">{{ $v->title }}</h4>
            <p data-en="{{ $v->description_en ?: $v->description }}">{{ $v->description }}</p>
          </div>
        @empty
          <p style="color:white;grid-column:1/-1;" data-en="No organizational values data yet.">Belum ada data nilai organisasi.</p>
        @endforelse
      </div>
    </div>
  </section>

  </div>
  {{-- /.konten-batik --}}

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

  // ---- Theme toggle (dark mode) ----
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
  if (profilDropdown && window.innerWidth <= 900) {
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

    // ---- Scrollspy: sinkronkan semua tab (hero + sticky + dropdown) ----
    const allTabTriggers = document.querySelectorAll('.tab-link, .tab-dd-link');
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
    // ---- Smooth scroll untuk semua trigger tab & dropdown ----
    document.querySelectorAll('.tab-link, .tab-dd-link').forEach(link => {
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

@include('partials.interactive-cursor')
</body>
</html>
