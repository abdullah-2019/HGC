<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageUpload extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public ?string $current = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.image-upload');
    }
}