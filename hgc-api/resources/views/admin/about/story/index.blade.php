{{-- resources/views/admin/about/story/index.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'Our Story')
@section('page-title', 'Our Story')

@section('content')
    <div class="p-4 md:p-6">
        {{-- Page Header --}}
        <!-- Added flex-nowrap to guarantee one row across all screen sizes -->
        <div class="flex flex-row flex-nowrap items-center justify-between mb-6 gap-4 w-full">
            <!-- min-w-0 isolates this flex column block to allow internal text truncation -->
            <div class="min-w-0">
                <h1 class="text-xl sm:text-2xl font-bold text-heading flex items-center gap-2 truncate">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-fg-brand flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="truncate">About Story</span>
                </h1>
                <!-- Hidden on ultra-small screens, truncated on tablets for fluid responsiveness -->
                <p class="mt-1 text-xs sm:text-sm text-body truncate hidden xs:block">View and manage your company story
                    section.</p>
            </div>

            <!-- flex-shrink-0 and whitespace-nowrap prevents the action button shape from compressing -->
            <a href="{{ route('admin.about.story.edit') }}"
                class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2.5 text-xs sm:text-sm font-medium text-white bg-brand hover:bg-brand-strong border border-transparent rounded-base focus:ring-4 focus:ring-brand-medium shadow-xs flex-shrink-0 whitespace-nowrap">
                <svg class="w-4 h-4 mr-1.5 sm:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Edit Story</span>
            </a>
        </div>


        {{-- Alerts --}}
        @if (session('success'))
            <div class="flex p-4 mb-6 text-sm text-fg-success rounded-base bg-success-softer border border-success-medium"
                role="alert">
                <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <div><span class="font-medium">Success!</span> {{ session('success') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="flex p-4 mb-6 text-sm text-fg-danger rounded-base bg-danger-softer border border-danger-medium"
                role="alert">
                <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                <div><span class="font-medium">Error!</span> {{ session('error') }}</div>
            </div>
        @endif

        {{-- Story Card --}}
        <div class="bg-neutral-primary-soft border border-default rounded-base shadow-xs overflow-hidden">
            {{-- Card Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-default bg-neutral-secondary-soft">
                <h5 class="text-lg font-semibold text-heading">Story Details</h5>
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $story->is_active ? 'bg-success-softer text-fg-success border border-success-medium' : 'bg-neutral-tertiary-medium text-body border border-default-medium' }}">
                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $story->is_active ? 'bg-success' : 'bg-body' }}"></span>
                    {{ $story->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                    {{-- Left: Image + Floating Card --}}
                    <div class="xl:col-span-1">
                        <div class="relative rounded-base overflow-hidden border border-default shadow-xs">
                            @if ($story->main_image)
                                <img src="{{ asset('storage/' . $story->main_image) }}" alt="Story Image"
                                    class="w-full h-80 object-cover">
                            @else
                                <div class="w-full h-80 bg-neutral-secondary-medium flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 mx-auto text-body mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm text-body">No image uploaded</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Floating Card Overlay --}}
                            <div
                                class="absolute bottom-4 left-4 bg-neutral-primary-soft border border-default rounded-base shadow-lg p-4 min-w-[140px]">
                                <div class="text-center">
                                    <span
                                        class="block text-2xl font-bold text-fg-brand">{{ $story->floating_card_value }}</span>
                                    <span class="text-xs text-body">{{ $story->floating_card_label_en }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Info --}}
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div class="bg-neutral-secondary-soft border border-default rounded-base p-3 text-center">
                                <span class="block text-xs text-body uppercase tracking-wider">Founded</span>
                                <span
                                    class="block text-lg font-semibold text-heading mt-1">{{ $story->founded_year }}</span>
                            </div>
                            <div class="bg-neutral-secondary-soft border border-default rounded-base p-3 text-center">
                                <span class="block text-xs text-body uppercase tracking-wider">Sort Order</span>
                                <span class="block text-lg font-semibold text-heading mt-1">{{ $story->sort_order }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Content --}}
                    <div class="xl:col-span-2 space-y-6">
                        {{-- English Content --}}
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span
                                    class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-brand rounded-full">EN</span>
                                <span
                                    class="text-xs font-medium text-fg-brand uppercase tracking-widest">{{ $story->section_label_en }}</span>
                            </div>
                            <h2 class="text-2xl font-bold text-heading">{{ $story->title_en }}</h2>
                            <div class="bg-neutral-secondary-soft border border-default rounded-base p-4">
                                <div class="text-body leading-relaxed story-content">
                                    {!! $story->paragraph_1_en !!}
                                </div>
                            </div>
                        </div>

                        {{-- Translations Accordion --}}
                        <div class="border border-default rounded-base divide-y divide-default overflow-hidden">
                            {{-- Dari --}}
                            <div class="bg-neutral-secondary-soft">
                                <button type="button"
                                    class="flex items-center justify-between w-full px-5 py-3.5 text-left hover:bg-neutral-tertiary-medium transition-colors"
                                    onclick="toggleAccordion('dari-panel', this)">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-emerald-600 rounded-full">DR</span>
                                        <span class="font-medium text-heading">Dari Translation</span>
                                    </div>
                                    <svg class="w-4 h-4 text-body accordion-icon transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div id="dari-panel" class="hidden px-5 pb-4 bg-neutral-primary-soft">
                                    <div class="space-y-3 pt-2">
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <span class="text-xs text-body uppercase">Section Label</span>
                                                <p class="text-sm text-heading font-medium mt-0.5" dir="rtl">
                                                    {{ $story->section_label_dari ?? '—' }}</p>
                                            </div>
                                            <div>
                                                <span class="text-xs text-body uppercase">Floating Card</span>
                                                <p class="text-sm text-heading font-medium mt-0.5" dir="rtl">
                                                    {{ $story->floating_card_label_dari ?? '—' }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-xs text-body uppercase">Title</span>
                                            <p class="text-base text-heading font-semibold mt-0.5" dir="rtl">
                                                {{ $story->title_dari ?? '—' }}</p>
                                        </div>
                                        <div class="bg-neutral-secondary-soft border border-default rounded-base p-3">
                                            <div class="text-body text-sm leading-relaxed story-content" dir="rtl">
                                                {!! $story->paragraph_1_dari ?? '<span class="text-body opacity-50">No content</span>' !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Pashto --}}
                            <div class="bg-neutral-secondary-soft">
                                <button type="button"
                                    class="flex items-center justify-between w-full px-5 py-3.5 text-left hover:bg-neutral-tertiary-medium transition-colors"
                                    onclick="toggleAccordion('pashto-panel', this)">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-amber-600 rounded-full">PS</span>
                                        <span class="font-medium text-heading">Pashto Translation</span>
                                    </div>
                                    <svg class="w-4 h-4 text-body accordion-icon transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div id="pashto-panel" class="hidden px-5 pb-4 bg-neutral-primary-soft">
                                    <div class="space-y-3 pt-2">
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <span class="text-xs text-body uppercase">Section Label</span>
                                                <p class="text-sm text-heading font-medium mt-0.5" dir="rtl">
                                                    {{ $story->section_label_pashto ?? '—' }}</p>
                                            </div>
                                            <div>
                                                <span class="text-xs text-body uppercase">Floating Card</span>
                                                <p class="text-sm text-heading font-medium mt-0.5" dir="rtl">
                                                    {{ $story->floating_card_label_pashto ?? '—' }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-xs text-body uppercase">Title</span>
                                            <p class="text-base text-heading font-semibold mt-0.5" dir="rtl">
                                                {{ $story->title_pashto ?? '—' }}</p>
                                        </div>
                                        <div class="bg-neutral-secondary-soft border border-default rounded-base p-3">
                                            <div class="text-body text-sm leading-relaxed story-content" dir="rtl">
                                                {!! $story->paragraph_1_pashto ?? '<span class="text-body opacity-50">No content</span>' !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-6 border-default">

                {{-- Highlights Section --}}
                <div>
                    <h5 class="text-lg font-semibold text-heading mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-warning" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Story Highlights
                    </h5>

                    @if ($story->highlights->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($story->highlights as $highlight)
                                <div
                                    class="bg-neutral-secondary-soft border border-default rounded-base p-5 text-center hover:border-default-medium transition-colors">
                                    <div
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-brand-softer text-fg-brand mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @switch($highlight->icon_name)
                                                @case('Building2')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                @break

                                                @case('Globe')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                @break

                                                @case('TrendingUp')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                @break

                                                @default
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            @endswitch
                                        </svg>
                                    </div>
                                    <div class="text-2xl font-bold text-heading">{{ $highlight->value_text }}</div>
                                    <div class="text-sm text-body mt-1">{{ $highlight->label_en }}</div>
                                    <div class="flex items-center justify-center gap-2 mt-2">
                                        @if ($highlight->label_dari)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200">DR</span>
                                        @endif
                                        @if ($highlight->label_pashto)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200">PS</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-neutral-secondary-soft border border-default rounded-base p-6 text-center">
                            <svg class="w-12 h-12 mx-auto text-body mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-body">No highlights found for this story.</p>
                        </div>
                    @endif
                </div>

                {{-- Metadata Footer --}}
                <div class="mt-6 pt-4 border-t border-default">
                    <div class="flex flex-wrap gap-6 text-xs text-body">
                        <span>Created: <span
                                class="text-heading font-medium">{{ $story->created_at?->format('M d, Y H:i') ?? 'N/A' }}</span></span>
                        <span>Updated: <span
                                class="text-heading font-medium">{{ $story->updated_at?->format('M d, Y H:i') ?? 'N/A' }}</span></span>
                        <span>ID: <span class="text-heading font-medium">#{{ $story->id }}</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .story-content h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0.75rem 0;
            color: inherit;
        }

        .story-content h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0.5rem 0;
            color: inherit;
        }

        .story-content p {
            margin-bottom: 0.75rem;
            line-height: 1.7;
        }

        .story-content ul {
            list-style-type: disc;
            padding-left: 1.5em;
            margin-bottom: 0.75rem;
        }

        .story-content ol {
            list-style-type: decimal;
            padding-left: 1.5em;
            margin-bottom: 0.75rem;
        }

        .story-content blockquote {
            border-left: 3px solid currentColor;
            padding-left: 1em;
            margin: 1rem 0;
            opacity: 0.8;
            font-style: italic;
        }

        .story-content a {
            color: #2563eb;
            text-decoration: underline;
        }

        .story-content hr {
            border: none;
            border-top: 1px solid currentColor;
            opacity: 0.2;
            margin: 1rem 0;
        }

        .story-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.375rem;
        }

        [dir="rtl"] .story-content ul,
        [dir="rtl"] .story-content ol {
            padding-left: 0;
            padding-right: 1.5em;
        }

        [dir="rtl"] .story-content blockquote {
            border-left: none;
            border-right: 3px solid currentColor;
            padding-left: 0;
            padding-right: 1em;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function toggleAccordion(panelId, btn) {
            const panel = document.getElementById(panelId);
            const icon = btn.querySelector('.accordion-icon');

            if (panel.classList.contains('hidden')) {
                panel.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                panel.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
@endpush
