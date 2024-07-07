<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Models\Asset;
use App\Models\Allocation;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\CurrentInventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Image;
use Redirect;
use View;

/**
 * This controller handles all actions related to User Profiles for
 * the Snipe-IT Asset Management application.
 *
 * @version    v1.0
 */
class AllocationController extends Controller
{
    /**
     * Returns a view with the user's profile form for editing
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v1.0]
     * @return \Illuminate\Contracts\View\View
     */
    public function getIndex()
    {
        $user = Auth::user();

        return view('account/profile', compact('user'));
    }

    public function satker(Request $request)
    {
        $user = Auth::user();
        $query = Asset::select('assets.*', 'categories.name AS category_name')
            ->where('company_id', $user->company_id)
            // ->where('model_id', 1391)
            ->join('models AS category_models', function ($join) {
                    $join->on('category_models.id', '=', 'assets.model_id')
                        ->join('categories', function ($subjoin) {
                            $subjoin->on('categories.id', '=', 'category_models.category_id')
                                ->where('category_models.category_id', '=', 19);
                        });
                });

        // Apply search filter
        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q  ->where('name', 'like', "%{$search}%");
                    // ->where('category_name', 'like', "%{$search}%");
                //     ->orWhereHas('model.category', function ($q) use ($search) {
                //         $q->where('name', 'like', "%{$search}%");
                // });
            });
        }

        // Apply sorting if provided
        if ($request->has('sort') && $request->has('order')) {
            $sort = $request->input('sort');
            $order = $request->input('order');
            $query->orderBy($sort, $order);
        }

        // Paginate results
        $asset_satker = $query->paginate($request->input('limit', 10));

        return response()->json($asset_satker);
    }

    public function edit($asset_id) {
    // Your logic for editing the allocation
        // $user = Auth::user();

        // return view('account/profile', compact('user'));

        // Your logic for editing the allocation
        $allocation = Allocation::where('assets_id', $asset_id)->first();
        $assets = Asset::where('company_id', Auth::user()->company_id)
                ->where('id', $asset_id)
                ->first();

        $asset = $assets;
        
        if ($allocation->allocation_code == "2"){
            $asset = Allocation::where('assets_id', $asset_id)->first();
        } 
        else if ($allocation->allocation_code == "1"){
            $asset = $assets;
        }

        $asset_tag = $assets->asset_tag;

        // Pass the allocation data to the view
        return view('account/edit-allocation', compact('asset', 'asset_tag'));
    }

    public function destroy($asset_id) {
        // Your logic for deleting the allocation
        $allocation = Allocation::where('assets_id', $asset_id)->first();
        if ($allocation) {
            $allocation->delete();
        }
        return redirect()->back()->with('success', 'Pengajuan Alokasi Berhasil Dihapus!');
    }

    /**
     * Validates and stores the user's update data.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v1.0]
     * @return \Illuminate\Http\RedirectResponse
     */

    /**
     * Returns a page with the API token generation interface.
     *
     * We created a controller method for this because closures aren't allowed
     * in the routes file if you want to be able to cache the routes.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @return View
     */
    public function api()
    {

        // Make sure the self.api permission has been granted
        if (!Gate::allows('self.api')) {
            abort(403);
        }

        return view('account/api');
    }

}
