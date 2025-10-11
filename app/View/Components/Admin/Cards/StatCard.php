<?php

namespace App\View\Components\Admin\Cards;

use Illuminate\View\Component;
use Illuminate\View\View;

class StatCard extends Component
{
    public string $icon;
    public string $iconBg;
    public string $value;
    public string $label;
    public ?string $change;
    public string $changeType;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $icon = 'fas fa-chart-line',
        string $iconBg = 'bg-gradient-to-br from-blue-400 to-blue-600',
        string $value = '0',
        string $label = 'Total',
        ?string $change = null,
        string $changeType = 'positive'
    ) {
        $this->icon = $icon;
        $this->iconBg = $iconBg;
        $this->value = $value;
        $this->label = $label;
        $this->change = $change;
        $this->changeType = $changeType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.admin.cards.stat-card');
    }
}