<aside class="w-64 h-screen bg-gradient-to-b from-blue-800 to-blue-900 text-white fixed shadow-lg">
    <!-- Header -->
    <div class="p-5 flex flex-col items-center border-b border-blue-700">
        <span class="text-3xl font-extrabold tracking-wide">Loka<span class="text-yellow-300">Jaya</span></span>
    </div>

    <!-- Profile -->
    <div class="p-5 text-center border-b border-blue-700">
        <div class="flex justify-center mb-2">
            <i class="fas fa-user-circle text-5xl text-yellow-300"></i>
        </div>
        <p class="text-sm font-semibold">{{ Auth::user()->name ?? 'ADMIN' }}</p>
        
    </div>

    <!-- Navigation -->
    <nav class="flex flex-col space-y-2 mt-5 px-4">
        @php
            $menu = [
                ['route'=>'dashboard','icon'=>'fa-home','label'=>'Dashboard'],
                ['route'=>'uli.index','icon'=>'fa-coins','label'=>'Uli'],
                ['route'=>'pengunjung.index','icon'=>'fa-users','label'=>'Pengunjung'],
                ['route'=>'pedagang.index','icon'=>'fa-store','label'=>'Pedagang'],
                ['route'=>'pengeluaran.index','icon'=>'fa-money-bill-wave','label'=>'Pengeluaran'],
                ['route'=>'laporan.index','icon'=>'fa-chart-line','label'=>'Laporan'],
            ];
        @endphp

        @foreach ($menu as $item)
            <a href="{{ route($item['route']) }}" 
               class="flex items-center px-3 py-2 rounded-lg transition-all duration-200 
               {{ request()->routeIs($item['route']) ? 'bg-blue-700 text-yellow-300' : 'hover:bg-blue-700 hover:pl-4' }}">
                <i class="fas {{ $item['icon'] }} mr-3 w-5 text-center"></i> 
                <span class="font-medium">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" class="absolute bottom-5 left-5 right-5">
        @csrf
        <button type="submit"
            class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200 shadow-md">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </button>
    </form>
</aside>
