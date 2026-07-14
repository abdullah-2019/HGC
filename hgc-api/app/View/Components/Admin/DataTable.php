<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public function __construct(
        public array $headers,
        public $items,
        public array $columns,
        public string $editRoute,
        public string $deleteRoute,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.data-table');
    }
}