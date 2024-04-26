<?php 

use App\Models\Setting;
use Database\Seeders\DayLocationsTableSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Only create default settings if they do not exist in the db.
        if(!Setting::first()) {
           // factory(Setting::class)->create();
            $this->call(SettingsSeeder::class);
            $this->call(YosralAccessoriesTableSeeder::class);
            $this->call(YosralAccessoriesUsersTableSeeder::class);
            $this->call(YosralActionLogsTableSeeder::class);
            $this->call(YosralAssetLogsTableSeeder::class);
            $this->call(YosralAssetMaintenancesTableSeeder::class);
            $this->call(YosralAssetUploadsTableSeeder::class);
            $this->call(YosralCategoriesTableSeeder::class);
            $this->call(YosralCheckoutAcceptancesTableSeeder::class);
            $this->call(YosralCheckoutRequestsTableSeeder::class);
            $this->call(YosralCompaniesTableSeeder::class);
            $this->call(YosralComponentsTableSeeder::class);
            $this->call(YosralComponentsAssetsTableSeeder::class);
            $this->call(YosralConsumablesTableSeeder::class);
            $this->call(YosralConsumablesUsersTableSeeder::class);
            $this->call(YosralCustomFieldCustomFieldsetTableSeeder::class);
            $this->call(YosralCustomFieldsTableSeeder::class);
            $this->call(YosralCustomFieldsetsTableSeeder::class);
            $this->call(YosralDepartmentsTableSeeder::class);
            $this->call(YosralDepreciationsTableSeeder::class);
            $this->call(YosralImportsTableSeeder::class);
            $this->call(YosralKitsTableSeeder::class);
            $this->call(YosralKitsAccessoriesTableSeeder::class);
            $this->call(YosralKitsConsumablesTableSeeder::class);
            $this->call(YosralKitsLicensesTableSeeder::class);
            $this->call(YosralKitsModelsTableSeeder::class);
            $this->call(YosralLicenseSeatsTableSeeder::class);
            $this->call(YosralLicensesTableSeeder::class);
            $this->call(YosralLocationsTableSeeder::class);
            $this->call(YosralLoginAttemptsTableSeeder::class);
            $this->call(YosralManufacturersTableSeeder::class);
            $this->call(YosralMigrationsTableSeeder::class);
            $this->call(YosralModelsTableSeeder::class);
            $this->call(YosralModelsCustomFieldsTableSeeder::class);
            $this->call(YosralOauthAccessTokensTableSeeder::class);
            $this->call(YosralOauthAuthCodesTableSeeder::class);
            $this->call(YosralOauthClientsTableSeeder::class);
            $this->call(YosralOauthPersonalAccessClientsTableSeeder::class);
            $this->call(YosralOauthRefreshTokensTableSeeder::class);
            $this->call(YosralPasswordResetsTableSeeder::class);
            $this->call(YosralPermissionGroupsTableSeeder::class);
            $this->call(YosralRequestedAssetsTableSeeder::class);
            $this->call(YosralRequestsTableSeeder::class);
            $this->call(YosralSettingsTableSeeder::class);
            $this->call(YosralStatusLabelsTableSeeder::class);
            $this->call(YosralSuppliersTableSeeder::class);
            $this->call(YosralThrottleTableSeeder::class);
            $this->call(YosralUsersTableSeeder::class);
            $this->call(YosralUsersGroupsTableSeeder::class);
    }

        $this->call(YosralAccessoriesTableSeeder::class);
        $this->call(YosralAccessoriesUsersTableSeeder::class);
        $this->call(YosralActionLogsTableSeeder::class);
        $this->call(YosralAssetLogsTableSeeder::class);
        $this->call(YosralAssetMaintenancesTableSeeder::class);
        $this->call(YosralAssetUploadsTableSeeder::class);
        $this->call(YosralCategoriesTableSeeder::class);
        $this->call(YosralCheckoutAcceptancesTableSeeder::class);
        $this->call(YosralCheckoutRequestsTableSeeder::class);
        $this->call(YosralCompaniesTableSeeder::class);
        $this->call(YosralComponentsTableSeeder::class);
        $this->call(YosralComponentsAssetsTableSeeder::class);
        $this->call(YosralConsumablesTableSeeder::class);
        $this->call(YosralConsumablesUsersTableSeeder::class);
        $this->call(YosralCustomFieldCustomFieldsetTableSeeder::class);
        $this->call(YosralCustomFieldsTableSeeder::class);
        $this->call(YosralCustomFieldsetsTableSeeder::class);
        $this->call(YosralDepartmentsTableSeeder::class);
        $this->call(YosralDepreciationsTableSeeder::class);
        $this->call(YosralImportsTableSeeder::class);
        $this->call(YosralKitsTableSeeder::class);
        $this->call(YosralKitsAccessoriesTableSeeder::class);
        $this->call(YosralKitsConsumablesTableSeeder::class);
        $this->call(YosralKitsLicensesTableSeeder::class);
        $this->call(YosralKitsModelsTableSeeder::class);
        $this->call(YosralLicenseSeatsTableSeeder::class);
        $this->call(YosralLicensesTableSeeder::class);
        $this->call(YosralLocationsTableSeeder::class);
        $this->call(YosralLoginAttemptsTableSeeder::class);
        $this->call(YosralManufacturersTableSeeder::class);
        $this->call(YosralMigrationsTableSeeder::class);
        $this->call(YosralModelsTableSeeder::class);
        $this->call(YosralModelsCustomFieldsTableSeeder::class);
        $this->call(YosralOauthAccessTokensTableSeeder::class);
        $this->call(YosralOauthAuthCodesTableSeeder::class);
        $this->call(YosralOauthClientsTableSeeder::class);
        $this->call(YosralOauthPersonalAccessClientsTableSeeder::class);
        $this->call(YosralOauthRefreshTokensTableSeeder::class);
        $this->call(YosralPasswordResetsTableSeeder::class);
        $this->call(YosralPermissionGroupsTableSeeder::class);
        $this->call(YosralRequestedAssetsTableSeeder::class);
        $this->call(YosralRequestsTableSeeder::class);
        $this->call(YosralSettingsTableSeeder::class);
        $this->call(YosralStatusLabelsTableSeeder::class);
        $this->call(YosralSuppliersTableSeeder::class);
        $this->call(YosralThrottleTableSeeder::class);
        $this->call(YosralUsersTableSeeder::class);
        $this->call(YosralUsersGroupsTableSeeder::class);
        $this->call(AldoAssetsTableSeeder::class);
        $this->call(DayLocationsTableSeeder::class);

        Artisan::call('snipeit:sync-asset-locations', ['--output' => 'all']);
        $output = Artisan::output();
        \Log::info($output);

        Model::reguard();

        DB::table('imports')->truncate();
        DB::table('asset_maintenances')->truncate();
        DB::table('requested_assets')->truncate();


    }
}
