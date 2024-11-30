<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
    $totalSellers = User::where('role', 'seller')->count(); // Total sellers
    $totalCountries = Country::count(); // Total countries
    $totalBrands = Brand::count(); // Total brands

    // Pass the data to the view
    return view('admin.index', compact('totalUsers', 'totalSellers', 'totalCountries','totalBrands'));
}
}
