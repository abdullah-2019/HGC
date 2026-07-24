@extends('admin.layouts.app')

@section('title', 'Add Award — ' . $company->name_en)
@section('page-title', 'Add Award')

@section('content')
    <x-admin.page-header title="Add Award" :subtitle="$company->name_en" />

    <form action="{{ route('admin.companies.awards.store', $company) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.companies.awards.form')
    </form>
@endsection