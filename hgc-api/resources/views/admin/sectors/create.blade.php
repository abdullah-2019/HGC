@extends('admin.layouts.app')

@section('title','Create Sector')
@section('page-title','Create Sector')


@section('content')

<form method="POST"
action="{{route('admin.sectors.store')}}"
enctype="multipart/form-data">

@csrf

@include('admin.sectors._form')

</form>

@endsection