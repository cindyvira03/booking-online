<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display dashboard data as JSON.
     */
    public function index()
    {
        $totalCategories = Category::count();
        $totalItems = Item::count();
        $totalUsers = User::where('role', 'user')->count();

        return response()->json([
            'total_categories' => $totalCategories,
            'total_items' => $totalItems,
            'total_users' => $totalUsers,
        ]);

        return view('pages.admin.dashboard', [
            'totalCategories' => $totalCategories,
            'totalItems' => $totalItems,
            'totalUsers' => $totalUsers,
        ]);
    }
}
