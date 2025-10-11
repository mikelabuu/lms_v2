<?php

namespace App\View\Components\Admin\Layout;

use Illuminate\View\Component;
use Illuminate\View\View;

class Sidebar extends Component
{
    public array $user;
    public string $activeItem;
    public array $notifications;

    /**
     * Create a new component instance.
     */
    public function __construct(
        array $user = [],
        string $activeItem = 'dashboard',
        array $notifications = []
    ) {
        $this->user = array_merge([
            'name' => 'Admin User',
            'role' => 'Administrator',
            'initials' => 'AU'
        ], $user);
        $this->activeItem = $activeItem;
        $this->notifications = array_merge(['users' => 0, 'courses' => 0], $notifications);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.admin.layout.sidebar');
    }
}