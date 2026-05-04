<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=JetBrains+Mono:wght@400;500&display=swap');

            *, *::before, *::after { box-sizing: border-box; }

            html, body {
                margin: 0; padding: 0;
                background: #0a0a0a;
                color: #fff;
                font-family: 'Inter', sans-serif;
                min-height: 100vh;
            }

            /* ── LAYOUT SHELL ── */
            .sg-shell {
                display: flex;
                min-height: 100vh;
            }

            /* ── SIDEBAR ── */
            .sg-sidebar {
                width: 230px;
                flex-shrink: 0;
                background: #0d0d0d;
                border-right: 1px solid #1a1a1a;
                display: flex;
                flex-direction: column;
                position: sticky;
                top: 0;
                height: 100vh;
                overflow-y: auto;
            }

            .sg-sidebar-header {
                padding: 1.4rem 1.4rem 1rem;
                border-bottom: 1px solid #1a1a1a;
            }
            .sg-brand {
                display: flex; align-items: center; gap: 9px;
                text-decoration: none;
            }
            .sg-brand-icon {
                width: 32px; height: 32px; background: #22ff72;
                border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;overflow: hidden;
            }
            .sg-brand-icon svg { width: 16px; height: 16px; stroke: #052e16; fill: none; stroke-width: 2; }
            .sg-brand-name { font-size: 16px; font-weight: 900; letter-spacing: -0.03em; color: #fff; }
            .sg-brand-name span { color: #22ff72; }

            /* nav */
            .sg-nav { flex: 1; padding: 1rem 0.8rem; display: flex; flex-direction: column; gap: 1.5rem; }
            .sg-nav-label {
                font-size: 10px; font-family: 'JetBrains Mono', monospace;
                text-transform: uppercase; letter-spacing: .1em;
                color: #333; padding: 0 0.6rem; margin-bottom: 4px;
            }
            .sg-nav-item {
                display: flex; align-items: center; gap: 9px;
                padding: 8px 10px; border-radius: 8px;
                font-size: 13px; font-weight: 500; color: #666;
                text-decoration: none; transition: background .15s, color .15s;
                cursor: pointer; border: none; background: transparent; width: 100%; text-align: left;
            }
            .sg-nav-item svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 1.8; flex-shrink: 0; }
            .sg-nav-item:hover { background: #141414; color: #ccc; }
            .sg-nav-item.active { background: #0a1f11; color: #22ff72; }
            .sg-nav-item.active svg { stroke: #22ff72; }

            .sg-nav-spacer { flex: 1; }

            /* user block */
            .sg-user-block {
                padding: 1rem 0.8rem;
                border-top: 1px solid #1a1a1a;
            }
            .sg-user-info {
                display: flex; align-items: center; gap: 10px;
                padding: 8px 10px; border-radius: 10px;
                background: #111; border: 1px solid #1e1e1e;
                margin-bottom: 8px;
            }
            .sg-avatar {
                width: 32px; height: 32px; border-radius: 8px;
                background: #22ff72; color: #052e16;
                font-size: 12px; font-weight: 900;
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0; font-family: 'JetBrains Mono', monospace;
                letter-spacing: -.02em;
            }
            .sg-user-name { font-size: 13px; font-weight: 600; color: #ccc; line-height: 1.2; }
            .sg-user-email {
                font-size: 11px; color: #444; font-family: 'JetBrains Mono', monospace;
                white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 130px;
            }

            .sg-user-actions { display: flex; flex-direction: column; gap: 2px; }

            .sg-btn-settings {
                display: flex; align-items: center; gap: 8px;
                width: 100%; padding: 8px 10px; border-radius: 8px;
                font-size: 13px; font-weight: 500; color: #666;
                background: transparent; border: none; cursor: pointer;
                text-decoration: none;
                transition: background .15s, color .15s; font-family: 'Inter', sans-serif;
            }
            .sg-btn-settings svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; }
            .sg-btn-settings:hover { background: #141414; color: #ccc; }
            .sg-btn-settings.active { background: #0a1f11; color: #22ff72; }
            .sg-btn-settings.active svg { stroke: #22ff72; }

            .sg-btn-logout {
                display: flex; align-items: center; gap: 8px;
                width: 100%; padding: 8px 10px; border-radius: 8px;
                font-size: 13px; font-weight: 500; color: #555;
                background: transparent; border: none; cursor: pointer;
                transition: background .15s, color .15s; font-family: 'Inter', sans-serif;
            }
            .sg-btn-logout svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; flex-shrink: 0; }
            .sg-btn-logout:hover { background: #1a0a0a; color: #f87171; }

            /* ── MOBILE TOPBAR ── */
            .sg-topbar {
                display: none;
                align-items: center; justify-content: space-between;
                padding: 1rem 1.4rem;
                background: #0d0d0d; border-bottom: 1px solid #1a1a1a;
                position: sticky; top: 0; z-index: 50;
            }
            .sg-topbar-toggle {
                background: transparent; border: 1px solid #1e1e1e;
                border-radius: 8px; padding: 7px; cursor: pointer; color: #666;
                display: flex; align-items: center;
                transition: border-color .2s, color .2s;
            }
            .sg-topbar-toggle:hover { border-color: #333; color: #ccc; }
            .sg-topbar-toggle svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }

            /* mobile sidebar */
            .sg-sidebar-overlay {
                display: none; position: fixed; inset: 0;
                background: rgba(0,0,0,.75); z-index: 40;
            }
            .sg-sidebar-overlay.open { display: block; }

            .sg-sidebar-mobile {
                position: fixed; left: 0; top: 0; bottom: 0;
                width: 230px; z-index: 50;
                transform: translateX(-100%); transition: transform .25s ease;
                display: flex; flex-direction: column;
                background: #0d0d0d; border-right: 1px solid #1a1a1a;
            }
            .sg-sidebar-mobile.open { transform: translateX(0); }

            /* ── MAIN ── */
            .sg-main { flex: 1; min-width: 0; overflow-x: hidden; }

            @media (max-width: 768px) {
                .sg-sidebar { display: none; }
                .sg-topbar { display: flex; }
            }
        </style>
    </head>
    <body>
        <div class="sg-shell">

            {{-- ── DESKTOP SIDEBAR ── --}}
            <aside class="sg-sidebar">
                <div class="sg-sidebar-header">
                    <a href="{{ route('dashboard') }}" class="sg-brand" wire:navigate>
                        <div class="sg-brand-icon">
                            <img src="{{ asset('logo.png') }}" alt="Logo" style="width:100%; height:100%; object-fit:contain;">
                        </div>
                        <div class="sg-brand-name">Sigma<span>Server</span></div>
                    </a>
                </div>

                <nav class="sg-nav">
                    {{-- Platform --}}
                    <div>
                        <div class="sg-nav-label">Platform</div>
                        <a href="{{ route('dashboard') }}"
                           class="sg-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                           wire:navigate>
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('servers.index') }}"
                           class="sg-nav-item {{ request()->routeIs('servers.*') ? 'active' : '' }}"
                           wire:navigate>
                            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/></svg>
                            My Servers
                        </a>
                    </div>

                    <div class="sg-nav-spacer"></div>

                    {{-- Bantuan --}}
                    <div>
                        <div class="sg-nav-label">Help</div>
                        <a href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="sg-nav-item">
                            <svg viewBox="0 0 24 24"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/></svg>
                            Repository
                        </a>
                        <a href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="sg-nav-item">
                            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            Documentation
                        </a>
                    </div>
                </nav>

                {{-- User block --}}
                <div class="sg-user-block">
                    <div class="sg-user-info">
                        <div class="sg-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                        <div style="min-width:0">
                            <div class="sg-user-name">{{ auth()->user()->name }}</div>
                            <div class="sg-user-email">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <div class="sg-user-actions">
                        <a href="{{ route('profile.edit') }}"
                           class="sg-btn-settings {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                           wire:navigate>
                            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
                            Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="sg-btn-logout" data-test="logout-button">
                                <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            {{-- ── MOBILE TOPBAR ── --}}
            <div class="sg-topbar">
                <a href="{{ route('dashboard') }}" class="sg-brand" wire:navigate>
                    <div class="sg-brand-icon">
                        <svg viewBox="0 0 20 20">
                            <rect x="2" y="2" width="7" height="7" rx="1.5"/>
                            <rect x="11" y="2" width="7" height="7" rx="1.5"/>
                            <rect x="2" y="11" width="7" height="7" rx="1.5"/>
                            <rect x="11" y="11" width="7" height="7" rx="1.5"/>
                        </svg>
                    </div>
                    <div class="sg-brand-name">Sigma<span>Server</span></div>
                </a>
                <button class="sg-topbar-toggle" onclick="toggleMobileSidebar()">
                    <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
            </div>

            {{-- ── MOBILE SIDEBAR ── --}}
            <div class="sg-sidebar-overlay" id="sg-overlay" onclick="toggleMobileSidebar()"></div>
            <aside class="sg-sidebar-mobile" id="sg-mobile-sidebar">
                <div class="sg-sidebar-header">
                    <a href="{{ route('dashboard') }}" class="sg-brand" wire:navigate>
                        <div class="sg-brand-icon">
                            <svg viewBox="0 0 20 20">
                                <rect x="2" y="2" width="7" height="7" rx="1.5"/>
                                <rect x="11" y="2" width="7" height="7" rx="1.5"/>
                                <rect x="2" y="11" width="7" height="7" rx="1.5"/>
                                <rect x="11" y="11" width="7" height="7" rx="1.5"/>
                            </svg>
                        </div>
                        <div class="sg-brand-name">Sigma<span>Server</span></div>
                    </a>
                </div>
                <nav class="sg-nav">
                    <div>
                        <div class="sg-nav-label">Platform</div>
                        <a href="{{ route('dashboard') }}" class="sg-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" wire:navigate onclick="toggleMobileSidebar()">
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('servers.index') }}" class="sg-nav-item {{ request()->routeIs('servers.*') ? 'active' : '' }}" wire:navigate onclick="toggleMobileSidebar()">
                            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/></svg>
                            My Servers
                        </a>
                    </div>
                    <div class="sg-nav-spacer"></div>
                    <div>
                        <div class="sg-nav-label">Help</div>
                        <a href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="sg-nav-item">
                            <svg viewBox="0 0 24 24"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/></svg>
                            Repository
                        </a>
                        <a href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="sg-nav-item">
                            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            Documentation
                        </a>
                    </div>
                </nav>
                <div class="sg-user-block">
                    <div class="sg-user-info">
                        <div class="sg-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                        <div style="min-width:0">
                            <div class="sg-user-name">{{ auth()->user()->name }}</div>
                            <div class="sg-user-email">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <div class="sg-user-actions">
                        <a href="{{ route('profile.edit') }}"
                           class="sg-btn-settings {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                           wire:navigate onclick="toggleMobileSidebar()">
                            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
                            Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="sg-btn-logout">
                                <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            {{-- ── MAIN CONTENT ── --}}
            <main class="sg-main">
                {{ $slot }}
            </main>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts

        <script>
            function toggleMobileSidebar() {
                document.getElementById('sg-mobile-sidebar').classList.toggle('open');
                document.getElementById('sg-overlay').classList.toggle('open');
            }
        </script>
    </body>
</html>