<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Undangan</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: #F8FAF7;
        }
    </style>
</head>
<body class="text-stone-800 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm bg-white p-8 rounded-2xl border border-stone-200 shadow-xs">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-amber-50 text-amber-800 rounded-2xl mb-3 border border-amber-200/60">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#84683A" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            <h1 class="text-xl font-bold text-stone-900 tracking-tight">Login Admin</h1>
            <p class="text-xs text-stone-500 mt-1">Masukkan password untuk mengelola undangan</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->has('password'))
            <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl">
                {{ $errors->first('password') }}
            </div>
        @endif

        <form id="loginForm" action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Password Admin</label>
                <div class="relative">
                    <input type="password" id="passwordInput" name="password" required autofocus placeholder="Masukkan password..."
                           class="w-full pl-3.5 pr-10 py-2.5 bg-white border border-stone-300 rounded-xl text-xs text-stone-800 placeholder-stone-400 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 focus:outline-none transition-all">
                    <button type="button" id="togglePasswordBtn" title="Tampilkan/Sembunyikan Password"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600 focus:outline-none p-1">
                        <svg id="eyeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <svg id="eyeOffIcon" class="hidden" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    </button>
                </div>
                <p id="jsErrorMsg" class="hidden text-[11px] text-rose-600 mt-1.5 font-semibold"></p>
            </div>

            <button type="submit" id="submitBtn"
                    class="w-full py-2.5 bg-stone-800 hover:bg-stone-700 text-amber-100 font-semibold text-xs rounded-xl transition-all shadow-xs flex items-center justify-center gap-2 cursor-pointer">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                Masuk Dashboard
            </button>
        </form>
    </div>

    <script>
    (function() {
        const form = document.getElementById('loginForm');
        const input = document.getElementById('passwordInput');
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');
        const btn = document.getElementById('submitBtn');
        const err = document.getElementById('jsErrorMsg');

        // Toggle Show/Hide Password
        toggleBtn.addEventListener('click', function() {
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            eyeIcon.classList.toggle('hidden', isPassword);
            eyeOffIcon.classList.toggle('hidden', !isPassword);
        });

        let attempts = parseInt(localStorage.getItem('admin_login_attempts') || '0');
        let lockoutUntil = parseInt(localStorage.getItem('admin_login_lockout') || '0');

        function checkLockout() {
            const now = Date.now();
            if (now < lockoutUntil) {
                const remaining = Math.ceil((lockoutUntil - now) / 1000);
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
                err.textContent = `Terlalu banyak percobaan. Dikunci selama ${remaining} detik.`;
                err.classList.remove('hidden');
                return true;
            } else {
                if (lockoutUntil > 0) {
                    localStorage.removeItem('admin_login_lockout');
                    localStorage.setItem('admin_login_attempts', '0');
                    attempts = 0;
                }
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
                return false;
            }
        }

        if (checkLockout()) {
            const timer = setInterval(() => {
                if (!checkLockout()) clearInterval(timer);
            }, 1000);
        }

        form.addEventListener('submit', function(e) {
            if (checkLockout()) {
                e.preventDefault();
                return;
            }

            const val = input.value;
            // Anti-SQLi / XSS pattern filter client-side
            const dangerousPattern = /['";--<>]|\/\*|\*\//;
            if (dangerousPattern.test(val)) {
                e.preventDefault();
                err.textContent = 'Karakter tidak valid terdeteksi (SQLi/XSS protection).';
                err.classList.remove('hidden');
                attempts++;
                localStorage.setItem('admin_login_attempts', attempts);
                if (attempts >= 5) {
                    localStorage.setItem('admin_login_lockout', Date.now() + 60000);
                    checkLockout();
                }
                return;
            }

            err.classList.add('hidden');
        });
    })();
    </script>

</body>
</html>
