@props([
    'icon' => 'fas fa-chart-bar',
    'iconBg' => 'bg-gradient-to-br from-blue-400 to-blue-600',
    'value' => '0',
    'label' => 'Statistic',
    'progress' => 0,
    'color' => 'green'
])

<div class="stat-card">
    <div class="stat-icon {{ $iconBg }} text-white">
        <i class="{{ $icon }}"></i>
    </div>
    <h3 class="text-2xl font-bold text-gray-800">{{ $value }}</h3>
    <p class="text-gray-500 text-sm">{{ $label }}</p>
</div>
