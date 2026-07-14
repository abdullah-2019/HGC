@extends('admin.layouts.app')

@section('title', 'Companies')
@section('page-title', 'Companies')

@section('content')
    <x-admin.page-header 
        title="Companies" 
        subtitle="Manage your group companies"
        :create-route="route('admin.companies.create')"
        create-label="Add Company"
    />

    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
        <x-admin.data-table 
            :headers="['Logo', 'Name', 'Short Name', 'Sector', 'Status', 'Order']"
            :items="$companies"
            :columns="['logo_url', 'name_en', 'short_name_en', 'sector_en', 'is_active', 'sort_order']"
            edit-route="admin.companies.edit"
            delete-route="admin.companies.destroy"
        />
    </div>
@endsection