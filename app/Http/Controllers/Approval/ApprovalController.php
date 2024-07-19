<?php

namespace App\Http\Controllers\Approval;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Asset;
use App\Models\Asset2;
use App\Models\Allocation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;
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

        $user = Auth::user();

        return view('approval/index');
    }

    public function getApprovalData()
    {
        // Fetch data from your model
        // $allocations = Allocation::all();

        $user = Auth::user();
        $allocations = Allocation::select('allocations.*', 'categories.name AS category_name', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS user_first_name"))
            ->where('allocations.company_id', $user->company_id)
            ->where('allocations.status', "Menunggu Persetujuan")
            ->join('categories', 'categories.id', '=', 'allocations.category_id')
            ->join('users', 'users.id', '=', 'allocations.user_id')
            ->get();

        if (Gate::allows('superadmin')) {
            $allocations = Allocation::select('allocations.*', 'categories.name AS category_name', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS user_first_name"))
                // ->where('allocations.company_id', $user->comppany_id)
                ->where('allocations.status', "Menunggu Persetujuan")
                ->join('categories', 'categories.id', '=', 'allocations.category_id')
                ->join('users', 'users.id', '=', 'allocations.user_id')
                ->get();
        }

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
        $user = Auth::user();

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
            // Check if the status is 'Sudah Disetujui'
            if ($status == 'Sudah Disetujui') {
                // Find the asset related to the allocation
                $asset = Asset2::find($allocation->assets_id);
                if ($asset) {
                    // Check if the current user is assigned to the asset or if it's unassigned
                    if ($asset->assigned_to == $allocation->user_id || $asset->assigned_to == null) {
                        // Proceed with the update
                        $allocation->status = $status;
                        $allocation->handling_date = now();
                        $allocation->handling_user_id = $user->id;
                        $allocation->save();

                        // Update the related asset
                        $asset->bmn = $allocation->bmn;
                        $asset->serial = $allocation->serial;
                        $asset->company_id = $allocation->company_id;
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

                        return redirect()->back()->with('success', 'Setujui Pengajuan Berhasil!');
                    } else {
                        // Alert that the asset is already assigned to another user
                        $assignedUser = $asset->assigned_to;
                        $alertMessage = 'Asset ini sudah dialokasikan pada user ' . $assignedUser . '. Jika Anda ingin mengubah pengguna yang menguasai perangkat, harap dealokasi pada Halaman Daftar Perangkat IT.';
                        echo "<script>alert('{$alertMessage}'); window.history.back();</script>";
                    }
                } else {
                    return redirect()->back()->with('error', 'Aset Tidak Ditemukan!');
                }
            } else {
                // If status is 'Tidak Disetujui', update only the allocation status
                $allocation->status = $status;
                $allocation->handling_date = now();
                $allocation->handling_user_id = $user->id;
                $allocation->save();

                return redirect()->back()->with('success', 'Tolak Pengajuan Berhasil!');
            }
        } else {
            return redirect()->back()->with('error', 'Alokasi Tidak Ditemukan!');
        }
    }


    public function bulkUpdateStatus(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status');
        $user = Auth::user();

        // Validate the input
        if (empty($ids) || !in_array($status, ['Sudah Disetujui', 'Tidak Disetujui'])) {
            return response()->json(['message' => 'Invalid input'], 400);
        }

        // Initialize counters
        $updatedCount = 0;
        $skippedCount = 0;

        // Find and update allocations
        $allocations = Allocation::whereIn('id', $ids)->get();
        foreach ($allocations as $allocation) {
            if ($status == 'Sudah Disetujui') {
                // Find the asset related to the allocation
                $asset = Asset2::find($allocation->assets_id);
                if ($asset) {
                    // Check if the current user is assigned to the asset or if it's unassigned
                    if ($asset->assigned_to == $allocation->user_id || $asset->assigned_to == null) {
                        // Proceed with the update
                        $allocation->status = $status;
                        $allocation->handling_date = now();
                        $allocation->handling_user_id = $user->id;
                        $allocation->save();

                        // Update the related asset
                        $asset->bmn = $allocation->bmn;
                        $asset->serial = $allocation->serial;
                        $asset->company_id = $allocation->company_id;
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

                        // Increment updated count
                        $updatedCount++;
                    } else {
                        // Increment skipped count
                        $skippedCount++;
                        continue;
                    }
                } else {
                    // Increment skipped count
                    $skippedCount++;
                    continue;
                }
            } else {
                // If status is 'Tidak Disetujui', update only the allocation status
                $allocation->status = $status;
                $allocation->handling_date = now();
                $allocation->handling_user_id = $user->id;
                $allocation->save();

                // Increment updated count
                $updatedCount++;
            }
        }

        // Prepare success message with updated and skipped counts
        $successMessage = $status == 'Sudah Disetujui' ? 'Status Setujui Pengajuan -> ' : 'Status Tolak Pengajuan -> ';
        $successMessage .= "Diperbarui: $updatedCount, Tidak Diperbarui: $skippedCount";

        return response()->json(['message' => $successMessage]);
    }




    public function getAllData()
    {
        // Fetch data from your model
        // $allocations = Allocation::all();

        $user = Auth::user();

        $allocations = Allocation::withTrashed()
            ->select('allocations.*', 'categories.name AS category_name', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS user_first_name"))
            ->where('allocations.company_id', $user->company_id)
            ->join('categories', 'categories.id', '=', 'allocations.category_id')
            ->join('users', 'users.id', '=', 'allocations.user_id')
            ->get();
        
        if (Gate::allows('superadmin')) {
            $allocations = Allocation::withTrashed()
                ->select('allocations.*', 'categories.name AS category_name', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS user_first_name"))
                // ->where('allocations.company_id', $user->company_id)
                ->join('categories', 'categories.id', '=', 'allocations.category_id')
                ->join('users', 'users.id', '=', 'allocations.user_id')
                ->get();
        }


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


    public function index2(Request $request)
    {
        $user = Auth::user();
        $limit = $request->get('limit', 10); // Number of records per page
        $offset = $request->get('offset', 0); // Starting position of records
        $search = $request->get('search', ''); // Search keyword
        $sort = $request->get('sort', 'id'); // Sort column
        $order = $request->get('order', 'asc'); // Sort order

        $query = Asset2::select('assets.*', 'categories.name AS category_name')
            // ->where('assets.company_id', $user->company_id)
            ->join('models AS category_models', function ($join) {
                $join->on('category_models.id', '=', 'assets.model_id')
                    ->join('categories', function ($subjoin) {
                        $subjoin->on('categories.id', '=', 'category_models.category_id')
                            ->whereIn('category_models.category_id', [3, 19, 20, 5, 8, 21, 27, 34, 85]);
                    });
            })
            // ->whereNull('assets.assigned_to')
            ->join('status_labels AS status_alias', function ($join) {
                $join->on('status_alias.id', '=', 'assets.status_id')
                    ->where('status_alias.deployable', '=', 1)
                    ->where('status_alias.pending', '=', 0)
                    ->where('status_alias.archived', '=', 0);
            })
            ->where('assets.non_it_stuff', '=', 0);

        if (in_array($user->company_id, range(1, 4)) || in_array($user->company_id, range(8, 25))) {
            $query->where('company_id', 5);
        } else {
            $query->where('company_id', $user->company_id);
        }

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
}
