{{-- resources/views/partials/batik-sync.blade.php
     Beberapa section (mis. .layanan di beranda) navy/gelap punya lapisan pola
     batik sendiri (::before) di atas .konten-batik, supaya kontras & tetap
     kelihatan di atas warna gelap. Karena keduanya menghitung posisi pola
     dari titik atas elemennya masing-masing, kalau tidak disamakan motifnya
     "putus"/tidak nyambung persis di batas section gelap tsb. Var CSS
     --batik-offset-y dipakai di background-position section itu supaya
     motifnya menyambung jadi satu gambar utuh dengan pola di .konten-batik
     di belakangnya.

     Disinkron ulang pakai ResizeObserver (bukan cuma event resize/load) supaya
     tetap presisi walau posisi section bergeser karena sebab lain: font baru
     selesai dimuat (reflow teks), gambar lazy-load, ganti tab, dll — semua itu
     otomatis kebaca lewat perubahan tinggi .konten-batik, tanpa perlu
     didaftar satu-satu. --}}
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
