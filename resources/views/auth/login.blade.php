<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Selamat Datang 👋</h1>
        <p class="text-gray-500">Masuk untuk melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="flex items-center gap-3 border rounded-lg px-3 py-2 bg-white">
                <i class="fas fa-envelope text-gray-500"></i>
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                    class="flex-1 border-none focus:ring-0" placeholder="Masukkan email" />
            </div>
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <div class="flex items-center gap-3 border rounded-lg px-3 py-2 bg-white">
                <i class="fas fa-lock text-gray-500"></i>
                <x-text-input id="password" type="password" name="password" required
                    class="flex-1 border-none focus:ring-0" placeholder="Masukkan password" />
            </div>
        </div>

        <div class="flex items-center justify-between text-sm mt-3">
            <label class="flex items-center gap-2 text-gray-600">
                <input type="checkbox" name="remember"
                    class="text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Lupa Password?</a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 mt-4">
            {{ __('Masuk') }}
        </x-primary-button>

        <p class="mt-4 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar</a>
        </p>
    </form>
</x-guest-layout>
