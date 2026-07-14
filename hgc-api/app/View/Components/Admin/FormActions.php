<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormActions extends Component
{
    public function __construct(
        public string $backRoute,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.form-actions');
    }
}