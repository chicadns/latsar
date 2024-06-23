<?php

namespace App\Http\Controllers\Consumables;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use App\Models\Company;
use App\Models\ConsumableTransaction;
use App\Models\Consumable;
use App\Models\ConsumableOnComp;
use App\Models\ConsumableDetails;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

/**
 * This controller handles all actions related to Consumables for
 * the Snipe-IT Asset Management application.
 *
 * @version    v1.0
 */
class ConsumablesTransactionController extends Controller
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
        $this->authorize('index', ConsumableTransaction::class);

        return view('consumablestransaction/index');
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
    public function create(ImageUploadRequest $request)
    {
        $transaction = $request->input('transaction_type');
        if ($transaction == 'pengeluaran') {
            $this->authorize('create', ConsumableTransaction::class);
        } else {
            $this->authorize('create', ConsumableDetails::class);
        }

        return view('consumablestransaction/edit')
            ->with('access_user', true)
            ->with('current_user', Auth::user())
            ->with('transaction', $transaction)
            ->with('item', new ConsumableTransaction)
            ->with('itemdetails', new ConsumableDetails);
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
        $this->authorize('create', ConsumableTransaction::class);
        $consumable = new ConsumableTransaction();
        $current_user = Auth::user();
        $groups = json_decode($current_user['groups'], true);

        $consumable->company_id             = $request->input('company_id_2');
        $consumable->company_user           = $request->input('company_user');
        $consumable->user_id                = Auth::id();
        $consumable->assigned_to            = $request->input('assigned_to');
        $consumable->purchase_date          = $request->input('purchase_date');
        $consumable->notes                  = $request->input('notes');
        $consumable->types                  = $request->input('types');
        $consumable->state                  = $request->input('state');
        $consumable->employee_num           = $request->input('nip');

        if ($consumable->types == 'Pemasukkan') {
            $consumable->employee_num = 0;
            $consumable->assigned_to = 0;
            $consumable->company_user = 0;
            if ($consumable->state == 'Disubmit') {
                $consumable->proceeded = 1;
            }
        }

        if ($consumable->save()) {
            $success = false;
            $names   = $request->input('names');

            for ($index = 0; $index < count($names); $index++) {
                $details = new ConsumableDetails();
                $details->transaction_id    = $consumable->id;
                $details->company_id        = $consumable->company_id;
                $details->consumable_id     = $request->input("names.$index");
                $details->category_id       = $request->input("categorys.$index");
                $details->purchase_cost     = $request->input("purchase_costs.$index");
                $details->qty               = $request->input("qtys.$index");
                $details->approve_qty       = $request->input("qtyapproves.$index");

                if ($details->save()){
                    $success = true;
                    $qty_update = ConsumableOnComp::where('id', $details->consumable_id)->first();
                    if ($consumable->state == "Disubmit" && $consumable->types == 'Pemasukkan') {
                        $qty_update->increment('qty', $details->qty);
                    }
                } else {
                    error_log("Error saving details");
                    return redirect()->back()->with('error', 'Terdapat input baris yang tidak terisi');
                }
            }
            if ($success){
                if (!$current_user->isSuperUser() && $groups[0]['name'] == 'Pengguna') {
                    return redirect()->route('view-assets')->with('success', trans('admin/consumables/message.create.success'));
                } else {
                    return redirect()->route('consumablestransaction.index')->with('success', trans('admin/consumables/message.create.success'));
                }
            }
        }

        return redirect()->back()->withErrors($consumable->getErrors());
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
        if (($item = ConsumableTransaction::find($consumableId)) && ($itemdetails = ConsumableDetails::where('transaction_id', $consumableId)->get())) {
            $this->authorize($item);
            $current_user = Auth::user();
            $groups = json_decode($current_user['groups'], true);
            
            if ($current_user->isSuperUser() || $groups[0]['name'] != 'Pengguna') {
                $item->employee_num = $current_user->nip_baru;
            }

            foreach ($itemdetails as $detail) {
                $detail->consumable_name = ConsumableOnComp::find($detail->consumable_id)->name;
                $detail->consumable_qty = ConsumableOnComp::find($detail->consumable_id)->qty;
                $detail->consumable_min = ConsumableOnComp::find($detail->consumable_id)->min_amt;
                $detail->category_name = Category::find($detail->category_id)->name;
            }
            
            $access_user = true;

            return view('consumablestransaction/edit', compact('item', 'itemdetails', 'current_user', 'access_user'));
        }

        if (!$current_user->isSuperUser() && $groups[0]['name'] == 'Pengguna') {
            return redirect()->route('view-assets')->with('error', trans('admin/consumables/message.does_not_exist'));
        } else {
            return redirect()->route('consumablestransaction.index')->with('error', trans('admin/consumables/message.does_not_exist'));
        }
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
        $consumable = ConsumableTransaction::find($consumableId);
        $change_qty = $consumable->state;
        $current_user = Auth::user();
        $groups = json_decode($current_user['groups'], true);
        
        if (is_null($consumable)) {
            if (!$current_user->isSuperUser() && $groups[0]['name'] == 'Pengguna') {
                return redirect()->route('view-assets')->with('error', trans('admin/consumables/message.does_not_exist'));
            } else {
                return redirect()->route('consumablestransaction.index')->with('error', trans('admin/consumables/message.does_not_exist'));
            }
        }
        
        $this->authorize($consumable);

        $consumable->company_id             = $request->input('company_id_2');
        $consumable->company_user           = $request->input('company_user');
        $consumable->assigned_to            = $request->input('assigned_to');
        $consumable->purchase_date          = $request->input('purchase_date');
        $consumable->notes                  = $request->input('notes');
        $consumable->types                  = $request->input('types');
        $consumable->state                  = $request->input('state');
        $consumable->employee_num           = $request->input('nip');

        if ($consumable->types == 'Pemasukkan') {
            $consumable->employee_num = 0;
            $consumable->assigned_to = 0;
            $consumable->company_user = 0;
            if ($consumable->state == 'Disubmit') {
                $consumable->proceeded = 1;
            } else if ($consumable->state == 'Entri Data') {
                $consumable->proceeded = 0;
            }
        } else if ($consumable->types == 'Pengeluaran') {
            if ($consumable->state == 'Disetujui') {
                $consumable->proceeded = 1;
            } else if ($consumable->state == 'Ditolak') {
                $consumable->proceeded = 0;
            }
        }

        if ($consumable->save()) {
            $successupdate = false;
            $names         = $request->input('names');
            $details       = ConsumableDetails::where('transaction_id', $consumableId)->get();

            if (count($names) > count($details)){
                $key = count($names);
            } else {
                $key = count($details);
            }

            for ($index = 0; $index < $key; $index++) {
                $detail                     = isset($details[$index]) ? $details[$index] : new ConsumableDetails;
                $detail->transaction_id     = $consumable->id;
                $detail->company_id         = $consumable->company_id;
                $detail->consumable_id      = $request->input("names.$index");
                $detail->category_id        = $request->input("categorys.$index");
                $detail->purchase_cost      = $request->input("purchase_costs.$index");
                $detail->qty                = $request->input("qtys.$index");
                $qty_current                = $detail->approve_qty;
                $detail->approve_qty        = $request->input("qtyapproves.$index");
                $deleteDetails              = $request->input("deleted_details.$index");
                $qty_update                 = ConsumableOnComp::where('id', $detail->consumable_id)->first();

                if ($deleteDetails !== null) {
                    ConsumableDetails::where('id', $deleteDetails)->delete();
                }

                if ($detail->save()){
                    $successupdate = true;
                    if ($consumable->state == "Disetujui" && $consumable->types == 'Pengeluaran' && ($change_qty == "Disubmit" || $change_qty == "Ditolak")) {
                        $qty_update->decrement('qty', $detail->approve_qty);
                    } else if ($consumable->state == "Disetujui" && $consumable->types == 'Pengeluaran' && $change_qty == "Disetujui") {
                        $qty_update->increment('qty', $qty_current);
                        $qty_update->decrement('qty', $detail->approve_qty);
                    }else if ($consumable->state == "Ditolak" && $consumable->types == 'Pengeluaran' && $change_qty == "Disetujui") {
                        $qty_update->increment('qty', $qty_current);
                    } else if ($consumable->state == "Disubmit" && $consumable->types == 'Pemasukkan') {
                        $qty_update->increment('qty', $detail->qty);
                    } else if ($consumable->state == "Entri Data" && $consumable->types == 'Pemasukkan') {
                        $qty_update->decrement('qty', $detail->qty);
                    }
                } else {
                    error_log("Error saving details");
                    return redirect()->back()->with('error', 'Terdapat input baris yang tidak terisi');
                }
            }
            if ($successupdate) {
                if (!$current_user->isSuperUser() && $groups[0]['name'] == 'Pengguna') {
                    return redirect()->route('view-assets')->with('success', trans('admin/consumables/message.update.success'));
                } else {
                    return redirect()->route('consumablestransaction.index')->with('success', trans('admin/consumables/message.update.success'));
                }
            }
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
        $current_user = Auth::user();
        $groups = json_decode($current_user['groups'], true);
        if (is_null($consumable = ConsumableTransaction::find($consumableId))) {
            if (!$current_user->isSuperUser() && $groups[0]['name'] == 'Pengguna') {
                return redirect()->route('view-assets')->with('error', trans('admin/consumables/message.not_found'));
            } else {
                return redirect()->route('consumablestransaction.index')->with('error', trans('admin/consumables/message.not_found'));
            }
        } else {
            // $this->authorize($consumable);
            $consumable->delete();
            ConsumableDetails::where('transaction_id', $consumableId)->delete();
            // Redirect to the locations management page
            if ($groupName == 'Pengguna') {
                return redirect()->route('view-assets')->with('success', trans('admin/consumables/message.delete.success'));
            } else {
                return redirect()->route('consumablestransaction.index')->with('success', trans('admin/consumables/message.delete.success'));
            }
        }
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
        $consumable = ConsumableTransaction::find($consumableId);
        $this->authorize($consumabletransaction);
        $current_user = Auth::user();
        $groups = json_decode($current_user['groups'], true);
        if (isset($consumabletransaction->id)) {
            return view('consumablestransaction/view', compact('consumable'));
        }

        if (!$current_user->isSuperUser() && $groups[0]['name'] == 'Pengguna') {
            return redirect()->route('view-assets')->with('error', trans('admin/consumables/message.does_not_exist'));
        } else {
            return redirect()->route('consumablestransaction.index')->with('error', trans('admin/consumables/message.does_not_exist'));
        }
    }

    public function getDataConsumables($consumableId = null)
    {
        if ($consumable = ConsumableOnComp::find($consumableId)) {
            $category = Category::find($consumable->category_id);
            $consumable['category_name'] = $category->name;
            return $consumable;
        }
    }
}
