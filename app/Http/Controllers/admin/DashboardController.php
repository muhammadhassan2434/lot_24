<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $subscriptions = DB::table('accounts')
    ->join('subscriptions', 'accounts.subscription_id', '=', 'subscriptions.id') // Join with subscriptions table
    ->select(DB::raw('MONTH(accounts.created_at) as month'), 'accounts.subscription_id', DB::raw('count(*) as count'))
    ->groupBy(DB::raw('MONTH(accounts.created_at)'), 'accounts.subscription_id')
    ->orderBy(DB::raw('MONTH(accounts.created_at)'))
    ->get();

    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$premium = array_fill(0, 12, 0);
$standard = array_fill(0, 12, 0);

// You might need to know the subscription_ids for premium and standard subscriptions.
$premium_subscription_id = 1; // Example: 1 represents the premium subscription ID.
$standard_subscription_id = 2; // Example: 2 represents the standard subscription ID.

foreach ($subscriptions as $subscription) {
    $monthIndex = $subscription->month - 1; // Convert month to zero-indexed
    if ($subscription->subscription_id == $premium_subscription_id) {
        $premium[$monthIndex] = $subscription->count; // Count for premium subscription
    } elseif ($subscription->subscription_id == $standard_subscription_id) {
        $standard[$monthIndex] = $subscription->count; // Count for standard subscription
    }
}

    // Fetch counts
    $totalUsers = User::count(); // Total users
    $totalSellers = Account::where('role', 'seller')->count(); // Total sellers
    $totalBuyer = Account::where('role', 'buyer')->count(); // Total countries
    $totalBrands = Brand::count(); // Total brands

    // Pass the data to the view
    return view('admin.index', compact('totalUsers', 'totalSellers', 'totalBuyer','totalBrands','months', 'premium', 'standard'));
}
}
