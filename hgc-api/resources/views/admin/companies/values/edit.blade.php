@extends('admin.layouts.app')

@section('title', 'Edit Value — ' . $company->name_en)
@section('page-title', 'Edit Value')

@section('content')
    <x-admin.page-header title="Edit Value" :subtitle="$company->name_en" />

    <form action="{{ route('admin.companies.values.update', [$company, $value]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.companies.values.form')
    </form>
@endsection