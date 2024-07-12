<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Models\Asset;
use App\Models\User;


/**
 * This controller handles all actions related to the Admin Dashboard
 * for the Snipe-IT Asset Management application.
 *
 * @author A. Gianotto <snipe@snipe.net>
 * @version v1.0
 */
class OperatorController extends Controller
{
    /**
     * Check authorization and display admin dashboard, otherwise display
     * the user's checked-out assets.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v1.0]
     * @return View
     */

    public function index()
    {
        // Get the current authenticated user
        $user = Auth::user();

        // Fetch total number of users with allocated assets
        $totalUsers = User::where('company_id', $user->company_id)->count();

        $allocatedUsersCount = User::where('company_id', $user->company_id)
        ->whereHas('assets', function ($query) {
            $query->whereNotNull('assigned_to');
        })
            ->count();

        // Calculate number of users with not allocated assets
        $notAllocatedUsersCount = $totalUsers - $allocatedUsersCount;

        // Calculate percentages
        $percentageAllocatedUsers = ($allocatedUsersCount / $totalUsers) * 100;
        $percentageNotAllocatedUsers = 100 - $percentageAllocatedUsers;

        // Fetch total number of assets
        $totalAssets = Asset::where('company_id', $user->company_id)->count();

        // Fetch number of allocated assets
        $allocatedAssets = Asset::where('company_id', $user->company_id)
            ->whereNotNull('assigned_to')
            ->count();

        // Calculate number of not allocated assets
        $notAllocatedAssets = $totalAssets - $allocatedAssets;

        return view('operator', compact('totalUsers', 'allocatedUsersCount', 'notAllocatedUsersCount', 'totalAssets', 'allocatedAssets', 'notAllocatedAssets'));
    }
}