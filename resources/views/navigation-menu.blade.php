<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <header class=" top-0 left-0 right-0 z-50 flex items-center justify-between px-6 h-16 bg-white border-b shadow-md">
        <!-- Hamburger -->

        <div class="flex items-center space-x-3">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-auto h-9">
            </a>
            <span class="text-2xl font-bold text-gray-800 tracking-wide select-none">SEVIMA KPI</span>
        </div>
    
        <!-- Profile dropdown -->
        <div class="relative" x-data="{ profileOpen: false }">
            <button 
                @click="profileOpen = !profileOpen" 
                class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded"
                aria-label="User menu"
            >
                <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" 
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
    
            <div 
                x-show="profileOpen" 
                @click.outside="profileOpen = false"
                x-transition
                class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50"
                style="display: none;"
            >
                <a href="{{ route('profile.show') }}" 
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

</nav>
