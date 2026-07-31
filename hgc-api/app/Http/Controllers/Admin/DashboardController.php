<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $companiesCount = DB::table('companies')
            ->where('is_active', 1)
            ->whereNull('deleted_at')
            ->count();

        $productsCount = DB::table('products')
            ->where('is_active', 1)
            ->count();

        $projectsCount = DB::table('projects')
            ->where('is_active', 1)
            ->count();

        $contactMessagesCount = DB::table('contact_submissions')->count();

        $unreadContacts = DB::table('contact_submissions')
            ->where('status', 'new')
            ->count();

        return view('admin.dashboard', compact(
            'companiesCount',
            'productsCount',
            'projectsCount',
            'contactMessagesCount',
            'unreadContacts'
        ));
    }
}