<?php

namespace App\Http\Controllers\Consumables;

use App\Models\Consumable;
use App\Models\Company;
use App\Models\ConsumableTransaction;
use App\Models\ConsumableDetails;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionDashboardController extends Controller
{
    public function index()
    {
        $this->authorize('index', ConsumableDetails::class);
        $current_user = Auth::user();
        $companyNamePattern = "BPS Propinsi";
        $unikerja = Company::where('id', $current_user->company_id)->value('name');
        $isBPSPropinsi = strpos($unikerja, $companyNamePattern) !== false;
        $data_type['pemasukkan'] = Company::scopeCompanyables(ConsumableDetails::select(
            'consumables_details.*','consumables_transaction.state','consumables_transaction.types'
        )->join('consumables_transaction', 'consumables_details.transaction_id', '=', 'consumables_transaction.id')
        ->groupBy(
            'consumables_details.company_id','consumables_details.consumable_id','consumables_transaction.state'
        )->where(function ($query) use ($current_user, $isBPSPropinsi) {
            if ($current_user->company_id <= 25 && $current_user->company_id != 6 && $current_user->company_id != 7) {
                $query->where('types', 'Pemasukkan')->where('consumables_transaction.company_id', 5)->where('state', 'Selesai');
            } elseif ($isBPSPropinsi) {
                $query->where('types', 'Pemasukkan')->where('consumables_transaction.company_id', $current_user)->where('state', 'Selesai');
            } else {
                $query->where('types', 'Pemasukkan')->where('state', 'Selesai');
            }
        }))->get();

        $data_type['pengeluaran'] = Company::scopeCompanyables(ConsumableDetails::select(
            'consumables_details.*','consumables_transaction.state','consumables_transaction.types'
        )->join('consumables_transaction', 'consumables_details.transaction_id', '=', 'consumables_transaction.id')
        ->groupBy(
            'consumables_details.company_id','consumables_details.consumable_id','consumables_transaction.state'
        )->where(function ($query) use ($current_user, $isBPSPropinsi) {
            if ($current_user->company_id <= 25 && $current_user->company_id != 6 && $current_user->company_id != 7) {
                $query->where(function($query) {
                    $query->where('types', 'Pengeluaran')->where('consumables_transaction.company_id', 5)->where('state', 'Selesai');
                })
                ->orWhere(function($query) {
                    $query->where('types', 'Pemasukkan')->where('consumables_transaction.company_id', '<>', 5)->where('state', 'Selesai');
                });
            } elseif ($isBPSPropinsi) {
                $query->where(function($query) use ($current_user) {
                    $query->where('types', 'Pengeluaran')->where('consumables_transaction.company_id', $current_user)->where('state', 'Selesai');
                })
                ->orWhere(function($query) use ($current_user) {
                    $query->where('types', 'Pemasukkan')->where('consumables_transaction.company_id', '<>', $current_user)->where('state', 'Selesai');
                });
            } else {
                $query->where('types', 'Pengeluaran')->where('state', 'Selesai');
            }
        }))->get();

        $groups = json_decode($current_user['groups'], true);
        $groupName = $current_user->isSuperUser() ? null : $groups[0]['name'];
        $companyNamePattern = "BPS Propinsi";
        $unikerja = Company::where('id', $current_user->company_id)->value('name');
        $isBPSPropinsi = strpos($unikerja, $companyNamePattern) !== false;
        if (!$isBPSPropinsi && $groupName != 'Admin Pusat' && !$current_user->isSuperuser()) {
            $company_type['id'] = $current_user->company_id;
            $company_type['name'] = \App\Models\Company::find($current_user->company_id)->name;
        } else {
            $company_type['id'] = null;
            $company_type['name'] = null;
        }
        
        $access_user['super_user'] = $current_user->isSuperUser();
        $access_user['group'] = $groupName;
        $access_user['prov'] = $isBPSPropinsi;

        return view('transactiondashboard/index')
            ->with('data_type', $data_type)
            ->with('company_type', $company_type)
            ->with('access_user', $access_user);
    }
}