<?php

namespace App\Http\Controllers\Approval;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Consumable;
use App\Models\Allocation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

/**
 * This controller handles all actions related to Consumables for
 * the Snipe-IT Asset Management application.
 *
 * @version    v1.0
 */
class ApprovalController extends Controller
{
    /**
     * Return a view to display component information.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @see ConsumablesController::getDatatable() method that generates the JSON response
     * @since [v1.0]
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('index', Consumable::class);

        return view('approval/index');
    }

    public function getApprovalData()
    {
        // Fetch data from your model
        // $allocations = Allocation::all();

        $user = Auth::user();
        $allocations = Allocation::select('allocations.*', 'categories.name AS category_name', 'users.first_name AS user_first_name')
                    ->where('allocations.company_id', $user->company_id)
                    ->where('allocations.status', "Menunggu Persetujuan")
                    ->join('categories', 'categories.id', '=', 'allocations.category_id')
                    ->join('users', 'users.id', '=', 'allocations.user_id')
                    ->get();

        // Format data for the data-table
        $data = [
            'total' => $allocations->count(),
            'rows' => $allocations->map(function ($allocation) {
                return [
                    'id' => $allocation->id,
                    'request_date' => $allocation->request_date,
                    'user_first_name' => $allocation->user_first_name,
                    'category' => $allocation->category_name,
                    'name' => $allocation->name,
                    'bmn' => $allocation->bmn,
                    'serial' => $allocation->serial,
                    'status' => $allocation->status,
                    'kondisi' => $allocation->kondisi,
                    'supporting_link' => $allocation->supporting_link,
                    'os' => $allocation->os,
                    'office' => $allocation->office,
                    'antivirus' => $allocation->antivirus,
                    // Add other fields as needed
                ];
            })
    ];

    return response()->json($data);
    }

    public function updateStatus(Request $request)
    {
        // Check if 'setuju' or 'tidak_setuju' is present in the request
        if ($request->has('setuju')) {
            $id = $request->input('setuju');
            $status = 'Sudah Disetujui';
        } elseif ($request->has('tidak_setuju')) {
            $id = $request->input('tidak_setuju');
            $status = 'Tidak Disetujui';
        } else {
            return redirect()->back()->with('error', 'Invalid request');
        }

        // Find the allocation by id and update its status
        $allocation = Allocation::find($id);
        if ($allocation) {
            $allocation->status = $status;
            $allocation->handling_date = now();
            $allocation->save();

            return redirect()->back()->with('success', $status == 'Sudah Disetujui' ? 'Setujui Pengajuan Berhasil!' : 'Tidaksetujui Pengajuan Berhasil!');
        } else {
            return redirect()->back()->with('error', 'Alokasi Tidak Ditemukan!');
        }
    }

    
    public function getAllData()
    {
        // Fetch data from your model
        // $allocations = Allocation::all();

        $user = Auth::user();
        $allocations = Allocation::select('allocations.*', 'categories.name AS category_name', 'users.first_name AS user_first_name')
                    ->where('allocations.company_id', $user->company_id)
                    ->join('categories', 'categories.id', '=', 'allocations.category_id')
                    ->join('users', 'users.id', '=', 'allocations.user_id')
                    ->get();

        // Format data for the data-table
        $data = [
            'total' => $allocations->count(),
            'rows' => $allocations->map(function ($allocation) {
                return [
                    'id' => $allocation->id,
                    'request_date' => $allocation->request_date,
                    'user_first_name' => $allocation->user_first_name,
                    'category' => $allocation->category_name,
                    'name' => $allocation->name,
                    'bmn' => $allocation->bmn,
                    'serial' => $allocation->serial,
                    'status' => $allocation->status,
                    'kondisi' => $allocation->kondisi,
                    'supporting_link' => $allocation->supporting_link,
                    'os' => $allocation->os,
                    'office' => $allocation->office,
                    'antivirus' => $allocation->antivirus,
                    // Add other fields as needed
                ];
            })
    ];

    return response()->json($data);
    }

}
