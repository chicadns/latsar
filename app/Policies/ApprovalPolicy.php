<?php

namespace App\Policies;

class ApprovalPolicy extends CheckoutablePermissionsPolicy
{
    protected function columnName()
    {
        return 'allocations';
    }
}
