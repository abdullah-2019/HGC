@extends('admin.layouts.app')

@section('title', $project->name_en)

@section('content')
    <div class="p-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                @if ($project->cover_image_url)
                    <img src="{{ asset('storage/' . $project->cover_image_url) }}" alt=""
                        class="w-16 h-20 rounded-lg object-cover border border-gray-600">
                @endif
                <div>
                    <h4 class="font-bold text-white">{{ $project->name_en }}</h4>
                    @if ($project->name_dari)
                        <p class="text-sm text-gray-400 mt-0.5" dir="rtl">{{ $project->name_dari }}</p>
                    @endif
                    @if ($project->name_pashto)
                        <p class="text-sm text-gray-400 mt-0.5" dir="rtl">{{ $project->name_pashto }}</p>
                    @endif
                    <p class="text-sm text-gray-500 mt-1"><small>{{ $project->slug }}</small></p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.projects.edit', $project) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-800">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('admin.projects.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Cover Image -->
                @if ($project->cover_image_url)
                    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm p-4">
                        <h3 class="text-lg font-semibold text-white mb-3">Cover Image</h3>
                        <img src="{{ asset('storage/' . $project->cover_image_url) }}" alt="Cover"
                            class="w-full h-64 object-cover rounded-lg">
                    </div>
                @endif

                <!-- Descriptions -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Descriptions</h3>
                    <div class="space-y-4">
                        @if ($project->description_en)
                            <div>
                                <h4 class="text-sm font-medium text-gray-400 mb-1">English</h4>
                                <div class="text-white prose prose-invert max-w-none">
                                    {!! $project->description_en !!}
                                </div>
                            </div>
                        @endif
                        @if ($project->description_dari)
                            <div class="border-t border-gray-700 pt-4">
                                <h4 class="text-sm font-medium text-gray-400 mb-1">Dari</h4>
                                <div class="text-white prose prose-invert max-w-none" dir="rtl">
                                    {!! $project->description_dari !!}
                                </div>
                            </div>
                        @endif
                        @if ($project->description_pashto)
                            <div class="border-t border-gray-700 pt-4">
                                <h4 class="text-sm font-medium text-gray-400 mb-1">Pashto</h4>
                                <div class="text-white prose prose-invert max-w-none" dir="rtl">
                                    {!! $project->description_pashto !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Gallery -->
                @php $gallery = $project->gallery_images ?? []; @endphp
                @if (count($gallery) > 0)
                    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Gallery ({{ count($gallery) }} images)</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                            @foreach ($gallery as $image)
                                <div
                                    class="group relative bg-gray-700/50 rounded-xl border border-gray-600 overflow-hidden">
                                    <div class="aspect-[4/3] bg-gray-800 overflow-hidden">
                                        <img src="{{ str_starts_with($image['image_url'] ?? '', 'http') ? $image['image_url'] : asset('storage/' . $image['image_url']) }}"
                                            alt="{{ $image['caption_en'] ?? '' }}" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Captions -->
                                    <div class="p-3 space-y-1.5">
                                        @if ($image['caption_en'] ?? false)
                                            <div>
                                                <span
                                                    class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">EN</span>
                                                <p class="text-xs text-white">{{ $image['caption_en'] }}</p>
                                            </div>
                                        @endif
                                        @if ($image['caption_dari'] ?? false)
                                            <div>
                                                <span
                                                    class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">Dari</span>
                                                <p class="text-xs text-white" dir="rtl">{{ $image['caption_dari'] }}
                                                </p>
                                            </div>
                                        @endif
                                        @if ($image['caption_pashto'] ?? false)
                                            <div>
                                                <span
                                                    class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">Pashto</span>
                                                <p class="text-xs text-white" dir="rtl">{{ $image['caption_pashto'] }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Milestones -->
                @if ($project->milestones->count() > 0)
                    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Milestones ({{ $project->milestones->count() }})
                        </h3>
                        <div class="relative border-l-2 border-gray-700 ml-3 space-y-6">
                            @foreach ($project->milestones->sortBy('milestone_date') as $milestone)
                                <div class="ml-6">
                                    <span
                                        class="absolute -left-2.5 flex items-center justify-center w-5 h-5 bg-blue-900 rounded-full ring-4 ring-gray-800">
                                        <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                    </span>
                                    <div class="flex items-center justify-between mb-1">
                                        <div>
                                            @if ($milestone->title_en)
                                                <h4 class="text-sm font-semibold text-white">{{ $milestone->title_en }}
                                                </h4>
                                            @endif
                                            @if ($milestone->title_dari)
                                                <p class="text-xs text-gray-400 mt-0.5" dir="rtl">
                                                    {{ $milestone->title_dari }}</p>
                                            @endif
                                            @if ($milestone->title_pashto)
                                                <p class="text-xs text-gray-400 mt-0.5" dir="rtl">
                                                    {{ $milestone->title_pashto }}</p>
                                            @endif
                                        </div>
                                        <time
                                            class="text-xs text-gray-400">{{ $milestone->milestone_date?->format('M d, Y') }}</time>
                                    </div>
                                    @if ($milestone->description)
                                        <p class="text-sm text-gray-400">{{ $milestone->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column - Info Cards -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Project Status</h3>
                    <div class="space-y-4">
                        @php
                            $statusColors = [
                                'ongoing' => 'bg-yellow-900 text-yellow-300',
                                'completed' => 'bg-green-900 text-green-300',
                                'planned' => 'bg-purple-900 text-purple-300',
                                'on_hold' => 'bg-red-900 text-red-300',
                            ];
                        @endphp
                        <div>
                            <span class="text-xs text-gray-400">Status</span>
                            <div class="mt-1">
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded {{ $statusColors[$project->status] ?? 'bg-gray-700 text-gray-300' }}">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400">Completion</span>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex-1 relative h-2 flex items-center bg-transparent rounded-full"
                                    style="border: 0.5px solid #4b5563 !important;">
                                    <div class="h-full rounded-full relative flex items-center justify-end"
                                        style="background-color: #22c55e !important; width: {{ $project->completion_percent }}%;">
                                        <div class="w-3 h-3 bg-white rounded-full absolute translate-x-1.5 shadow-md z-10"
                                            style="border: 0.5px solid #22c55e !important;"></div>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-white">{{ $project->completion_percent }}%</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-2 border-t border-gray-700">
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-400">Featured:</span>
                                @if ($project->is_featured)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @else
                                    <span class="text-xs text-gray-500">No</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-400">Active:</span>
                                @if ($project->is_active)
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-900 text-green-300">Yes</span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-900 text-red-300">No</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details Card -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Details</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-xs text-gray-400">Category</span>
                            <p class="text-sm font-medium text-white">{{ $project->category?->name_en ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400">Company</span>
                            <p class="text-sm font-medium text-white">{{ $project->company?->name_en ?? 'N/A' }}</p>
                        </div>
                        <div class="border-t border-gray-700 pt-3">
                            <span class="text-xs text-gray-400">Location</span>
                            <p class="text-sm font-medium text-white">{{ $project->location_en ?? 'N/A' }}</p>
                            @if ($project->location_dari)
                                <p class="text-xs text-gray-500 mt-0.5" dir="rtl">{{ $project->location_dari }}</p>
                            @endif
                            @if ($project->location_pashto)
                                <p class="text-xs text-gray-500 mt-0.5" dir="rtl">{{ $project->location_pashto }}
                                </p>
                            @endif
                            @if ($project->province)
                                <p class="text-xs text-gray-500 mt-1">{{ $project->province }}</p>
                            @endif
                        </div>
                        <div class="border-t border-gray-700 pt-3">
                            <span class="text-xs text-gray-400">Client</span>
                            <p class="text-sm font-medium text-white">{{ $project->client_name_en ?? 'N/A' }}</p>
                            @if ($project->client_name_dari)
                                <p class="text-xs text-gray-500 mt-0.5" dir="rtl">{{ $project->client_name_dari }}
                                </p>
                            @endif
                            @if ($project->client_logo_url)
                                <img src="{{ asset('storage/' . $project->client_logo_url) }}" alt="Client Logo"
                                    class="w-12 h-12 object-contain mt-2 rounded border border-gray-600">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Budget Card -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Budget & Timeline</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-xs text-gray-400">Budget</span>
                            <p class="text-sm font-medium text-white">
                                @if ($project->budget_amount)
                                    {{ number_format($project->budget_amount, 0) }} {{ $project->budget_currency }}
                                @else
                                    <span class="text-gray-500">Not set</span>
                                @endif
                            </p>
                        </div>
                        <div class="border-t border-gray-700 pt-3">
                            <span class="text-xs text-gray-400">Duration</span>
                            <p class="text-sm font-medium text-white">{{ $project->duration_text ?? 'N/A' }}</p>
                        </div>
                        <div class="border-t border-gray-700 pt-3">
                            <span class="text-xs text-gray-400">Start Date</span>
                            <p class="text-sm font-medium text-white">
                                {{ $project->start_date?->format('M d, Y') ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400">End Date</span>
                            <p class="text-sm font-medium text-white">{{ $project->end_date?->format('M d, Y') ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Meta Information</h3>
                    <div class="space-y-3 text-xs text-gray-400">
                        <div class="flex justify-between">
                            <span>Sort Order:</span>
                            <span class="text-white font-medium">{{ $project->sort_order }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Created:</span>
                            <span class="text-white font-medium">{{ $project->created_at?->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Updated:</span>
                            <span class="text-white font-medium">{{ $project->updated_at?->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
