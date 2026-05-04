<x-layouts::app :title="__('Dashboard')">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=JetBrains+Mono:wght@400;500&display=swap');

        .sg-wrap {
            min-height: 100vh;
            background: #0a0a0a;
            font-family: 'Inter', sans-serif;
            color: #fff;
            padding: 2rem 2.5rem;
        }

        /* ── HEADER ── */
        .sg-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #1a1a1a;
            margin-bottom: 2rem;
        }
        .sg-header-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    
        .sg-logo-icon svg { width: 18px; height: 18px; stroke: #052e16; fill: none; stroke-width: 2; }
        .sg-logo-name { font-size: 17px; font-weight: 900; letter-spacing: -0.03em; }
        .sg-logo-name span { color: #22ff72; }

        .sg-header-right { display: flex; align-items: center; gap: 12px; }
        .sg-greeting { font-size: 13px; color: #555; font-family: 'JetBrains Mono', monospace; }
        .sg-greeting strong { color: #bbb; }

        .sg-btn-new {
            display: inline-flex; align-items: center; gap: 7px;
            background: #22ff72; color: #052e16;
            font-size: 13px; font-weight: 700; font-family: 'Inter', sans-serif;
            padding: 9px 18px; border-radius: 8px; text-decoration: none;
            transition: background .18s, transform .15s; border: none; cursor: pointer;
        }
        .sg-btn-new:hover { background: #16c957; transform: translateY(-1px); }
        .sg-btn-new svg { width: 13px; height: 13px; stroke: #052e16; fill: none; stroke-width: 2.5; }

        /* ── PAGE TITLE ── */
        .sg-page-head { margin-bottom: 1.8rem; }
        .sg-tag {
            display: inline-flex; align-items: center; gap: 7px;
            background: #0a1f11; border: 1px solid #1a3d22; color: #22ff72;
            font-size: 11px; font-family: 'JetBrains Mono', monospace;
            padding: 4px 12px; border-radius: 20px; margin-bottom: 1rem;
            letter-spacing: 0.06em; width: fit-content;
        }
        .sg-tag-dot {
            width: 6px; height: 6px; border-radius: 50%; background: #22ff72;
            animation: blink 1.8s ease infinite;
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.2} }
        .sg-page-title {
            font-size: 2rem; font-weight: 900; letter-spacing: -0.04em;
            line-height: 1.05; color: #fff; margin-bottom: 0.3rem;
        }
        .sg-page-title span { color: #22ff72; }
        .sg-page-sub { font-size: 13px; color: #555; }

        /* ── STAT CARDS ── */
        .sg-stats {
            display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px; margin-bottom: 2rem;
        }
        .sg-stat-card {
            background: #111; border: 1px solid #1e1e1e; border-radius: 12px;
            padding: 1.3rem 1.4rem; display: flex; align-items: center; gap: 14px;
            transition: border-color .2s;
        }
        .sg-stat-card:hover { border-color: #2a2a2a; }
        .sg-stat-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .sg-stat-icon svg { width: 18px; height: 18px; fill: none; stroke-width: 1.8; }
        .sg-stat-icon.blue  { background: #0a1220; border: 1px solid #0f2340; }
        .sg-stat-icon.blue svg  { stroke: #60a5fa; }
        .sg-stat-icon.green { background: #0a1f11; border: 1px solid #1a3d22; }
        .sg-stat-icon.green svg { stroke: #22ff72; }
        .sg-stat-icon.yellow{ background: #1a1500; border: 1px solid #332900; }
        .sg-stat-icon.yellow svg{ stroke: #fbbf24; }

        .sg-stat-label { font-size: 12px; color: #555; font-family: 'JetBrains Mono', monospace; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 4px; }
        .sg-stat-value { font-size: 2rem; font-weight: 900; letter-spacing: -0.04em; line-height: 1; color: #fff; }

        /* ── TABLE CARD ── */
        .sg-table-card {
            background: #111; border: 1px solid #1e1e1e; border-radius: 12px;
            overflow: hidden;
        }
        .sg-table-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.1rem 1.4rem; border-bottom: 1px solid #1a1a1a;
        }
        .sg-table-title { font-size: 14px; font-weight: 700; letter-spacing: -0.02em; }
        .sg-table-count {
            font-size: 11px; color: #444; font-family: 'JetBrains Mono', monospace;
        }

        .sg-table-wrap { overflow-x: auto; }
        table.sg-table { width: 100%; border-collapse: collapse; }
        table.sg-table thead tr {
            background: #0d0d0d; border-bottom: 1px solid #1a1a1a;
        }
        table.sg-table thead th {
            padding: 10px 18px;
            font-size: 10px; font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase; letter-spacing: .08em;
            color: #444; font-weight: 500; text-align: left;
        }
        table.sg-table thead th.center { text-align: center; }
        table.sg-table tbody tr {
            border-bottom: 1px solid #161616; transition: background .15s;
        }
        table.sg-table tbody tr:last-child { border-bottom: none; }
        table.sg-table tbody tr:hover { background: #141414; }
        table.sg-table td {
            padding: 14px 18px; font-size: 13px; color: #aaa;
        }
        table.sg-table td.name { font-weight: 600; color: #e0e0e0; }
        table.sg-table td.addr {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px; color: #555;
        }
        table.sg-table td.status-cell { text-align: center; }

        /* status badges */
        .sg-badge {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11px; font-family: 'JetBrains Mono', monospace;
            padding: 4px 10px; border-radius: 20px; font-weight: 500;
        }
        .sg-badge-dot { width: 5px; height: 5px; border-radius: 50%; }
        .sg-badge.active  { background: #0a1f11; color: #22ff72; border: 1px solid #1a3d22; }
        .sg-badge.active .sg-badge-dot { background: #22ff72; }
        .sg-badge.pending { background: #1a1500; color: #fbbf24; border: 1px solid #332900; }
        .sg-badge.pending .sg-badge-dot { background: #fbbf24; }
        .sg-badge.other   { background: #1a0a0a; color: #f87171; border: 1px solid #3a1515; }
        .sg-badge.other .sg-badge-dot { background: #f87171; }

        /* empty state */
        .sg-empty {
            padding: 3rem 1.5rem; text-align: center;
        }
        .sg-empty-icon {
            width: 48px; height: 48px; border-radius: 12px;
            background: #111; border: 1px solid #1e1e1e;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .sg-empty-icon svg { width: 22px; height: 22px; stroke: #333; fill: none; stroke-width: 1.8; }
        .sg-empty-title { font-size: 14px; font-weight: 600; color: #444; margin-bottom: 4px; }
        .sg-empty-sub { font-size: 12px; color: #333; }

        /* table footer */
        .sg-table-foot {
            padding: 12px 18px; border-top: 1px solid #1a1a1a;
            display: flex; justify-content: flex-end;
        }
        .sg-view-all {
            font-size: 12px; font-family: 'JetBrains Mono', monospace;
            color: #22ff72; text-decoration: none; opacity: .8;
            transition: opacity .2s;
        }
        .sg-view-all:hover { opacity: 1; }
    </style>

    <div class="sg-wrap">

        {{-- HEADER --}}
        <div class="sg-header">
            <div class="sg-header-brand">
                <div class="sg-logo-icon">
                    <a href="{{ route('dashboard') }}" class="sg-brand" wire:navigate>
                        <div class="sg-brand-icon">
                            <img src="{{ asset('logo.png') }}" alt="Logo" style="width:100%; height:100%; object-fit:contain;">
                        </div>
                        <div class="sg-brand-name">Sigma<span>Server</span></div>
                    </a>
                </div>
            </div>

            <div class="sg-header-right">
                <div class="sg-greeting">
                    Hello, <strong>{{ auth()->user()->name }}</strong>
                </div>
                <a href="{{ route('servers.index') }}" class="sg-btn-new">
                    <svg viewBox="0 0 14 14"><line x1="7" y1="2" x2="7" y2="12"/><line x1="2" y1="7" x2="12" y2="7"/></svg>
                    New Server
                </a>
            </div>
        </div>

        {{-- PAGE TITLE --}}
        <div class="sg-page-head">
            <div class="sg-tag">
                <div class="sg-tag-dot"></div>
                Control Panel · Real-time
            </div>
            <h1 class="sg-page-title">Dashboard<span>.</span></h1>
            <p class="sg-page-sub">Monitor and manage all your Minecraft servers here.</p>
        </div>

        {{-- STATS --}}
        <div class="sg-stats">
            <div class="sg-stat-card">
                <div class="sg-stat-icon blue"></div>
                <div>
                    <div class="sg-stat-label">Total Servers</div>
                    <div class="sg-stat-value">{{ auth()->user()->servers()->count() }}</div>
                </div>
            </div>

            <div class="sg-stat-card">
                <div class="sg-stat-icon green"></div>
                <div>
                    <div class="sg-stat-label">Active Servers</div>
                    <div class="sg-stat-value">{{ auth()->user()->servers()->where('status','active')->count() }}</div>
                </div>
            </div>

            <div class="sg-stat-card">
                <div class="sg-stat-icon yellow"></div>
                <div>
                    <div class="sg-stat-label">Pending</div>
                    <div class="sg-stat-value">{{ auth()->user()->servers()->whereIn('status',['pending','provisioning'])->count() }}</div>
                </div>
            </div>
        </div>

    </div>
</x-layouts::app>