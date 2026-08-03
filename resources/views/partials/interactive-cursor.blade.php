{{-- resources/views/partials/interactive-cursor.blade.php --}}
{{-- Native cursor stays visible; a trailing ring + magnetic hover on CTA buttons layer on top. Desktop/mouse only (pointer:fine), skipped for touch and prefers-reduced-motion. --}}
<style>
  @media (pointer: fine) {
    .cursor-ring {
      position: fixed;
      top: 0; left: 0;
      pointer-events: none;
      z-index: 100000;
      opacity: 0;
      will-change: transform;
      width: 36px; height: 36px;
      margin: -18px 0 0 -18px;
      border-radius: 50%;
      border: 1.5px solid rgba(20,128,140,.55);
      transition: opacity .25s ease, width .25s ease, height .25s ease, margin .25s ease, border-color .25s ease, background-color .25s ease;
    }
    .cursor-ring.is-visible { opacity: 1; }
    .cursor-ring.is-hover {
      width: 58px; height: 58px;
      margin: -29px 0 0 -29px;
      border-color: var(--teal, #14839C);
      background: rgba(20,128,140,.08);
    }
    [data-theme="dark"] .cursor-ring { border-color: rgba(95,192,209,.5); }
    [data-theme="dark"] .cursor-ring.is-hover { border-color: #5FC0D1; background: rgba(95,192,209,.12); }

    [class*="btn"] { transition: transform .2s ease; }
  }
</style>

<script>
(function () {
  if (!window.matchMedia("(pointer: fine)").matches) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  const ring = document.createElement("div");
  ring.className = "cursor-ring";
  document.body.append(ring);

  let mouseX = -100, mouseY = -100;
  let ringX = -100, ringY = -100;

  window.addEventListener("mousemove", (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    ring.classList.add("is-visible");
  }, { passive: true });

  document.addEventListener("mouseleave", () => {
    ring.classList.remove("is-visible");
  });

  (function loop() {
    ringX += (mouseX - ringX) * 0.18;
    ringY += (mouseY - ringY) * 0.18;
    ring.style.transform = `translate(${ringX}px, ${ringY}px)`;
    requestAnimationFrame(loop);
  })();

  const hoverSelector = 'a, button, input, select, textarea, label, [role="button"], [class*="btn"], .lang-btn, .theme-fab, .burger, .galeri-filter, .info-filter, .tab-link, .footer-social a, .kontak-social a';
  document.addEventListener("mouseover", (e) => {
    if (e.target.closest && e.target.closest(hoverSelector)) ring.classList.add("is-hover");
  });
  document.addEventListener("mouseout", (e) => {
    if (e.target.closest && e.target.closest(hoverSelector)) ring.classList.remove("is-hover");
  });

  // ---- Magnetic hover: CTA-style buttons pull slightly toward the cursor ----
  document.querySelectorAll('[class*="btn"]').forEach((el) => {
    el.addEventListener("mousemove", (e) => {
      const rect = el.getBoundingClientRect();
      const relX = e.clientX - rect.left - rect.width / 2;
      const relY = e.clientY - rect.top - rect.height / 2;
      el.style.transform = `translate(${(relX * 0.25).toFixed(1)}px, ${(relY * 0.25).toFixed(1)}px)`;
    }, { passive: true });
    el.addEventListener("mouseleave", () => {
      el.style.transform = "";
    });
  });
})();
</script>
