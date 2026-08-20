<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Pustekinfo DPR RI</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon-bg.png')); ?>?v=2">
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (sama dengan halaman lain) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body {
            font-family: 'Work Sans', system-ui, sans-serif;
            height: 100%;
            overflow: hidden;
        }
        h1, h2, h3 {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        }
        .bg-gradient-dpr {
            background: linear-gradient(135deg, #005f73 0%, #0a2f5c 100%);
        }
        .banner-photo {
            filter: grayscale(25%) saturate(.8) brightness(.7);
        }

        .ct-left{
            display: flex;
            align-items: center;
        }

        .back-btn{
            border:2px solid #007a8c;
            color:#007a8c;
            background:#fff;
            transition:background-color .15s ease;
        }
        .back-btn:hover{background:#eaf6f7;}

        .field-label{
            display:block;
            font-size:.85rem;
            font-weight:700;
            color:#0a2f5c;
            margin-bottom:.5rem;
        }
        .input-plain{
            width:100%;
            border:1px solid transparent;
            border-radius:.75rem;
            background:#eef1fa;
            padding:1rem 1.1rem;
            font-size:.9rem;
            transition:box-shadow .15s ease;
        }
        .input-plain:focus{outline:none;box-shadow:0 0 0 2px rgba(0,122,140,.45);}

        .btn-primary{
            background:#007a8c;
            color:#fff;
        }
        .btn-primary:hover{background:#005f73;}


            @media (max-width: 768px) {
            .mobile-safe {
                padding: 0.75rem;
            }
            .mobile-card {
                padding: 1rem;
                border-radius: 1.25rem;
            }
            .mobile-logo {
                height: 2.5rem;
            }
            .mobile-text {
                font-size: 0.8rem;
                line-height: 1.5;
            }
            .mobile-input {
                padding-top: 0.85rem;
                padding-bottom: 0.85rem;
            }
            .mobile-button {
                padding-top: 0.85rem;
                padding-bottom: 0.85rem;
            }
        }
        .login-batik-bg{
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background-image: url('<?php echo e(asset('images/group-batik.png')); ?>');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 10000px auto;
            filter: url(#batikBoostLight);
            opacity: .05;
        }
        [data-theme="dark"] .login-batik-bg{
            filter: url(#batikTintTeal);
            opacity: .05;
        }
        .banner-batik-bg{
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image: url('<?php echo e(asset('images/group-batik.png')); ?>');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 10000px auto;
            filter: url(#batikTintTeal);
            opacity: .04;
        }
        .icon-btn{
            width:36px;height:36px;border-radius:50%;
            border:1px solid #dfe4e7;background:#fff;color:#5b6b73;
            display:flex;align-items:center;justify-content:center;
            font-size:14px;cursor:pointer;flex-shrink:0;
        }

        /* ---------- Dark mode ---------- */
        [data-theme="dark"] .bg-gray-50{background-color:#060d12 !important;}
        [data-theme="dark"] .bg-\[\#f4f7f6\]{background-color:#060d12 !important;}
        [data-theme="dark"] .bg-white{background-color:#0c1920 !important;}
        [data-theme="dark"] .border-gray-100{border-color:rgba(255,255,255,.1) !important;}
        [data-theme="dark"] .text-\[\#0a2f5c\]{color:#eaf3f5 !important;}
        [data-theme="dark"] .text-gray-500,
        [data-theme="dark"] .text-gray-600,
        [data-theme="dark"] .text-gray-400{color:#8ea0a8 !important;}
        [data-theme="dark"] input[type="text"],
        [data-theme="dark"] input[type="password"]{
            background-color:#0a141a !important;color:#eaf3f5 !important;
            border-color:rgba(255,255,255,.14) !important;
        }
        [data-theme="dark"] input[type="text"]::placeholder,
        [data-theme="dark"] input[type="password"]::placeholder{color:#5b6b73 !important;}
        [data-theme="dark"] .border-gray-200{border-color:rgba(255,255,255,.14) !important;}
        [data-theme="dark"] .border-gray-300{border-color:rgba(255,255,255,.2) !important;}
        [data-theme="dark"] .bg-teal-50{background-color:rgba(20,131,156,.14) !important;}
        [data-theme="dark"] .border-teal-200{border-color:rgba(20,131,156,.35) !important;}
        [data-theme="dark"] .text-teal-700{color:#5FC0D1 !important;}
        [data-theme="dark"] .bg-red-50{background-color:rgba(176,65,62,.14) !important;}
        [data-theme="dark"] .border-red-200{border-color:rgba(176,65,62,.35) !important;}
        [data-theme="dark"] .icon-btn{background:#0c1920;border-color:rgba(255,255,255,.14);color:#c3cdd2;}
        [data-theme="dark"] .back-btn{background:#0c1920;border-color:#5FC0D1;color:#5FC0D1;}
        [data-theme="dark"] .back-btn:hover{background:#0f2229;}
        [data-theme="dark"] .field-label{color:#eaf3f5;}
        [data-theme="dark"] .input-plain{background:#0a141a;color:#eaf3f5;}
        [data-theme="dark"] .input-plain::placeholder{color:#5b6b73;}

        input.field-invalid{border-color:#ef4444 !important;}
        input.field-invalid:focus{box-shadow:0 0 0 2px rgba(239,68,68,.35) !important;}
        .field-error-msg{display:block;margin-top:6px;color:#ef4444;font-size:12px;font-weight:600;}
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased h-full flex flex-col md:flex-row">

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

    <!-- Sisi Kiri: Form Login -->
    <div class="w-full md:w-5/12 h-full min-h-0 flex flex-col justify-center p-4 sm:p-8 md:p-12 relative bg-[#f4f7f6] mobile-safe overflow-hidden">

        <!-- Background Batik (sama seperti group-batik.png di beranda) -->
        <div class="login-batik-bg absolute inset-0 z-1 pointer-events-none"></div>

        <!-- Container Form (Card Putih) -->
        <div class="relative z-10 w-full max-w-md lg:max-w-lg xl:max-w-xl mx-auto bg-white rounded-3xl p-6 sm:p-8 md:p-10 shadow-xl shadow-gray-200/50 border border-gray-100 mobile-card">

            <div class="mb-6 flex items-center justify-between gap-3">
                <a href="<?php echo e(route('home')); ?>" class="back-btn inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
                <button type="button" class="icon-btn" id="themeToggle" aria-label="Ganti tema" aria-pressed="false">◐</button>
            </div>

            <!-- Logo & Greeting -->
            <div class="text-left mb-7">
                <img src="<?php echo e(asset('images/Logo.png')); ?>" alt="Logo" class="h-11 sm:h-12 mb-3 object-contain mobile-logo">
                <h3 class="text-2xl lg:text-3xl font-bold text-[#0a2f5c]">Selamat Datang</h3>
                <p class="text-sm text-gray-500 mt-2 leading-relaxed mobile-text">Silakan masuk menggunakan email dan password terdaftar Anda.</p>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
                <div class="mb-4 rounded-lg border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-700">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Form input Laravel -->
            <form action="<?php echo e(route('login.post')); ?>" method="POST" class="space-y-5">
                <?php echo csrf_field(); ?>

                <!-- Input Email -->
                <div>
                    <label for="login" class="field-label">Alamat Email</label>
                    <input type="email" name="login" id="login" autocomplete="username"
                        class="input-plain mobile-input"
                        placeholder="nama@email.com" required value="<?php echo e(old('login')); ?>">
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-xs text-red-500 block -mt-2 pl-1"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Input Password -->
                <div>
                    <label for="password" class="field-label">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" autocomplete="current-password"
                            class="input-plain mobile-input pr-12"
                            placeholder="Password" required>
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600">
                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-xs text-red-500 block -mt-2 pl-1"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Opsi Tambahan (Ingat Saya & Lupa Password) -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center space-x-2 text-gray-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 focus:ring-teal-500 accent-teal-600">
                        <span>Ingat Saya</span>
                    </label>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>" class="text-teal-600 font-medium hover:underline">Lupa Password?</a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" class="btn-primary w-full font-bold py-3.5 rounded-xl shadow-md transition-colors uppercase tracking-wider text-sm mt-3 mobile-button">
                    Masuk Sekarang
                </button>
            </form>

            <!-- Helpdesk/Bantuan -->
            <div class="flex items-center justify-center space-x-2 text-xs text-gray-600 mt-5">
                <i class="fa-solid fa-headset text-teal-600 text-base"></i>
                <span>Butuh bantuan? Hubungi <a href="#" class="text-teal-600 font-semibold hover:underline">Helpdesk Pustekinfo</a></span>
            </div>
        </div>

        <!-- Footer Hak Cipta -->
        <div class="text-center text-xs text-gray-400 mt-6">
            &copy; <?php echo e(date('Y')); ?> Pustekinfo DPR RI. All rights reserved.
        </div>
    </div>

    <!-- Sisi Kanan: Branding (Hidden di HP, muncul di MD ke atas) -->
    <div class="ct-left hidden md:flex md:w-7/12 h-full text-white p-12 flex-col justify-between relative overflow-hidden shadow-2xl">

        <!-- Foto latar, diredupkan supaya cuma jadi kesan/tekstur, bukan foto yang menonjol -->
        <div class="banner-photo absolute inset-0"
             style="background-image: url('<?php echo e(asset('images/gedung-dpr-banner.jpg')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
        <div class="absolute inset-0 bg-gradient-dpr opacity-80"></div>
        <div class="banner-batik-bg"></div>

        <!-- Konten Tengah -->
        <div class="mt-16 md:mt-20 mb-auto mx-auto flex flex-col items-center text-center z-10">
            <!-- Ganti src dengan logo asli Anda -->
            <div class="logo-frame mb-4 flex items-center justify-center p-6 lg:p-8 rounded-3xl bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg">
                <img src="<?php echo e(asset('images/Logo.png')); ?>" alt="Logo Pustekinfo" class="h-20 lg:h-24 object-contain fallback-logo">
                <!-- Fallback jika gambar tidak ada (CSS Hacking untuk demo) -->
                <div class="w-24 h-24 flex items-center justify-center font-bold text-5xl text-teal-400 unique-logo-placeholder hidden">//</div>
            </div>

            <h1 class="pustek text-4xl lg:text-5xl font-semibold tracking-wide uppercase">Pustekinfo</h1>
            <p class="text-teal-300 text-1xl lg:text-2xl tracking-wide font-medium">Sekretariat Jenderal DPR RI</p>

            <div class="w-16 h-0.5 bg-teal-400 my-8 opacity-50"></div>

            <h2 class="text-lg font-bold px-4 leading-snug">Pusat Teknologi Informasi dan Komunikasi</h2>
            <p class="text-xs text-gray-300 mt-2 px-6 leading-relaxed">
                Sekretariat Jenderal Dewan Perwakilan Rakyat<br>Republik Indonesia
            </p>
        </div>

        <!-- Background gedung siluet (Opsional, menggunakan overlay warna jika tidak ada gambar) -->
        <div class="absolute bottom-0 left-0 right-0 h-48 bg-black/10 mix-blend-overlay pointer-events-none"></div>
    </div>

    <!-- Script Sederhana Show/Hide Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        const themeToggle = document.getElementById('themeToggle');
        function applyTheme(isDark) {
            document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
            themeToggle.setAttribute('aria-pressed', String(isDark));
            themeToggle.textContent = isDark ? '◑' : '◐';
        }
        applyTheme(localStorage.getItem('theme') === 'dark');
        themeToggle.addEventListener('click', () => {
            const isDark = document.documentElement.getAttribute('data-theme') !== 'dark';
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            applyTheme(isDark);
        });
    </script>
<?php echo $__env->make('partials.form-validation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('partials.page-loading', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH C:\Users\Khalish\Documents\Pustekinfo_DPR-RI\resources\views/login.blade.php ENDPATH**/ ?>