@extends('admin.layouts.app')

@section('title', 'Why Choose Us')
@section('page-title', 'Why Choose Us')

@section('content')
    <x-admin.page-header 
        title="Why Choose Us" 
        subtitle="Manage why choose us features"
        :create-route="route('admin.why-us.create')"
        create-label="Add Feature"
    />

    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
        <x-admin.data-table 
            :headers="['Icon', 'Title (EN)', 'Title (Dari)', 'Title (Pashto)', 'Order', 'Status']"
            :items="$features"
            :columns="['icon_name', 'title_en', 'title_dari', 'title_pashto', 'sort_order', 'is_active']"
            edit-route="admin.why-us.edit"
            delete-route="admin.why-us.destroy"
        />
    </div>
@endsection