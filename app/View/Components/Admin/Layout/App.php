<?php

namespace App\View\Components\Admin\Layout;

use Illuminate\View\Component;
use Illuminate\View\View;

class App extends Component
{
    public string $title;
    public string $activeItem;
    public array $user;
    public array $notifications;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title = 'Admin Dashboard - CLSU LMS',
        string $activeItem = 'dashboard',
        array $user = [],
        array $notifications = []
    ) {
        $this->title = $title;
        $this->activeItem = $activeItem;
        $this->user = array_merge([
            'name' => 'Admin User',
            'role' => 'Administrator',
            'initials' => 'AU'
        ], $user);
        $this->notifications = array_merge(['users' => 0, 'courses' => 0], $notifications);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.admin.layout.app');
    }
}