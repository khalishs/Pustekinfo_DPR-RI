
<script>
  (function(){
    document.querySelectorAll('form').forEach(function(form){
      form.setAttribute('novalidate', 'novalidate');
    });

    function clean(str){ return (str || '').replace(/\s+/g, ' ').trim(); }

    function fieldLabel(field){
      if (field.id) {
        var byFor = document.querySelector('label[for="' + field.id + '"]');
        if (byFor) return clean(byFor.textContent);
      }
      var container = field.closest('.form-group, .form-field, .form-row, .field');
      var labelEl = container ? container.querySelector('label') : null;
      if (labelEl) return clean(labelEl.textContent);
      var wrapLabel = field.closest('label');
      if (wrapLabel) return clean(wrapLabel.textContent);
      if (field.placeholder) return clean(field.placeholder);
      return field.name || 'Kolom ini';
    }

    function messageFor(field){
      var v = field.validity;
      var label = fieldLabel(field);

      if (v.valueMissing) {
        if (field.type === 'file') return 'Anda harus memilih berkas untuk ' + label + '.';
        if (field.tagName === 'SELECT') return 'Pilih ' + label.toLowerCase() + '.';
        if (field.type === 'checkbox' || field.type === 'radio') return label + ' harus dicentang.';
        return label + ' wajib diisi.';
      }
      if (v.typeMismatch) {
        if (field.type === 'email') return 'Format email tidak valid.';
        if (field.type === 'url') return 'Format URL tidak valid.';
        return 'Format ' + label.toLowerCase() + ' tidak valid.';
      }
      if (v.tooShort) return label + ' minimal ' + field.minLength + ' karakter.';
      if (v.tooLong) return label + ' maksimal ' + field.maxLength + ' karakter.';
      if (v.rangeUnderflow) return label + ' minimal ' + field.min + '.';
      if (v.rangeOverflow) return label + ' maksimal ' + field.max + '.';
      if (v.stepMismatch) return 'Nilai ' + label.toLowerCase() + ' tidak sesuai kelipatan yang diizinkan.';
      if (v.patternMismatch) return field.title || ('Format ' + label.toLowerCase() + ' tidak sesuai.');
      if (v.badInput) return 'Isian ' + label.toLowerCase() + ' tidak valid.';
      return field.validationMessage || (label + ' tidak valid.');
    }

    // Untuk field yang dibungkus wrapper "relative" (ikon di dalam input,
    // gaya form login) taruh pesan error setelah wrapper-nya, bukan setelah
    // input itu sendiri — supaya ikon (posisinya absolute, inset-y-0) tetap
    // center terhadap tinggi input dan tidak ikut turun waktu ada teks error.
    function errorAnchor(field){
      var parent = field.parentElement;
      if (parent && parent.classList.contains('relative')) return parent;
      return field;
    }

    // Cuma pegang elemen error yang dibuat sendiri (penanda field-error-msg),
    // supaya tidak ganggu pesan error dari server (@ error Blade) atau
    // validator lain yang sudah ada (mis. validasi ukuran file di admin).
    function clearFieldError(field){
      field.classList.remove('field-invalid');
      var next = errorAnchor(field).nextElementSibling;
      if (next && next.classList.contains('field-error-msg')) next.remove();
    }

    function showFieldError(field, msg){
      field.classList.add('field-invalid');
      var err = document.createElement('small');
      err.className = 'error field-error-msg';
      err.textContent = msg;
      errorAnchor(field).insertAdjacentElement('afterend', err);
    }

    document.addEventListener('input', function(e){
      if (e.target.matches('input, textarea')) clearFieldError(e.target);
    });
    document.addEventListener('change', function(e){
      if (e.target.matches('select, input[type="checkbox"], input[type="radio"], input[type="file"]')) clearFieldError(e.target);
    });

    // Capture phase supaya jalan lebih dulu daripada listener submit lain
    // (mis. indikator loading di admin) — kalau tidak valid, itu tidak ikut jalan.
    document.addEventListener('submit', function(e){
      var form = e.target;
      if (!(form instanceof HTMLFormElement)) return;

      var invalids = [];
      form.querySelectorAll('input, select, textarea').forEach(function(field){
        clearFieldError(field);
        if (field.disabled) return;
        if (!field.checkValidity()) invalids.push(field);
      });

      if (invalids.length) {
        e.preventDefault();
        invalids.forEach(function(field){ showFieldError(field, messageFor(field)); });
        invalids[0].focus();
        invalids[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    }, true);
  })();
</script>
<?php /**PATH C:\laragon\www\Pustekinfo-DPR\resources\views/partials/form-validation.blade.php ENDPATH**/ ?>