@extends('admin.layouts.app')

@section('title', 'Edit Sector')
@section('page-title', 'Edit Sector')

@section('content')


<form method="POST" action="{{ route('admin.sectors.update', $sector) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        @include('admin.error-alert')
        @include('admin.sectors._form')
    </form>

@endsection
