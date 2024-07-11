<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Models\Asset;
use App\Models\Allocation;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\CurrentInventory;
use App\Presenters\AllocationPresenter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        return view('account/view-assets#asset', compact('user'));
    }

    public function satker(Request $request)
    {
        $user = Auth::user();
        $limit = $request->get('limit', 10); // Number of records per page
        $offset = $request->get('offset', 0); // Starting position of records
        $search = $request->get('search', ''); // Search keyword
        $sort = $request->get('sort', 'id'); // Sort column
        $order = $request->get('order', 'asc'); // Sort order

        $query = Asset::select('assets.*', 'categories.name AS category_name')
            ->where('company_id', $user->company_id)
            ->join('models AS category_models', function ($join) {
                $join->on('category_models.id', '=', 'assets.model_id')
                    ->join('categories', function ($subjoin) {
                        $subjoin->on('categories.id', '=', 'category_models.category_id')
                            ->whereIn('category_models.category_id', [3, 19, 20, 5, 8, 21, 27, 34, 85]);
                    });
            })
            ->whereNull('assets.assigned_to')
            ->join('status_labels AS status_alias', function ($join) {
                $join->on('status_alias.id', '=', 'assets.status_id')
                    ->where('status_alias.deployable', '=', 1)
                    ->where('status_alias.pending', '=', 0)
                    ->where('status_alias.archived', '=', 0);
            })
            ->where('assets.non_it_stuff', '=', 0);
        // ->whereNotIn('assets.id', function ($subquery) use ($user) {
        //     $subquery->select('allocations.assets_id')
        //     ->from('allocations')
        //     ->where('allocations.user_id', '=', $user->id)
        //     ->whereIn('allocations.status', ['Belum Dikirim', 'Menunggu Persetujuan']);
        // });

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('assets.name', 'like', '%' . $search . '%')
                    ->orWhere('categories.name', 'like', '%' . $search . '%')
                    ->orWhere('assets.bmn', 'like', '%' . $search . '%')
                    ->orWhere('assets.serial', 'like', '%' . $search . '%');
            });
        }

        $total = $query->count();

        $assets = $query->orderBy($sort, $order)
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json([
            'total' => $total,
            'data' => $assets
        ]);
    }

    public function storeAllocations(Request $request)
    {
        $user = Auth::user();
        $selectedIds = json_decode($request->input('selected_ids'), true);

        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'No assets selected');
        }

        $assets = Asset::whereIn('id', $selectedIds)->get();

        Log::info('Assets found: ', $assets->toArray());

        foreach ($assets as $asset) {
            // print_r($asset->model);
            // die();
            $allocated = Allocation::firstOrCreate([
                'user_id' => $user->id,
                'assets_id' => $asset->id,
            ], [
                'company_id' => $asset->company_id,
                'user_id' => $user->id,
                'assigned_type' => 'App\Models\User',
                'assets_id' => $asset->id,
                'category_id' => $asset->model->category_id,
                'name' => $asset->name,
                'bmn' => $asset->bmn,
                'serial' => $asset->serial,
                'kondisi' => 'some_default_value',
                'os' => $asset->_snipeit_sistem_operasi_2,
                'office' => $asset->_snipeit_software_office_1,
                'antivirus' => $asset->_snipeit_antivirus_3,
                'status' => 'Belum Dikirim',
                'request_date' => now(),
                'allocation_code' => '1'
            ]);
            // var_dump($asset->id);
            // var_dump($user->id);
            // var_dump($allocated->wasRecentlyCreated);
            // die();

            // if(!$allocated){
            //     App::abort(500, 'Error');
            // } else{
            //     error_log('Berhasil saving Chica!!!.');
            // }
        }

        $ballon = $allocated->wasRecentlyCreated ? ['success', 'Perangkat IT Berhasil Ditambahkan!'] : ['error', 'Perangkat IT Sudah Anda Tambahkan...'];

        return redirect()->route('allocations.index')->with($ballon[0], $ballon[1]);
    }

    public function viewAllocations()
    {
        $user = Auth::user();
        $userAssets = $user->assets;

        $allocations = Allocation::select('allocations.*', 'categories.name AS category_name', 'users.first_name AS user_first_name')
            ->where('allocations.user_id', $user->id)
            ->where('allocations.deleted_at', NULL)
            ->join('categories', 'categories.id', '=', 'allocations.category_id')
            ->join('users', 'users.id', '=', 'allocations.user_id')
            ->get();

        // Create a collection to hold the final data
        $finalData = collect();

        // Add user assets to the final data with the status "Sudah Disetujui"
        foreach ($userAssets as $asset) {
            // Fetch asset from the database based on $asset->id
            $assetData = Asset::find($asset->id); // Replace 'Asset' with your actual Eloquent model name for assets

            if ($assetData) {
                // Add additional fields to $assetData
                $assetData->status = 'Sudah Disetujui'; // Add 'status' field

                // Assuming relationships exist properly, add 'category_name' field
                if ($assetData->model && $assetData->model->category) {
                    $assetData->category_name = $assetData->model->category->name;
                } else {
                    $assetData->category_name = null; // Handle if category name is not available
                }

                $finalData->push($assetData); // Push the enhanced asset data into $finalData collection
            }
        }

        // Add allocations to the final data
        foreach ($allocations as $allocation) {
            $existingAsset = $finalData->firstWhere('asset_id', $allocation->assets_id);

            if ($existingAsset) {
                if ($existingAsset['status'] === 'Sudah Disetujui') {
                    continue;
                }
            }

            $finalData->push([
                'id' => $allocation->id,
                'name' => $allocation->name,
                'category_name' => $allocation->category_name,
                'status' => $allocation->status,
                'source' => 'allocation',
                'request_date' => $allocation->request_date,
                'user_first_name' => $allocation->user_first_name,
                'bmn' => $allocation->bmn,
                'serial' => $allocation->serial,
                'kondisi' => $allocation->kondisi,
                'os' => $allocation->os,
                'os2' => $allocation->os2,
                'office' => $allocation->office,
                'office2' => $allocation->office2,
                'antivirus' => $allocation->antivirus,
                'assets_id' => $allocation->assets_id
            ]);
        }

        // Remove duplicates and ensure correct data
        $finalData = $finalData->unique('id');

        // Format data for the data-table
        $data = [
            'total' => $finalData->count(),
            'rows' => $finalData->map(function ($item) {
                $isComplete = $item['bmn'] && $item['serial'] && $item['kondisi'] && $item['os'] && $item['office'];

                return [
                    'id' => $item['id'],
                    'request_date' => $item['request_date'],
                    'user_first_name' => $item['user_first_name'],
                    'category' => $item['category_name'],
                    'name' => $item['name'],
                    'bmn' => $item['bmn'],
                    'serial' => $item['serial'],
                    'status' => $item['status'],
                    'asset_id' => $item['assets_id'],
                    'kondisi' => $item['kondisi'],
                    'os' => $item['os'],
                    'os2' => $item['os2'],
                    'office' => $item['office'],
                    'office2' => $item['office2'],
                    'antivirus' => $item['antivirus'],
                    'icon' => $isComplete ?
                        '<i class="fa fa-check-circle" style="color: green;" title="Data Sudah Lengkap."></i>' :
                        '<i class="fa fa-warning" style="color: orange;" title="Data Belum Lengkap!"></i>',
                    'complete_status' => $isComplete ? 1 : 0,
                    // Add other fields as needed
                ];
            })
        ];

        return response()->json($data);
    }

    public function edit($id, $assets_id)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Find the allocation that matches the given id and belongs to the authenticated user
        $allocation = Allocation::where('assets_id', $assets_id)
            ->where('user_id', $user->id)
            ->where('status', "Belum Dikirim")
            ->first();

        // Find the asset that matches the given assets_id and belongs to the same company as the authenticated user
        $assets = Asset::where('company_id', $user->company_id)
            ->where('id', $assets_id)
            ->first();

        $allocation_id = null; // Initialize allocation_id

        if ($allocation) {
            if ($allocation->allocation_code == "2") {
                $data = $allocation;
            } else {
                $data = $assets;
            }
            $allocation_id = $allocation->id;
        }

        // Retrieve the asset tag from the assets
        $asset = $data;
        $asset_tag = $assets->asset_tag;

        // Debugging output to check the value of $allocation_id
        // var_dump($allocation_id); die();

        // Pass the allocation data to the view
        return view('account/edit-allocation', compact('asset', 'asset_tag', 'allocation_id'));
    }



    public function destroy($allocation_id)
    {
        // Your logic for deleting the allocation
        $allocation = Allocation::where('id', $allocation_id)->first();
        if ($allocation) {
            $allocation->delete();
        }
        return redirect()->route('allocations.index')->with('success', 'Pengajuan Alokasi Berhasil Dihapus!');
    }

    public function submit($allocation_id)
    {
        try {
            $allocation = Allocation::findOrFail($allocation_id);
            $allocation->status = 'Menunggu Persetujuan';
            $allocation->save();

            return redirect()->route('allocations.index')->with('success', 'Pengajuan Berhasil Dikirim!');
        } catch (\Exception $e) {
            Log::error('Error updating allocation: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengirim pengajuan. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $allocation_id)
    {
        // Validate incoming requests
        $validatedData = $request->validate([
            'bmn' => 'required|string|max:255',
            'serial' => 'required|string|max:255',
            'kondisi' => 'required|string',
            'supporting_link' => 'nullable|url',
            'os' => 'required|string|max:255',
            'os2' => 'nullable|string|max:255',
            'office' => 'required|string|max:255',
            'office2' => 'nullable|string|max:255',
            'antivirus' => 'nullable|string|max:255',
        ]);

        try {
            $allocation = Allocation::findOrFail($allocation_id);
            // Update allocation with validated data
            $allocation->bmn = $validatedData['bmn'];
            $allocation->serial = $validatedData['serial'];
            $allocation->kondisi = $validatedData['kondisi'];
            $allocation->supporting_link = $validatedData['supporting_link'];
            $allocation->os = $validatedData['os'];
            $allocation->os2 = $validatedData['os2'];
            $allocation->office = $validatedData['office'];
            $allocation->office2 = $validatedData['office2'];
            $allocation->antivirus = $validatedData['antivirus'];
            $allocation->allocation_code = 2;
            $allocation->status = "Belum Dikirim";
            // Save changes
            $allocation->save();

            // Redirect back with success message
            return redirect()->route('allocations.index')->with('success', 'Perangkat IT Berhasil di-update!');
        } catch (\Exception $e) {
            Log::error('Error updating allocation: ' . $e->getMessage());
            return redirect()->route('allocations.index')->with('error', 'Gagal update informasi perangkat. Silakan coba lagi.');
        }
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
