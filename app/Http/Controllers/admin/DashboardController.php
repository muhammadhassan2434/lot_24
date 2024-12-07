<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Brand;



class DashboardController extends Controller
{
    public function index()
{
    // Fetch counts
    $totalUsers = User::count(); // Total users
    $totalSellers = Account::where('role', 'seller')->count(); // Total sellers
    $totalBuyer = Account::where('role', 'buyer')->count(); // Total countries
    $totalBrands = Brand::count(); // Total brands

    // Pass the data to the view
    return view('admin.index', compact('totalUsers', 'totalSellers', 'totalBuyer','totalBrands'));
}
}
