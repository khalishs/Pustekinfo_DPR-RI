
<script>
  (function(){
    var wrap = document.querySelector('.konten-batik');
    if (!wrap) return;
    var targets = document.querySelectorAll('.layanan, section.page-section.dark');
    if (!targets.length) return;

    function sync(){
      var wrapTop = wrap.getBoundingClientRect().top;
      targets.forEach(function(el){
        var offset = el.getBoundingClientRect().top - wrapTop;
        el.style.setProperty('--batik-offset-y', (-offset).toFixed(1) + 'px');
      });
    }

    sync();
    window.addEventListener('load', sync);
    window.addEventListener('resize', sync);

    if ('ResizeObserver' in window) {
      new ResizeObserver(sync).observe(wrap);
    }

    // Section yang punya animasi reveal (translateY masuk) baru sampai posisi
    // akhirnya beberapa saat setelah class "show" ditambahkan — resync tiap
    // frame selama animasi itu berlangsung supaya polanya tetap menyambung.
    targets.forEach(function(el){
      var mo = new MutationObserver(function(){
        if (!el.classList.contains('show')) return;
        mo.disconnect();
        var start = performance.now();
        (function tick(now){
          sync();
          if (now - start < 950) requestAnimationFrame(tick);
        })(start);
      });
      mo.observe(el, { attributes: true, attributeFilter: ['class'] });
    });
  })();
</script>
<?php /**PATH C:\Users\Khalish\Documents\Pustekinfo_DPR-RI\resources\views/partials/batik-sync.blade.php ENDPATH**/ ?>