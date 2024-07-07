<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Transformers\ApprovalTransformer;
use App\Http\Transformers\SelectlistTransformer;
use App\Models\Company;
use App\Models\Asset;
use App\Models\Category;
use App\Models\ConsumableTransaction;
use App\Models\ConsumableDetails;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;

use Illuminate\Support\Facades\Auth;

class AllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     *
     * @return \Illuminate\Http\Response
     */
    public function satker(Request $request)
    {
        // This array is what determines which fields should be allowed to be sorted on ON the table itself, no relations
        // Relations will be handled in query scopes a little further down.
        $allowed_columns = 
            [
            'no',
            'request_date',
            'user_first_name',
            'category',
            'name',
            'bmn',
            'serial',
            'status',
            ];

        // Initial query with necessary joins and eager loading
        $user = User::with(
            'assets',
            'assets.model',
            'assets.model.fieldset.fields',
            'assets_non_it',
            'assets_non_it.model',
            'assets_non_it.model.fieldset.fields',
            'consumables',
            'accessories',
            'licenses',
        )->find(Auth::user()->id);
        
        $asset_satker = Asset::where('company_id', Auth::user()->company_id)->get();

        // if ($request->filled('search')) {
        //     $allocations = $allocations->TextSearch(e($request->input('search')));
        // }

        // if ($request->filled('name')) {
        //     $allocations->where('allocations.name', '=', $request->input('name'));
        // }

        // if ($request->filled('category_id')) {
        //     $allocations->where('allocations.category_id', '=', $request->input('category_id'));
        // }

        // if ($request->filled('serial')) {
        //     $allocations->where('allocations.serial', '=', $request->input('serial'));
        // }

        // Ensure the offset and limit are actually integers and do not exceed system limits
        $offset = ($request->input('offset') > $asset_satker->count()) ? $asset_satker->count() : app('api_offset_value');
        $limit = app('api_limit_value');

        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';
        $sort_override = $request->input('sort');
        $column_sort = in_array($sort_override, $allowed_columns) ? $sort_override : 'created_at';

        switch ($sort_override) {
            case 'category':
                $asset_satker = $asset_satker->orderBy('categories.name', $order);
                break;
            case 'user_first_name':
                $asset_satker = $asset_satker->orderBy('users.first_name', $order);
                break;
            default:
                $asset_satker = $asset_satker->orderBy($column_sort, $order);
                break;
        }

        // Pagination
        $total = $asset_satker->count();
        $allocations = $asset_satker->skip($offset)->take($limit)->get();

        return (new ApprovalTransformer)->transformAllocations($allocations, $total);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @param  \App\Http\Requests\ImageUploadRequest $request
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $allocation = Allocation::with(['user', 'asset.model.category'])->findOrFail($id);
        return response()->json($allocation);
    }

    public function approve($id)
    {
        $allocation = Allocation::findOrFail($id);
        $allocation->status = 'Sudah Disetujui';
        $allocation->save();

        return response()->json(['success' => true]);
    }

    public function decline($id)
    {
        $allocation = Allocation::findOrFail($id);
        $allocation->status = 'Tidak Disetujui';
        $allocation->save();

        return response()->json(['success' => true]);
    }
}
