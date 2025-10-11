@props([
    'icon' => 'fas fa-chart-line',
    'iconBg' => 'bg-gradient-to-br from-blue-400 to-blue-600',
    'value' => '0',
    'label' => 'Total',
    'change' => null,
    'changeType' => 'positive'
])

<div class="stat-card group">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <div class="flex items-center space-x-3 mb-4">
                <div class="stat-icon {{ $iconBg }} text-white shadow-lg">
                    <i class="{{ $icon }}"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-green-600 transition-colors duration-200">
                        {{ $value }}
                    </h3>
                    <p class="text-sm text-gray-600">{{ $label }}</p>
                </div>
            </div>
            
            @if($change)
                <div class="flex items-center space-x-1">
                    <i class="fas fa-arrow-{{ $changeType === 'positive' ? 'up' : 'down' }} text-{{ $changeType === 'positive' ? 'green' : 'red' }}-500 text-xs"></i>
                    <span class="text-xs font-medium text-{{ $changeType === 'positive' ? 'green' : 'red' }}-600">
                        {{ $change }}
                    </span>
                    <span class="text-xs text-gray-500">vs last month</span>
                </div>
            @endif
        </div>
        
        <!-- Decorative Element -->
        <div class="opacity-10 group-hover:opacity-20 transition-opacity duration-200">
            <i class="{{ $icon }} text-6xl text-gray-400"></i>
        </div>
    </div>
</div>