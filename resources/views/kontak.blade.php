{{-- resources/views/kontak.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontak - Pustekinfo DPR RI</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;800&display=swap" rel="stylesheet">
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
    position:relative;
    background-color:#14839C1A;
    background-repeat:no-repeat;
    background-position:center top;
    background-size:5000px auto;
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

  h1, h2, h3,
  .kontak-info h2,
  .lokasi h2,
  .kontak-form-card h3,
  .kontak-info-body .title {
    font-family:'Plus Jakarta Sans', system-ui, sans-serif;
  }

  /* ---------- Eyebrow generik ---------- */
  .eyebrow{
    display:flex;
    align-items:center;
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    gap:10px;
    color:var(--teal);
    font-size:12px;
    font-weight:600;
    letter-spacing:.12em;
  }
  .eyebrow::before{
    content:"";
    width:22px;height:2px;
    background:var(--teal);
    display:inline-block;
  }

  /* ---------- Navbar (sama seperti beranda) ---------- */
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
  .navbar-logo{height:50px;width:190px;object-fit:contain;object-position:left center;
    pointer-events:none;}
  .nav-links{display:flex;align-items:center;gap:34px;}

  .nav-links li a{
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    font-size:14.5px;font-weight:600;color:#3c4a52;
    display:flex;align-items:center;gap:4px;
  }
  .nav-links li.active a{color:var(--teal);}
  .nav-links li.active{position:relative;}
  .nav-links li.active::after{
    content:"";position:absolute;left:0;right:0;bottom:-18px;
    height:2px;background:var(--teal);
    view-transition-name:nav-underline;
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
  }
  .btn-login{
    padding:10px 22px;border-radius:20px;border:none;
    background:var(--navy);color:var(--white);
    font-size:14px;font-weight:700;cursor:pointer;
  }
    .burger{display: none;}


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

  @media (max-width:900px){
    .navbar{padding:10px 16px;gap:8px;}
    .nav-links{display:none;}

    .brand{gap:8px;min-width:0;}
    .brand-logo{width:36px;height:36px;flex-shrink:0;}
    .navbar-logo{height:32px;width:122px;flex-shrink:0;}

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
    .lang-btn{padding:6px 12px;font-size:11.5px;}
    .btn-login{padding:8px 14px;font-size:12.5px;white-space:nowrap;}
    .profile-box{padding:4px 10px 4px 4px;gap:6px;}
    .profile-avatar{width:26px;height:26px;}
    .profile-name{font-size:11.5px;max-width:80px;}
    .logout-btn{padding:6px 12px;font-size:11px;white-space:nowrap;}

    .burger{display:flex;}
    .nav-links{
      display:flex;
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
      opacity:0;
      visibility:hidden;
      transform:translateY(-10px);
      pointer-events:none;
      transition:opacity .25s ease, transform .25s ease, visibility .25s ease;
    }
    .nav-links.open{
      opacity:1;
      visibility:visible;
      transform:translateY(0);
      pointer-events:auto;
    }
    .nav-links li{width:100%;}
    .nav-links li a{
      padding:14px 4px;
      width:100%;
      justify-content:space-between;
      border-bottom:1px solid #f1f4f5;
    }
    .nav-links li.active::after{display:none;}
  }

  @media (max-width:420px){
    .btn-login{padding:8px 10px;}
    .profile-name{display:none;}
    .profile-box{padding:4px;}
  }

  /* ---------- Hero / Page Banner (sama seperti Profil, Layanan, Informasi) ---------- */
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

  @media (max-width:900px){
    .hero-profil{margin-top:62px;padding:70px 20px 44px;}
    .hero-profil h1{font-size:24px;}
  }

  /* ---------- POLA BATIK (sama seperti halaman lain) ---------- */
  .konten-batik{
    position:relative;
    z-index:0;
    background-color:#14839C1A;
  }
  .konten-batik::before{
    content:"";
    position:absolute;
    opacity: .2;
    inset:0;
    z-index:-1;
    pointer-events:none;
    background-image:url('{{ asset('images/group-batik.png') }}');
    background-repeat:no-repeat;
    background-position:center top;
    background-size:10000px auto;
    filter:url(#batikBoostLight);
    opacity:.1;
  }
  [data-theme="dark"] .konten-batik{background-color:#0e1b23;}
  [data-theme="dark"] .konten-batik::before{filter:url(#batikTintTeal);opacity:.1;}
  @media (max-width:900px){
    .konten-batik::before{background-size:3000px auto;}
  }

  /* ---------- Kontak: Informasi & Form ---------- */
  .kontak-page{
    background:rgba(255, 255, 255, 0.2);
    padding:70px 100px 40px;
    opacity:0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .kontak-page.show{opacity:1;transform:translateY(0);}

  .kontak-grid{
    max-width:1240px;
    margin:0 auto;
    display:grid;
    grid-template-columns:0.82fr 1fr;
    gap:70px;
    align-items:start;
  }

  /* --- Kolom info --- */

  .kontak-info{
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    padding:30px;
    max-width: 500px;
    height: 430px;
  }
  .kontak-info h2{
    margin-top:14px;
    font-size:26px;
    font-weight:800;
    color:var(--navy);
    letter-spacing:-.01em;
  }

  .kontak-info-list{
    margin-top:28px;
    display:flex;
    flex-direction:column;
  }
  .kontak-info-item{
    display:flex;
    gap:16px;
    padding:20px 0;
    border-bottom:1px solid #eef1f3;
  }
  .kontak-info-item:first-child{padding-top:0;}
  .kontak-info-item:last-child{border-bottom:none;padding-bottom:0;}

  .kontak-info-icon{
    width:20px;height:20px;
    color:var(--teal);
    flex-shrink:0;
    margin-top:2px;
  }
  .kontak-info-icon svg{
    width:100%;height:100%;
    stroke:currentColor;
    fill:none;
    stroke-width:1.8;
    stroke-linecap:round;
    stroke-linejoin:round;
  }

  .kontak-info-body .title{
    font-size:14.5px;
    font-weight:700;
    color:var(--navy);
  }
  .kontak-info-body .desc{
    margin-top:4px;
    font-size:13.5px;
    color:#7a8a92;
    line-height:1.65;
  }

  .kontak-social{
    margin-top:28px;
    display:flex;
    gap:10px;
  }
  .kontak-social a{
    width:38px;height:38px;
    border-radius:10px;
    border:1px solid #dfe4e7;
    color:#5b6b73;
    display:flex;align-items:center;justify-content:center;
    transition:.2s ease;
  }
  .kontak-social a:hover{
    background:var(--teal);
    border-color:var(--teal);
    color:var(--white);
  }
  .kontak-social svg{
    width:15px;height:15px;
    stroke:currentColor;
    fill:none;
    stroke-width:1.8;
    stroke-linecap:round;
    stroke-linejoin:round;
  }

  /* --- Kolom form --- */
  .kontak-form-card{
    background-color: rgba(255, 255, 255, 0.5);
    border-radius:1px 20px 1px 20px;
    padding:40px 44px;
    box-shadow:0 30px 60px -28px rgba(11,34,51,.22);
    border:1px solid #eef1f3;
  }
  .kontak-form-card h3{
    font-size:20px;
    font-weight:800;
    color:var(--navy);
  }
  .kontak-form-card > p{
    margin-top:8px;
    color:#7a8a92;
    font-size:13.5px;
    line-height:1.65;
  }

  form.kontak-form{margin-top:24px;}

  .form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
    margin-top:20px;
  }
  .form-row:first-of-type{margin-top:0;}

  .form-field label{
    display:block;
    font-size:13px;
    font-weight:700;
    color:var(--navy);
    margin-bottom:8px;
  }
  .form-field label.required::after{
    content:" *";
    color:#c0392b;
  }
  [data-theme="dark"] .form-field label.required::after{color:#ff8f8a;}
  .form-field input,
  .form-field select,
  .form-field textarea{
    width:100%;
    border:1px solid #dfe4e7;
    border-radius:8px;
    padding:12px 14px;
    font-size:13.5px;
    font-family:inherit;
    color:var(--ink);
    background:var(--white);
    transition:.2s ease;
  }
  .form-field input::placeholder,
  .form-field textarea::placeholder{color:#a7b3b8;}
  .form-field input:focus,
  .form-field select:focus,
  .form-field textarea:focus{
    outline:none;
    border-color:var(--teal); 
    box-shadow:0 0 0 3px rgba(20,128,140,.12);
  }
  .form-field select{
    appearance:none;
    -webkit-appearance:none;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%235b6b73' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 14px center;
    padding-right:36px;
    cursor:pointer;
  }
  .form-field textarea{
    resize:vertical;
    min-height:120px;
    font-family:inherit;
  }
  .form-field.full{grid-column:1/-1;}
  .form-field small.error{display:block;margin-top:6px;color:#c0392b;font-size:12px;font-weight:600;}
  [data-theme="dark"] .form-field small.error{color:#ff8f8a;}

  .kontak-form-footer{
    margin-top:26px;
    display:flex;
    align-items:center;
    gap:18px;
    flex-wrap:wrap;
  }
  .btn-kirim{
    display:flex;
    align-items:center;
    gap:10px;
    background:var(--navy);
    color:var(--white);
    border:none;
    padding:14px 26px;
    border-radius:8px;
    font-size:13px;
    font-weight:700;
    letter-spacing:.04em;
    cursor:pointer;
    transition:.2s ease;
  }
  .btn-kirim:hover{
    background:var(--teal);
    transform:translateY(-2px);
  }
  .btn-kirim svg{
    width:15px;height:15px;
    stroke:currentColor;
    fill:none;
    stroke-width:2;
    stroke-linecap:round;
    stroke-linejoin:round;
  }
  .kontak-form-footer .note{
    font-size:12px;
    color:#9aa8af;
    font-weight:500;
  }

  @media (max-width:900px){
    .kontak-page{padding:50px 20px 20px;}
    .kontak-grid{grid-template-columns:1fr;gap:50px;}
    .kontak-form-card{padding:28px 24px;}
    .form-row{grid-template-columns:1fr;gap:16px;}
  }

  /* ---------- Lokasi ---------- */
  .lokasi{
    background-color: rgba(255, 255, 255, 0.7);
    padding:30px 100px 110px;
    opacity:0;
    transform:translateY(60px);
    transition:opacity .9s ease, transform .9s ease;
  }
  .lokasi.show{opacity:1;transform:translateY(0);}
  .lokasi-inner{max-width:1240px;margin:0 auto;}
  .lokasi-inner h2{
    margin-top:14px;
    font-size:26px;
    font-weight:800;
    color:var(--navy);
    letter-spacing:-.01em;
  }

  .lokasi-map{
    margin-top:30px;
    position:relative;
    overflow:hidden;
    border-radius:1px 20px 1px 20px;
    min-height:340px;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:14px;
    background:
      radial-gradient(120% 140% at 15% 10%, var(--teal) 0%, transparent 55%),
      linear-gradient(150deg, var(--navy) 0%, var(--navy) 45%, var(--teal) 100%);
    box-shadow:0 30px 60px -28px rgba(11,34,51,.3);
  }
  .lokasi-map iframe{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    border:0;
    display:block;
  }
  @media (max-width:900px){
    .lokasi{padding:20px 20px 80px;}
    .lokasi-map{min-height:260px;}
  }

  .footer-divider{
    margin-top:-1px;
    height:3px;
    background:linear-gradient(10deg, #057888 0%, #052D46 55%, #052D46 100%);
  }

  /* ---------- Footer (sama seperti beranda) ---------- */
  .footer{
    position:relative;
    background:#052D46;
    padding:64px 100px 0;
    overflow:hidden;
  }
  /* Motif batik dekoratif di ujung kiri footer — sama seperti beranda */
  .footer::before{
    content:"";position:absolute;inset:-40px 0 -80px;
    background-repeat:no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat, no-repeat;
    background-image:url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}'),url('{{ asset('images/motif-batik.png') }}');
    background-position:left -100px bottom -30px,right -80px top -40px,30% 68%,35% 15%,55% 82%,75% 20%,90% 75%;
    background-size:480px auto,320px auto,150px auto,130px auto,170px auto,140px auto,220px auto;
    filter:brightness(0) invert(1);opacity:.5;pointer-events:none;z-index:0;
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
    background:var(--teal);
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
      background-size:170px auto,140px auto,65px auto,55px auto,70px auto,60px auto,90px auto;
      background-position:left -40px bottom -10px,right -40px top -20px,38% 68%,35% 15%,55% 82%,75% 20%,90% 75%;
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

  /* ---------- Dark mode: Kontak page-specific ---------- */
  [data-theme="dark"] .eyebrow{color:#5FC0D1;}
  [data-theme="dark"] .eyebrow::before{background:#5FC0D1;}
  [data-theme="dark"] .kontak-batik{display: none;}
  [data-theme="dark"] .kontak-page{background:rgba(0, 0, 0, 0.2);}
  [data-theme="dark"] .kontak-info{background-color:rgba(0, 0, 0, 0.8);}
  [data-theme="dark"] .kontak-info h2,
  [data-theme="dark"] .lokasi-inner h2{color:#eaf3f5;}
  [data-theme="dark"] .kontak-info-item{border-bottom-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .kontak-info-icon{color:#5FC0D1;}
  [data-theme="dark"] .kontak-info-body .title{color:#eaf3f5;}
  [data-theme="dark"] .kontak-info-body .desc{color:#8ea0a8;}

  [data-theme="dark"] .kontak-social a{
    background:#122530;border-color:rgba(255,255,255,.14);color:#c3cdd2;
  }
  [data-theme="dark"] .kontak-social a:hover{
    background:#5FC0D1;border-color:#5FC0D1;color:#0b1720;
  }

  [data-theme="dark"] .kontak-form-card{
    background:rgba(0, 0, 0, 0.8);
    border-color: rgba(0, 0, 0, 0.8);
    box-shadow:0 30px 60px -28px rgba(0,0,0,.6);
  }
  [data-theme="dark"] .kontak-form-card h3{color:#eaf3f5;}
  [data-theme="dark"] .kontak-form-card > p{color:#8ea0a8;}

  [data-theme="dark"] .form-field label{color:#eaf3f5;}
  [data-theme="dark"] .form-field input,
  [data-theme="dark"] .form-field select,
  [data-theme="dark"] .form-field textarea{
    background-color:#0b1720;
    border-color:rgba(255,255,255,.14);
    color:#c3cdd2;
  }
  [data-theme="dark"] .form-field input::placeholder,
  [data-theme="dark"] .form-field textarea::placeholder{color:#8ea0a8;}
  [data-theme="dark"] .form-field input:focus,
  [data-theme="dark"] .form-field select:focus,
  [data-theme="dark"] .form-field textarea:focus{
    border-color:#5FC0D1;
    box-shadow:0 0 0 3px rgba(95,192,209,.18);
  }
  [data-theme="dark"] .form-field select{
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%235FC0D1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
  }

  [data-theme="dark"] .btn-kirim{background:#5FC0D1;color:#0b1720;}
  [data-theme="dark"] .btn-kirim:hover{background:#7fd3e0;}
  [data-theme="dark"] .kontak-form-footer .note{color:#8ea0a8;}

  [data-theme="dark"] .lokasi{background-color: rgba(18, 36, 46, 0.8);}
  [data-theme="dark"] .lokasi-map{
    box-shadow:0 30px 60px -28px rgba(0,0,0,.6);
  }

  [data-theme="dark"] .footer-desc{color:rgba(255,255,255,.5);}
  [data-theme="dark"] .footer-social a{
    border-color:rgba(255,255,255,.14);color:rgba(255,255,255,.65);
  }
  [data-theme="dark"] .footer-social a:hover{
    background:#5FC0D1;border-color:#5FC0D1;color:#0b1720;
  }
  [data-theme="dark"] .footer-col .head{
    color:rgba(255,255,255,.8);border-bottom-color:#5FC0D1;
  }
  [data-theme="dark"] .footer-links a{color:rgba(255,255,255,.55);}
  [data-theme="dark"] .footer-links a .chev{color:#5FC0D1;}
  [data-theme="dark"] .footer-links a:hover{color:#eaf3f5;}
  [data-theme="dark"] .footer-contact .item{color:rgba(255,255,255,.6);}
  [data-theme="dark"] .footer-contact .item svg{stroke:#5FC0D1;}
  [data-theme="dark"] .footer-bottom{border-top-color:rgba(255,255,255,.08);}
  [data-theme="dark"] .footer-bottom p{color:rgba(255,255,255,.4);}
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
      <li><a href="{{ route('home') }}" data-en="Home">Beranda</a></li>
      <li><a href="{{ route('profil') }}" data-en="Profile">Profil </a></li>
      <li><a href="{{ route('layanan') }}" data-en="Services">Layanan</a></li>
      <li><a href="{{ route('informasi') }}" data-en="Information">Informasi</a></li>
      <li><a href="{{ route('galeri') }}" data-en="Gallery">Galeri</a></li>
      <li class="active"><a href="{{ route('kontak') }}" data-en="Contact">Kontak</a></li>
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
      <p class="breadcrumb" data-en-html="Home / &lt;span&gt;Contact&lt;/span&gt;">Beranda / <span>Kontak</span></p>
      <h1 data-en-html="We're ready to <span class=&quot;accent&quot;>help you</span>">Kami siap <span class="accent">membantu Anda</span></h1>
      <p data-en="Contact us for questions about services, partnerships, or technical support.">Hubungi kami untuk pertanyaan seputar layanan, kerja sama, atau bantuan teknis.</p>
    </div>
  </header>

  <div class="konten-batik">

  {{-- ================= INFORMASI KONTAK & FORM ================= --}}
  <section class="kontak-page">
    <div class="kontak-grid">

      {{-- Kolom kiri: Informasi kontak --}}
      <div class="kontak-info">
        <div class="eyebrow" data-en="CONTACT INFORMATION">INFORMASI KONTAK</div>
        <h2 data-en="Have a Question?">Ada Pertanyaan?</h2>

        <div class="kontak-info-list">
          <div class="kontak-info-item">
          <div class="kontak-info-icon">
            <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div class="kontak-info-body">
            <div class="title" data-en="Address">Alamat</div>
            <div class="desc" data-en="{{ $setting->address_en ?: ($setting->address ?? 'Address not set') }}">{{ $setting->address ?? 'Alamat belum diatur' }}</div>
          </div>
        </div>

        <div class="kontak-info-item">
          <div class="kontak-info-icon">
            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div class="kontak-info-body">
            <div class="title" data-en="Phone">Telepon</div>
            <div class="desc">{{ $setting->phone ?? '-' }}</div>
          </div>
        </div>

        <div class="kontak-info-item">
          <div class="kontak-info-icon">
            <svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg>
          </div>
          <div class="kontak-info-body">
            <div class="title">Email</div>
            <div class="desc">{{ $setting->email ?? '-' }}</div>
          </div>
        </div>
      </div>
      </div>


      {{-- Kolom kanan: Form kirim pesan --}}
      <div class="kontak-form-card">
        <h3 data-en="Send a Message">Kirim Pesan</h3>
        <p data-en="Fill out the form below, our team will respond within 1&times;24 working hours.">Isi formulir berikut, tim kami akan merespons dalam 1&times;24 jam kerja.</p>

        @if(session('status'))
          <div style="margin-bottom:20px;padding:14px 18px;border-radius:10px;background:#e6f7ee;color:#1f9d7c;font-size:13.5px;font-weight:600;">
            {{ session('status') }}
          </div>
        @endif
        <form class="kontak-form" method="POST" action="{{ route('kontak.kirim') }}">
          @csrf

          <div class="form-row">
            <div class="form-field">
              <label for="nama" class="required" data-en="Full name">Nama lengkap</label>
              <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Anda" data-en-placeholder="Your name" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf" required>
              @error('nama')<small class="error">{{ $message }}</small>@enderror
            </div>
            <div class="form-field">
              <label for="email" class="required">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
              @error('email')<small class="error">{{ $message }}</small>@enderror
            </div>
          </div>

          <div class="form-row">
            <div class="form-field">
              <label for="instansi" data-en="Work unit / Institution">Unit kerja / Instansi</label>
              <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}" placeholder="Opsional" data-en-placeholder="Optional">
              @error('instansi')<small class="error">{{ $message }}</small>@enderror
            </div>
            <div class="form-field">
              <label for="kategori" data-en="Category">Kategori</label>
              <select id="kategori" name="kategori">
                <option value="umum" data-en="General question" @selected(old('kategori', 'umum') === 'umum')>Pertanyaan umum</option>
                <option value="teknis" data-en="Technical support" @selected(old('kategori') === 'teknis')>Bantuan teknis</option>
                <option value="kerjasama" data-en="Partnership" @selected(old('kategori') === 'kerjasama')>Kerja sama</option>
                <option value="pengaduan" data-en="Complaint" @selected(old('kategori') === 'pengaduan')>Pengaduan</option>
              </select>
              @error('kategori')<small class="error">{{ $message }}</small>@enderror
            </div>
          </div>

          <div class="form-row">
            <div class="form-field full">
              <label for="pesan" class="required" data-en="Message">Pesan</label>
              <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda di sini..." data-en-placeholder="Write your message here..." required>{{ old('pesan') }}</textarea>
              @error('pesan')<small class="error">{{ $message }}</small>@enderror
            </div>
          </div>

          <div class="kontak-form-footer">
            <button type="submit" class="btn-kirim">
              <svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
              <span data-en="SEND MESSAGE">KIRIM PESAN</span>
            </button>
            <span class="note" data-en="Your data will be kept confidential.">Data Anda akan kami jaga kerahasiaannya.</span>
          </div>
        </form>
      </div>

    </div>
  </section>

  {{-- ================= LOKASI ================= --}}
  @if($setting->show_location ?? true)
  <section class="lokasi">
    <div class="lokasi-inner">
      <div class="eyebrow" data-en="LOCATION">LOKASI</div>
      <h2 data-en="Find Us">Temukan Kami</h2>

      <div class="lokasi-map">
        {{-- Link peta diatur melalui Admin Panel > Pengaturan Footer > Link Peta (Google Maps Embed) --}}
        <iframe
          src="{{ $setting->maps_embed_url ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4137668829876!2d106.79718367398998!3d-6.209030293778832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6b735ae6133%3A0x214dde968c25b376!2sSekretariat%20Jenderal%20Dewan%20Perwakilan%20Rakyat%20Republik%20Indonesia!5e0!3m2!1sid!2sus!4v1784135196454!5m2!1sid!2sus' }}"
          width="100%"
          height="100%"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Lokasi Pustekinfo - Gedung Sekretariat Jakarta">
        </iframe>
      </div>
    </div>
  </section>
  @endif

  </div>
  {{-- /.konten-batik --}}

  <div class="footer-divider"></div>

  {{-- ================= FOOTER (sama seperti beranda) ================= --}}
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
          <a href=""><span class="chev">›</span> <span data-en="Academic System">Sistem Akademik</span></a>
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

    // Theme toggle
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

    // Dropdown Profil (mobile)
    const profilDropdown = document.getElementById("profilDropdown");
    if (window.innerWidth <= 900) {
        profilDropdown.querySelector("a").addEventListener("click", (e) => {
            e.preventDefault();
            profilDropdown.classList.toggle("open");
        });
    }

    // Burger menu
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

    // Fade-in saat scroll
    function observeSection(selector, threshold = 0.15) {
        const section = document.querySelector(selector);
        if (!section) return;
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold });
        observer.observe(section);
    }
    observeSection(".kontak-page", 0.1);
    observeSection(".lokasi", 0.15);

    const namaInput = document.getElementById("nama");
    if (namaInput) {
        namaInput.addEventListener("input", () => {
            namaInput.value = namaInput.value.replace(/[^A-Za-z\s]/g, "");
        });
    }

  </script>

@include('partials.interactive-cursor')
</body>
</html>