<?php

namespace App\Http\Transformers;

use App\Helpers\Helper;
use App\Models\Allocation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class AllocationTransformer
{
    public function transformAllocations(Collection $allocations, $total)
    {
        $array = [];
        foreach ($allocations as $allocation) {
            $array[] = self::transformAllocation($allocation);
        }

        return (new DatatablesTransformer)->transformDatatables($array, $total);
    }

    public function transformAllocation(Allocation $allocation)
    {
        $user = $allocation->user;
        $asset = $allocation->asset;
        $category = $asset->model->category;

        $array = [
            'id'            => (int) $allocation->id,
            'no'            => (int) $allocation->id,  // Assuming 'no' is the ID or row number
            'request_date'  => Helper::getFormattedDateObject($allocation->request_date, 'date'),
            'user_first_name' => e($user->first_name),
            'category'      => ($category) ? ['id' => $category->id, 'name' => e($category->name)] : null,
            'name'          => e($allocation->name),
            'bmn'           => e($allocation->bmn),
            'serial'        => e($allocation->serial),
            'status'        => e($allocation->status),
            'action'        => $this->generateActionButtons($allocation)
        ];

        return $array;
    }

    private function generateActionButtons(Allocation $allocation)
    {
        $approveButton = '<button class="btn btn-success" onclick="showApproveModal(' . $allocation->id . ')">✔️</button>';
        $declineButton = '<button class="btn btn-danger" onclick="declineAllocation(' . $allocation->id . ')">❌</button>';
        return $approveButton . ' ' . $declineButton;
    }

    public function transformCheckedoutAllocations(Collection $allocations_users, $total)
    {
        $array = [];
        foreach ($allocations_users as $user) {
            $array[] = (new UsersTransformer)->transformUser($user);
        }

        return (new DatatablesTransformer)->transformDatatables($array, $total);
    }
}
