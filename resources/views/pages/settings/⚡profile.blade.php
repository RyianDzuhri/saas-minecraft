<?php

use App\Concerns\ProfileValidationRules;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Profile settings')] class extends Component {
    use ProfileValidationRules;

    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();
        $validated = $this->validate($this->profileRules($user->id));
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        Flux::toast(variant: 'success', text: __('Profile updated.'));
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Flux::toast(text: __('A new verification link has been sent to your email address.'));
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        return Auth::user() instanceof MustVerifyEmail && ! Auth::user()->hasVerifiedEmail();
    }

    #[Computed]
    public function showDeleteUser(): bool
    {
        return ! Auth::user() instanceof MustVerifyEmail
            || (Auth::user() instanceof MustVerifyEmail && Auth::user()->hasVerifiedEmail());
    }
}; ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=JetBrains+Mono:wght@400;500&display=swap');

    .sg-profile-section {
        font-family: 'Inter', sans-serif;
        width: 100%;
    }

    /* ── FORM FIELDS ── */
    .sg-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .sg-label {
        font-size: 11px;
        font-weight: 500;
        color: #555;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        font-family: 'JetBrains Mono', monospace;
    }
    .sg-input {
        width: 100%;
        background: #111;
        border: 1px solid #1e1e1e;
        border-radius: 9px;
        padding: 11px 14px;
        font-size: 14px;
        color: #fff;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }
    .sg-input::placeholder { color: #333; }
    .sg-input:focus {
        border-color: #22ff72;
        box-shadow: 0 0 0 3px rgba(34,255,114,.07);
    }

    /* ── UNVERIFIED EMAIL NOTICE ── */
    .sg-notice {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #1a1500;
        border: 1px solid #332900;
        border-radius: 9px;
        padding: 12px 14px;
        margin-top: 10px;
    }
    .sg-notice svg {
        width: 15px; height: 15px;
        stroke: #fbbf24; fill: none; stroke-width: 2;
        flex-shrink: 0; margin-top: 1px;
    }
    .sg-notice-text {
        font-size: 13px;
        color: #a0803a;
        line-height: 1.5;
    }
    .sg-notice-link {
        color: #fbbf24;
        cursor: pointer;
        text-decoration: underline;
        text-underline-offset: 3px;
        background: none;
        border: none;
        font-size: 13px;
        font-family: 'Inter', sans-serif;
        padding: 0;
        transition: opacity .2s;
    }
    .sg-notice-link:hover { opacity: .75; }

    /* ── SAVE BUTTON ── */
    .sg-btn-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #22ff72;
        color: #052e16;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        padding: 10px 22px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background .18s, transform .15s;
    }
    .sg-btn-save:hover { background: #16c957; transform: translateY(-1px); }
    .sg-btn-save:active { transform: scale(.98); }
    .sg-btn-save svg {
        width: 13px; height: 13px;
        stroke: #052e16; fill: none; stroke-width: 2.5;
    }

    /* ── DIVIDER ── */
    .sg-divider {
        height: 1px;
        background: #1a1a1a;
        margin: 2rem 0;
    }

    /* ── DELETE ZONE ── */
    .sg-danger-zone {
        background: #111;
        border: 1px solid #3a1515;
        border-radius: 12px;
        padding: 1.2rem 1.4rem;
    }
    .sg-danger-title {
        font-size: 13px;
        font-weight: 700;
        color: #f87171;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 7px;
    }
    .sg-danger-title svg {
        width: 14px; height: 14px;
        stroke: #f87171; fill: none; stroke-width: 2;
    }
    .sg-danger-desc {
        font-size: 12px;
        color: #555;
        margin-bottom: 1rem;
        line-height: 1.5;
    }
</style>

<section class="sg-profile-section">
    @include('partials.settings-heading')

    <x-pages::settings.layout
        :heading="__('Profil')"
        :subheading="__('Perbarui nama dan alamat email kamu')">

        <form wire:submit="updateProfileInformation" style="display:flex;flex-direction:column;gap:16px;margin-top:1.5rem">

            {{-- Name --}}
            <div class="sg-field">
                <label class="sg-label" for="sg-name">Nama</label>
                <input
                    id="sg-name"
                    class="sg-input"
                    type="text"
                    wire:model="name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Nama lengkap"
                />
                @error('name')
                    <span style="font-size:11px;color:#f87171;font-family:'JetBrains Mono',monospace">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="sg-field">
                <label class="sg-label" for="sg-email">Email</label>
                <input
                    id="sg-email"
                    class="sg-input"
                    type="email"
                    wire:model="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                />
                @error('email')
                    <span style="font-size:11px;color:#f87171;font-family:'JetBrains Mono',monospace">{{ $message }}</span>
                @enderror

                @if ($this->hasUnverifiedEmail)
                    <div class="sg-notice">
                        <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                        <div class="sg-notice-text">
                            Email kamu belum diverifikasi.
                            <button type="button" class="sg-notice-link" wire:click.prevent="resendVerificationNotification">
                                Kirim ulang email verifikasi.
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Save --}}
            <div style="padding-top:4px">
                <button type="submit" class="sg-btn-save" data-test="update-profile-button">
                    <svg viewBox="0 0 14 14"><polyline points="2,7 5,10 12,3"/></svg>
                    Simpan perubahan
                </button>
            </div>

        </form>

        {{-- Delete user --}}
        @if ($this->showDeleteUser)
            <div class="sg-divider"></div>
            <div class="sg-danger-zone">
                <div class="sg-danger-title">
                    <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    Peringatan
                </div>
                <div class="sg-danger-desc">
                    Tindakan di bawah ini bersifat permanen dan tidak dapat dibatalkan.
                </div>
                <livewire:pages::settings.delete-user-form />
            </div>
        @endif

    </x-pages::settings.layout>
</section>