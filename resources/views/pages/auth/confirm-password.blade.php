<x-layouts::auth :title="__('Confirm password')">

    <style>
        .sg-card {
            width: 100%;
            max-width: 420px;
        }

        .sg-title {
            font-size: 26px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 6px;
        }

        .sg-subtitle {
            color: #555;
            font-size: 14px;
            margin-bottom: 1.5rem;
        }

        .sg-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sg-label {
            font-size: 11px;
            font-weight: 500;
            color: #555;
            letter-spacing: .07em;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
        }

        .sg-btn {
            width: 100%;
            background: #22ff72;
            color: #052e16;
            font-size: 14px;
            font-weight: 800;
            padding: 14px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: .2s;
        }

        .sg-btn:hover {
            background: #16c957;
            transform: translateY(-1px);
        }

        /* 🔥 FIX AGAR TIDAK RUSAK SAAT ERROR */
        input {
            background: #181818 !important;
            color: #fff !important;
            border: 1px solid #222 !important;
            border-radius: 10px;
            padding: 12px;
        }

        input:focus {
            border-color: #22ff72 !important;
            box-shadow: 0 0 0 3px rgba(34,255,114,0.1);
        }

        .sg-error {
            font-size: 12px;
            color: #f87171;
            font-family: 'JetBrains Mono', monospace;
        }
    </style>

    <div class="flex flex-col items-center justify-center min-h-screen">

        <div class="sg-card">

            {{-- TITLE --}}
            <div>
                <h1 class="sg-title">Confirm Password</h1>
                <p class="sg-subtitle">
                    This is a secure area. Please confirm your password before continuing.
                </p>
            </div>

            {{-- STATUS --}}
            <x-auth-session-status class="text-center mb-4" :status="session('status')" />

            {{-- FORM --}}
            <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-5">
                @csrf

                {{-- PASSWORD --}}
                <div class="sg-field">
                    <label class="sg-label">Password</label>

                    <flux:input
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        viewable
                    />

                    @error('password')
                        <span class="sg-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="sg-btn" data-test="confirm-password-button">
                    Confirm
                </button>

            </form>

        </div>

    </div>

</x-layouts::auth>