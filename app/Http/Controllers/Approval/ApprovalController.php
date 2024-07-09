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
        // $this->authorize('index', [Allocation::class, User::class]);
        
        // $user = User::with(
        //     'assets',
        //     'assets.model',
        //     'assets.model.fieldset.fields',
        //     'assets_non_it',
        //     'assets_non_it.model',
        //     'assets_non_it.model.fieldset.fields',
        //     'consumables',
        //     'accessories',
        //     'licenses',
        // )->find(Auth::user()->id);

        // $allocations = Allocation::where('company_id', Auth::user()->company_id)->get();

        // echo($allocations);

        // return view('approval/index', compact('allocations'));

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
                    // Add other fields as needed
                ];
            })
    ];

    return response()->json($data);
    }

    /**
     * Return a view to display the form view to create a new consumable
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @see ConsumablesController::postCreate() method that stores the form data
     * @since [v1.0]
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Consumable::class);

        return view('consumables/edit')->with('category_type', 'consumable')
            ->with('item', new Consumable);
    }

    /**
     * Validate and store new consumable data.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @see ConsumablesController::getCreate() method that returns the form view
     * @since [v1.0]
     * @param ImageUploadRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ImageUploadRequest $request)
    {
        $this->authorize('create', Consumable::class);
        $consumable = new Consumable();
        $consumable->name                   = $request->input('name');
        $consumable->category_id            = $request->input('category_id');
        $consumable->location_id            = $request->input('location_id');
        $consumable->company_id             = Company::getIdForCurrentUser($request->input('company_id'));
        $consumable->order_number           = $request->input('order_number');
        $consumable->min_amt                = 0;
        $consumable->manufacturer_id        = $request->input('manufacturer_id');
        $consumable->model_number           = $request->input('model_number');
        $consumable->item_no                = $request->input('item_no');
        $consumable->purchase_date          = $request->input('purchase_date');
        $consumable->purchase_cost          = Helper::ParseCurrency($request->input('purchase_cost'));
        $consumable->qty                    = 0;
        $consumable->user_id                = Auth::id();
        $consumable->notes                  = $request->input('notes');


        $consumable = $request->handleImages($consumable);

        if ($consumable->save()) {
            return redirect()->route('consumables.index')->with('success', trans('admin/consumables/message.create.success'));
        }

        return redirect()->back()->withInput()->withErrors($consumable->getErrors());
    }

    /**
     * Returns a form view to edit a consumable.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param  int $consumableId
     * @see ConsumablesController::postEdit() method that stores the form data.
     * @since [v1.0]
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($consumableId = null)
    {
        if ($item = Consumable::find($consumableId)) {
            $this->authorize($item);

            return view('consumables/edit', compact('item'))->with('category_type', 'consumable');
        }

        return redirect()->route('consumables.index')->with('error', trans('admin/consumables/message.does_not_exist'));
    }

    /**
     * Returns a form view to edit a consumable.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param ImageUploadRequest $request
     * @param  int $consumableId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @see ConsumablesController::getEdit() method that stores the form data.
     * @since [v1.0]
     */
    public function update(ImageUploadRequest $request, $consumableId = null)
    {
        if (is_null($consumable = Consumable::find($consumableId))) {
            return redirect()->route('consumables.index')->with('error', trans('admin/consumables/message.does_not_exist'));
        }

        // $min = $consumable->numCheckedOut();
        // $validator = Validator::make($request->all(), [
        //     "qty" => "required|numeric|min:$min"
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $this->authorize($consumable);

        $consumable->name                   = $request->input('name');
        $consumable->category_id            = $request->input('category_id');
        $consumable->location_id            = $request->input('location_id');
        $consumable->company_id             = Company::getIdForCurrentUser($request->input('company_id'));
        $consumable->order_number           = $request->input('order_number');
        // $consumable->min_amt                = $request->input('min_amt');
        $consumable->manufacturer_id        = $request->input('manufacturer_id');
        $consumable->model_number           = $request->input('model_number');
        $consumable->item_no                = $request->input('item_no');
        $consumable->purchase_date          = $request->input('purchase_date');
        $consumable->purchase_cost          = Helper::ParseCurrency($request->input('purchase_cost'));
        // $consumable->qty                    = Helper::ParseFloat($request->input('qty'));
        $consumable->notes                  = $request->input('notes');

        $consumable = $request->handleImages($consumable);

        if ($consumable->save()) {
            return redirect()->route('consumables.index')->with('success', trans('admin/consumables/message.update.success'));
        }

        return redirect()->back()->withInput()->withErrors($consumable->getErrors());
    }

    /**
     * Delete a consumable.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param  int $consumableId
     * @since [v1.0]
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($consumableId)
    {
        if (is_null($consumable = Consumable::find($consumableId))) {
            return redirect()->route('consumables.index')->with('error', trans('admin/consumables/message.not_found'));
        }
        $this->authorize($consumable);
        $consumable->delete();
        // Redirect to the locations management page
        return redirect()->route('consumables.index')->with('success', trans('admin/consumables/message.delete.success'));
    }

    /**
     * Return a view to display component information.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @see ConsumablesController::getDataView() method that generates the JSON response
     * @since [v1.0]
     * @param int $consumableId
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($consumableId = null)
    {
        $consumable = Consumable::find($consumableId);
        $this->authorize($consumable);
        if (isset($consumable->id)) {
            return view('consumables/view', compact('consumable'));
        }

        return redirect()->route('consumables.index')
            ->with('error', trans('admin/consumables/message.does_not_exist'));
    }
}
