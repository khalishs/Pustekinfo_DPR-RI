<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - PusTekInfo DPR RI</title>
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
            min-height: 100vh;
        }
        h1, h2, h3 {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        }
        .bg-gradient-dpr {
            background: linear-gradient(135deg, #005f73 0%, #0a2f5c 100%);
        }

        .space-y-5{
            margin-top: -40px;
        }

        .text-center{
            margin-bottom:45px;
        }

        .footer{
            margin-top:7px;
        }
        
        .back{
            margin-top: -10px;
        }
        

            @media (max-width: 768px) {
            body {
                display: block;
            }
            .mobile-safe {
                padding: 1rem;
            }
            .mobile-card {
                padding: 1.25rem;
                border-radius: 1.25rem;
            }
            .mobile-logo {
                height: 3rem;
            }
            .mobile-text {
                font-size: 0.75rem;
                line-height: 1.5;
            }
            .mobile-input {
                padding-top: 0.9rem;
                padding-bottom: 0.9rem;
            }
            .mobile-button {
                padding-top: 0.9rem;
                padding-bottom: 0.9rem;
            }
        }
        .login-batik-bg{
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;

            background-repeat: no-repeat;
            background-position: center top;
            background-size: 5000px auto;

            filter: brightness(0) invert(1);
            opacity: .40;
        }
        [data-theme="dark"] .login-batik-bg{
            background-image: url('{{ asset('images/batik.png') }}') !important;
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
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Sisi Kiri: Branding (Hidden di HP, muncul di MD ke atas) -->
    <div class="hidden md:flex md:w-5/12 text-white p-12 flex-col justify-between relative overflow-hidden shadow-2xl"
         style="background-image: url('{{ asset('images/latar2.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        

        <!-- Konten Tengah -->
        <div class="mt-16 md:mt-20 mb-auto mx-auto flex flex-col items-center text-center z-10">
            <!-- Ganti src dengan logo asli Anda -->
            <div class="logo-frame mb-4 flex items-center justify-center p-6 lg:p-8 rounded-3xl bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo PusTekInfo" class="h-20 lg:h-24 object-contain fallback-logo">
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

    <!-- Sisi Kanan: Form Login -->
    <div class="w-full md:w-7/12 flex flex-col justify-between p-4 sm:p-8 md:p-12 relative bg-[#f4f7f6] mobile-safe overflow-hidden">

        <!-- Background Batik (transparan di tengah, makin terlihat ke samping) -->
        <div class="login-batik-bg absolute inset-0 z-1 pointer-events-none"
             style="background-image: url('{{ asset('images/Batik-terang.jpeg') }}');"></div>

        <!-- Container Form (Card Putih) -->
        <div class="relative z-10 w-full max-w-md lg:max-w-lg xl:max-w-xl mx-auto my-auto bg-white rounded-3xl p-5 sm:p-8 md:p-10 lg:p-12 shadow-xl shadow-gray-200/50 border border-gray-100 mobile-card">
            
            <div class="back mb-4 flex items-center justify-between">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-teal-600 hover:text-teal-700">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <button type="button" class="icon-btn" id="themeToggle" aria-label="Ganti tema" aria-pressed="false">◐</button>
            </div>

            <!-- Logo & Greeting -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="h-14 sm:h-16 lg:h-20 mx-auto mb-4 object-contain mobile-logo">
                <h3 class="text-2xl lg:text-3xl font-bold text-[#0a2f5c]">Selamat Datang</h3>
                <p class="text-xs lg:text-sm text-gray-500 mt-1 px-2 sm:px-4 leading-relaxed mobile-text">Silakan masuk untuk melanjutkan</p>
            </div>

            @if (session('status'))
                <div class="mb-4 rounded-lg border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-700">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form input Laravel -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Username / Email -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-teal-600">
                        <i class="fa-solid fa-user text-lg"></i>
                    </span>
                    <input type="text" name="login" id="login" 
                        class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm transition-all mobile-input"
                        placeholder="Username" required value="{{ old('login') }}">
                </div>
                @error('login')
                    <span class="text-xs text-red-500 block -mt-3 pl-1">{{ $message }}</span>
                @enderror

                <!-- Input Password -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-teal-600">
                        <i class="fa-solid fa-lock text-lg"></i>
                    </span>
                    <input type="password" name="password" id="password" 
                        class="w-full pl-12 pr-12 py-3.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm transition-all mobile-input"
                        placeholder="Password" required>
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
                @error('password')
                    <span class="text-xs text-red-500 block -mt-3 pl-1">{{ $message }}</span>
                @enderror

                <!-- Opsi Tambahan (Ingat Saya & Lupa Password) -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center space-x-2 text-gray-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-teal-600 border-gray-300 focus:ring-teal-500 accent-teal-600">
                        <span>Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-teal-600 font-medium hover:underline">Lupa Password?</a>
                    @endif
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" class="w-full bg-[#007a8c] hover:bg-[#005f73] text-white font-bold py-3.5 rounded-xl shadow-md transition-colors uppercase tracking-wider text-sm mt-4 mobile-button">
                    Masuk
                </button>
            </form>

            <!-- Helpdesk/Bantuan -->
            <div class="flex items-center justify-center space-x-2 text-xs text-gray-600 mt-4">
                <i class="fa-solid fa-headset text-teal-600 text-base"></i>
                <span>Butuh bantuan? Hubungi <a href="#" class="text-teal-600 font-semibold hover:underline">Helpdesk PusTekInfo</a></span>
            </div>
        </div>

        <!-- Footer Hak Cipta -->
        <div class="footer text-center text-xs text-gray-400 mt-8 md:mt-4">
            &copy; {{ date('Y') }} PusTekInfo DPR RI. All rights reserved.
        </div>
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
</body>
</html>