<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TranslatableInput extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public $values = null,
        public string $type = 'text',
        public bool $required = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.translatable-input');
    }
}