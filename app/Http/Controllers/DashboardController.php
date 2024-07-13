<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

use App\Models\User;
use App\Models\Asset;

/**
 * This controller handles all actions related to the Admin Dashboard
 * for the Snipe-IT Asset Management application.
 *
 * @author A. Gianotto <snipe@snipe.net>
 * @version v1.0
 */
class DashboardController extends Controller
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
        // Show the page
        $user = Auth::user();

        if (Auth::user()->hasAccess('admin') && (!($user->groups->contains('id', 5)))) {
            $asset_stats = null;

            $counts['asset'] = \App\Models\Asset::count();
            $counts['accessory'] = (\App\Models\Asset::CategoryNonTISum()->count()) + (\App\Models\License::CategoryNonTI3()->count());
            $counts['license'] = (\App\Models\License::count()) - (\App\Models\License::CategoryNonTI3()->count());
            $counts['consumable'] = \App\Models\Consumable::count();
            $counts['component'] = \App\Models\Component::count();
            $counts['user'] = \App\Models\Company::scopeCompanyables(Auth::user())->count();
            $counts['grand_total'] = $counts['asset'] + $counts['accessory'] + $counts['license'] + $counts['consumable'];

            if ((! file_exists(storage_path().'/oauth-private.key')) || (! file_exists(storage_path().'/oauth-public.key'))) {
                Artisan::call('migrate', ['--force' => true]);
                Artisan::call('passport:install');
            }

            return view('dashboard')->with('asset_stats', $asset_stats)->with('counts', $counts);
        } else if ($user->groups->contains('id', 5)) {
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
        else {
            // Redirect to the profile page
            return redirect()->intended('account/view-assets');
        }
    }

}
