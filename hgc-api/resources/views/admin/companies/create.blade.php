@extends('admin.layouts.app')

@section('title', 'Add Company')
@section('page-title', 'Add Company')

@section('content')
    <x-admin.page-header title="Add Company" subtitle="Create a new group company" />

    <form action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.companies.form')
    </form>
@endsection
