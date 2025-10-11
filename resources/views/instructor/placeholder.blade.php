@props([
    'title' => 'Page',
    'icon' => 'fas fa-cog',
    'description' => 'This page is under development'
])

<x-instructor.layout.app 
    :title="$title . ' - CLSU Instructor Dashboard'"
    activeItem="{{ strtolower($title) }}"
    :user="['name' => 'Dr. Lorenz', 'department' => 'Computer Science', 'initials' => 'JS']"
    :notifications="['assignments' => 8, 'students' => 3]"
>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $title }}</h1>
            <p class="text-gray-600 mt-2">{{ $description }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="text-center py-12">
            <i class="{{ $icon }} text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-600 mb-2">{{ $title }}</h3>
            <p class="text-gray-500">This page is under development and will be available soon</p>
        </div>
    </div>
</x-instructor.layout.app>
