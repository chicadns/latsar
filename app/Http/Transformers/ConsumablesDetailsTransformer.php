<?php

namespace App\Http\Transformers;

use App\Helpers\Helper;
use App\Models\ConsumableDetails;
use Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ConsumablesDetailsTransformer
{
    public function transformConsumablesDetails(Collection $consumables, $total)
    {
        $array = [];
        foreach ($consumables as $consumable) {
            $array[] = self::transformConsumableDetail($consumable);
        }

        return (new DatatablesTransformer)->transformDatatables($array, $total);
    }

    public function transformConsumableDetail(ConsumableDetails $consumable)
    {
        $array = [
            'id'            => (int) $consumable->id,
            'name'          => $consumable->consumable->name,
            'category_id'   => ($consumable->category_id) ? ['id' => $consumable->category->id, 'name' => ($consumable->category->name)] : null,
            'purchase_cost' => Helper::formatCurrencyOutput($consumable->purchase_cost),
            'purchase_date' => Helper::getFormattedDateObject($consumable->ConsumableTransaction->purchase_date, 'date'),
            'qty'           => (int) $consumable->qty,
            'types'         => $consumable->consumableTransaction->types,
            'state'         => $consumable->consumableTransaction->state,
            'employee_num'  => $consumable->consumableTransaction->employee_num ? (int) $consumable->consumableTransaction->employee_num : 'Tidak disertakan',
        ];

        //ada kode checkout, tapi belum dimasukkin

        $permissions_array['available_actions'] = [
            // 'checkout' => Gate::allows('checkout', ConsumableTransaction::class),
            // 'checkin' => Gate::allows('checkin', ConsumableTransaction::class),
            'update' => Gate::allows('update', ConsumableDetails::class),
            'delete' => Gate::allows('delete', ConsumableDetails::class),
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
