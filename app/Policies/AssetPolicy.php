<?php

namespace App\Policies;

use App\Models\User;

use App\Models\Asset;

class AssetPolicy extends CheckoutablePermissionsPolicy
{
    protected function columnName()
    {
        return 'assets';
    }

    public function viewRequestable(User $user, Asset $asset = null)
    {
        return $user->hasAccess('assets.view.requestable');
    }

    public function audit(User $user, Asset $asset = null)
    {
        return $user->hasAccess('assets.audit');
    }

    public function viewCompanyAssets(User $user, Asset $asset)
    {
        // Allow users from company IDs 1-4 and 8-25 to access assets from company ID 5
        $allowedCompanyIds = array_merge(range(1, 4), range(8, 25));

        // Check if the user belongs to allowed company IDs and the asset belongs to company ID 5
        if ($asset->company_id == 5 && in_array($user->company_id, $allowedCompanyIds)) {
            return true;
        }

        // Default permission check
        return $user->company_id == $asset->company_id;
    }
}
