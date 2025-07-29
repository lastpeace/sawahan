<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <aside class="w-48 h-screen bg-blue-900 text-white fixed">
        {{-- Header --}}
        <div class="p-3 flex items-center space-x-2 border-b border-blue-700">
            <span class="text-xl font-bold">Sawahan</span>
        </div>

        {{-- User Info --}}
        <div class="p-3 text-center border-b border-blue-700">
            <div class="flex justify-center mb-1">
                <i class="fas fa-user-circle text-3xl"></i>
            </div>
            <p class="text-xs font-medium">{{ Auth::user()->name ?? 'Username' }}</p>
        </div>

        {{-- Navigation --}}
        <nav class="flex flex-col space-y-1 mt-3 px-3 text-sm">
            <a href="#" class="flex items-center px-2 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-list mr-2 w-4"></i> Data
            </a>
            <a href="{{ route('uli.index') }}"
                class="flex items-center px-2 py-2 rounded hover:bg-blue-800 {{ request()->routeIs('uli.index') ? 'bg-blue-800' : '' }}">
                <i class="fas fa-coins mr-2 w-4"></i> Uli
            </a>
        </nav>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="absolute bottom-3 left-3 right-3">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm">
                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
            </button>
        </form>
    </aside>
</nav>
