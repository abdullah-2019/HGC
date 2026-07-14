@extends('admin.layouts.app')

@section('title', 'Edit Company')
@section('page-title', 'Edit Company')

@section('content')
    <x-admin.page-header title="Edit Company" subtitle="Update company details" />

    <form action="{{ route('admin.companies.update', $company) }}" method="POST" enctype="multipart/form-data">
        @include('admin.companies.form')
    </form>

    {{-- Awards Section --}}
    <div class="mt-8 p-5 bg-gray-800 border border-gray-700 rounded-xl">
        <h3 class="text-lg font-semibold text-white mb-4">Company Awards</h3>
        {{-- Awards management will be added here --}}
    </div>

    {{-- Values Section --}}
    <div class="mt-8 p-5 bg-gray-800 border border-gray-700 rounded-xl">
        <h3 class="text-lg font-semibold text-white mb-4">Company Values</h3>
        {{-- Values management will be added here --}}
    </div>
@endsection
