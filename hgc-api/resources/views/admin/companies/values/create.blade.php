@extends('admin.layouts.app')

@section('title', 'Add Value — ' . $company->name_en)
@section('page-title', 'Add Value')

@section('content')
    <x-admin.page-header title="Add Value" :subtitle="$company->name_en" />

    <form action="{{ route('admin.companies.values.store', $company) }}" method="POST">
        @csrf
        @include('admin.companies.values.form')
    </form>
@endsection