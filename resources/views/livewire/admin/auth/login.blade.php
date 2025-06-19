<div>
    <!-- Session Status (untuk pesan seperti reset password) -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold">Admin Login</h1>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" wire:model="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            wire:model="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" wire:model="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                <span wire:loading.remove wire:target="login">
                    {{ __('Masuk') }}
                </span>
                <span wire:loading wire:target="login">
                    Memproses...
                </span>
            </x-primary-button>
        </div>
    </form>
</div>