<?php

namespace App\Http\Transformers;

use App\Helpers\Helper;
use App\Models\ConsumableDetails;
use Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class TransactionDashboardTransformer
{
    public function transformTransactionDashboards(Collection $consumables, $total)
    {
        $array = [];
        foreach ($consumables as $consumable) {
            $array[] = self::transformTransactionDashboard($consumable);
        }

        return (new DatatablesTransformer)->transformDatatables($array, $total);
    }

    public function transformTransactionDashboard(ConsumableDetails $consumable)
    {
        $array = [
            'id'            => (int) $consumable->id,
            'company_id'    => ($consumable->company_id) ? ['id' => (int) $consumable->company->id, 'name' => e($consumable->company->name)] : null,
            'category_id'   => ($consumable->category_id) ? ['id' => $consumable->category->id, 'name' => ($consumable->category->name)] : null,
            'name'          => e($consumable->consumable->name),
            'purchase_cost' => Helper::formatCurrencyOutput($consumable->purchase_cost),
            'qty'           => ($consumable->types == 'Pemasukkan') ? $consumable->total_qty : $consumable->total_qty2,
            //'qty'           => $consumable->total_qty,
            'total_cost'    => ($consumable->types == 'Pemasukkan') ? Helper::formatCurrencyOutput($consumable->total_qty*$consumable->purchase_cost) : Helper::formatCurrencyOutput($consumable->total_qty2*$consumable->purchase_cost)
        ];

        //ada kode checkout, tapi belum dimasukkin

        $permissions_array['available_actions'] = [
            // 'checkout' => Gate::allows('checkout', ConsumableTransaction::class),
            // 'checkin' => Gate::allows('checkin', ConsumableTransaction::class),
            // 'update' => Gate::allows('update', ConsumableDetails::class),
            // 'delete' => Gate::allows('delete', ConsumableDetails::class),
        ];
        $array += $permissions_array;

        return $array;
    }

    public function transformCheckedoutConsumables(Collection $consumables_users, $total)
    {
        $array = [];
        foreach ($consumables_users as $user) {
            $array[] = (new UsersTransformer)->transformUser($user);
        }

        return (new DatatablesTransformer)->transformDatatables($array, $total);
    }
}
