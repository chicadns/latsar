<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Transformers\ConsumablesDetailsTransformer;
use App\Http\Transformers\SelectlistTransformer;
use App\Models\Company;
use App\Models\ConsumableDetails;
use App\Models\Consumable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;

class ConsumablesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', ConsumableDetails::class);

        // This array is what determines which fields should be allowed to be sorted on ON the table itself, no relations
        // Relations will be handled in query scopes a little further down.
        $allowed_columns = 
            [
                'id',
                'name',
                'purchase_date',
                'purchase_cost',
                'company',
                'category',
                'qty',
                ];


        $consumables = Company::scopeCompanyables(
            ConsumableDetails::select('consumables_details.*')
                ->with('company', 'category')
        );

        if ($request->filled('search')) {
            $consumables = $consumables->TextSearch(e($request->input('search')));
        }

        if ($request->filled('name')) {
            $consumables->where('name', '=', $request->input('name'));
        }

        if ($request->filled('company_id')) {
            $consumables->where('company_id', '=', $request->input('company_id'));
        }

        if ($request->filled('category_id')) {
            $consumables->where('category_id', '=', $request->input('category_id'));
        }


        // Set the offset to the API call's offset, unless the offset is higher than the actual count of items in which
        // case we override with the actual count, so we should return 0 items.
        $offset = (($consumables) && ($request->get('offset') > $consumables->count())) ? $consumables->count() : $request->get('offset', 0);

        // Check to make sure the limit is not higher than the max allowed
        ((config('app.max_results') >= $request->input('limit')) && ($request->filled('limit'))) ? $limit = $request->input('limit') : $limit = config('app.max_results');

        $allowed_columns = ['id', 'name','purchase_date', 'purchase_cost', 'company', 'category', 'qty'];
        $order = $request->input('order') === 'asc' ? 'asc' : 'desc';

        $sort_override =  $request->input('sort');
        $column_sort = in_array($sort_override, $allowed_columns) ? $sort_override : 'created_at';


        switch ($sort_override) {
            case 'category':
                $consumables = $consumables->OrderCategory($order);
                break;
            case 'company':
                $consumables = $consumables->OrderCompany($order);
                break;
            default:
                $consumables = $consumables->orderBy($column_sort, $order);
                break;
        }

        $total = $consumables->count();
        $consumables = $consumables->skip($offset)->take($limit)->get();

        return (new ConsumablesDetailsTransformer)->transformConsumablesDetails($consumables, $total);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @param  \App\Http\Requests\ImageUploadRequest $request
     * @return \Illuminate\Http\Response
     */
    // public function store(ImageUploadRequest $request)
    // {
    //     $this->authorize('create', ConsumableDetails::class);
    //     $consumable = new ConsumableDetails;
    //     $consumable->fill($request->all());
    //     $consumable = $request->handleImages($consumable);

    //     if ($consumable->save()) {
    //         return response()->json(Helper::formatStandardApiResponse('success', $consumable, trans('admin/consumables/message.create.success')));
    //     }

    //     return response()->json(Helper::formatStandardApiResponse('error', null, $consumable->getErrors()));
    // }

    /**
     * Display the specified resource.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $this->authorize('view', ConsumableDetails::class);
    //     $consumable = ConsumableDetails::findOrFail($id);

    //     return (new ConsumablesDetailsTransformer)->transformConsumable($consumable);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @param  \App\Http\Requests\ImageUploadRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function update(ImageUploadRequest $request, $id)
    // {
    //     $this->authorize('update', ConsumableDetails::class);
    //     $consumable = ConsumableDetails::findOrFail($id);
    //     $consumable->fill($request->all());
    //     $consumable = $request->handleImages($consumable);
        
    //     if ($consumable->save()) {
    //         return response()->json(Helper::formatStandardApiResponse('success', $consumable, trans('admin/consumables/message.update.success')));
    //     }

    //     return response()->json(Helper::formatStandardApiResponse('error', null, $consumable->getErrors()));
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $this->authorize('delete', ConsumableDetails::class);
    //     $consumable = ConsumableDetails::findOrFail($id);
    //     $this->authorize('delete', $consumable);
    //     $consumable->delete();

    //     return response()->json(Helper::formatStandardApiResponse('success', null, trans('admin/consumables/message.delete.success')));
    // }

    /**
    * Returns a JSON response containing details on the users associated with this consumable.
    *
    * @author [A. Gianotto] [<snipe@snipe.net>]
    * @see \App\Http\Controllers\Consumables\ConsumablesController::getView() method that returns the form.
    * @since [v1.0]
    * @param int $consumableId
    * @return array
     */
    // public function getDataView($consumableId)
    // {
    //     $consumable = ConsumableDetails::with(['consumableAssignments'=> function ($query) {
    //         $query->orderBy($query->getModel()->getTable().'.created_at', 'DESC');
    //     },
    //     'consumableAssignments.admin'=> function ($query) {
    //     },
    //     'consumableAssignments.user'=> function ($query) {
    //     },
    //     ])->find($consumableId);

    //     if (! Company::isCurrentUserHasAccess($consumable)) {
    //         return ['total' => 0, 'rows' => []];
    //     }
    //     $this->authorize('view', ConsumableDetails::class);
    //     $rows = [];

    //     foreach ($consumable->consumableAssignments as $consumable_assignment) {
    //         $rows[] = [
    //             'name' => ($consumable_assignment->user) ? $consumable_assignment->user->present()->nameUrl() : 'Deleted User',
    //             'created_at' => Helper::getFormattedDateObject($consumable_assignment->created_at, 'datetime'),
    //             'note' => ($consumable_assignment->note) ? e($consumable_assignment->note) : null,
    //             'admin' => ($consumable_assignment->admin) ? $consumable_assignment->admin->present()->nameUrl() : null,
    //         ];
    //     }

    //     $consumableCount = $consumable->users->count();
    //     $data = ['total' => $consumableCount, 'rows' => $rows];

    //     return $data;
    // }

    /**
    * Gets a paginated collection for the select2 menus
    *
    * @see \App\Http\Transformers\SelectlistTransformer
    */
    public function selectlist(Request $request)
    {
        $consumables = ConsumableDetails::select([
            'consumables_details.id',
            'consumables_details.consumable_id',
            'consumables_details.transaction_id',
        ]);

        if ($request->filled('transaction')) {
            $consumables = $consumables->where('consumables_details.transaction_id', $request->get('transaction'))->paginate();
            $consumablesId = $consumables->pluck('consumable_id')->toArray();
            $namedetails = Consumable::whereIn('id', $consumablesId)->pluck('name', 'id');

            $consumables->each(function ($consumable) use ($namedetails) {
                $consumable->name = $namedetails[$consumable->consumable_id] ?? null;
            });
        }
        return (new SelectlistTransformer)->transformSelectlist($consumables);
    }
}
