<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=JetBrains+Mono:wght@400;500&display=swap');

    .sg-settings-wrap {
        display: flex;
        gap: 0;
        min-height: calc(100vh - 0px);
        font-family: 'Inter', sans-serif;
    }

    /* ── SIDEBAR NAV ── */
    .sg-settings-nav {
        width: 200px;
        flex-shrink: 0;
        padding: 2rem 1rem 2rem 0;
        border-right: 1px solid #1a1a1a;
    }

    .sg-settings-nav-label {
        font-size: 10px;
        font-family: 'JetBrains Mono', monospace;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: #333;
        padding: 0 0.6rem;
        margin-bottom: 6px;
    }

    .sg-settings-nav-item {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 8px 10px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        color: #666;
        text-decoration: none;
        transition: background .15s, color .15s;
        width: 100%;
        margin-bottom: 2px;
    }
    .sg-settings-nav-item svg {
        width: 14px; height: 14px;
        stroke: currentColor; fill: none; stroke-width: 1.8;
        flex-shrink: 0;
    }
    .sg-settings-nav-item:hover { background: #141414; color: #ccc; }
    .sg-settings-nav-item.active { background: #0a1f11; color: #22ff72; }
    .sg-settings-nav-item.active svg { stroke: #22ff72; }

    /* ── DIVIDER (mobile) ── */
    .sg-settings-sep {
        display: none;
        height: 1px;
        background: #1a1a1a;
        margin: 1rem 0;
    }

    /* ── CONTENT ── */
    .sg-settings-content {
        flex: 1;
        padding: 2rem 0 2rem 2.5rem;
        min-width: 0;
    }

    .sg-settings-heading {
        font-size: 1.4rem;
        font-weight: 900;
        letter-spacing: -0.04em;
        color: #fff;
        margin-bottom: 3px;
        line-height: 1.1;
    }
    .sg-settings-heading span { color: #22ff72; }

    .sg-settings-subheading {
        font-size: 13px;
        color: #555;
        margin-bottom: 1.8rem;
        line-height: 1.5;
    }

    .sg-settings-body {
        width: 100%;
        max-width: 480px;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 640px) {
        .sg-settings-wrap { flex-direction: column; }
        .sg-settings-nav {
            width: 100%;
            padding: 1.5rem 0 0;
            border-right: none;
            border-bottom: 1px solid #1a1a1a;
            padding-bottom: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }
        .sg-settings-nav-label { width: 100%; }
        .sg-settings-content { padding: 1.5rem 0 0; }
        .sg-settings-sep { display: block; }
    }
</style>

<div class="sg-settings-wrap">

    {{-- ── LEFT NAV ── --}}
    <nav class="sg-settings-nav">
        <div class="sg-settings-nav-label">Settings</div>

        <a href="{{ route('profile.edit') }}"
           class="sg-settings-nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
           wire:navigate>
            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            Profile
        </a>

        <a href="{{ route('security.edit') }}"
           class="sg-settings-nav-item {{ request()->routeIs('security.edit') ? 'active' : '' }}"
           wire:navigate>
            <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            Safe
        </a>

        <a href="{{ route('appearance.edit') }}"
           class="sg-settings-nav-item {{ request()->routeIs('appearance.edit') ? 'active' : '' }}"
           wire:navigate>
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 3a4.5 4.5 0 010 9 4.5 4.5 0 010-9z"/><path stroke-linecap="round" d="M6.3 17.7a9 9 0 0111.4 0"/></svg>
            UI
        </a>
    </nav>

    <div class="sg-settings-sep"></div>

    {{-- ── RIGHT CONTENT ── --}}
    <div class="sg-settings-content">
        @if(!empty($heading))
            <div class="sg-settings-heading">{{ $heading }}<span>.</span></div>
        @endif
        @if(!empty($subheading))
            <div class="sg-settings-subheading">{{ $subheading }}</div>
        @endif

        <div class="sg-settings-body">
            {{ $slot }}
        </div>
    </div>

</div>