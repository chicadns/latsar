<?php

namespace App\Http\Middleware;

use App\Models\Asset;
use App\Models\License;
use Auth;
use Closure;

class AssetCountForSidebar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $total_rtd_sidebar = Asset::RTD()->count();
            view()->share('total_rtd_sidebar', $total_rtd_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_deployed_sidebar = Asset::Deployed()->count();
            view()->share('total_deployed_sidebar', $total_deployed_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_archived_sidebar = Asset::Archived()->count();
            view()->share('total_archived_sidebar', $total_archived_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_pending_sidebar = Asset::Pending()->count();
            view()->share('total_pending_sidebar', $total_pending_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_undeployable_sidebar = Asset::Undeployable()->count();
            view()->share('total_undeployable_sidebar', $total_undeployable_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_allocated_sidebar = Asset::Allocated()->count();
            view()->share('total_allocated_sidebar', $total_allocated_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_available_sidebar = Asset::Available()->count();
            view()->share('total_available_sidebar', $total_available_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_unavailable_sidebar = Asset::Unavailable()->count();
            view()->share('total_unavailable_sidebar', $total_unavailable_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }
        
        try {
            $total_repair_sidebar = Asset::Repair()->count();
            view()->share('total_repair_sidebar', $total_repair_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categoryti1_sidebar = Asset::CategoryTI1()->count();
            view()->share('total_categoryti1_sidebar', $total_categoryti1_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categoryti2_sidebar = License::CategoryTI2()->count();
            view()->share('total_categoryti2_sidebar', $total_categoryti2_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti1_sidebar = Asset::CategoryNonTI1()->count();
            view()->share('total_categorynonti1_sidebar', $total_categorynonti1_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti2_sidebar = Asset::CategoryNonTI2()->count();
            view()->share('total_categorynonti2_sidebar', $total_categorynonti2_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti3_sidebar = License::CategoryNonTI3()->count();
            view()->share('total_categorynonti3_sidebar', $total_categorynonti3_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti4_sidebar = Asset::CategoryNonTI4()->count();
            view()->share('total_categorynonti4_sidebar', $total_categorynonti4_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti5_sidebar = Asset::CategoryNonTI5()->count();
            view()->share('total_categorynonti5_sidebar', $total_categorynonti5_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti6_sidebar = Asset::CategoryNonTI6()->count();
            view()->share('total_categorynonti6_sidebar', $total_categorynonti6_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti7_sidebar = Asset::CategoryNonTI7()->count();
            view()->share('total_categorynonti7_sidebar', $total_categorynonti7_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti8_sidebar = Asset::CategoryNonTI8()->count();
            view()->share('total_categorynonti8_sidebar', $total_categorynonti8_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti9_sidebar = Asset::CategoryNonTI9()->count();
            view()->share('total_categorynonti9_sidebar', $total_categorynonti9_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        try {
            $total_categorynonti10_sidebar = Asset::CategoryNonTI10()->count();
            view()->share('total_categorynonti10_sidebar', $total_categorynonti10_sidebar);
        } catch (\Exception $e) {
            \Log::debug($e);
        }

        return $next($request);
    }
}
