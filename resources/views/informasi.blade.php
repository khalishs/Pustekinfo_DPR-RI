{{-- resources/views/informasi.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Informasi - Pustekinfo | Pusat Teknologi Informasi DPR RI</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
    background: var(--white);
  }

  @view-transition{
    navigation:auto;
  }
  a{text-decoration:none;color:inherit;}
  ul{list-style:none;}
  img{max-width:100%;display:block;}

  h1, h2, h3, h4,
  .section-inner > h2,
  .info-news-title,
  .info-doc-title,
  .info-faq-item summary {
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
  .navbar-logo{height:50px;width:auto;object-fit:contain; transform:scale(4.9); /* 1.2 - 1.8 sesuaikan */
    transform-origin:left center;}
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
    .navbar-logo{height:32px;width:auto;flex-shrink:0;}
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

  /* ================= HERO (pola sama seperti hero Profil & Layanan) ================= */
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
  .section-head{display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:16px;}

  @media (max-width:900px){
    section.page-section{padding:60px 20px;}
    .tabs-nav-sticky.show{top:56px;}
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
  }
  [data-theme="dark"] .konten-batik{background-color:#0e1b23;}
  [data-theme="dark"] .konten-batik::before{filter:url(#batikTintTeal);opacity:.4;}
  /* section putih/mist bergantian dimatikan di dalam area batik, supaya
     polanya tetap terlihat sampai bawah — sama seperti di beranda */
  .konten-batik section.page-section:nth-child(even){background:transparent;}
  @media (max-width:900px){
    .konten-batik::before{background-size:3000px auto;}
  }

  /* ================= FILTER PILLS (dipakai Berita & Publikasi) ================= */
  .info-filters-wrap{position:relative;margin-top:26px;}
  .info-filters-wrap::before{
    content:"";position:absolute;top:-36px;left:-30px;right:-30px;bottom:-36px;
    background:
      radial-gradient(45% 100% at 12% 50%, rgba(20,128,140,.32), transparent 70%),
      radial-gradient(35% 100% at 60% 50%, rgba(201,163,78,.2), transparent 70%),
      radial-gradient(30% 100% at 92% 50%, rgba(20,128,140,.22), transparent 70%);
    filter:blur(28px);
    z-index:0;pointer-events:none;
  }
  .info-filters{position:relative;z-index:1;display:flex;gap:10px;flex-wrap:nowrap;overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:none;-ms-overflow-style:none;padding:4px 2px;}
  .info-filters::-webkit-scrollbar{display:none;}
  .info-filter{
    padding:10px 20px;border-radius:20px;border:1px solid #dfe4e7;
    background:var(--white);font-size:13px;font-weight:700;color:#5b6b73;
    cursor:pointer;font-family:inherit;flex-shrink:0;white-space:nowrap;
    transition:transform .25s ease, box-shadow .25s ease, border-color .2s ease, color .2s ease;
  }
  .info-filter:hover{border-color:var(--teal);color:var(--teal);transform:translateY(-2px);box-shadow:0 10px 24px -10px rgba(20,128,140,.5);}
  .info-filter.active{background:var(--navy);border-color:var(--navy);color:var(--white);box-shadow:0 8px 20px -10px rgba(11,34,51,.5);}
  .info-filter.active:hover{color:var(--white);box-shadow:0 12px 26px -10px rgba(11,34,51,.6);}
  [data-theme="dark"] .info-filters-wrap::before{
    background:
      radial-gradient(45% 100% at 12% 50%, rgba(95,192,209,.28), transparent 70%),
      radial-gradient(35% 100% at 60% 50%, rgba(201,163,78,.18), transparent 70%),
      radial-gradient(30% 100% at 92% 50%, rgba(95,192,209,.2), transparent 70%);
  }

  /* ================= BERITA (grid kartu) ================= */
  .info-news-grid{margin-top:36px;display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
  .info-news-card{
    background:var(--white);border-radius:1px 16px 1px 16px;overflow:hidden;
    box-shadow:0 20px 40px -26px rgba(11,34,51,.22);
    transition:transform .25s ease, box-shadow .25s ease;
  }
  .info-news-card:hover{transform:translateY(-6px);box-shadow:0 26px 46px -22px rgba(11,34,51,.3);}
  .info-news-thumb{
    position:relative;height:140px;
    display:flex;align-items:center;justify-content:center;
    background:radial-gradient(120% 120% at 20% 15%, var(--teal) 0%, transparent 55%),
      linear-gradient(160deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
  }
  .info-news-thumb svg{width:36px;height:36px;stroke:rgba(255,255,255,.8);fill:none;stroke-width:1.6;stroke-linecap:round;stroke-linejoin:round;}
  .info-news-badge{
    position:absolute;top:14px;left:14px;
    background:rgba(255,255,255,.14);backdrop-filter:blur(4px);
    color:var(--white);font-size:10px;font-weight:800;letter-spacing:.08em;
    padding:6px 12px;border-radius:1px 8px 1px 8px;text-transform:uppercase;
  }
  .info-news-body{padding:20px 22px 24px;}
  .info-news-date{display:flex;align-items:center;gap:6px;color:#8a97a0;font-size:12px;font-weight:600;}
  .info-news-date svg{width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:1.8;flex-shrink:0;}
  .info-news-title{margin-top:10px;font-size:15px;font-weight:700;color:var(--navy);line-height:1.4;}
  .info-news-desc{margin-top:8px;color:#7a8a92;font-size:13px;line-height:1.65;
    display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
  .info-news-empty{grid-column:1/-1;color:#8a97a0;font-size:13.5px;}

  .info-loadmore-wrap{display:flex;justify-content:center;margin-top:44px;}
  .info-loadmore{
    display:inline-flex;align-items:center;gap:8px;
    padding:13px 28px;border-radius:24px;border:1.5px solid #dfe4e7;
    background:var(--white);color:var(--navy);font-size:13.5px;font-weight:700;
    cursor:pointer;transition:.2s ease;
  }
  .info-loadmore:hover{border-color:var(--teal);color:var(--teal);}

  @media (max-width:900px){.info-news-grid{grid-template-columns:1fr 1fr;}}
  @media (max-width:640px){.info-news-grid{grid-template-columns:1fr;}}

  /* ================= AGENDA (kalender + panel hari ini) ================= */
  .agenda-grid{margin-top:40px;display:grid;grid-template-columns:1.55fr 1fr;gap:28px;align-items:stretch;}

  .agenda-cal{background:var(--white);border-radius:16px;padding:28px 30px 22px;box-shadow:0 30px 60px -30px rgba(11,34,51,.25);}
  .agenda-cal-head{display:flex;align-items:center;justify-content:space-between;}
  .agenda-cal-head .month{font-size:18px;font-weight:800;color:var(--navy);}
  .agenda-cal-nav{display:flex;align-items:center;gap:8px;}
  .agenda-cal-nav a{
    width:30px;height:30px;border-radius:50%;border:1px solid #e2e8ec;background:var(--white);color:#5b6b73;
    display:flex;align-items:center;justify-content:center;font-size:13px;
    transition:background .2s ease, border-color .2s ease, color .2s ease;
  }
  .agenda-cal-nav a:hover{background:var(--mist);border-color:var(--teal);color:var(--teal);}
  .agenda-cal-nav .today-btn{width:auto;border-radius:8px;padding:0 14px;height:30px;font-size:11.5px;font-weight:700;color:var(--teal);border-color:#d7e6e8;}

  .agenda-cal-daynames{margin-top:22px;display:grid;grid-template-columns:repeat(7,1fr);text-align:center;}
  .agenda-cal-daynames span{font-size:11px;font-weight:700;color:#9aa8af;letter-spacing:.04em;}

  .agenda-cal-days{margin-top:10px;display:grid;grid-template-columns:repeat(7,1fr);row-gap:6px;}
  .agenda-day{
    position:relative;aspect-ratio:1/1;display:flex;flex-direction:column;align-items:center;justify-content:center;
    font-size:13.5px;font-weight:600;color:var(--navy);border-radius:10px;transition:background .2s ease, color .2s ease;
  }
  .agenda-day.muted{color:#c7d0d4;font-weight:500;}
  .agenda-day.today{background:rgba(20,128,140,.06);border:1px solid rgba(20,128,140,.4);color:var(--teal);font-weight:800;}
  .agenda-day .dot{width:6px;height:6px;border-radius:50%;margin-top:3px;}
  .agenda-day .dot.c1{background:#e0a340;}
  .agenda-day .dot.c2{background:#b0413e;}
  .agenda-day .dot.c3{background:#1f9d7c;}
  .agenda-day .dot.c4{background:#3b7dd8;}
  .agenda-day .dot.c5{background:#8b5cf6;}
  .agenda-day .dot.c6{background:#d6478a;}

  .agenda-legend{margin-top:20px;padding-top:18px;border-top:1px solid #eef1f3;display:flex;gap:22px;flex-wrap:wrap;}
  .agenda-legend span{display:flex;align-items:center;gap:7px;font-size:12px;font-weight:600;color:#7a8a92;}
  .agenda-legend i{width:7px;height:7px;border-radius:50%;display:inline-block;}
  .agenda-legend i.c1{background:#e0a340;}
  .agenda-legend i.c2{background:#b0413e;}
  .agenda-legend i.c3{background:#1f9d7c;}
  .agenda-legend i.c4{background:#3b7dd8;}
  .agenda-legend i.c5{background:#8b5cf6;}
  .agenda-legend i.c6{background:#d6478a;}

  .agenda-today{
    background:#073D5F;
    border-radius:16px;padding:26px 26px 30px;display:flex;flex-direction:column;
    box-shadow:0 30px 60px -30px rgba(11,34,51,.35);
  }
  /* Tidak ada lagi pola batik terpisah di sini — cukup pakai layer .konten-batik::before */
  
  .agenda-today-head{display:flex;align-items:center;justify-content:space-between;padding-bottom:18px;border-bottom:1px solid rgba(255,255,255,.14);}
  .agenda-today-head .label{display:flex;align-items:center;gap:8px;color:var(--white);font-size:13px;font-weight:800;}
  .agenda-today-head .label::before{content:"";width:6px;height:6px;border-radius:50%;background:var(--teal);}
  .agenda-today-head .date{color:rgba(255,255,255,.6);font-size:12px;font-weight:600;}

  .agenda-event{margin-top:20px;padding:16px 0 4px;}
  .agenda-event-top{display:flex;align-items:flex-start;gap:10px;}
  .agenda-event-top .bullet{margin-top:6px;width:7px;height:7px;border-radius:50%;background:var(--teal);flex-shrink:0;}
  .agenda-event-top .title{color:var(--white);font-size:14.5px;font-weight:700;line-height:1.4;}
  .agenda-event-meta{margin-top:10px;margin-left:17px;display:flex;flex-direction:column;gap:8px;}
  .agenda-event-meta span{display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.65);font-size:12.5px;font-weight:600;}
  .agenda-event-meta svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:1.8;flex-shrink:0;}

  .agenda-today-empty{padding-top:24px;text-align:center;color:rgba(255,255,255,.4);font-size:12.5px;font-weight:600;}

  .agenda-upcoming-head{
    margin-top:22px;padding-top:18px;border-top:1px solid rgba(255,255,255,.14);
    display:flex;align-items:center;gap:8px;
    color:rgba(255,255,255,.55);font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;
  }
  .agenda-event.upcoming{margin-top:16px;}
  .agenda-event.upcoming .agenda-event-top .title{color:rgba(255,255,255,.85);}
  .agenda-event.upcoming .agenda-event-top .bullet{background:rgba(255,255,255,.35);}

  @media (max-width:900px){
    .agenda-grid{grid-template-columns:1fr;gap:24px;}
    .agenda-cal{padding:22px 18px 18px;}
  }

  /* ================= PUBLIKASI (list dokumen) ================= */
  .info-doc-list{margin-top:36px;display:flex;flex-direction:column;gap:12px;}
  .info-doc-item{
    display:flex;align-items:center;gap:16px;padding:18px 20px;border-radius:12px;
    background:var(--white);border:1px solid #e7ecee;transition:.2s ease;
  }
  .info-doc-item:hover{border-color:var(--teal);box-shadow:0 16px 32px -24px rgba(11,34,51,.25);}
  .info-doc-item.hide{display:none;}
  .info-doc-icon{
    width:40px;height:40px;border-radius:10px;background:rgba(20,128,140,.1);color:var(--teal);
    display:flex;align-items:center;justify-content:center;flex-shrink:0;
  }
  .info-doc-icon svg{width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
  .info-doc-body{flex:1;min-width:0;}
  .info-doc-title-row{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
  .info-doc-cat{
    background:rgba(20,128,140,.1);color:var(--teal);font-size:10px;font-weight:800;
    letter-spacing:.06em;padding:4px 9px;border-radius:6px;text-transform:uppercase;flex-shrink:0;
  }
  .info-doc-title{font-size:14px;font-weight:700;color:var(--navy);}
  .info-doc-meta{margin-top:5px;font-size:12px;color:#8a97a0;font-weight:600;}
  .info-doc-download{
    width:38px;height:38px;border-radius:50%;border:1px solid #dfe4e7;
    display:flex;align-items:center;justify-content:center;color:#5b6b73;flex-shrink:0;transition:.2s ease;
  }
  .info-doc-download svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;}
  .info-doc-download:hover{background:var(--teal);border-color:var(--teal);color:#fff;}

  /* ================= FAQ (accordion) ================= */
  .info-faq-list{margin-top:36px;display:flex;flex-direction:column;gap:10px;}
  .info-faq-item{background:var(--white);border:1px solid #e7ecee;border-radius:12px;overflow:hidden;}
  .info-faq-item summary{
    list-style:none;cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
    padding:18px 22px;font-size:14px;font-weight:700;color:var(--navy);
  }
  .info-faq-item summary::-webkit-details-marker{display:none;}
  .info-faq-item summary .chev{width:18px;height:18px;flex-shrink:0;color:#8a97a0;transition:transform .2s ease;}
  .info-faq-item summary .chev svg{width:100%;height:100%;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
  .info-faq-item[open] summary .chev{transform:rotate(180deg);}
  .info-faq-item[open] summary{border-bottom:1px solid #eef1f3;}
  .info-faq-item .answer{padding:16px 22px 20px;color:#5b6b73;font-size:13.5px;line-height:1.75;}

  /* ================= FOOTER (sama seperti halaman lain) ================= */
  .footer-divider{height:3px;background:linear-gradient(10deg, #057888 0%, #052D46 55%, #052D46 100%);}
  .footer{position:relative;background:#052D46;padding:64px 100px 0;overflow:hidden;}
  /* Motif batik dekoratif di ujung kiri footer — sama seperti beranda */
  .footer::before{
    content:"";position:absolute;inset:-40px 0 -80px;
    background-repeat:no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat;
    background-image:url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}');
    background-position:left -100px bottom -30px,right -80px top -40px,30% 68%,35% 15%,55% 82%,75% 20%,90% 75%;
    background-size:480px auto,320px auto,150px auto,130px auto,170px auto,140px auto,220px auto;
    filter:brightness(0) invert(1);opacity:.35;pointer-events:none;z-index:0;
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
      opacity:.25;
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

  /* ---- Informasi page: burger button ---- */
  [data-theme="dark"] .burger{background:#122530;border-color:rgba(255,255,255,.14);}
  [data-theme="dark"] .burger span{background:#c3cdd2;}

  /* ---- Sections & headings ---- */
  [data-theme="dark"] section.page-section:nth-child(even){background:#122530;}
  [data-theme="dark"] .section-inner > h2{color:#eaf3f5;}
  [data-theme="dark"] .eyebrow{color:#5FC0D1;}
  [data-theme="dark"] .eyebrow.eyebrow-dash::before{background:#5FC0D1;}

  /* ---- Sticky tabs ---- */
  [data-theme="dark"] .tabs-nav-sticky{background:#073D5F;border-bottom-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .tabs-nav .tabs-scroll{border-bottom-color:rgba(255,255,255,.14);}

  /* ---- Filter pills ---- */
  [data-theme="dark"] .info-filter{background:#122530;border-color:rgba(255,255,255,.14);color:#c3cdd2;}
  [data-theme="dark"] .info-filter:hover{border-color:#5FC0D1;color:#5FC0D1;box-shadow:0 10px 24px -10px rgba(95,192,209,.4);}
  [data-theme="dark"] .info-filter.active{background:#5FC0D1;border-color:#5FC0D1;color:#0b1720;}
  [data-theme="dark"] .info-filter.active:hover{color:#0b1720;}

  /* ---- Berita cards ---- */
  [data-theme="dark"] .info-news-card{background:#122530;box-shadow:0 20px 40px -26px rgba(0,0,0,.5);}
  [data-theme="dark"] .info-news-card:hover{box-shadow:0 26px 46px -22px rgba(0,0,0,.6);}
  [data-theme="dark"] .info-news-date{color:#8ea0a8;}
  [data-theme="dark"] .info-news-title{color:#eaf3f5;}
  [data-theme="dark"] .info-news-desc{color:#c3cdd2;}
  [data-theme="dark"] .info-news-empty{color:#8ea0a8;}

  [data-theme="dark"] .info-loadmore{background:#122530;border-color:rgba(255,255,255,.14);color:#c3cdd2;}
  [data-theme="dark"] .info-loadmore:hover{border-color:#5FC0D1;color:#5FC0D1;}

  /* ---- Agenda ---- */
  [data-theme="dark"] .agenda-cal{background:#122530;box-shadow:0 30px 60px -30px rgba(0,0,0,.55);}
  [data-theme="dark"] .agenda-cal-head .month{color:#eaf3f5;}
  [data-theme="dark"] .agenda-cal-nav a{background:#0b1720;border-color:rgba(255,255,255,.14);color:#c3cdd2;}
  [data-theme="dark"] .agenda-cal-nav a:hover{background:rgba(255,255,255,.08);border-color:#5FC0D1;color:#5FC0D1;}
  [data-theme="dark"] .agenda-cal-nav .today-btn{color:#5FC0D1;border-color:rgba(255,255,255,.14);}
  [data-theme="dark"] .agenda-cal-daynames span{color:#8ea0a8;}
  [data-theme="dark"] .agenda-day{color:#c3cdd2;}
  [data-theme="dark"] .agenda-day.muted{color:#4d5d64;}
  [data-theme="dark"] .agenda-day.today{background:rgba(95,192,209,.12);border-color:#5FC0D1;color:#5FC0D1;}
  [data-theme="dark"] .agenda-day .dot.c1,[data-theme="dark"] .agenda-legend i.c1{background:#f0b95e;}
  [data-theme="dark"] .agenda-day .dot.c2,[data-theme="dark"] .agenda-legend i.c2{background:#e0645f;}
  [data-theme="dark"] .agenda-day .dot.c3,[data-theme="dark"] .agenda-legend i.c3{background:#3ecb9e;}
  [data-theme="dark"] .agenda-day .dot.c4,[data-theme="dark"] .agenda-legend i.c4{background:#6ea8ff;}
  [data-theme="dark"] .agenda-day .dot.c5,[data-theme="dark"] .agenda-legend i.c5{background:#b18cff;}
  [data-theme="dark"] .agenda-day .dot.c6,[data-theme="dark"] .agenda-legend i.c6{background:#ff7bb3;}
  [data-theme="dark"] .agenda-legend{border-top-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .agenda-legend span{color:#8ea0a8;}
  [data-theme="dark"] .agenda-today{box-shadow:0 30px 60px -30px rgba(0,0,0,.6);}

  /* ---- Publikasi & unduhan ---- */
  [data-theme="dark"] .info-doc-item{background:#122530;border-color:rgba(255,255,255,.1);}
  [data-theme="dark"] .info-doc-item:hover{border-color:#5FC0D1;box-shadow:0 16px 32px -24px rgba(0,0,0,.5);}
  [data-theme="dark"] .info-doc-icon{background:rgba(95,192,209,.12);color:#5FC0D1;}
  [data-theme="dark"] .info-doc-cat{background:rgba(95,192,209,.12);color:#5FC0D1;}
  [data-theme="dark"] .info-doc-title{color:#eaf3f5;}
  [data-theme="dark"] .info-doc-meta{color:#8ea0a8;}
  [data-theme="dark"] .info-doc-download{background:#0b1720;border-color:rgba(255,255,255,.14);color:#c3cdd2;}
  [data-theme="dark"] .info-doc-download:hover{background:#5FC0D1;border-color:#5FC0D1;color:#0b1720;}

  /* ---- FAQ ---- */
  [data-theme="dark"] .info-faq-item{background:#122530;border-color:rgba(255,255,255,.1);}
  [data-theme="dark"] .info-faq-item summary{color:#eaf3f5;}
  [data-theme="dark"] .info-faq-item summary .chev{color:#8ea0a8;}
  [data-theme="dark"] .info-faq-item[open] summary{border-bottom-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .info-faq-item .answer{color:#c3cdd2;}
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
      <feColorMatrix type="saturate" values="2.2"/>
      <feComponentTransfer>
        <feFuncA type="linear" slope="2.6" intercept="0"/>
      </feComponentTransfer>
    </filter>
  </svg>

  @php
    $tabs = [
      ['id' => 'berita',    'label' => 'Berita',    'label_en' => 'News',        'icon' => '<path d="M4 4h13a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H4z"/><path d="M4 4v16a2 2 0 0 0 2 2h13"/><line x1="8" y1="9" x2="15" y2="9"/><line x1="8" y1="13" x2="15" y2="13"/>'],
      ['id' => 'agenda',    'label' => 'Agenda',    'label_en' => 'Agenda',      'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>'],
      ['id' => 'publikasi', 'label' => 'Publikasi', 'label_en' => 'Publications','icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>'],
      ['id' => 'faq',       'label' => 'FAQ',        'label_en' => 'FAQ',        'icon' => '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/>'],
    ];

    $newsIcons = [
      'sertifikasi' => '<path d="M12 2 4 5v6c0 5.2 3.4 9.9 8 11 4.6-1.1 8-5.8 8-11V5l-8-3z"/><path d="M9 12l2 2 4-4"/>',
      'pengumuman'  => '<path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>',
      'sistem'      => '<polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10"/><path d="M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>',
      'pelatihan'   => '<path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5"/>',
      'layanan'     => '<line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>',
      'kegiatan'    => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
    ];
    $defaultNewsIcon = '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>';

    $documents = [
      ['cat' => 'LAPORAN',  'cat_en' => 'REPORT',   'title' => 'Laporan Kinerja Tahun 2025',              'title_en' => '2025 Performance Report',            'date' => '12 Jan 2026', 'date_en' => '12 Jan 2026', 'size' => '2.4 MB'],
      ['cat' => 'KEBIJAKAN','cat_en' => 'POLICY',   'title' => 'Kebijakan Keamanan Informasi',            'title_en' => 'Information Security Policy',        'date' => '03 Nov 2025', 'date_en' => '03 Nov 2025', 'size' => '1.1 MB'],
      ['cat' => 'LAPORAN',  'cat_en' => 'REPORT',   'title' => 'Rencana Strategis TI 2025–2029',          'title_en' => '2025–2029 IT Strategic Plan',         'date' => '20 Agu 2025', 'date_en' => '20 Aug 2025', 'size' => '3.8 MB'],
      ['cat' => 'PANDUAN',  'cat_en' => 'GUIDE',    'title' => 'Panduan Layanan Mandiri',                  'title_en' => 'Self-Service Guide',                  'date' => '15 Jul 2025', 'date_en' => '15 Jul 2025', 'size' => '0.9 MB'],
      ['cat' => 'KEBIJAKAN','cat_en' => 'POLICY',   'title' => 'Standar Operasional Prosedur Helpdesk',   'title_en' => 'Helpdesk Standard Operating Procedure','date' => '02 Jul 2025', 'date_en' => '02 Jul 2025', 'size' => '1.5 MB'],
      ['cat' => 'LAPORAN',  'cat_en' => 'REPORT',   'title' => 'Laporan Audit Keamanan Informasi 2025',   'title_en' => '2025 Information Security Audit Report','date' => '28 Jun 2025', 'date_en' => '28 Jun 2025', 'size' => '2.1 MB'],
      ['cat' => 'PANDUAN',  'cat_en' => 'GUIDE',    'title' => 'Panduan Penggunaan Sistem Persuratan',    'title_en' => 'Correspondence System User Guide',    'date' => '10 Jun 2025', 'date_en' => '10 Jun 2025', 'size' => '1.3 MB'],
      ['cat' => 'FORMULIR', 'cat_en' => 'FORM',     'title' => 'Formulir Permintaan Akses Sistem',        'title_en' => 'System Access Request Form',          'date' => '01 Jun 2025', 'date_en' => '01 Jun 2025', 'size' => '0.4 MB'],
    ];

    $faqs = [
      ['q' => 'Berapa lama waktu respons pesan saya?', 'q_en' => 'How long does it take to respond to my message?', 'a' => 'Tim kami akan merespons dalam waktu 1x24 jam kerja melalui email yang Anda cantumkan.', 'a_en' => 'Our team will respond within 1x24 working hours via the email you provided.'],
      ['q' => 'Bagaimana cara melaporkan kendala teknis?', 'q_en' => 'How do I report a technical issue?', 'a' => 'Laporkan kendala teknis melalui menu Helpdesk pada portal stela.dpr.go.id, atau hubungi kontak resmi yang tertera pada halaman ini.', 'a_en' => 'Report technical issues through the Helpdesk menu on the stela.dpr.go.id portal, or contact the official channels listed on this page.'],
      ['q' => 'Apakah bisa berkunjung langsung ke kantor?', 'q_en' => 'Can I visit the office in person?', 'a' => 'Bisa. Kunjungan dapat dilakukan pada jam kerja (08.00–16.00 WIB) dengan konfirmasi terlebih dahulu melalui kontak resmi.', 'a_en' => 'Yes. Visits can be made during working hours (08.00–16.00 WIB) with prior confirmation through official contact channels.'],
      ['q' => 'Bagaimana cara mengunduh dokumen publikasi?', 'q_en' => 'How do I download publication documents?', 'a' => 'Dokumen publikasi dapat diunduh langsung melalui bagian Publikasi & Unduhan pada halaman ini.', 'a_en' => 'Publication documents can be downloaded directly through the Publications & Downloads section on this page.'],
      ['q' => 'Apakah agenda kegiatan diperbarui secara berkala?', 'q_en' => 'Is the activity agenda updated regularly?', 'a' => 'Ya, agenda kegiatan diperbarui secara berkala oleh tim Pustekinfo mengikuti jadwal kerja internal.', 'a_en' => 'Yes, the activity agenda is updated regularly by the Pustekinfo team following the internal work schedule.'],
    ];
  @endphp

  {{-- ================= NAVBAR ================= --}}
  <nav class="navbar">
    <div class="brand">
      <img src="{{ asset('images/logo_pustekinfo_landscape.png') }}" alt="Logo Pustekinfo" class="navbar-logo">
    </div>

    <ul class="nav-links">
      <li><a href="{{ route('home') }}" data-en="Home">Beranda</a></li>
      <li><a href="{{ route('profil') }}" data-en="Profile">Profil </a></li>
      <li><a href="{{ route('layanan') }}" data-en="Services">Layanan</a></li>
      <li class="active"><a href="{{ route('informasi') }}" data-en="Information">Informasi</a></li>
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

  {{-- ================= HERO ================= --}}
  <header class="hero-profil" @if($pageBanner?->image) style="background-image:linear-gradient(160deg, rgba(7,61,95,.85) 0%, rgba(7,61,95,.7) 50%, rgba(20,131,156,.55) 100%), url('{{ media_url($pageBanner->image) }}');background-size:cover;background-position:center;" @endif>
    <div class="hero-profil-inner">
      <p class="breadcrumb" data-en-html="Home / &lt;span&gt;Information&lt;/span&gt;">Beranda / <span>Informasi</span></p>
      <h1 data-en-html="Center for <span class=&quot;accent&quot;>Information &amp; Publications</span>">Pusat <span class="accent">Informasi &amp; Publikasi</span></h1>
      <p data-en="Latest news, activity agenda, and Pustekinfo's official publication documents.">Berita terbaru, agenda kegiatan, dan dokumen publikasi resmi Pustekinfo.</p>
    </div>

    <div class="tabs-nav">
      <div class="tabs-scroll">
        @foreach($tabs as $i => $t)
          <a href="#{{ $t['id'] }}" class="tab-link {{ $i === 0 ? 'active' : '' }}" data-target="{{ $t['id'] }}">
            <span data-en="{{ $t['label_en'] }}">{{ $t['label'] }}</span>
          </a>
        @endforeach
      </div>
    </div>
  </header>

  <div class="tabs-nav-sticky" id="tabsSticky">
    <div class="tabs-scroll">
      @foreach($tabs as $i => $t)
        <a href="#{{ $t['id'] }}" class="tab-link {{ $i === 0 ? 'active' : '' }}" data-target="{{ $t['id'] }}">
          <span data-en="{{ $t['label_en'] }}">{{ $t['label'] }}</span>
        </a>
      @endforeach
    </div>
  </div>

  <div class="konten-batik">

  {{-- ================= BERITA & KEGIATAN ================= --}}
  <section id="berita" class="page-section">
    <div class="section-inner">
      <div class="eyebrow eyebrow-dash" data-en="LATEST NEWS">KABAR TERBARU</div>
      <h2 data-en="News &amp; Activities">Berita &amp; Kegiatan</h2>

      <div class="info-filters-wrap">
        <div class="info-filters">
          <a href="{{ route('informasi') }}#berita" class="info-filter {{ ! $kategoriAktif ? 'active' : '' }}" data-en="All">Semua</a>
          @foreach($kategoriList as $kat)
            <a href="{{ route('informasi', ['kategori' => $kat]) }}#berita" class="info-filter {{ $kategoriAktif === $kat ? 'active' : '' }}">{{ $kat }}</a>
          @endforeach
        </div>
      </div>

      <div class="info-news-grid">
        @forelse($news as $item)
          <a href="{{ route('berita.show', $item) }}" class="info-news-card">
            <div class="info-news-thumb">
              <span class="info-news-badge" data-en="{{ $item->category_en ?: $item->category }}">{{ $item->category }}</span>
              <svg viewBox="0 0 24 24">{!! $newsIcons[strtolower($item->category)] ?? $defaultNewsIcon !!}</svg>
            </div>
            <div class="info-news-body">
              <div class="info-news-date">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ $item->published_at?->format('d M Y') }}
              </div>
              <div class="info-news-title" data-en="{{ $item->title_en ?: $item->title }}">{{ $item->title }}</div>
              <div class="info-news-desc" data-en="{{ $item->excerpt_en ?: $item->excerpt }}">{{ $item->excerpt }}</div>
            </div>
          </a>
        @empty
          <p class="info-news-empty" data-en="No news for this category yet.">Belum ada berita untuk kategori ini.</p>
        @endforelse
      </div>

      @if($news->hasMorePages())
        <div class="info-loadmore-wrap">
          <a href="{{ $news->nextPageUrl() }}#berita" class="info-loadmore" data-en="Load more">Muat lebih banyak</a>
        </div>
      @endif
    </div>
  </section>

  {{-- ================= AGENDA KEGIATAN ================= --}}
  <section id="agenda" class="page-section">
    <div class="section-inner">
      <div class="eyebrow eyebrow-dash" data-en="SCHEDULE">JADWAL</div>
      <h2 data-en="Activity Agenda">Agenda Kegiatan</h2>

      <div class="agenda-grid">
        <div class="agenda-cal">
          <div class="agenda-cal-head">
            <div class="month">{{ $monthLabel }}</div>
            <div class="agenda-cal-nav">
              <a href="{{ route('informasi', ['bulan' => $prevMonth]) }}#agenda" aria-label="Bulan sebelumnya">‹</a>
              <a href="{{ route('informasi', ['bulan' => $nextMonth]) }}#agenda" aria-label="Bulan berikutnya">›</a>
              <a href="{{ route('informasi') }}#agenda" class="today-btn" data-en="Today">Hari Ini</a>
            </div>
          </div>

          <div class="agenda-cal-daynames">
            <span data-en="Mon">Senin</span><span data-en="Tue">Selasa</span><span data-en="Wed">Rabu</span><span data-en="Thu">Kamis</span><span data-en="Fri">Jumat</span><span data-en="Sat">Sabtu</span><span data-en="Sun">Minggu</span>
          </div>

          <div class="agenda-cal-days">
            @foreach($calendarDays as $day)
              <div class="agenda-day {{ $day['muted'] ? 'muted' : '' }} {{ $day['today'] ? 'today' : '' }}">
                {{ $day['day'] }}
                @foreach($day['events'] as $ev)
                  <span class="dot {{ $ev->color_tag }}"></span>
                @endforeach
              </div>
            @endforeach
          </div>
          <div class="agenda-legend">
            <span><i class="c1"></i><span data-en="Agenda Purpose 1">Tujuan Agenda 1</span></span>
            <span><i class="c2"></i><span data-en="Agenda Purpose 2">Tujuan Agenda 2</span></span>
            <span><i class="c3"></i><span data-en="Agenda Purpose 3">Tujuan Agenda 3</span></span>
            <span><i class="c4"></i><span data-en="Agenda Purpose 4">Tujuan Agenda 4</span></span>
            <span><i class="c5"></i><span data-en="Agenda Purpose 5">Tujuan Agenda 5</span></span>
            <span><i class="c6"></i><span data-en="Agenda Purpose 6">Tujuan Agenda 6</span></span>
          </div>
        </div>

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

  {{-- ================= PUBLIKASI & UNDUHAN ================= --}}
  <section id="publikasi" class="page-section">
    <div class="section-inner">
      <div class="eyebrow eyebrow-dash" data-en="DOCUMENTS">DOKUMEN</div>
      <h2 data-en="Publications &amp; Downloads">Publikasi &amp; Unduhan</h2>

      <div class="info-filters-wrap">
        <div class="info-filters" id="docFilters">
          <button class="info-filter active" data-filter="semua" data-en="All">Semua</button>
          <button class="info-filter" data-filter="laporan" data-en="Reports">Laporan</button>
          <button class="info-filter" data-filter="kebijakan" data-en="Policies">Kebijakan</button>
          <button class="info-filter" data-filter="panduan" data-en="Guides">Panduan</button>
          <button class="info-filter" data-filter="formulir" data-en="Forms">Formulir</button>
        </div>
      </div>

      <div class="info-doc-list" id="docList">
        @foreach($documents as $doc)
          <div class="info-doc-item" data-category="{{ strtolower($doc['cat']) }}">
            <span class="info-doc-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></span>
            <div class="info-doc-body">
              <div class="info-doc-title-row">
                <span class="info-doc-cat" data-en="{{ $doc['cat_en'] }}">{{ $doc['cat'] }}</span>
                <span class="info-doc-title" data-en="{{ $doc['title_en'] }}">{{ $doc['title'] }}</span>
              </div>
              <div class="info-doc-meta"><span data-en="{{ $doc['date_en'] }}">{{ $doc['date'] }}</span> · {{ $doc['size'] }}</div>
            </div>
            <a href="#" class="info-doc-download" aria-label="Unduh {{ $doc['title'] }}">
              <svg viewBox="0 0 24 24"><path d="M12 3v12"/><polyline points="7 10 12 15 17 10"/><path d="M5 21h14"/></svg>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ================= FAQ ================= --}}
  <section id="faq" class="page-section">
    <div class="section-inner">
      <div class="eyebrow eyebrow-dash" data-en="HELP">BANTUAN</div>
      <h2 data-en="Frequently Asked Questions">Pertanyaan Umum</h2>

      <div class="info-faq-list">
        @foreach($faqs as $item)
          <details class="info-faq-item">
            <summary>
              <span data-en="{{ $item['q_en'] }}">{{ $item['q'] }}</span>
              <span class="chev"><svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg></span>
            </summary>
            <div class="answer" data-en="{{ $item['a_en'] }}">{{ $item['a'] }}</div>
          </details>
        @endforeach
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
          <a href="#faq"><span class="chev">›</span> FAQ</a>
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
      <p data-en="© {{ date('Y') }} Pustekinfo. All rights reserved.">© {{ date('Y') }} Pustekinfo. Seluruh hak dilindungi.</p>
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

  // ---- Filter dokumen publikasi (client-side) ----
  const docFilters = document.querySelectorAll("#docFilters .info-filter");
  const docItems = document.querySelectorAll("#docList .info-doc-item");
  docFilters.forEach(btn => {
    btn.addEventListener("click", () => {
      docFilters.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
      const filter = btn.dataset.filter;
      docItems.forEach(item => {
        const match = filter === "semua" || item.dataset.category === filter;
        item.classList.toggle("hide", !match);
      });
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

@include('partials.interactive-cursor')
</body>
</html>