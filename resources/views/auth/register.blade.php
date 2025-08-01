<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Buat Akun Baru ✨</h1>
        <p class="text-gray-600">Silakan isi data di bawah untuk mendaftar</p>
    </div>


    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-medium" />
            <x-text-input id="name"
                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-300"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
            <x-text-input id="email"
                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-300"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password"
                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-300"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password_confirmation"
                class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-300"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Tombol -->
        <button type="submit"
            class="w-full py-3 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold shadow-md hover:from-blue-700 hover:to-blue-800 transition">
            Daftar Sekarang
        </button>

        <p class="text-sm text-gray-600 text-center mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
