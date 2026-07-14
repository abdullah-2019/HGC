<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public function __construct(
        public string $title,
        public ?string $subtitle = null,
        public ?string $createRoute = null,
        public ?string $createLabel = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.page-header');
    }
}