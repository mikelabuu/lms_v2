@props([
    'user' => [
        'name' => 'Dr. Lorenz',
        'department' => 'Computer Science',
        'initials' => 'JS'
    ]
])

<header class="header glass-effect">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center">
            <button id="menu-toggle" class="mr-4 text-gray-700 hover:text-gray-900 lg:hidden transition" onclick="toggleSidebar()">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-700 to-pink-500 bg-clip-text text-transparent">
                    Instructor Dashboard
                </h1>
                <p class="text-sm text-gray-500 mt-1">Welcome back, {{ explode(' ', $user['name'])[0] }}!</p>
            </div>
        </div>
        
        <div class="flex items-center space-x-4">
            <div class="relative hidden md:block">
                <input type="text" placeholder="Search courses, students, assignments..." 
                       class="search-input py-2.5 pl-12 pr-4 w-80 border border-gray-200 rounded-xl focus:outline-none text-sm">
                <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
            </div>
            
            <button class="relative p-2.5 rounded-xl hover:bg-gray-100 transition">
                <i class="fas fa-bell text-gray-600 text-lg"></i>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            
            <button class="p-2.5 rounded-xl hover:bg-gray-100 transition">
                <i class="fas fa-envelope text-gray-600 text-lg"></i>
            </button>
            
            <div class="flex items-center space-x-3 pl-4 border-l border-gray-200">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white text-sm font-bold">
                    {{ $user['initials'] }}
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-medium text-gray-800">{{ $user['name'] }}</p>
                    <p class="text-xs text-gray-500">{{ $user['department'] }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border-t border-gray-100">
        <div class="flex items-center justify-between px-6 py-3">
            <div class="text-sm text-gray-600 flex items-center space-x-4">
                <span class="flex items-center">
                    <i class="far fa-calendar-alt mr-2 text-purple-600"></i>
                    <span id="current-date">Loading...</span>
                </span>
                <span class="text-gray-300">|</span>
                <span class="flex items-center">
                    <i class="far fa-clock mr-2 text-purple-600"></i>
                    <span id="current-time">Loading...</span>
                </span>
            </div>
            <div class="text-sm text-gray-600">
                <span class="font-medium">Semester:</span> 1st Sem 2025-2026
            </div>
        </div>
    </div>
</header>
