<?php

namespace App\Http\Controllers\Approval;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Asset;
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
        // $this->authorize('index', Allocation::class);

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
                $os_output ='';
                $office_output ='';

                if ($allocation->os == 99){
                    $os_output = $allocation->os2;
                } else {
                    $os_output = $allocation->os;
                };
                if ($allocation->office == 99){
                    $office_output = $allocation->office2;
                } else {
                    $office_output = $allocation->office;
                };

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
                    'os' => $os_output,
                    'office' => $office_output,
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

            $asset = Asset::find($allocation->assets_id);

            // var_dump($asset);
            // die();

            // Update the related asset if needed
            if ($asset) {
                $asset->bmn = $allocation->bmn;
                $asset->serial = $allocation->serial;
                $asset->supporting_link = $allocation->supporting_link;
                $asset->assigned_type = $allocation->assigned_type;
                $asset->assigned_to = $allocation->user_id;
                $asset->_snipeit_sistem_operasi_2 = $allocation->os;
                $asset->_snipeit_software_office_1 = $allocation->office;
                $asset->_snipeit_antivirus_3 = $allocation->antivirus;

                // Update the notes column
                if (!empty($asset->notes)) {
                    $notesParts = explode(' - ', $asset->notes, 2);
                    $notesParts[0] = $allocation->kondisi;
                    $asset->notes = implode(' - ', $notesParts);
                } else {
                    $asset->notes = $allocation->kondisi;
                }

                $asset->save();
            }

            return redirect()->back()->with('success', $status == 'Sudah Disetujui' ? 'Setujui Pengajuan Berhasil!' : 'Tolak Pengajuan Berhasil!');
        } else {
            return redirect()->back()->with('error', 'Alokasi Tidak Ditemukan!');
        }
    }

    public function bulkUpdateStatus(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status');

        // Validate the input
        if (empty($ids) || !in_array($status, ['Sudah Disetujui', 'Tidak Disetujui'])) {
            return response()->json(['message' => 'Invalid input'], 400);
        }

        // Find and update allocations
        $allocations = Allocation::whereIn('id', $ids)->get();
        foreach ($allocations as $allocation) {
            $allocation->status = $status;
            $allocation->handling_date = now();
            $allocation->save();

            $asset = Asset::find($allocation->assets_id);

            // Update the related asset if needed
            if ($asset) {
                $asset->bmn = $allocation->bmn;
                $asset->serial = $allocation->serial;
                $asset->supporting_link = $allocation->supporting_link;
                $asset->assigned_type = $allocation->assigned_type;
                $asset->assigned_to = $allocation->user_id;
                $asset->_snipeit_sistem_operasi_2 = $allocation->os;
                $asset->_snipeit_software_office_1 = $allocation->office;
                $asset->_snipeit_antivirus_3 = $allocation->antivirus;

                // Update the notes column
                if (!empty($asset->notes)) {
                    $notesParts = explode(' - ', $asset->notes, 2);
                    $notesParts[0] = $allocation->kondisi;
                    $asset->notes = implode(' - ', $notesParts);
                } else {
                    $asset->notes = $allocation->kondisi;
                }

                $asset->save();
            }
        }

        return response()->json(['message' => $status == 'Sudah Disetujui' ? 'Setujui Pengajuan Berhasil!' : 'Tolak Pengajuan Berhasil!']);
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
                $os_output = '';
                $office_output = '';

                if ($allocation->os == 99) {
                    $os_output = $allocation->os2;
                } else {
                    $os_output = $allocation->os;
                };
                if ($allocation->office == 99) {
                    $office_output = $allocation->office2;
                } else {
                    $office_output = $allocation->office;
                };
                return [
                    'id' => $allocation->id,
                    'request_date' => $allocation->request_date,
                    'handling_date' => $allocation->handling_date,
                    'user_first_name' => $allocation->user_first_name,
                    'category' => $allocation->category_name,
                    'name' => $allocation->name,
                    'bmn' => $allocation->bmn,
                    'serial' => $allocation->serial,
                    'status' => $allocation->status,
                    'kondisi' => $allocation->kondisi,
                    'supporting_link' => $allocation->supporting_link,
                    'os' => $os_output,
                    'office' => $office_output,
                    'antivirus' => $allocation->antivirus,
                    // Add other fields as needed
                ];
            })
    ];

    return response()->json($data);
    }

}
