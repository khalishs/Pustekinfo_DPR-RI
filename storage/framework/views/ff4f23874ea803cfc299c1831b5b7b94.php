
<style>
  .pub-loading-bar{
    position:fixed;top:0;left:0;height:3px;width:0;
    background:linear-gradient(90deg,var(--teal,#14839C),#5FC0D1,var(--gold,#c9a34e));
    box-shadow:0 0 10px rgba(20,128,140,.65);
    z-index:10000;transition:width .35s ease,opacity .25s ease .1s;
    opacity:0;pointer-events:none;
  }
  .pub-loading-bar.is-active{opacity:1;transition:width .35s ease;}

  .pub-loading-overlay{
    position:fixed;inset:0;z-index:9999;
    background:rgba(6,18,26,.6);backdrop-filter:blur(6px);
    display:flex;align-items:center;justify-content:center;
    opacity:0;pointer-events:none;transition:opacity .22s ease;
  }
  .pub-loading-overlay.is-visible{opacity:1;pointer-events:auto;}

  .pub-loading-box{
    display:flex;flex-direction:column;align-items:center;gap:22px;
    background:var(--white,#fff);border-radius:28px;padding:44px 48px 38px;
    box-shadow:0 32px 80px -18px rgba(20,128,140,.3),0 16px 40px -14px rgba(11,34,51,.4);
    text-align:center;width:min(90vw,380px);
    transform:scale(.82) translateY(14px);
    opacity:0;
    transition:transform .4s cubic-bezier(.34,1.56,.64,1),opacity .25s ease;
  }
  .pub-loading-overlay.is-visible .pub-loading-box{
    transform:scale(1) translateY(0);
    opacity:1;
  }
  [data-theme="dark"] .pub-loading-box{background:#0c1920;}

  .pub-loading-orbit{position:relative;width:92px;height:92px;display:flex;align-items:center;justify-content:center;}
  .pub-loading-orbit::before{
    content:"";position:absolute;inset:0;border-radius:50%;
    background:conic-gradient(from 0deg,transparent 0deg,var(--teal,#14839C) 100deg,#5FC0D1 190deg,var(--gold,#c9a34e) 270deg,transparent 320deg);
    -webkit-mask:radial-gradient(farthest-side,transparent calc(100% - 4px),#000 calc(100% - 4px));
    mask:radial-gradient(farthest-side,transparent calc(100% - 4px),#000 calc(100% - 4px));
    animation:pub-orbit-spin 1.3s linear infinite;
  }
  .pub-loading-orbit::after{
    content:"";position:absolute;inset:10px;border-radius:50%;
    background:radial-gradient(circle,rgba(20,128,140,.2),transparent 72%);
    animation:pub-pulse-glow 2s ease-in-out infinite;
  }
  .pub-loading-logo{
    position:relative;z-index:1;width:56px;height:56px;border-radius:50%;
    background:var(--white,#fff);padding:10px;object-fit:contain;
    box-shadow:0 8px 20px -6px rgba(11,34,51,.35);
    animation:pub-logo-breathe 2s ease-in-out infinite;
  }
  [data-theme="dark"] .pub-loading-logo{background:#122530;}
  @keyframes pub-orbit-spin{to{transform:rotate(360deg);}}
  @keyframes pub-pulse-glow{0%,100%{transform:scale(.85);opacity:.5;}50%{transform:scale(1.3);opacity:1;}}
  @keyframes pub-logo-breathe{0%,100%{transform:scale(1);}50%{transform:scale(1.07);}}

  .pub-loading-copy{display:flex;flex-direction:column;gap:6px;}
  .pub-loading-heading{
    font-family:'Plus Jakarta Sans',system-ui,sans-serif;
    font-size:19px;font-weight:800;color:var(--navy,#12242E);letter-spacing:-.01em;
    display:flex;align-items:baseline;justify-content:center;gap:2px;
  }
  [data-theme="dark"] .pub-loading-heading{color:#eaf3f5;}
  .pub-loading-dots i{font-style:normal;opacity:.25;animation:pub-dot-pulse 1.3s ease-in-out infinite;}
  .pub-loading-dots i:nth-child(2){animation-delay:.15s;}
  .pub-loading-dots i:nth-child(3){animation-delay:.3s;}
  @keyframes pub-dot-pulse{0%,60%,100%{opacity:.25;}30%{opacity:1;}}

  .pub-loading-text{font-size:13.5px;font-weight:600;color:var(--teal,#14839C);}
  [data-theme="dark"] .pub-loading-text{color:#5FC0D1;}
</style>
<script>
  (function(){
    var bar = document.createElement('div');
    bar.className = 'pub-loading-bar';
    document.body.appendChild(bar);

    var overlay = document.createElement('div');
    overlay.className = 'pub-loading-overlay';
    overlay.setAttribute('aria-hidden', 'true');
    overlay.innerHTML =
      '<div class="pub-loading-box">' +
        '<div class="pub-loading-orbit">' +
          '<img src="<?php echo e(asset('images/Logo.png')); ?>" alt="Logo Pustekinfo" class="pub-loading-logo">' +
        '</div>' +
        '<div class="pub-loading-copy">' +
          '<span class="pub-loading-heading">Tolong menunggu sesaat<span class="pub-loading-dots"><i>.</i><i>.</i><i>.</i></span></span>' +
          '<span class="pub-loading-text">Sedang memuat halaman...</span>' +
        '</div>' +
      '</div>';
    document.body.appendChild(overlay);

    var progress = 0, progressTimer = null, active = false;

    function startBar(){
      active = true;
      clearInterval(progressTimer);
      progress = 20;
      bar.classList.add('is-active');
      bar.style.width = progress + '%';
      progressTimer = setInterval(function(){
        progress += (90 - progress) * 0.1;
        bar.style.width = Math.min(progress, 90) + '%';
      }, 200);
    }

    function showOverlay(){
      overlay.classList.add('is-visible');
      overlay.setAttribute('aria-hidden', 'false');
    }

    // Navigasi lewat klik link internal (bukan tab baru/anchor/aksi lain)
    document.addEventListener('click', function(e){
      if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
      var link = e.target.closest('a[href]');
      if (!link || (link.target && link.target !== '_self') || link.hasAttribute('download')) return;
      var href = link.getAttribute('href') || '';
      if (!href || href.charAt(0) === '#' || /^(javascript:|mailto:|tel:|https?:\/\/wa\.me)/.test(href)) return;
      // Jangan tampilkan loading untuk link eksternal (domain lain).
      try {
        var url = new URL(href, window.location.href);
        if (url.origin !== window.location.origin) return;
      } catch (err) { return; }
      startBar();
      showOverlay();
    });

    // Submit form (baru tampil kalau validasi field sudah lolos — lihat
    // partials/form-validation.blade.php yang membatalkan submit event
    // duluan kalau ada isian yang belum valid).
    document.addEventListener('submit', function(e){
      if (e.defaultPrevented) return;
      startBar();
      showOverlay();
    });

    // Fallback untuk reload/refresh/navigasi lain yang tidak lewat klik/submit
    window.addEventListener('beforeunload', function(){
      if (!active) startBar();
    });

    // Pulihkan tampilan kalau halaman diambil dari bfcache (tombol back/forward)
    window.addEventListener('pageshow', function(e){
      if (e.persisted) {
        active = false;
        clearInterval(progressTimer);
        bar.classList.remove('is-active');
        bar.style.width = '0%';
        overlay.classList.remove('is-visible');
        overlay.setAttribute('aria-hidden', 'true');
      }
    });
  })();
</script>
<?php /**PATH C:\Users\Khalish\Documents\Pustekinfo_DPR-RI\resources\views/partials/page-loading.blade.php ENDPATH**/ ?>