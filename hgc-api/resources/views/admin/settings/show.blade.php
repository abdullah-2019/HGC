@extends('admin.layouts.app')

@section('title', 'Setting Details')
@section('page-title', 'Setting Details')

@section('content')

    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">

        <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <dt class="text-gray-400">Key</dt>
                <dd class="text-white">{{ $siteSetting->setting_key }}</dd>
            </div>

            <div>
                <dt class="text-gray-400">Type</dt>
                <dd class="text-white">{{ $siteSetting->setting_type }}</dd>
            </div>

            <div class="md:col-span-2">
                <dt class="text-gray-400">Description</dt>
                <dd class="text-white">
                    {{ $siteSetting->description }}
                </dd>
            </div>

            <div class="md:col-span-2">
                <dt class="text-gray-400">Value</dt>

                <pre class="bg-gray-900 p-4 rounded mt-2 text-gray-300 overflow-auto">
                {{ $siteSetting->setting_value }}
            </pre>
            </div>

        </dl>

    </div>

@endsection
