<?php

namespace App\Policies;

class ConsumableTransactionPolicy extends CheckoutablePermissionsPolicy
{
    protected function columnName()
    {
        return 'consumablestransaction';
    }
}
