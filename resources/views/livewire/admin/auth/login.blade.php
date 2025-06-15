<div>
    {{--
        Catatan: Komponen Livewire harus memiliki satu elemen root.
        Kita menggunakan <div> ini sebagai pembungkus utama.
    --}}
    <div id="login-form-container">
        <form wire:submit="login">

            {{-- Menampilkan error umum jika kredensial salah --}}
            @error('email')
                <div class="error-message">
                    <p>{{ $message }}</p>
                </div>
            @enderror

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input
                    id="email"
                    type="email"
                    wire:model="email"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    wire:model="password"
                    required
                >
            </div>

            <div class="form-group">
                <button type="submit">
                    Login
                </button>
            </div>

        </form>
    </div>
</div>