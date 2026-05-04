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

        .sg-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #1a1a1a;
            margin-bottom: 2rem;
        }
        .sg-header-brand { display: flex; align-items: center; gap: 10px; }
        
        .sg-logo-icon svg { width: 18px; height: 18px; stroke: #052e16; fill: none; stroke-width: 2; }
        .sg-logo-name { font-size: 17px; font-weight: 900; letter-spacing: -0.03em; }
        .sg-logo-name span { color: #22ff72; }

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
        }
        .sg-input::placeholder { color: #333; }

        .sg-btn-create {
            display: inline-flex; align-items: center; gap: 7px;
            background: #22ff72; color: #052e16;
            font-size: 13px; font-weight: 700;
            padding: 11px 20px; border-radius: 9px;
            border: none; cursor: pointer;
        }

        .sg-flash {
            display: flex; align-items: center; gap: 10px;
            background: #0a1f11; border: 1px solid #1a3d22;
            color: #22ff72; font-size: 13px;
            padding: 12px 16px; border-radius: 10px; margin-bottom: 1.8rem;
        }

        .sg-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .sg-card {
            background: #111; border: 1px solid #1e1e1e;
            border-radius: 14px;
            display: flex; flex-direction: column;
        }

        .sg-card-head {
            display: flex; justify-content: space-between;
            padding: 1.1rem 1.3rem;
        }

        .sg-card-name {
            font-size: 14px; font-weight: 700;
            color: #e0e0e0;
        }

        .sg-badge {
            font-size: 10px;
            padding: 3px 9px;
            border-radius: 20px;
        }

        .sg-card-body { padding: 1.1rem 1.3rem; }

        .sg-card-row {
            display: flex; justify-content: space-between;
            padding: 8px 0;
        }

        .sg-card-key { font-size: 11px; color: #444; }
        .sg-card-val { font-size: 12px; color: #bbb; }

        .sg-card-foot { padding: 1rem 1.3rem; }

        .sg-btn-pay {
            background: #22ff72; color: #052e16;
            padding: 10px; border-radius: 8px;
            text-decoration: none;
        }

        .sg-btn-delete {
            color: #f87171;
            border: 1px solid #3a1515;
            padding: 10px;
            border-radius: 8px;
        }

        .sg-empty {
            text-align: center;
            padding: 4rem 2rem;
        }
    </style>

    <div class="sg-wrap">

        <div class="sg-header">
            <div class="sg-header-brand">
                <a href="{{ route('dashboard') }}">
                    <div class="sg-logo-name">Sigma<span>Server</span></div>
                </a>
            </div>
        </div>

        <div class="sg-page-head">
            <div class="sg-tag">
                <div class="sg-tag-dot"></div>
                Your servers · Manage everything
            </div>
            <h1 class="sg-page-title">My Servers<span>.</span></h1>
            <p class="sg-page-sub">Create, manage, and monitor all your Minecraft servers.</p>
        </div>

        <form method="POST" action="{{ route('servers.store') }}" class="sg-create-row">
            @csrf
            <input type="text" name="name" class="sg-input" placeholder="New server name..." required />
            <button type="submit" class="sg-btn-create">
                + Create Server
            </button>
        </form>

        @if(session('success'))
            <div class="sg-flash">
                {{ session('success') }}
            </div>
        @endif

        <div class="sg-grid">
            @forelse($servers as $server)
                <div class="sg-card">

                    <div class="sg-card-head">
                        <div class="sg-card-name">{{ $server->name }}</div>
                        <span class="sg-badge">{{ ucfirst($server->status) }}</span>
                    </div>

                    <div class="sg-card-body">
                        <div class="sg-card-row">
                            <span class="sg-card-key">Port</span>
                            <span class="sg-card-val">{{ $server->port }}</span>
                        </div>
                        <div class="sg-card-row">
                            <span class="sg-card-key">Version</span>
                            <span class="sg-card-val">{{ $server->version }}</span>
                        </div>
                        <div class="sg-card-row">
                            <span class="sg-card-key">IP Address</span>
                            <span class="sg-card-val">
                                {{ $server->ip ?? 'Not assigned yet' }}
                            </span>
                        </div>
                    </div>

                    <div class="sg-card-foot">

                        @if($server->status === 'pending')
                            <a href="{{ route('pay.create', $server->id) }}" target="_blank" class="sg-btn-pay">
                                Pay Now · Rp 10.000
                            </a>
                        @elseif($server->status === 'active')
                            <button disabled>Server Running</button>
                        @elseif($server->status === 'provisioning')
                            <button disabled>Setting up...</button>
                        @endif

                        <form method="POST" action="{{ route('servers.destroy', $server->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="sg-btn-delete"
                                onclick="return confirm('Are you sure you want to delete this server? All data will be permanently lost.')">
                                Delete Server
                            </button>
                        </form>

                    </div>
                </div>

            @empty
                <div class="sg-empty">
                    <div>No servers yet</div>
                    <div>Type a server name above and click "Create Server" to get started.</div>
                </div>
            @endforelse
        </div>

    </div>
</x-layouts::app>