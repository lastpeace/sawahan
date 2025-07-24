<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <aside class="w-64 h-screen bg-blue-900 text-white fixed">
        <div class="p-4 flex items-center space-x-2 border-b border-blue-700">
            <span class="text-2xl font-bold">Sawahan</span>
        </div>

        <div class="p-4 text-center border-b border-blue-700">
            <div class="flex justify-center mb-2">
                <i class="fas fa-user-circle text-4xl"></i>
            </div>
            <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Username' }}</p>
        </div>

        <nav class="flex flex-col space-y-1 mt-4 px-4">
            <a href="#" class="flex items-center px-2 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-list mr-3"></i> Data
            </a>
            <a href="{{ route('uli.index') }}"
                class="flex items-center px-2 py-2 rounded hover:bg-blue-800 {{ request()->routeIs('uli.index') ? 'bg-blue-800' : '' }}">
                <i class="fas fa-coins mr-3"></i> Uli
            </a>
            <a href="{{ route('pengunjung.index') }}" class="flex items-center px-2 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-user-friends mr-3"></i> Pengunjung
            </a>
            <a href="#" class="flex items-center px-2 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-store mr-3"></i> Pedagang
            </a>
            <a href="#" class="flex items-center px-2 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-money-bill-wave mr-3"></i> Pengeluaran
            </a>
            <a href="#" class="flex items-center px-2 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-chart-line mr-3"></i> Laporan
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="absolute bottom-4 left-4 right-4">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
            </button>
        </form>
    </aside>

</nav>
