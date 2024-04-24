<?php

use Illuminate\Database\Seeder;

class YosralPermissionGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permission_groups')->delete();
        
        \DB::table('permission_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Superadmin',
                'permissions' => '{"superuser":"1","admin":"1","import":"1","reports.view":"1","assets.view":"1","assets.create":"1","assets.edit":"1","assets.delete":"1","assets.checkin":"1","assets.checkout":"1","assets.audit":"1","assets.view.requestable":"1","accessories.view":"1","accessories.create":"1","accessories.edit":"1","accessories.delete":"1","accessories.checkout":"1","accessories.checkin":"1","consumables.view":"1","consumables.create":"1","consumables.edit":"1","consumables.delete":"1","consumables.checkout":"1","licenses.view":"1","licenses.create":"1","licenses.edit":"1","licenses.delete":"1","licenses.checkout":"1","licenses.keys":"1","licenses.files":"1","components.view":"1","components.create":"1","components.edit":"1","components.delete":"1","components.checkout":"1","components.checkin":"1","kits.view":"1","kits.create":"1","kits.edit":"1","kits.delete":"1","kits.checkout":"1","users.view":"1","users.create":"1","users.edit":"1","users.delete":"1","models.view":"1","models.create":"1","models.edit":"1","models.delete":"1","categories.view":"1","categories.create":"1","categories.edit":"1","categories.delete":"1","departments.view":"1","departments.create":"1","departments.edit":"1","departments.delete":"1","statuslabels.view":"1","statuslabels.create":"1","statuslabels.edit":"1","statuslabels.delete":"1","customfields.view":"1","customfields.create":"1","customfields.edit":"1","customfields.delete":"1","suppliers.view":"1","suppliers.create":"1","suppliers.edit":"1","suppliers.delete":"1","manufacturers.view":"1","manufacturers.create":"1","manufacturers.edit":"1","manufacturers.delete":"1","depreciations.view":"1","depreciations.create":"1","depreciations.edit":"1","depreciations.delete":"1","locations.view":"1","locations.create":"1","locations.edit":"1","locations.delete":"1","companies.view":"1","companies.create":"1","companies.edit":"1","companies.delete":"1","self.two_factor":"1","self.api":"1","self.edit_location":"1","self.checkout_assets":"1"}',
                'created_at' => '2021-09-18 14:32:42',
                'updated_at' => '2021-09-18 14:32:42',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admin Pusat',
                'permissions' => '{"superuser":"0","admin":"1","import":"1","reports.view":"1","assets.view":"1","assets.create":"1","assets.edit":"1","assets.delete":"1","assets.checkin":"1","assets.checkout":"1","assets.audit":"1","assets.view.requestable":"1","accessories.view":"0","accessories.create":"0","accessories.edit":"0","accessories.delete":"0","accessories.checkout":"0","accessories.checkin":"0","consumables.view":"0","consumables.create":"0","consumables.edit":"0","consumables.delete":"0","consumables.checkout":"0","licenses.view":"1","licenses.create":"1","licenses.edit":"1","licenses.delete":"1","licenses.checkout":"1","licenses.keys":"1","licenses.files":"1","components.view":"0","components.create":"0","components.edit":"0","components.delete":"0","components.checkout":"0","components.checkin":"0","kits.view":"0","kits.create":"0","kits.edit":"0","kits.delete":"0","kits.checkout":"0","users.view":"1","users.create":"0","users.edit":"0","users.delete":"0","models.view":"1","models.create":"0","models.edit":"0","models.delete":"0","categories.view":"1","categories.create":"0","categories.edit":"0","categories.delete":"0","departments.view":"1","departments.create":"0","departments.edit":"0","departments.delete":"0","statuslabels.view":"0","statuslabels.create":"0","statuslabels.edit":"0","statuslabels.delete":"0","customfields.view":"1","customfields.create":"0","customfields.edit":"0","customfields.delete":"0","suppliers.view":"1","suppliers.create":"0","suppliers.edit":"0","suppliers.delete":"0","manufacturers.view":"1","manufacturers.create":"0","manufacturers.edit":"0","manufacturers.delete":"0","depreciations.view":"0","depreciations.create":"0","depreciations.edit":"0","depreciations.delete":"0","locations.view":"1","locations.create":"0","locations.edit":"0","locations.delete":"0","companies.view":"1","companies.create":"0","companies.edit":"0","companies.delete":"0","self.two_factor":"0","self.api":"0","self.edit_location":"0","self.checkout_assets":"0"}',
                'created_at' => '2021-09-18 14:36:46',
                'updated_at' => '2021-09-18 14:36:46',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Admin Daerah',
                'permissions' => '{"superuser":"0","admin":"1","import":"1","reports.view":"1","assets.view":"1","assets.create":"1","assets.edit":"1","assets.delete":"1","assets.checkin":"1","assets.checkout":"1","assets.audit":"1","assets.view.requestable":"1","accessories.view":"0","accessories.create":"0","accessories.edit":"0","accessories.delete":"0","accessories.checkout":"0","accessories.checkin":"0","consumables.view":"0","consumables.create":"0","consumables.edit":"0","consumables.delete":"0","consumables.checkout":"0","licenses.view":"1","licenses.create":"1","licenses.edit":"1","licenses.delete":"1","licenses.checkout":"1","licenses.keys":"1","licenses.files":"1","components.view":"0","components.create":"0","components.edit":"0","components.delete":"0","components.checkout":"0","components.checkin":"0","kits.view":"0","kits.create":"0","kits.edit":"0","kits.delete":"0","kits.checkout":"0","users.view":"1","users.create":"0","users.edit":"0","users.delete":"0","models.view":"1","models.create":"0","models.edit":"0","models.delete":"0","categories.view":"1","categories.create":"0","categories.edit":"0","categories.delete":"0","departments.view":"1","departments.create":"0","departments.edit":"0","departments.delete":"0","statuslabels.view":"0","statuslabels.create":"0","statuslabels.edit":"0","statuslabels.delete":"0","customfields.view":"0","customfields.create":"0","customfields.edit":"0","customfields.delete":"0","suppliers.view":"1","suppliers.create":"0","suppliers.edit":"0","suppliers.delete":"0","manufacturers.view":"1","manufacturers.create":"0","manufacturers.edit":"0","manufacturers.delete":"0","depreciations.view":"0","depreciations.create":"0","depreciations.edit":"0","depreciations.delete":"0","locations.view":"0","locations.create":"0","locations.edit":"0","locations.delete":"0","companies.view":"1","companies.create":"0","companies.edit":"0","companies.delete":"0","self.two_factor":"0","self.api":"0","self.edit_location":"0","self.checkout_assets":"0"}',
                'created_at' => '2021-09-18 14:37:35',
                'updated_at' => '2021-10-29 11:56:38',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Pengguna',
                'permissions' => '{"superuser":"0","admin":"0","import":"0","reports.view":"0","assets.view":"1","assets.create":"0","assets.edit":"0","assets.delete":"0","assets.checkin":"0","assets.checkout":"0","assets.audit":"0","assets.view.requestable":"0","accessories.view":"1","accessories.create":"0","accessories.edit":"0","accessories.delete":"0","accessories.checkout":"0","accessories.checkin":"0","consumables.view":"1","consumables.create":"0","consumables.edit":"0","consumables.delete":"0","consumables.checkout":"0","licenses.view":"1","licenses.create":"0","licenses.edit":"0","licenses.delete":"0","licenses.checkout":"0","licenses.keys":"0","licenses.files":"0","components.view":"1","components.create":"0","components.edit":"0","components.delete":"0","components.checkout":"0","components.checkin":"0","kits.view":"1","kits.create":"0","kits.edit":"0","kits.delete":"0","kits.checkout":"0","users.view":"1","users.create":"0","users.edit":"0","users.delete":"0","models.view":"1","models.create":"0","models.edit":"0","models.delete":"0","categories.view":"1","categories.create":"0","categories.edit":"0","categories.delete":"0","departments.view":"1","departments.create":"0","departments.edit":"0","departments.delete":"0","statuslabels.view":"0","statuslabels.create":"0","statuslabels.edit":"0","statuslabels.delete":"0","customfields.view":"0","customfields.create":"0","customfields.edit":"0","customfields.delete":"0","suppliers.view":"1","suppliers.create":"0","suppliers.edit":"0","suppliers.delete":"0","manufacturers.view":"1","manufacturers.create":"0","manufacturers.edit":"0","manufacturers.delete":"0","depreciations.view":"1","depreciations.create":"0","depreciations.edit":"0","depreciations.delete":"0","locations.view":"1","locations.create":"0","locations.edit":"0","locations.delete":"0","companies.view":"1","companies.create":"0","companies.edit":"0","companies.delete":"0","self.two_factor":"0","self.api":"0","self.edit_location":"0","self.checkout_assets":"0"}',
                'created_at' => '2021-09-22 18:32:37',
                'updated_at' => '2021-09-23 20:05:52',
            ),
        ));
        
        
    }
}