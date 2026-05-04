<x-layouts::auth :title="__('Register')">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&family=JetBrains+Mono:wght@400;500&display=swap');

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

        .sigma-form-side {
            flex: 1;
            background: #0d0d0d;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow: hidden;
        }

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
            overflow: hidden;
        }

        .sigma-brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sigma-brand-name {
            font-size: 24px;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.03em;
        }

        .sigma-brand-name span {
            color: #22ff72;
        }

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

        .sigma-tag-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22ff72;
            box-shadow: 0 0 8px #22ff72;
        }

        .sigma-title {
            font-size: 3rem;
            font-weight: 900;
            color: #fff;
            line-height: 1;
            margin-bottom: 1rem;
        }

        .sigma-subtitle {
            color: #666;
            font-size: 16px;
            max-width: 420px;
            line-height: 1.6;
        }

        .sigma-form {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .sigma-label {
            font-size: 12px;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
            font-family: 'JetBrains Mono';
            margin-bottom: 2px;
        }

        .sigma-input { 
            width: 100%; 
            background: #181818; 
            border: 1px solid #222; 
            border-radius: 14px;
            padding: 12px 14px; 
            color: #fff; 
            font-size: 14px; 
            outline: none; 
            transition: 0.2s;
            box-sizing: border-box;
        }

        .sigma-input::placeholder {
            color: #888;
        }

        .sigma-input:focus {
            border-color: #22ff72;
            box-shadow: 0 0 0 4px rgba(34, 255, 114, 0.08);
            background: #1a1a1a;
        }

        .sigma-submit {
            background: #22ff72;
            color: #052e16;
            border: none;
            padding: 18px;
            border-radius: 14px;
            font-weight: 800;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: 0.2s;
            margin-top: 1rem;
        }

        .sigma-submit:hover {
            background: #16c957;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(34, 255, 114, 0.15);
        }

        .sigma-footer {
            margin-top: 1.5rem;
            font-size: 14px;
            color: #444;
            text-align: center;
        }

        .sigma-footer a {
            color: #22ff72;
            text-decoration: none;
            font-weight: 600;
        }

        .sigma-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #444;
            cursor: pointer;
        }

        .sigma-error {
            color: #ff4f4f;
            font-size: 12px;
            font-family: 'JetBrains Mono';
            margin-top: 4px;
            display: block;
        }
    </style>

    <div class="sigma-landscape-container">

        <!-- LEFT SIDE -->
        <div class="sigma-hero-side">
            <div class="sigma-brand">
                <div class="sigma-brand-icon">
                    <img src="{{ asset('logo.png') }}" alt="Logo">
                </div>
                <div class="sigma-brand-name">Sigma<span>Server</span></div>
            </div>

            <div class="sigma-tag">
                <div class="sigma-tag-dot"></div>
                Join the Community
            </div>

            <h1 class="sigma-title">Start Your<br>New Adventure.</h1>

            <p class="sigma-subtitle">
                Get instant access to the fastest Minecraft servers. It only takes a few seconds to set up your account.
            </p>
        </div>

        <!-- RIGHT SIDE -->
        <div class="sigma-form-side">
            <div class="sigma-card">

                <div style="margin-bottom: 1rem;">
                    <h2 style="color: #fff; font-size: 28px; font-weight: 900; margin-bottom: 0.5rem;">
                        Create New Account
                    </h2>
                    <p style="color: #555; font-size: 15px;">
                        Fill in your details to start renting a server.
                    </p>
                </div>

                <form method="POST" action="{{ route('register.store') }}" class="sigma-form">
                    @csrf

                    <!-- FULL NAME -->
                    <div>
                        <label class="sigma-label" for="name">Full Name</label>
                        <input id="name" class="sigma-input" type="text" name="name"
                               value="{{ old('name') }}" required autofocus
                               placeholder="Enter your full name" />
                        @error('name') <span class="sigma-error">{{ $message }}</span> @enderror
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="sigma-label" for="email">Email Address</label>
                        <input id="email" class="sigma-input" type="email" name="email"
                               value="{{ old('email') }}" required
                               placeholder="name@example.com" />
                        @error('email') <span class="sigma-error">{{ $message }}</span> @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="sigma-label" for="password">Password</label>
                        <div style="position: relative;">
                            <input id="password" class="sigma-input" type="password"
                                   name="password" required
                                   placeholder="Create a secure password" />
                            <button type="button" class="sigma-toggle" onclick="togglePass('password', this)">
                                👁
                            </button>
                        </div>
                        @error('password') <span class="sigma-error">{{ $message }}</span> @enderror
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div>
                        <label class="sigma-label" for="password_confirmation">Confirm Password</label>
                        <div style="position: relative;">
                            <input id="password_confirmation" class="sigma-input"
                                   type="password" name="password_confirmation"
                                   required placeholder="Re-enter your password" />
                            <button type="button" class="sigma-toggle" onclick="togglePass('password_confirmation', this)">
                                👁
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="sigma-submit">
                        Create Account Now
                    </button>
                </form>

                <div class="sigma-footer">
                    Already have an account?
                    <a href="{{ route('login') }}">Login here</a>
                </div>

            </div>
        </div>

    </div>

    <script>
        function togglePass(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</x-layouts::auth>