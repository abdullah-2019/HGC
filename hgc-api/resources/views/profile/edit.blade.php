@extends('admin.layouts.app')

@section('title', 'Profile')
@section('page-title', 'Profile')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection