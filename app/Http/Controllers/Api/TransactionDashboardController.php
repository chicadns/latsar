<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Transformers\TransactionDashboardTransformer;
use App\Http\Transformers\SelectlistTransformer;
use App\Http\Transformers\PieChartTransformer;
use App\Models\Company;
use App\Models\ConsumableDetails;
use App\Models\ConsumableTransaction;
use App\Models\ConsumableOnComp;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use Auth;
use DB;

class TransactionDashboardController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('index', ConsumableDetails::class);
        $allowed_columns =
            [
                'id',
                'name',
                'purchase_cost',
                'company',
                'qty',
            ];
        
        $consumables = Company::scopeCompanyables(ConsumableDetails::select(
            'consumables_details.*',
            'consumables_transaction.state',
            'consumables_transaction.types',
            DB::raw('SUM(consumables_details.qty) as total_qty'),
            DB::raw('SUM(consumables_details.approve_qty) as total_qty2'),
            DB::raw('consumables_details.consumable_id as id')
        )->join('consumables_transaction', 'consumables_details.transaction_id', '=', 'consumables_transaction.id')
        ->groupBy(
            // 'consumables_transaction.types',
            'consumables_details.company_id',
            'consumables_details.consumable_id',
            'consumables_transaction.state'
        )->orderBy('consumables_details.company_id')
        ->orderby('consumables_details.consumable_id'));

        

        if ($request->filled('type_filter')) {
            $consumables = $consumables->whereHas('consumableTransaction', function ($query) use ($request) {
                $current_user = Auth::user();
                $companyNamePattern = "BPS Propinsi";
                $unikerja = Company::where('id', $current_user->company_id)->value('name');
                $isBPSPropinsi = strpos($unikerja, $companyNamePattern) !== false;
                if ($request->get('type_filter') === 'Pemasukkan') {
                    if ($current_user->company_id <= 25 && $current_user->company_id != 6 && $current_user->company_id != 7) {
                        $query->where('types', $request->get('type_filter'))->where('company_id', 5)->where('state', 'Selesai');
                    } elseif ($isBPSPropinsi) {
                        $query->where('types', $request->get('type_filter'))->where('company_id', $current_user)->where('state', 'Selesai');
                    } else {
                        $query->where('types', $request->get('type_filter'))->where('state', 'Selesai');
                    }
                } else {
                    if ($current_user->company_id <= 25 && $current_user->company_id != 6 && $current_user->company_id != 7) {
                        $query->where(function($query) use ($request) {
                            $query->where('types', $request->get('type_filter'))->where('company_id', 5)->where('state', 'Selesai');
                        })
                        ->orWhere(function($query) {
                            $query->where('types', 'Pemasukkan')->where('company_id', '<>', 5)->where('state', 'Selesai');
                        });
                    } elseif ($isBPSPropinsi) {
                        $query->where(function($query) use ($request, $current_user) {
                            $query->where('types', $request->get('type_filter'))->where('company_id', $current_user)->where('state', 'Selesai');
                        })
                        ->orWhere(function($query) use ($current_user) {
                            $query->where('types', 'Pemasukkan')->where('company_id', '<>', $current_user)->where('state', 'Selesai');
                        });
                    } else {
                        $query->where('types', $request->get('type_filter'))->where('state', 'Selesai');
                    }
                }
            });
        }

        if ($request->filled('selectedOptions')) {
            $selectedOptions = $request->get('selectedOptions');
            if ($request->get('type_filter') === 'Pengeluaran') {
                if (isset($selectedOptions['company']) && $selectedOptions['company'] !== null) {
                    $consumables = $consumables->where('consumables_details.company_id', $selectedOptions['company']);                
                }

                if (isset($selectedOptions['namestuff']) && $selectedOptions['namestuff'] !== null) {
                    $consumables = $consumables->where('consumables_details.consumable_id', $selectedOptions['namestuff']);
                }
            }
        }

        // Set the offset to the API call's offset, unless the offset is higher than the actual count of items in which
        // case we override with the actual count, so we should return 0 items.
        $offset = (($consumables) && ($request->get('offset') > $consumables->count())) ? $consumables->count() : $request->get('offset', 0);

        // Check to make sure the limit is not higher than the max allowed
        ((config('app.max_results') >= $request->input('limit')) && ($request->filled('limit'))) ? $limit = $request->input('limit') : $limit = config('app.max_results');

        $consumables = $consumables->skip($offset)->take($limit)->get();
        $total = $consumables->count();

        return (new TransactionDashboardTransformer)->transformTransactionDashboards($consumables, $total);
    }

    public function selectlist(Request $request)
    {
        $consumables = 
            ConsumableOnComp::select([
            'consumables.id',
            'consumables.name',
        ]);

        if ($request->filled('filterCompany')) {
            $consumables = $consumables->where('consumables.company_id', $request->get('filterCompany'));
        }

        if ($request->filled('search')) {
            $consumables = $consumables->where('consumables.name', 'LIKE', '%'.$request->get('search').'%');
        }

        $consumables = $consumables->orderBy('name', 'ASC')->paginate(50);

        return (new SelectlistTransformer)->transformSelectlist($consumables);
    }

    public function getTransactionCountByCompany(Request $request)
    {
        $companies = Company::scopeCompanyables(ConsumableDetails::select(
            'consumables_details.*',
            'consumables_transaction.state',
            'consumables_transaction.types',
            DB::raw('SUM(consumables_details.qty) as total_qty'),
            DB::raw('SUM(consumables_details.approve_qty) as total_qty2'),
            DB::raw('consumables_details.consumable_id as id')
        )->join('consumables_transaction', 'consumables_details.transaction_id', '=', 'consumables_transaction.id')
        ->groupBy(
            // 'consumables_transaction.types',
            'consumables_details.company_id',
            // 'consumables_details.consumable_id',
            'consumables_transaction.state'
        )->orderBy('consumables_details.company_id')
        ->orderby('consumables_details.consumable_id'));

        if ($request->filled('typeFilter')) {
            $companies = $companies->whereHas('consumableTransaction', function ($query) use ($request) {
                $current_user = Auth::user();
                $companyNamePattern = "BPS Propinsi";
                $unikerja = Company::where('id', $current_user->company_id)->value('name');
                $isBPSPropinsi = strpos($unikerja, $companyNamePattern) !== false;
                if ($request->get('typeFilter') === 'Pemasukkan') {
                    if ($current_user->company_id <= 25 && $current_user->company_id != 6 && $current_user->company_id != 7) {
                        $query->where('types', $request->get('typeFilter'))->where('company_id', 5)->where('state', 'Selesai');
                    } elseif ($isBPSPropinsi) {
                        $query->where('types', $request->get('type_filter'))->where('company_id', $current_user)->where('state', 'Selesai');
                    } else {
                        $query->where('types', $request->get('typeFilter'))->where('state', 'Selesai');
                    }
                } else {
                    if ($current_user->company_id <= 25 && $current_user->company_id != 6 && $current_user->company_id != 7) {
                        $query->where(function($query) use ($request) {
                            $query->where('types', $request->get('typeFilter'))->where('company_id', 5)->where('state', 'Selesai');
                        })
                        ->orWhere(function($query) {
                            $query->where('types', 'Pemasukkan')->where('company_id', '<>', 5)->where('state', 'Selesai');
                        });
                    } elseif ($isBPSPropinsi) {
                        $query->where(function($query) use ($request, $current_user) {
                            $query->where('types', $request->get('type_filter'))->where('company_id', $current_user)->where('state', 'Selesai');
                        })
                        ->orWhere(function($query) use ($current_user) {
                            $query->where('types', 'Pemasukkan')->where('company_id', '<>', $current_user)->where('state', 'Selesai');
                        });
                    } else {
                        $query->where('types', $request->get('typeFilter'))->where('state', 'Selesai');
                    }
                }
            });
        }

        $companies = $companies->get();

        if ($companies->count() > 0) {
            foreach ($companies as $company) {
                $total[$company->company->name]['label'] = $company->company->name;
                $total[$company->company->name]['count'] = $company->total_qty;

                if ($company->color != '') {
                    $total[$company->company->name]['color'] = $company->color;
                }
            }
        } else {
            $total = [];
        }

        return (new PieChartTransformer())->transformPieChartDate($total);
    }

    public function getTransactionCountByConsumableName(Request $request)
    {
        $consumables = Company::scopeCompanyables(ConsumableDetails::select(
            'consumables_details.*',
            'consumables_transaction.state',
            'consumables_transaction.types',
            DB::raw('SUM(consumables_details.qty) as total_qty'),
            DB::raw('SUM(consumables_details.approve_qty) as total_qty2'),
            DB::raw('consumables_details.consumable_id as id')
        )->join('consumables_transaction', 'consumables_details.transaction_id', '=', 'consumables_transaction.id')
        ->groupBy(
            // 'consumables_transaction.types',
            'consumables_details.company_id',
            'consumables_details.consumable_id',
            'consumables_transaction.state'
        )->orderBy('consumables_details.company_id')
        ->orderby('consumables_details.consumable_id'));

        if ($request->filled('typeFilter')) {
            $consumables = $consumables->whereHas('consumableTransaction', function ($query) use ($request) {
                $current_user = Auth::user();
                $companyNamePattern = "BPS Propinsi";
                $unikerja = Company::where('id', $current_user->company_id)->value('name');
                $isBPSPropinsi = strpos($unikerja, $companyNamePattern) !== false;
                if ($request->get('typeFilter') === 'Pemasukkan') {
                    if ($current_user->company_id <= 25 && $current_user->company_id != 6 && $current_user->company_id != 7) {
                        $query->where('types', $request->get('typeFilter'))->where('company_id', 5)->where('state', 'Selesai');
                    } elseif ($isBPSPropinsi) {
                        $query->where('types', $request->get('type_filter'))->where('company_id', $current_user)->where('state', 'Selesai');
                    } else {
                        $query->where('types', $request->get('typeFilter'))->where('state', 'Selesai');
                    }
                } else {
                    if ($current_user->company_id <= 25 && $current_user->company_id != 6 && $current_user->company_id != 7) {
                        $query->where(function($query) use ($request) {
                            $query->where('types', $request->get('typeFilter'))->where('company_id', 5)->where('state', 'Selesai');
                        })
                        ->orWhere(function($query) {
                            $query->where('types', 'Pemasukkan')->where('company_id', '<>', 5)->where('state', 'Selesai');
                        });
                    } elseif ($isBPSPropinsi) {
                        $query->where(function($query) use ($request, $current_user) {
                            $query->where('types', $request->get('type_filter'))->where('company_id', $current_user)->where('state', 'Selesai');
                        })
                        ->orWhere(function($query) use ($current_user) {
                            $query->where('types', 'Pemasukkan')->where('company_id', '<>', $current_user)->where('state', 'Selesai');
                        });
                    } else {
                        $query->where('types', $request->get('typeFilter'))->where('state', 'Selesai');
                    }
                }
            });
        }

        if($request->get('compFilter') != null) {
            $consumables = $consumables->where('consumables_details.company_id', $request->get('compFilter'));
        }

        $consumables = $consumables->get();

        if ($consumables->count() > 0) {
            foreach ($consumables as $consumable) {
                $total[$consumable->consumable->name . $consumable->id]['company'] = $consumable->company->name;
                $total[$consumable->consumable->name . $consumable->id]['label']   = $consumable->consumable->name."-".$consumable->company->name;
                $total[$consumable->consumable->name . $consumable->id]['count']   = $consumable->total_qty;

                if ($consumable->color != '') {
                    $total[$consumable->consumable->name . $consumable->id]['color'] = $consumable->color;
                }
            }
        } else {
            $total = [];
        }

        return (new PieChartTransformer())->transformPieChartDate($total);
    }
}