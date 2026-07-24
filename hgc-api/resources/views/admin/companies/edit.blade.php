@extends('admin.layouts.app')

@section('title', 'Edit Company')
@section('page-title', 'Edit Company')

@section('content')
    <x-admin.page-header title="Edit Company" subtitle="Update company details" />

    <form action="{{ route('admin.companies.update', $company) }}" method="POST" enctype="multipart/form-data">
        @include('admin.companies.form')
    </form>
    <br>

    {{-- Awards Section --}}
    @include('admin.companies.awards.index', ['company' => $company])
    <br>
    {{-- Values Section --}}
    @include('admin.companies.values.index', ['company' => $company])
@endsection
