@extends('admin.layouts.app')

@section('title', 'Edit Statistic')

@section('content')
<div class="max-w-4xl mx-auto bg-gray-900 min-h-screen text-gray-100 p-2">

    <!-- Top Navigation Header -->
    <div class="flex items-center justify-between mb-6 border-b border-gray-800 pb-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Statistic</h1>
            <p class="mt-1 text-sm text-gray-400">Update statistic metrics and multi-lingual descriptors.</p>
        </div>

        <a href="{{ route('admin.stats.index') }}"
            class="h-10 inline-flex items-center justify-center px-4 text-sm font-medium text-gray-300 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white transition-colors shadow-sm">
            Back
        </a>
    </div>

    <!-- Error Validation Alert Component -->
    @if ($errors->any())
        <div class="flex p-4 mb-5 text-sm rounded-xl bg-gray-800 border border-red-800/80 text-red-400 shadow-lg" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px] text-red-500" aria-hidden="true" xmlns="http://w3.org" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 3 0v5a1.5 1.5 0 0 1-3 0V4Zm1 9a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5Z" />
            </svg>
            <div>
                <span class="font-bold tracking-wide block mb-1 text-red-400">Please correct the following errors:</span>
                <ul class="mt-1.5 list-disc list-inside space-y-1 text-xs text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Form Container Block -->
    <div class="relative overflow-hidden bg-gray-800 rounded-xl border border-gray-700 shadow-lg">
        <form action="{{ route('admin.stats.update', $stat) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Key (Read Only) --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-400">Parameter Key Reference</label>
                    <input type="text" value="{{ $stat->key }}" disabled
                        class="bg-gray-700/50 border border-gray-600/60 text-gray-500 text-sm rounded-lg block w-full h-11 px-3 cursor-not-allowed font-mono">
                </div>

                {{-- Value --}}
                <div>
                    <label for="value" class="block mb-2 text-sm font-medium text-white">Value</label>
                    <input type="number" id="value" name="value" value="{{ old('value', $stat->value) }}" required
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full h-11 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Suffix --}}
                <div>
                    <label for="suffix" class="block mb-2 text-sm font-medium text-white">Suffix (e.g. +, %)</label>
                    <input type="text" id="suffix" name="suffix" maxlength="10" value="{{ old('suffix', $stat->suffix) }}" placeholder="e.g. %"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full h-11 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono">
                </div>

                {{-- Icon --}}
                <div>
                    <label for="icon_name" class="block mb-2 text-sm font-medium text-white">Lucide Icon Class</label>
                    <input type="text" id="icon_name" name="icon_name" value="{{ old('icon_name', $stat->icon_name) }}" placeholder="e.g. Users, Trophy"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full h-11 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono">
                </div>

                {{-- English Label --}}
                <div>
                    <label for="label_en" class="block mb-2 text-sm font-medium text-white">English Description Label</label>
                    <input type="text" id="label_en" name="label_en" value="{{ old('label_en', $stat->label_en) }}" required
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full h-11 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Dari Label --}}
                <div>
                    <label for="label_dari" class="block mb-2 text-sm font-medium text-white text-right">Dari Label (دری)</label>
                    <input type="text" id="label_dari" name="label_dari" value="{{ old('label_dari', $stat->label_dari) }}" dir="rtl" placeholder="عنوان به زبان دری"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full h-11 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right font-serif">
                </div>

                {{-- Pashto Label --}}
                <div>
                    <label for="label_pashto" class="block mb-2 text-sm font-medium text-white text-right">Pashto Label (پښتو)</label>
                    <input type="text" id="label_pashto" name="label_pashto" value="{{ old('label_pashto', $stat->label_pashto) }}" dir="rtl" placeholder="عنوان په پښتو ژبه"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full h-11 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right font-serif">
                </div>

                {{-- Sort Order --}}
                <div>
                    <label for="sort_order" class="block mb-2 text-sm font-medium text-white">Sorting Sequence Index</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $stat->sort_order) }}"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full h-11 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Status Toggle Switch (Flowbite Compliant) --}}
                <div class="md:col-span-2 pt-2 border-t border-gray-700/60">
                    <input type="hidden" name="is_active" value="0">
                    <label class="inline-flex items-center cursor-pointer select-none">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $stat->is_active) ? 'checked' : '' }}>
                        <!-- Flowbite Responsive Track Configuration -->
                        <div class="relative w-11 h-6 bg-gray-600 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-300">Set visibility status to Active</span>
                    </label>
                </div>

            </div>

            <!-- Action Form Trigger -->
            <div class="flex justify-end pt-4 border-t border-gray-700">
                <button type="submit"
                    class="inline-flex items-center justify-center px-5 h-11 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors focus:ring-4 focus:ring-blue-900 shadow-md font-semibold">
                    Update Statistic
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
