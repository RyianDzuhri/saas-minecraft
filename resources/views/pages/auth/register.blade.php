<x-layouts::auth :title="__('Register')">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&family=JetBrains+Mono:wght@400;500&display=swap');

        /* Layout Utama: 50:50 Landscape & No Scroll */
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; 
            background: #0a0a0a;
            font-family: 'Inter', sans-serif;
        }

        .sigma-landscape-container {
            display: flex;
            width: 100vw;
            height: 100vh;
        }

        /* Sisi Kiri: Hero (50%) */
        .sigma-hero-side {
            flex: 1;
            background: #0a0a0a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 8%;
            border-right: 1px solid #1a1a1a;
            position: relative;
        }

        /* Sisi Kanan: Form Area (50%) */
        .sigma-form-side {
            flex: 1;
            background: #0d0d0d;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow-y: auto; /* Jaga-jaga kalau layar pendek, form tetap bisa diakses */
        }

        /* Dekorasi Cahaya */
        .sigma-hero-side::before {
            content: '';
            position: absolute;
            top: 20%;
            left: 10%;
            width: 300px;
            height: 300px;
            background: rgba(34, 255, 114, 0.05);
            filter: blur(100px);
            border-radius: 50%;
        }

        .sigma-card {
            width: 100%;
            max-width: 440px; 
        }

        /* Brand & Typography */
        .sigma-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 3rem;
        }
        .sigma-brand-icon {
            width: 42px;
            height: 42px;
            background: #22ff72;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sigma-brand-icon svg { width: 24px; height: 24px; stroke: #052e16; fill: none; stroke-width: 2.5; }
        .sigma-brand-name { font-size: 24px; font-weight: 900; color: #ffffff; letter-spacing: -0.03em; }
        .sigma-brand-name span { color: #22ff72; }

        .sigma-tag {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #0a1f11;
            border: 1px solid #1a3d22;
            color: #22ff72;
            font-size: 11px;
            font-family: 'JetBrains Mono', monospace;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }
        .sigma-tag-dot { width: 6px; height: 6px; border-radius: 50%; background: #22ff72; box-shadow: 0 0 8px #22ff72; }
        .sigma-title { font-size: 3rem; font-weight: 900; color: #fff; line-height: 1; margin-bottom: 1rem; }
        .sigma-subtitle { color: #666; font-size: 16px; max-width: 420px; line-height: 1.6; }

        /* Form Styling (Big Inputs) */
        .sigma-form { display: flex; flex-direction: column; gap: 1.2rem; }
        .sigma-label { font-size: 12px; font-weight: 600; color: #555; text-transform: uppercase; font-family: 'JetBrains Mono'; margin-bottom: 2px; }
        
        .sigma-input { 
            width: 100%; 
            background: #181818; 
            border: 1px solid #222; 
            border-radius: 14px;
            padding: 16px 20px; 
            color: #fff; 
            font-size: 16px; 
            outline: none; 
            transition: 0.2s;
            box-sizing: border-box;
        }
        .sigma-input:focus { border-color: #22ff72; box-shadow: 0 0 0 4px rgba(34, 255, 114, 0.08); background: #1a1a1a; }
        
        .sigma-submit {
            background: #22ff72; color: #052e16; border: none; 
            padding: 18px; 
            border-radius: 14px; font-weight: 800; font-size: 16px; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: 0.2s; margin-top: 1rem;
        }
        .sigma-submit:hover { background: #16c957; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(34, 255, 114, 0.15); }

        .sigma-footer { margin-top: 1.5rem; font-size: 14px; color: #444; text-align: center; }
        .sigma-footer a { color: #22ff72; text-decoration: none; font-weight: 600; }
        
        .sigma-toggle { position: absolute; right: 18px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #444; cursor: pointer; }
        
        .sigma-error { color: #ff4f4f; font-size: 12px; font-family: 'JetBrains Mono'; margin-top: 4px; display: block; }
    </style>

    <div class="sigma-landscape-container">
        <!-- Sisi Kiri: Hero -->
        <div class="sigma-hero-side">
            <div class="sigma-brand">
                <div class="sigma-brand-icon">
                    <svg viewBox="0 0 20 20">
                        <rect x="2" y="2" width="7" height="7" rx="1.5"/>
                        <rect x="11" y="2" width="7" height="7" rx="1.5"/>
                        <rect x="2" y="11" width="7" height="7" rx="1.5"/>
                        <rect x="11" y="11" width="7" height="7" rx="1.5"/>
                    </svg>
                </div>
                <div class="sigma-brand-name">Sigma<span>Server</span></div>
            </div>

            <div class="sigma-tag">
                <div class="sigma-tag-dot"></div>
                Join the Community
            </div>
            <h1 class="sigma-title">Mulai Petualangan<br>Baru Kamu.</h1>
            <p class="sigma-subtitle">Dapatkan akses instan ke server Minecraft tercepat. Hanya butuh beberapa detik untuk setup akun kamu.</p>
        </div>

        <!-- Sisi Kanan: Form Register -->
        <div class="sigma-form-side">
            <div class="sigma-card">
                <div style="margin-bottom: 2rem;">
                    <h2 style="color: #fff; font-size: 28px; font-weight: 900; margin-bottom: 0.5rem;">Buat Akun Baru</h2>
                    <p style="color: #555; font-size: 15px;">Lengkapi data diri kamu untuk mulai menyewa server.</p>
                </div>

                <form method="POST" action="{{ route('register.store') }}" class="sigma-form">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="sigma-field">
                        <label class="sigma-label" for="name">Nama Lengkap</label>
                        <input id="name" class="sigma-input" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap" />
                        @error('name') <span class="sigma-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="sigma-field">
                        <label class="sigma-label" for="email">Email Address</label>
                        <input id="email" class="sigma-input" type="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com" />
                        @error('email') <span class="sigma-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Password --}}
                    <div class="sigma-field">
                        <label class="sigma-label" for="password">Password</label>
                        <div style="position: relative;">
                            <input id="password" class="sigma-input" type="password" name="password" required placeholder="Buat password aman" />
                            <button type="button" class="sigma-toggle" onclick="togglePass('password', this)">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        @error('password') <span class="sigma-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Ulangi Password --}}
                    <div class="sigma-field">
                        <label class="sigma-label" for="password_confirmation">Ulangi Password</label>
                        <div style="position: relative;">
                            <input id="password_confirmation" class="sigma-input" type="password" name="password_confirmation" required placeholder="Ketik ulang password" />
                            <button type="button" class="sigma-toggle" onclick="togglePass('password_confirmation', this)">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="sigma-submit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                        Buat Akun Sekarang
                    </button>
                </form>

                <div class="sigma-footer">
                    Sudah punya akun? <a href="{{ route('login') }}" wire:navigate>Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePass(id, btn) {
            const input = document.getElementById(id);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            
            const svg = btn.querySelector('svg');
            if (isHidden) {
                svg.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                svg.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            }
        }
    </script>
</x-layouts::auth>