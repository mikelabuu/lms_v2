<?php

namespace App\View\Components\Admin\Layout;

use Illuminate\View\Component;
use Illuminate\View\View;

class Header extends Component
{
    public array $user;
    public string $title;

    /**
     * Create a new component instance.
     */
    public function __construct(
        array $user = [],
        string $title = 'Admin Dashboard'
    ) {
        $this->user = array_merge([
            'name' => 'Admin User',
            'role' => 'Administrator',
            'initials' => 'AU'
        ], $user);
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.admin.layout.header');
    }
}