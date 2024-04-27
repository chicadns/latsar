<?php

namespace App\Policies;

class ConsumableDetailsPolicy extends CheckoutablePermissionsPolicy
{
    protected function columnName()
    {
        return 'consumablesdetails';
    }
}
