@extends('admin.layouts.app')

@section('title', 'Edit Award — ' . $company->name_en)
@section('page-title', 'Edit Award')

@section('content')
    <x-admin.page-header title="Edit Award" :subtitle="$company->name_en" />

    <form action="{{ route('admin.companies.awards.update', [$company, $award]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.companies.awards.form')
    </form>
@endsection