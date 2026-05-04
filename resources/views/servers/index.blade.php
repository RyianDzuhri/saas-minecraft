<x-layouts::app :title="__('My Servers')">
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
        .sg-header-brand { display: flex; align-items: center; gap: 10px; }
        .sg-logo-icon {
            width: 34px; height: 34px; background: #22ff72;
            border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .sg-logo-icon svg { width: 18px; height: 18px; stroke: #052e16; fill: none; stroke-width: 2; }
        .sg-logo-name { font-size: 17px; font-weight: 900; letter-spacing: -0.03em; }
        .sg-logo-name span { color: #22ff72; }

        /* ── PAGE TITLE ── */
        .sg-page-head { margin-bottom: 2rem; }
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

        /* ── CREATE FORM ── */
        .sg-create-row {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 2rem; flex-wrap: wrap;
        }
        .sg-input {
            background: #111; border: 1px solid #1e1e1e;
            border-radius: 9px; padding: 11px 16px;
            font-size: 14px; color: #fff;
            font-family: 'Inter', sans-serif;
            outline: none; width: 280px;
            transition: border-color .2s, box-shadow .2s;
        }
        .sg-input::placeholder { color: #333; }
        .sg-input:focus {
            border-color: #22ff72;
            box-shadow: 0 0 0 3px rgba(34,255,114,.07);
        }
        .sg-btn-create {
            display: inline-flex; align-items: center; gap: 7px;
            background: #22ff72; color: #052e16;
            font-size: 13px; font-weight: 700; font-family: 'Inter', sans-serif;
            padding: 11px 20px; border-radius: 9px;
            border: none; cursor: pointer; white-space: nowrap;
            transition: background .18s, transform .15s;
        }
        .sg-btn-create:hover { background: #16c957; transform: translateY(-1px); }
        .sg-btn-create svg { width: 13px; height: 13px; stroke: #052e16; fill: none; stroke-width: 2.5; }

        /* ── FLASH ── */
        .sg-flash {
            display: flex; align-items: center; gap: 10px;
            background: #0a1f11; border: 1px solid #1a3d22;
            color: #22ff72; font-size: 13px; font-family: 'JetBrains Mono', monospace;
            padding: 12px 16px; border-radius: 10px; margin-bottom: 1.8rem;
        }
        .sg-flash svg { width: 16px; height: 16px; stroke: #22ff72; fill: none; stroke-width: 2; flex-shrink: 0; }

        /* ── GRID ── */
        .sg-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }
        @media (max-width: 900px) { .sg-grid { grid-template-columns: repeat(2, minmax(0,1fr)); } }
        @media (max-width: 580px) { .sg-grid { grid-template-columns: 1fr; } }

        /* ── SERVER CARD ── */
        .sg-card {
            background: #111; border: 1px solid #1e1e1e;
            border-radius: 14px; overflow: hidden; display: flex; flex-direction: column;
            transition: border-color .2s, transform .2s;
        }
        .sg-card:hover { border-color: #2a2a2a; transform: translateY(-1px); }

        .sg-card-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.1rem 1.3rem; border-bottom: 1px solid #1a1a1a;
            background: #0d0d0d;
        }
        .sg-card-name {
            font-size: 14px; font-weight: 700; letter-spacing: -0.02em;
            color: #e0e0e0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            max-width: 180px;
        }

        /* badges */
        .sg-badge {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 10px; font-family: 'JetBrains Mono', monospace;
            padding: 3px 9px; border-radius: 20px; font-weight: 500; white-space: nowrap;
        }
        .sg-badge-dot { width: 5px; height: 5px; border-radius: 50%; }
        .sg-badge.active   { background: #0a1f11; color: #22ff72; border: 1px solid #1a3d22; }
        .sg-badge.active .sg-badge-dot { background: #22ff72; animation: blink 1.8s ease infinite; }
        .sg-badge.pending  { background: #1a1500; color: #fbbf24; border: 1px solid #332900; }
        .sg-badge.pending .sg-badge-dot { background: #fbbf24; }
        .sg-badge.provisioning { background: #0a1220; color: #60a5fa; border: 1px solid #0f2340; }
        .sg-badge.provisioning .sg-badge-dot { background: #60a5fa; animation: blink 1s ease infinite; }
        .sg-badge.other    { background: #1a0a0a; color: #f87171; border: 1px solid #3a1515; }
        .sg-badge.other .sg-badge-dot { background: #f87171; }

        /* card body */
        .sg-card-body { padding: 1.1rem 1.3rem; flex: 1; display: flex; flex-direction: column; gap: 0; }
        .sg-card-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 8px 0; border-bottom: 1px solid #161616;
        }
        .sg-card-row:last-child { border-bottom: none; }
        .sg-card-key { font-size: 11px; font-family: 'JetBrains Mono', monospace; color: #444; text-transform: uppercase; letter-spacing: .05em; }
        .sg-card-val { font-size: 12px; font-weight: 500; color: #bbb; }
        .sg-card-val.mono { font-family: 'JetBrains Mono', monospace; font-size: 12px; }
        .sg-card-val.green { color: #22ff72; }
        .sg-card-val.dim { color: #444; font-style: italic; }

        /* card footer */
        .sg-card-foot {
            padding: 1rem 1.3rem; border-top: 1px solid #1a1a1a;
            background: #0d0d0d; display: flex; flex-direction: column; gap: 8px;
        }

        .sg-btn-pay {
            display: block; width: 100%; text-align: center;
            background: #22ff72; color: #052e16;
            font-size: 13px; font-weight: 700; font-family: 'Inter', sans-serif;
            padding: 10px; border-radius: 8px; text-decoration: none;
            transition: background .18s, transform .15s; border: none; cursor: pointer;
        }
        .sg-btn-pay:hover { background: #16c957; transform: translateY(-1px); }

        .sg-btn-running {
            display: block; width: 100%; text-align: center;
            background: transparent; color: #444;
            font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif;
            padding: 10px; border-radius: 8px;
            border: 1px solid #1e1e1e; cursor: not-allowed;
        }

        .sg-btn-provisioning {
            display: block; width: 100%; text-align: center;
            background: #0a1220; color: #60a5fa;
            font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif;
            padding: 10px; border-radius: 8px;
            border: 1px solid #0f2340; cursor: wait;
        }

        .sg-btn-delete {
            display: block; width: 100%; text-align: center;
            background: transparent; color: #f87171;
            font-size: 13px; font-weight: 600; font-family: 'Inter', sans-serif;
            padding: 10px; border-radius: 8px;
            border: 1px solid #3a1515;
            transition: background .18s, border-color .18s; cursor: pointer;
        }
        .sg-btn-delete:hover { background: rgba(248,113,113,.08); border-color: rgba(248,113,113,.4); }

        /* ── EMPTY STATE ── */
        .sg-empty {
            grid-column: 1 / -1;
            background: #111; border: 1px dashed #1e1e1e;
            border-radius: 14px; padding: 4rem 2rem; text-align: center;
        }
        .sg-empty-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: #0d0d0d; border: 1px solid #1e1e1e;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.2rem;
        }
        .sg-empty-icon svg { width: 24px; height: 24px; stroke: #333; fill: none; stroke-width: 1.6; }
        .sg-empty-title { font-size: 15px; font-weight: 700; color: #333; margin-bottom: 5px; }
        .sg-empty-sub { font-size: 13px; color: #2a2a2a; }
    </style>

    <div class="sg-wrap">

        {{-- ── TOPBAR ── --}}
        <div class="sg-header">
            <div class="sg-header-brand">
                <div class="sg-logo-icon">
                    <svg viewBox="0 0 20 20">
                        <rect x="2" y="2" width="7" height="7" rx="1.5"/>
                        <rect x="11" y="2" width="7" height="7" rx="1.5"/>
                        <rect x="2" y="11" width="7" height="7" rx="1.5"/>
                        <rect x="11" y="11" width="7" height="7" rx="1.5"/>
                    </svg>
                </div>
                <div class="sg-logo-name">Sigma<span>Server</span></div>
            </div>
        </div>

        {{-- ── PAGE TITLE ── --}}
        <div class="sg-page-head">
            <div class="sg-tag">
                <div class="sg-tag-dot"></div>
                Server kamu · Kelola semua
            </div>
            <h1 class="sg-page-title">My Servers<span>.</span></h1>
            <p class="sg-page-sub">Buat, kelola, dan pantau semua server Minecraft kamu.</p>
        </div>

        {{-- ── CREATE FORM ── --}}
        <form method="POST" action="{{ route('servers.store') }}" class="sg-create-row">
            @csrf
            <input
                type="text"
                name="name"
                class="sg-input"
                placeholder="Nama server baru..."
                required
            />
            <button type="submit" class="sg-btn-create">
                <svg viewBox="0 0 14 14"><line x1="7" y1="2" x2="7" y2="12"/><line x1="2" y1="7" x2="12" y2="7"/></svg>
                Buat Server
            </button>
        </form>

        {{-- ── FLASH ── --}}
        @if(session('success'))
            <div class="sg-flash">
                <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- ── GRID ── --}}
        <div class="sg-grid">
            @forelse($servers as $server)
                <div class="sg-card">

                    {{-- Head --}}
                    <div class="sg-card-head">
                        <div class="sg-card-name" title="{{ $server->name }}">{{ $server->name }}</div>
                        @if($server->status === 'active')
                            <span class="sg-badge active"><span class="sg-badge-dot"></span>Active</span>
                        @elseif($server->status === 'pending')
                            <span class="sg-badge pending"><span class="sg-badge-dot"></span>Pending</span>
                        @elseif($server->status === 'provisioning')
                            <span class="sg-badge provisioning"><span class="sg-badge-dot"></span>Provisioning</span>
                        @else
                            <span class="sg-badge other"><span class="sg-badge-dot"></span>{{ ucfirst($server->status) }}</span>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="sg-card-body">
                        <div class="sg-card-row">
                            <span class="sg-card-key">Port</span>
                            <span class="sg-card-val mono">{{ $server->port }}</span>
                        </div>
                        <div class="sg-card-row">
                            <span class="sg-card-key">Version</span>
                            <span class="sg-card-val">{{ $server->version }}</span>
                        </div>
                        <div class="sg-card-row">
                            <span class="sg-card-key">IP Address</span>
                            @if($server->ip)
                                <span class="sg-card-val mono green">{{ $server->ip }}</span>
                            @else
                                <span class="sg-card-val dim">Belum ditetapkan</span>
                            @endif
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="sg-card-foot">

                        {{-- Action button --}}
                        @if($server->status === 'pending')
                            <a href="{{ route('pay.create', $server->id) }}" target="_blank" class="sg-btn-pay">
                                Bayar Sekarang · Rp 10.000
                            </a>
                        @elseif($server->status === 'active')
                            <button disabled class="sg-btn-running">
                                ● Server Berjalan
                            </button>
                        @elseif($server->status === 'provisioning')
                            <button disabled class="sg-btn-provisioning">
                                ◌ Sedang Menyiapkan...
                            </button>
                        @endif

                        {{-- Delete --}}
                        <form method="POST" action="{{ route('servers.destroy', $server->id) }}" style="margin:0">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="sg-btn-delete"
                                onclick="return confirm('Yakin ingin menghapus server ini? Semua data akan hilang permanen.')"
                            >
                                Hapus Server
                            </button>
                        </form>

                    </div>
                </div>

            @empty
                <div class="sg-empty">
                    <div class="sg-empty-icon">
                        <svg viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                        </svg>
                    </div>
                    <div class="sg-empty-title">Belum ada server</div>
                    <div class="sg-empty-sub">Ketik nama server di atas lalu klik "Buat Server" untuk memulai.</div>
                </div>
            @endforelse
        </div>

    </div>
</x-layouts::app>