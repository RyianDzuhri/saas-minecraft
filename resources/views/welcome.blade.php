<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SigmaServer - Server Minecraft Cepat & Andal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <style>
            :root {
                --primary-green: #1fff7f;
                --bg-black: #0a0a0a;
                --card-bg: #111111;
                --text-main: #ffffff;
                --text-muted: #a1a09a;
                --border-color: #1f1f1f;
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: var(--bg-black);
                color: var(--text-main);
                line-height: 1.5;
                display: flex;
                flex-direction: column;
                align-items: center;
                min-height: 100vh;
                padding: 2rem;
            }

            header {
                width: 100%;
                max-width: 1100px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 80px;
            }

            .logo-container {
                display: flex;
                align-items: center;
                gap: 12px;
                font-weight: 700;
                font-size: 1.5rem;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                background-color: var(--primary-green);
                border-radius: 8px;
                display: grid;
                grid-template-columns: 1fr 1fr;
                padding: 8px;
                gap: 4px;
            }

            .logo-dot {
                background-color: #000;
                border-radius: 2px;
            }

            .nav-buttons {
                display: flex;
                gap: 15px;
            }

            .btn {
                padding: 10px 24px;
                border-radius: 8px;
                font-weight: 600;
                text-decoration: none;
                font-size: 14px;
                transition: 0.3s;
                cursor: pointer;
            }

            .btn-outline {
                color: white;
                border: 1px solid var(--border-color);
                background: rgba(255,255,255,0.03);
            }

            .btn-outline:hover {
                border-color: #444;
            }

            .btn-primary {
                background-color: var(--primary-green);
                color: #000;
                border: none;
            }

            .btn-primary:hover {
                filter: brightness(1.1);
                box-shadow: 0 0 20px rgba(31, 255, 127, 0.3);
            }

            main {
                width: 100%;
                max-width: 1100px;
                text-align: left;
            }

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: rgba(31, 255, 127, 0.05);
                border: 1px solid rgba(31, 255, 127, 0.2);
                color: var(--primary-green);
                padding: 6px 16px;
                border-radius: 100px;
                font-size: 13px;
                font-weight: 500;
                margin-bottom: 30px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .badge-dot {
                width: 8px;
                height: 8px;
                background-color: var(--primary-green);
                border-radius: 50%;
                box-shadow: 0 0 8px var(--primary-green);
            }

            h1 {
                font-size: clamp(2.5rem, 6vw, 4.5rem);
                font-weight: 700;
                line-height: 1.1;
                margin-bottom: 20px;
                max-width: 800px;
            }

            h1 span {
                color: #ffffff;
                background: linear-gradient(to bottom, #fff, #888);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .highlight {
                color: white !important;
                -webkit-text-fill-color: white !important;
            }

            .description {
                font-size: 18px;
                color: var(--text-muted);
                max-width: 650px;
                margin-bottom: 40px;
            }

            .hero-actions {
                display: flex;
                align-items: center;
                gap: 20px;
            }

            .price-info {
                color: #555;
                font-size: 14px;
                font-family: monospace;
            }

            .scroll-btn {
                width: 40px;
                height: 40px;
                border: 1px solid var(--border-color);
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-left: auto;
            }

        </style>
    </head>
    <body>
        <header>
            <div class="logo-container">
                <div class="logo-icon">
                    <div class="logo-dot"></div>
                    <div class="logo-dot"></div>
                    <div class="logo-dot"></div>
                    <div class="logo-dot"></div>
                </div>
                SigmaServer
            </div>

            <nav class="nav-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Mulai sekarang</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <main>
            <div class="badge">
                <span class="badge-dot"></span>
                99.9% uptime · Server Indonesia
            </div>

            <h1>Server Minecraft yang <span class="highlight">cepat & andal.</span></h1>
            
            <p class="description">
                Sewa server Minecraft berkualitas tinggi dengan performa lag-free, 
                setup instan, dan support 24/7. Cocok untuk semua mode — Survival, 
                SkyBlock, hingga minigames.
            </p>

            <div class="hero-actions">
                <a href="{{ route('register') }}" class="btn btn-primary" style="display: flex; align-items: center; gap: 10px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                    Mulai sekarang
                </a>
                
                <span class="price-info">Mulai dari Rp 10.000/bln</span>

                <div class="scroll-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 13l5 5 5-5M7 6l5 5 5-5"/></svg>
                </div>
            </div>
        </main>
    </body>
</html>