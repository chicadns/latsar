<?php

namespace App\Policies;

class TransactionDashboardPolicy extends CheckoutablePermissionsPolicy
{
    protected function columnName()
    {
        return 'transactiondashboard';
    }
}
