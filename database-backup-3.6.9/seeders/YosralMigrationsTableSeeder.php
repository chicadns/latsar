<?php

use Illuminate\Database\Seeder;

class YosralMigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2012_12_06_225921_migration_cartalyst_sentry_install_users',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2012_12_06_225929_migration_cartalyst_sentry_install_groups',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2012_12_06_225988_migration_cartalyst_sentry_install_throttle',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2013_03_23_193214_update_users_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2013_11_13_075318_create_models_table',
                'batch' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2013_11_13_075335_create_categories_table',
                'batch' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2013_11_13_075347_create_manufacturers_table',
                'batch' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2013_11_15_015858_add_user_id_to_categories',
                'batch' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'migration' => '2013_11_15_112701_add_user_id_to_manufacturers',
                'batch' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'migration' => '2013_11_15_190327_create_assets_table',
                'batch' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'migration' => '2013_11_15_190357_create_licenses_table',
                'batch' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'migration' => '2013_11_15_201848_add_license_name_to_licenses',
                'batch' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'migration' => '2013_11_16_040323_create_depreciations_table',
                'batch' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'migration' => '2013_11_16_042851_add_depreciation_id_to_models',
                'batch' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'migration' => '2013_11_16_084923_add_user_id_to_models',
                'batch' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'migration' => '2013_11_16_103258_create_locations_table',
                'batch' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'migration' => '2013_11_16_103336_add_location_id_to_assets',
                'batch' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'migration' => '2013_11_16_103407_add_checkedout_to_to_assets',
                'batch' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'migration' => '2013_11_16_103425_create_history_table',
                'batch' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'migration' => '2013_11_17_054359_drop_licenses_table',
                'batch' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'migration' => '2013_11_17_054526_add_physical_to_assets',
                'batch' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'migration' => '2013_11_17_055126_create_settings_table',
                'batch' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'migration' => '2013_11_17_062634_add_license_to_assets',
                'batch' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'migration' => '2013_11_18_134332_add_contacts_to_users',
                'batch' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'migration' => '2013_11_18_142847_add_info_to_locations',
                'batch' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'migration' => '2013_11_18_152942_remove_location_id_from_asset',
                'batch' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'migration' => '2013_11_18_164423_set_nullvalues_for_user',
                'batch' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'migration' => '2013_11_19_013337_create_asset_logs_table',
                'batch' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'migration' => '2013_11_19_061409_edit_added_on_asset_logs_table',
                'batch' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'migration' => '2013_11_19_062250_edit_location_id_asset_logs_table',
                'batch' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'migration' => '2013_11_20_055822_add_soft_delete_on_assets',
                'batch' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'migration' => '2013_11_20_121404_add_soft_delete_on_locations',
                'batch' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'migration' => '2013_11_20_123137_add_soft_delete_on_manufacturers',
                'batch' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'migration' => '2013_11_20_123725_add_soft_delete_on_categories',
                'batch' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'migration' => '2013_11_20_130248_create_status_labels',
                'batch' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'migration' => '2013_11_20_130830_add_status_id_on_assets_table',
                'batch' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'migration' => '2013_11_20_131544_add_status_type_on_status_labels',
                'batch' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'migration' => '2013_11_20_134103_add_archived_to_assets',
                'batch' => 1,
            ),
            39 => 
            array (
                'id' => 40,
                'migration' => '2013_11_21_002321_add_uploads_table',
                'batch' => 1,
            ),
            40 => 
            array (
                'id' => 41,
                'migration' => '2013_11_21_024531_remove_deployable_boolean_from_status_labels',
                'batch' => 1,
            ),
            41 => 
            array (
                'id' => 42,
                'migration' => '2013_11_22_075308_add_option_label_to_settings_table',
                'batch' => 1,
            ),
            42 => 
            array (
                'id' => 43,
                'migration' => '2013_11_22_213400_edits_to_settings_table',
                'batch' => 1,
            ),
            43 => 
            array (
                'id' => 44,
                'migration' => '2013_11_25_013244_create_licenses_table',
                'batch' => 1,
            ),
            44 => 
            array (
                'id' => 45,
                'migration' => '2013_11_25_031458_create_license_seats_table',
                'batch' => 1,
            ),
            45 => 
            array (
                'id' => 46,
                'migration' => '2013_11_25_032022_add_type_to_actionlog_table',
                'batch' => 1,
            ),
            46 => 
            array (
                'id' => 47,
                'migration' => '2013_11_25_033008_delete_bad_licenses_table',
                'batch' => 1,
            ),
            47 => 
            array (
                'id' => 48,
                'migration' => '2013_11_25_033131_create_new_licenses_table',
                'batch' => 1,
            ),
            48 => 
            array (
                'id' => 49,
                'migration' => '2013_11_25_033534_add_licensed_to_licenses_table',
                'batch' => 1,
            ),
            49 => 
            array (
                'id' => 50,
                'migration' => '2013_11_25_101308_add_warrantee_to_assets_table',
                'batch' => 1,
            ),
            50 => 
            array (
                'id' => 51,
                'migration' => '2013_11_25_104343_alter_warranty_column_on_assets',
                'batch' => 1,
            ),
            51 => 
            array (
                'id' => 52,
                'migration' => '2013_11_25_150450_drop_parent_from_categories',
                'batch' => 1,
            ),
            52 => 
            array (
                'id' => 53,
                'migration' => '2013_11_25_151920_add_depreciate_to_assets',
                'batch' => 1,
            ),
            53 => 
            array (
                'id' => 54,
                'migration' => '2013_11_25_152903_add_depreciate_to_licenses_table',
                'batch' => 1,
            ),
            54 => 
            array (
                'id' => 55,
                'migration' => '2013_11_26_211820_drop_license_from_assets_table',
                'batch' => 1,
            ),
            55 => 
            array (
                'id' => 56,
                'migration' => '2013_11_27_062510_add_note_to_asset_logs_table',
                'batch' => 1,
            ),
            56 => 
            array (
                'id' => 57,
                'migration' => '2013_12_01_113426_add_filename_to_asset_log',
                'batch' => 1,
            ),
            57 => 
            array (
                'id' => 58,
                'migration' => '2013_12_06_094618_add_nullable_to_licenses_table',
                'batch' => 1,
            ),
            58 => 
            array (
                'id' => 59,
                'migration' => '2013_12_10_084038_add_eol_on_models_table',
                'batch' => 1,
            ),
            59 => 
            array (
                'id' => 60,
                'migration' => '2013_12_12_055218_add_manager_to_users_table',
                'batch' => 1,
            ),
            60 => 
            array (
                'id' => 61,
                'migration' => '2014_01_28_031200_add_qr_code_to_settings_table',
                'batch' => 1,
            ),
            61 => 
            array (
                'id' => 62,
                'migration' => '2014_02_13_183016_add_qr_text_to_settings_table',
                'batch' => 1,
            ),
            62 => 
            array (
                'id' => 63,
                'migration' => '2014_05_24_093839_alter_default_license_depreciation_id',
                'batch' => 1,
            ),
            63 => 
            array (
                'id' => 64,
                'migration' => '2014_05_27_231658_alter_default_values_licenses',
                'batch' => 1,
            ),
            64 => 
            array (
                'id' => 65,
                'migration' => '2014_06_19_191508_add_asset_name_to_settings',
                'batch' => 1,
            ),
            65 => 
            array (
                'id' => 66,
                'migration' => '2014_06_20_004847_make_asset_log_checkedout_to_nullable',
                'batch' => 1,
            ),
            66 => 
            array (
                'id' => 67,
                'migration' => '2014_06_20_005050_make_asset_log_purchasedate_to_nullable',
                'batch' => 1,
            ),
            67 => 
            array (
                'id' => 68,
                'migration' => '2014_06_24_003011_add_suppliers',
                'batch' => 1,
            ),
            68 => 
            array (
                'id' => 69,
                'migration' => '2014_06_24_010742_add_supplier_id_to_asset',
                'batch' => 1,
            ),
            69 => 
            array (
                'id' => 70,
                'migration' => '2014_06_24_012839_add_zip_to_supplier',
                'batch' => 1,
            ),
            70 => 
            array (
                'id' => 71,
                'migration' => '2014_06_24_033908_add_url_to_supplier',
                'batch' => 1,
            ),
            71 => 
            array (
                'id' => 72,
                'migration' => '2014_07_08_054116_add_employee_id_to_users',
                'batch' => 1,
            ),
            72 => 
            array (
                'id' => 73,
                'migration' => '2014_07_09_134316_add_requestable_to_assets',
                'batch' => 1,
            ),
            73 => 
            array (
                'id' => 74,
                'migration' => '2014_07_17_085822_add_asset_to_software',
                'batch' => 1,
            ),
            74 => 
            array (
                'id' => 75,
                'migration' => '2014_07_17_161625_make_asset_id_in_logs_nullable',
                'batch' => 1,
            ),
            75 => 
            array (
                'id' => 76,
                'migration' => '2014_08_12_053504_alpha_0_4_2_release',
                'batch' => 1,
            ),
            76 => 
            array (
                'id' => 77,
                'migration' => '2014_08_17_083523_make_location_id_nullable',
                'batch' => 1,
            ),
            77 => 
            array (
                'id' => 78,
                'migration' => '2014_10_16_200626_add_rtd_location_to_assets',
                'batch' => 1,
            ),
            78 => 
            array (
                'id' => 79,
                'migration' => '2014_10_24_000417_alter_supplier_state_to_32',
                'batch' => 1,
            ),
            79 => 
            array (
                'id' => 80,
                'migration' => '2014_10_24_015641_add_display_checkout_date',
                'batch' => 1,
            ),
            80 => 
            array (
                'id' => 81,
                'migration' => '2014_10_28_222654_add_avatar_field_to_users_table',
                'batch' => 1,
            ),
            81 => 
            array (
                'id' => 82,
                'migration' => '2014_10_29_045924_add_image_field_to_models_table',
                'batch' => 1,
            ),
            82 => 
            array (
                'id' => 83,
                'migration' => '2014_11_01_214955_add_eol_display_to_settings',
                'batch' => 1,
            ),
            83 => 
            array (
                'id' => 84,
                'migration' => '2014_11_04_231416_update_group_field_for_reporting',
                'batch' => 1,
            ),
            84 => 
            array (
                'id' => 85,
                'migration' => '2014_11_05_212408_add_fields_to_licenses',
                'batch' => 1,
            ),
            85 => 
            array (
                'id' => 86,
                'migration' => '2014_11_07_021042_add_image_to_supplier',
                'batch' => 1,
            ),
            86 => 
            array (
                'id' => 87,
                'migration' => '2014_11_20_203007_add_username_to_user',
                'batch' => 1,
            ),
            87 => 
            array (
                'id' => 88,
                'migration' => '2014_11_20_223947_add_auto_to_settings',
                'batch' => 1,
            ),
            88 => 
            array (
                'id' => 89,
                'migration' => '2014_11_20_224421_add_prefix_to_settings',
                'batch' => 1,
            ),
            89 => 
            array (
                'id' => 90,
                'migration' => '2014_11_21_104401_change_licence_type',
                'batch' => 1,
            ),
            90 => 
            array (
                'id' => 91,
                'migration' => '2014_12_09_082500_add_fields_maintained_term_to_licenses',
                'batch' => 1,
            ),
            91 => 
            array (
                'id' => 92,
                'migration' => '2015_02_04_155757_increase_user_field_lengths',
                'batch' => 1,
            ),
            92 => 
            array (
                'id' => 93,
                'migration' => '2015_02_07_013537_add_soft_deleted_to_log',
                'batch' => 1,
            ),
            93 => 
            array (
                'id' => 94,
                'migration' => '2015_02_10_040958_fix_bad_assigned_to_ids',
                'batch' => 1,
            ),
            94 => 
            array (
                'id' => 95,
                'migration' => '2015_02_10_053310_migrate_data_to_new_statuses',
                'batch' => 1,
            ),
            95 => 
            array (
                'id' => 96,
                'migration' => '2015_02_11_044104_migrate_make_license_assigned_null',
                'batch' => 1,
            ),
            96 => 
            array (
                'id' => 97,
                'migration' => '2015_02_11_104406_migrate_create_requests_table',
                'batch' => 1,
            ),
            97 => 
            array (
                'id' => 98,
                'migration' => '2015_02_12_001312_add_mac_address_to_asset',
                'batch' => 1,
            ),
            98 => 
            array (
                'id' => 99,
                'migration' => '2015_02_12_024100_change_license_notes_type',
                'batch' => 1,
            ),
            99 => 
            array (
                'id' => 100,
                'migration' => '2015_02_17_231020_add_localonly_to_settings',
                'batch' => 1,
            ),
            100 => 
            array (
                'id' => 101,
                'migration' => '2015_02_19_222322_add_logo_and_colors_to_settings',
                'batch' => 1,
            ),
            101 => 
            array (
                'id' => 102,
                'migration' => '2015_02_24_072043_add_alerts_to_settings',
                'batch' => 1,
            ),
            102 => 
            array (
                'id' => 103,
                'migration' => '2015_02_25_022931_add_eula_fields',
                'batch' => 1,
            ),
            103 => 
            array (
                'id' => 104,
                'migration' => '2015_02_25_204513_add_accessories_table',
                'batch' => 1,
            ),
            104 => 
            array (
                'id' => 105,
                'migration' => '2015_02_26_091228_add_accessories_user_table',
                'batch' => 1,
            ),
            105 => 
            array (
                'id' => 106,
                'migration' => '2015_02_26_115128_add_deleted_at_models',
                'batch' => 1,
            ),
            106 => 
            array (
                'id' => 107,
                'migration' => '2015_02_26_233005_add_category_type',
                'batch' => 1,
            ),
            107 => 
            array (
                'id' => 108,
                'migration' => '2015_03_01_231912_update_accepted_at_to_acceptance_id',
                'batch' => 1,
            ),
            108 => 
            array (
                'id' => 109,
                'migration' => '2015_03_05_011929_add_qr_type_to_settings',
                'batch' => 1,
            ),
            109 => 
            array (
                'id' => 110,
                'migration' => '2015_03_18_055327_add_note_to_user',
                'batch' => 1,
            ),
            110 => 
            array (
                'id' => 111,
                'migration' => '2015_04_29_234704_add_slack_to_settings',
                'batch' => 1,
            ),
            111 => 
            array (
                'id' => 112,
                'migration' => '2015_05_04_085151_add_parent_id_to_locations_table',
                'batch' => 1,
            ),
            112 => 
            array (
                'id' => 113,
                'migration' => '2015_05_22_124421_add_reassignable_to_licenses',
                'batch' => 1,
            ),
            113 => 
            array (
                'id' => 114,
                'migration' => '2015_06_10_003314_fix_default_for_user_notes',
                'batch' => 1,
            ),
            114 => 
            array (
                'id' => 115,
                'migration' => '2015_06_10_003554_create_consumables',
                'batch' => 1,
            ),
            115 => 
            array (
                'id' => 116,
                'migration' => '2015_06_15_183253_move_email_to_username',
                'batch' => 1,
            ),
            116 => 
            array (
                'id' => 117,
                'migration' => '2015_06_23_070346_make_email_nullable',
                'batch' => 1,
            ),
            117 => 
            array (
                'id' => 118,
                'migration' => '2015_06_26_213716_create_asset_maintenances_table',
                'batch' => 1,
            ),
            118 => 
            array (
                'id' => 119,
                'migration' => '2015_07_04_212443_create_custom_fields_table',
                'batch' => 1,
            ),
            119 => 
            array (
                'id' => 120,
                'migration' => '2015_07_09_014359_add_currency_to_settings_and_locations',
                'batch' => 1,
            ),
            120 => 
            array (
                'id' => 121,
                'migration' => '2015_07_21_122022_add_expected_checkin_date_to_asset_logs',
                'batch' => 1,
            ),
            121 => 
            array (
                'id' => 122,
                'migration' => '2015_07_24_093845_add_checkin_email_to_category_table',
                'batch' => 1,
            ),
            122 => 
            array (
                'id' => 123,
                'migration' => '2015_07_25_055415_remove_email_unique_constraint',
                'batch' => 1,
            ),
            123 => 
            array (
                'id' => 124,
                'migration' => '2015_07_29_230054_add_thread_id_to_asset_logs_table',
                'batch' => 1,
            ),
            124 => 
            array (
                'id' => 125,
                'migration' => '2015_07_31_015430_add_accepted_to_assets',
                'batch' => 1,
            ),
            125 => 
            array (
                'id' => 126,
                'migration' => '2015_09_09_195301_add_custom_css_to_settings',
                'batch' => 1,
            ),
            126 => 
            array (
                'id' => 127,
                'migration' => '2015_09_21_235926_create_custom_field_custom_fieldset',
                'batch' => 1,
            ),
            127 => 
            array (
                'id' => 128,
                'migration' => '2015_09_22_000104_create_custom_fieldsets',
                'batch' => 1,
            ),
            128 => 
            array (
                'id' => 129,
                'migration' => '2015_09_22_003321_add_fieldset_id_to_assets',
                'batch' => 1,
            ),
            129 => 
            array (
                'id' => 130,
                'migration' => '2015_09_22_003413_migrate_mac_address',
                'batch' => 1,
            ),
            130 => 
            array (
                'id' => 131,
                'migration' => '2015_09_28_003314_fix_default_purchase_order',
                'batch' => 1,
            ),
            131 => 
            array (
                'id' => 132,
                'migration' => '2015_10_01_024551_add_accessory_consumable_price_info',
                'batch' => 1,
            ),
            132 => 
            array (
                'id' => 133,
                'migration' => '2015_10_12_192706_add_brand_to_settings',
                'batch' => 1,
            ),
            133 => 
            array (
                'id' => 134,
                'migration' => '2015_10_22_003314_fix_defaults_accessories',
                'batch' => 1,
            ),
            134 => 
            array (
                'id' => 135,
                'migration' => '2015_10_23_182625_add_checkout_time_and_expected_checkout_date_to_assets',
                'batch' => 1,
            ),
            135 => 
            array (
                'id' => 136,
                'migration' => '2015_11_05_061015_create_companies_table',
                'batch' => 1,
            ),
            136 => 
            array (
                'id' => 137,
                'migration' => '2015_11_05_061115_add_company_id_to_consumables_table',
                'batch' => 1,
            ),
            137 => 
            array (
                'id' => 138,
                'migration' => '2015_11_05_183749_image',
                'batch' => 1,
            ),
            138 => 
            array (
                'id' => 139,
                'migration' => '2015_11_06_092038_add_company_id_to_accessories_table',
                'batch' => 1,
            ),
            139 => 
            array (
                'id' => 140,
                'migration' => '2015_11_06_100045_add_company_id_to_users_table',
                'batch' => 1,
            ),
            140 => 
            array (
                'id' => 141,
                'migration' => '2015_11_06_134742_add_company_id_to_licenses_table',
                'batch' => 1,
            ),
            141 => 
            array (
                'id' => 142,
                'migration' => '2015_11_08_035832_add_company_id_to_assets_table',
                'batch' => 1,
            ),
            142 => 
            array (
                'id' => 143,
                'migration' => '2015_11_08_222305_add_ldap_fields_to_settings',
                'batch' => 1,
            ),
            143 => 
            array (
                'id' => 144,
                'migration' => '2015_11_15_151803_add_full_multiple_companies_support_to_settings_table',
                'batch' => 1,
            ),
            144 => 
            array (
                'id' => 145,
                'migration' => '2015_11_26_195528_import_ldap_settings',
                'batch' => 1,
            ),
            145 => 
            array (
                'id' => 146,
                'migration' => '2015_11_30_191504_remove_fk_company_id',
                'batch' => 1,
            ),
            146 => 
            array (
                'id' => 147,
                'migration' => '2015_12_21_193006_add_ldap_server_cert_ignore_to_settings_table',
                'batch' => 1,
            ),
            147 => 
            array (
                'id' => 148,
                'migration' => '2015_12_30_233509_add_timestamp_and_userId_to_custom_fields',
                'batch' => 1,
            ),
            148 => 
            array (
                'id' => 149,
                'migration' => '2015_12_30_233658_add_timestamp_and_userId_to_custom_fieldsets',
                'batch' => 1,
            ),
            149 => 
            array (
                'id' => 150,
                'migration' => '2016_01_28_041048_add_notes_to_models',
                'batch' => 1,
            ),
            150 => 
            array (
                'id' => 151,
                'migration' => '2016_02_19_070119_add_remember_token_to_users_table',
                'batch' => 1,
            ),
            151 => 
            array (
                'id' => 152,
                'migration' => '2016_02_19_073625_create_password_resets_table',
                'batch' => 1,
            ),
            152 => 
            array (
                'id' => 153,
                'migration' => '2016_03_02_193043_add_ldap_flag_to_users',
                'batch' => 1,
            ),
            153 => 
            array (
                'id' => 154,
                'migration' => '2016_03_02_220517_update_ldap_filter_to_longer_field',
                'batch' => 1,
            ),
            154 => 
            array (
                'id' => 155,
                'migration' => '2016_03_08_225351_create_components_table',
                'batch' => 1,
            ),
            155 => 
            array (
                'id' => 156,
                'migration' => '2016_03_09_024038_add_min_stock_to_tables',
                'batch' => 1,
            ),
            156 => 
            array (
                'id' => 157,
                'migration' => '2016_03_10_133849_add_locale_to_users',
                'batch' => 1,
            ),
            157 => 
            array (
                'id' => 158,
                'migration' => '2016_03_10_135519_add_locale_to_settings',
                'batch' => 1,
            ),
            158 => 
            array (
                'id' => 159,
                'migration' => '2016_03_11_185621_add_label_settings_to_settings',
                'batch' => 1,
            ),
            159 => 
            array (
                'id' => 160,
                'migration' => '2016_03_22_125911_fix_custom_fields_regexes',
                'batch' => 1,
            ),
            160 => 
            array (
                'id' => 161,
                'migration' => '2016_04_28_141554_add_show_to_users',
                'batch' => 1,
            ),
            161 => 
            array (
                'id' => 162,
                'migration' => '2016_05_16_164733_add_model_mfg_to_consumable',
                'batch' => 1,
            ),
            162 => 
            array (
                'id' => 163,
                'migration' => '2016_05_19_180351_add_alt_barcode_settings',
                'batch' => 1,
            ),
            163 => 
            array (
                'id' => 164,
                'migration' => '2016_05_19_191146_add_alter_interval',
                'batch' => 1,
            ),
            164 => 
            array (
                'id' => 165,
                'migration' => '2016_05_19_192226_add_inventory_threshold',
                'batch' => 1,
            ),
            165 => 
            array (
                'id' => 166,
                'migration' => '2016_05_20_024859_remove_option_keys_from_settings_table',
                'batch' => 1,
            ),
            166 => 
            array (
                'id' => 167,
                'migration' => '2016_05_20_143758_remove_option_value_from_settings_table',
                'batch' => 1,
            ),
            167 => 
            array (
                'id' => 168,
                'migration' => '2016_06_01_000001_create_oauth_auth_codes_table',
                'batch' => 1,
            ),
            168 => 
            array (
                'id' => 169,
                'migration' => '2016_06_01_000002_create_oauth_access_tokens_table',
                'batch' => 1,
            ),
            169 => 
            array (
                'id' => 170,
                'migration' => '2016_06_01_000003_create_oauth_refresh_tokens_table',
                'batch' => 1,
            ),
            170 => 
            array (
                'id' => 171,
                'migration' => '2016_06_01_000004_create_oauth_clients_table',
                'batch' => 1,
            ),
            171 => 
            array (
                'id' => 172,
                'migration' => '2016_06_01_000005_create_oauth_personal_access_clients_table',
                'batch' => 1,
            ),
            172 => 
            array (
                'id' => 173,
                'migration' => '2016_06_01_140218_add_email_domain_and_format_to_settings',
                'batch' => 1,
            ),
            173 => 
            array (
                'id' => 174,
                'migration' => '2016_06_22_160725_add_user_id_to_maintenances',
                'batch' => 1,
            ),
            174 => 
            array (
                'id' => 175,
                'migration' => '2016_07_13_150015_add_is_ad_to_settings',
                'batch' => 1,
            ),
            175 => 
            array (
                'id' => 176,
                'migration' => '2016_07_14_153609_add_ad_domain_to_settings',
                'batch' => 1,
            ),
            176 => 
            array (
                'id' => 177,
                'migration' => '2016_07_22_003348_fix_custom_fields_regex_stuff',
                'batch' => 1,
            ),
            177 => 
            array (
                'id' => 178,
                'migration' => '2016_07_22_054850_one_more_mac_addr_fix',
                'batch' => 1,
            ),
            178 => 
            array (
                'id' => 179,
                'migration' => '2016_07_22_143045_add_port_to_ldap_settings',
                'batch' => 1,
            ),
            179 => 
            array (
                'id' => 180,
                'migration' => '2016_07_22_153432_add_tls_to_ldap_settings',
                'batch' => 1,
            ),
            180 => 
            array (
                'id' => 181,
                'migration' => '2016_07_27_211034_add_zerofill_to_settings',
                'batch' => 1,
            ),
            181 => 
            array (
                'id' => 182,
                'migration' => '2016_08_02_124944_add_color_to_statuslabel',
                'batch' => 1,
            ),
            182 => 
            array (
                'id' => 183,
                'migration' => '2016_08_04_134500_add_disallow_ldap_pw_sync_to_settings',
                'batch' => 1,
            ),
            183 => 
            array (
                'id' => 184,
                'migration' => '2016_08_09_002225_add_manufacturer_to_licenses',
                'batch' => 1,
            ),
            184 => 
            array (
                'id' => 185,
                'migration' => '2016_08_12_121613_add_manufacturer_to_accessories_table',
                'batch' => 1,
            ),
            185 => 
            array (
                'id' => 186,
                'migration' => '2016_08_23_143353_add_new_fields_to_custom_fields',
                'batch' => 1,
            ),
            186 => 
            array (
                'id' => 187,
                'migration' => '2016_08_23_145619_add_show_in_nav_to_status_labels',
                'batch' => 1,
            ),
            187 => 
            array (
                'id' => 188,
                'migration' => '2016_08_30_084634_make_purchase_cost_nullable',
                'batch' => 1,
            ),
            188 => 
            array (
                'id' => 189,
                'migration' => '2016_09_01_141051_add_requestable_to_asset_model',
                'batch' => 1,
            ),
            189 => 
            array (
                'id' => 190,
                'migration' => '2016_09_02_001448_create_checkout_requests_table',
                'batch' => 1,
            ),
            190 => 
            array (
                'id' => 191,
                'migration' => '2016_09_04_180400_create_actionlog_table',
                'batch' => 1,
            ),
            191 => 
            array (
                'id' => 192,
                'migration' => '2016_09_04_182149_migrate_asset_log_to_action_log',
                'batch' => 1,
            ),
            192 => 
            array (
                'id' => 193,
                'migration' => '2016_09_19_235935_fix_fieldtype_for_target_type',
                'batch' => 1,
            ),
            193 => 
            array (
                'id' => 194,
                'migration' => '2016_09_23_140722_fix_modelno_in_consumables_to_string',
                'batch' => 1,
            ),
            194 => 
            array (
                'id' => 195,
                'migration' => '2016_09_28_231359_add_company_to_logs',
                'batch' => 1,
            ),
            195 => 
            array (
                'id' => 196,
                'migration' => '2016_10_14_130709_fix_order_number_to_varchar',
                'batch' => 1,
            ),
            196 => 
            array (
                'id' => 197,
                'migration' => '2016_10_16_015024_rename_modelno_to_model_number',
                'batch' => 1,
            ),
            197 => 
            array (
                'id' => 198,
                'migration' => '2016_10_16_015211_rename_consumable_modelno_to_model_number',
                'batch' => 1,
            ),
            198 => 
            array (
                'id' => 199,
                'migration' => '2016_10_16_143235_rename_model_note_to_notes',
                'batch' => 1,
            ),
            199 => 
            array (
                'id' => 200,
                'migration' => '2016_10_16_165052_rename_component_total_qty_to_qty',
                'batch' => 1,
            ),
            200 => 
            array (
                'id' => 201,
                'migration' => '2016_10_19_145520_fix_order_number_in_components_to_string',
                'batch' => 1,
            ),
            201 => 
            array (
                'id' => 202,
                'migration' => '2016_10_27_151715_add_serial_to_components',
                'batch' => 1,
            ),
            202 => 
            array (
                'id' => 203,
                'migration' => '2016_10_27_213251_increase_serial_field_capacity',
                'batch' => 1,
            ),
            203 => 
            array (
                'id' => 204,
                'migration' => '2016_10_29_002724_enable_2fa_fields',
                'batch' => 1,
            ),
            204 => 
            array (
                'id' => 205,
                'migration' => '2016_10_29_082408_add_signature_to_acceptance',
                'batch' => 1,
            ),
            205 => 
            array (
                'id' => 206,
                'migration' => '2016_11_01_030818_fix_forgotten_filename_in_action_logs',
                'batch' => 1,
            ),
            206 => 
            array (
                'id' => 207,
                'migration' => '2016_11_13_020954_rename_component_serial_number_to_serial',
                'batch' => 1,
            ),
            207 => 
            array (
                'id' => 208,
                'migration' => '2016_11_16_172119_increase_purchase_cost_size',
                'batch' => 1,
            ),
            208 => 
            array (
                'id' => 209,
                'migration' => '2016_11_17_161317_longer_state_field_in_location',
                'batch' => 1,
            ),
            209 => 
            array (
                'id' => 210,
                'migration' => '2016_11_17_193706_add_model_number_to_accessories',
                'batch' => 1,
            ),
            210 => 
            array (
                'id' => 211,
                'migration' => '2016_11_24_160405_add_missing_target_type_to_logs_table',
                'batch' => 1,
            ),
            211 => 
            array (
                'id' => 212,
                'migration' => '2016_12_07_173720_increase_size_of_state_in_suppliers',
                'batch' => 1,
            ),
            212 => 
            array (
                'id' => 213,
                'migration' => '2016_12_19_004212_adjust_locale_length_to_10',
                'batch' => 2,
            ),
            213 => 
            array (
                'id' => 214,
                'migration' => '2016_12_19_133936_extend_phone_lengths_in_supplier_and_elsewhere',
                'batch' => 2,
            ),
            214 => 
            array (
                'id' => 215,
                'migration' => '2016_12_27_212631_make_asset_assigned_to_polymorphic',
                'batch' => 2,
            ),
            215 => 
            array (
                'id' => 216,
                'migration' => '2017_01_09_040429_create_locations_ldap_query_field',
                'batch' => 2,
            ),
            216 => 
            array (
                'id' => 217,
                'migration' => '2017_01_14_002418_create_imports_table',
                'batch' => 2,
            ),
            217 => 
            array (
                'id' => 218,
                'migration' => '2017_01_25_063357_fix_utf8_custom_field_column_names',
                'batch' => 2,
            ),
            218 => 
            array (
                'id' => 219,
                'migration' => '2017_03_03_154632_add_time_date_display_to_settings',
                'batch' => 2,
            ),
            219 => 
            array (
                'id' => 220,
                'migration' => '2017_03_10_210807_add_fields_to_manufacturer',
                'batch' => 2,
            ),
            220 => 
            array (
                'id' => 221,
                'migration' => '2017_05_08_195520_increase_size_of_field_values_in_custom_fields',
                'batch' => 2,
            ),
            221 => 
            array (
                'id' => 222,
                'migration' => '2017_05_22_204422_create_departments',
                'batch' => 2,
            ),
            222 => 
            array (
                'id' => 223,
                'migration' => '2017_05_22_233509_add_manager_to_locations_table',
                'batch' => 2,
            ),
            223 => 
            array (
                'id' => 224,
                'migration' => '2017_06_14_122059_add_next_autoincrement_to_settings',
                'batch' => 2,
            ),
            224 => 
            array (
                'id' => 225,
                'migration' => '2017_06_18_151753_add_header_and_first_row_to_importer_table',
                'batch' => 2,
            ),
            225 => 
            array (
                'id' => 226,
                'migration' => '2017_07_07_191533_add_login_text',
                'batch' => 2,
            ),
            226 => 
            array (
                'id' => 227,
                'migration' => '2017_07_25_130710_add_thumbsize_to_settings',
                'batch' => 2,
            ),
            227 => 
            array (
                'id' => 228,
                'migration' => '2017_08_03_160105_set_asset_archived_to_zero_default',
                'batch' => 2,
            ),
            228 => 
            array (
                'id' => 229,
                'migration' => '2017_08_22_180636_add_secure_password_options',
                'batch' => 2,
            ),
            229 => 
            array (
                'id' => 230,
                'migration' => '2017_08_25_074822_add_auditing_tables',
                'batch' => 2,
            ),
            230 => 
            array (
                'id' => 231,
                'migration' => '2017_08_25_101435_add_auditing_to_settings',
                'batch' => 2,
            ),
            231 => 
            array (
                'id' => 232,
                'migration' => '2017_09_18_225619_fix_assigned_type_not_being_nulled',
                'batch' => 2,
            ),
            232 => 
            array (
                'id' => 233,
                'migration' => '2017_10_03_015503_drop_foreign_keys',
                'batch' => 2,
            ),
            233 => 
            array (
                'id' => 234,
                'migration' => '2017_10_10_123504_allow_nullable_depreciation_id_in_models',
                'batch' => 2,
            ),
            234 => 
            array (
                'id' => 235,
                'migration' => '2017_10_17_133709_add_display_url_to_settings',
                'batch' => 2,
            ),
            235 => 
            array (
                'id' => 236,
                'migration' => '2017_10_19_120002_add_custom_forgot_password_url',
                'batch' => 2,
            ),
            236 => 
            array (
                'id' => 237,
                'migration' => '2017_10_19_130406_add_image_and_supplier_to_accessories',
                'batch' => 2,
            ),
            237 => 
            array (
                'id' => 238,
                'migration' => '2017_10_20_234129_add_location_indices_to_assets',
                'batch' => 2,
            ),
            238 => 
            array (
                'id' => 239,
                'migration' => '2017_10_25_202930_add_images_uploads_to_locations_manufacturers_etc',
                'batch' => 2,
            ),
            239 => 
            array (
                'id' => 240,
                'migration' => '2017_10_27_180947_denorm_asset_locations',
                'batch' => 2,
            ),
            240 => 
            array (
                'id' => 241,
                'migration' => '2017_10_27_192423_migrate_denormed_asset_locations',
                'batch' => 2,
            ),
            241 => 
            array (
                'id' => 242,
                'migration' => '2017_10_30_182938_add_address_to_user',
                'batch' => 2,
            ),
            242 => 
            array (
                'id' => 243,
                'migration' => '2017_11_08_025918_add_alert_menu_setting',
                'batch' => 2,
            ),
            243 => 
            array (
                'id' => 244,
                'migration' => '2017_11_08_123942_labels_display_company_name',
                'batch' => 2,
            ),
            244 => 
            array (
                'id' => 245,
                'migration' => '2017_12_12_010457_normalize_asset_last_audit_date',
                'batch' => 2,
            ),
            245 => 
            array (
                'id' => 246,
                'migration' => '2017_12_12_033618_add_actionlog_meta',
                'batch' => 2,
            ),
            246 => 
            array (
                'id' => 247,
                'migration' => '2017_12_26_170856_re_normalize_last_audit',
                'batch' => 2,
            ),
            247 => 
            array (
                'id' => 248,
                'migration' => '2018_01_17_184354_add_archived_in_list_setting',
                'batch' => 2,
            ),
            248 => 
            array (
                'id' => 249,
                'migration' => '2018_01_19_203121_add_dashboard_message_to_settings',
                'batch' => 2,
            ),
            249 => 
            array (
                'id' => 250,
                'migration' => '2018_01_24_062633_add_footer_settings_to_settings',
                'batch' => 2,
            ),
            250 => 
            array (
                'id' => 251,
                'migration' => '2018_01_24_093426_add_modellist_preferenc',
                'batch' => 2,
            ),
            251 => 
            array (
                'id' => 252,
                'migration' => '2018_02_22_160436_add_remote_user_settings',
                'batch' => 2,
            ),
            252 => 
            array (
                'id' => 253,
                'migration' => '2018_03_03_011032_add_theme_to_settings',
                'batch' => 2,
            ),
            253 => 
            array (
                'id' => 254,
                'migration' => '2018_03_06_054937_add_default_flag_on_statuslabels',
                'batch' => 2,
            ),
            254 => 
            array (
                'id' => 255,
                'migration' => '2018_03_23_212048_add_display_in_email_to_custom_fields',
                'batch' => 2,
            ),
            255 => 
            array (
                'id' => 256,
                'migration' => '2018_03_24_030738_add_show_images_in_email_setting',
                'batch' => 2,
            ),
            256 => 
            array (
                'id' => 257,
                'migration' => '2018_03_24_050108_add_cc_alerts',
                'batch' => 2,
            ),
            257 => 
            array (
                'id' => 258,
                'migration' => '2018_03_29_053618_add_canceled_at_and_fulfilled_at_in_requests',
                'batch' => 2,
            ),
            258 => 
            array (
                'id' => 259,
                'migration' => '2018_03_29_070121_add_drop_unique_requests',
                'batch' => 2,
            ),
            259 => 
            array (
                'id' => 260,
                'migration' => '2018_03_29_070511_add_new_index_requestable',
                'batch' => 2,
            ),
            260 => 
            array (
                'id' => 261,
                'migration' => '2018_04_02_150700_labels_display_model_name',
                'batch' => 2,
            ),
            261 => 
            array (
                'id' => 262,
                'migration' => '2018_04_16_133902_create_custom_field_default_values_table',
                'batch' => 2,
            ),
            262 => 
            array (
                'id' => 263,
                'migration' => '2018_05_04_073223_add_category_to_licenses',
                'batch' => 2,
            ),
            263 => 
            array (
                'id' => 264,
                'migration' => '2018_05_04_075235_add_update_license_category',
                'batch' => 2,
            ),
            264 => 
            array (
                'id' => 265,
                'migration' => '2018_05_08_031515_add_gdpr_privacy_footer',
                'batch' => 2,
            ),
            265 => 
            array (
                'id' => 266,
                'migration' => '2018_05_14_215229_add_indexes',
                'batch' => 2,
            ),
            266 => 
            array (
                'id' => 267,
                'migration' => '2018_05_14_223646_add_indexes_to_assets',
                'batch' => 2,
            ),
            267 => 
            array (
                'id' => 268,
                'migration' => '2018_05_14_233638_denorm_counters_on_assets',
                'batch' => 2,
            ),
            268 => 
            array (
                'id' => 269,
                'migration' => '2018_05_16_153409_add_first_counter_totals_to_assets',
                'batch' => 2,
            ),
            269 => 
            array (
                'id' => 270,
                'migration' => '2018_06_21_134622_add_version_footer',
                'batch' => 2,
            ),
            270 => 
            array (
                'id' => 271,
                'migration' => '2018_07_05_215440_add_unique_serial_option_to_settings',
                'batch' => 2,
            ),
            271 => 
            array (
                'id' => 272,
                'migration' => '2018_07_17_005911_create_login_attempts_table',
                'batch' => 2,
            ),
            272 => 
            array (
                'id' => 273,
                'migration' => '2018_07_24_154348_add_logo_to_print_assets',
                'batch' => 2,
            ),
            273 => 
            array (
                'id' => 274,
                'migration' => '2018_07_28_023826_create_checkout_acceptances_table',
                'batch' => 2,
            ),
            274 => 
            array (
                'id' => 275,
                'migration' => '2018_08_20_204842_add_depreciation_option_to_settings',
                'batch' => 2,
            ),
            275 => 
            array (
                'id' => 276,
                'migration' => '2018_09_10_082212_create_checkout_acceptances_for_unaccepted_assets',
                'batch' => 2,
            ),
            276 => 
            array (
                'id' => 277,
                'migration' => '2018_10_18_191228_add_kits_licenses_table',
                'batch' => 2,
            ),
            277 => 
            array (
                'id' => 278,
                'migration' => '2018_10_19_153910_add_kits_table',
                'batch' => 2,
            ),
            278 => 
            array (
                'id' => 279,
                'migration' => '2018_10_19_154013_add_kits_models_table',
                'batch' => 2,
            ),
            279 => 
            array (
                'id' => 280,
                'migration' => '2018_12_05_211936_add_favicon_to_settings',
                'batch' => 2,
            ),
            280 => 
            array (
                'id' => 281,
                'migration' => '2018_12_05_212119_add_email_logo_to_settings',
                'batch' => 2,
            ),
            281 => 
            array (
                'id' => 282,
                'migration' => '2019_02_07_185953_add_kits_consumables_table',
                'batch' => 2,
            ),
            282 => 
            array (
                'id' => 283,
                'migration' => '2019_02_07_190030_add_kits_accessories_table',
                'batch' => 2,
            ),
            283 => 
            array (
                'id' => 284,
                'migration' => '2019_02_12_182750_add_actiondate_to_actionlog',
                'batch' => 2,
            ),
            284 => 
            array (
                'id' => 285,
                'migration' => '2019_02_14_154310_change_auto_increment_prefix_to_nullable',
                'batch' => 2,
            ),
            285 => 
            array (
                'id' => 286,
                'migration' => '2019_02_16_143518_auto_increment_back_to_string',
                'batch' => 2,
            ),
            286 => 
            array (
                'id' => 287,
                'migration' => '2019_02_17_205048_add_label_logo_to_settings',
                'batch' => 2,
            ),
            287 => 
            array (
                'id' => 288,
                'migration' => '2019_02_20_234421_make_serial_nullable',
                'batch' => 2,
            ),
            288 => 
            array (
                'id' => 289,
                'migration' => '2019_02_21_224703_make_fields_nullable_for_integrity',
                'batch' => 2,
            ),
            289 => 
            array (
                'id' => 290,
                'migration' => '2019_04_06_060145_add_user_skin_setting',
                'batch' => 2,
            ),
            290 => 
            array (
                'id' => 291,
                'migration' => '2019_04_06_205355_add_setting_allow_user_skin',
                'batch' => 2,
            ),
            291 => 
            array (
                'id' => 292,
                'migration' => '2019_06_12_184327_rename_groups_table',
                'batch' => 2,
            ),
            292 => 
            array (
                'id' => 293,
                'migration' => '2019_07_23_140906_add_show_assigned_assets_to_settings',
                'batch' => 2,
            ),
            293 => 
            array (
                'id' => 294,
                'migration' => '2019_08_20_084049_add_custom_remote_user_header',
                'batch' => 2,
            ),
            294 => 
            array (
                'id' => 295,
                'migration' => '2019_12_04_223111_passport_upgrade',
                'batch' => 2,
            ),
            295 => 
            array (
                'id' => 296,
                'migration' => '2020_02_04_172100_add_ad_append_domain_settings',
                'batch' => 2,
            ),
            296 => 
            array (
                'id' => 297,
                'migration' => '2020_04_29_222305_add_saml_fields_to_settings',
                'batch' => 2,
            ),
            297 => 
            array (
                'id' => 298,
                'migration' => '2020_08_11_200712_add_saml_key_rollover',
                'batch' => 2,
            ),
            298 => 
            array (
                'id' => 299,
                'migration' => '2020_10_22_233743_move_accessory_checkout_note_to_join_table',
                'batch' => 2,
            ),
            299 => 
            array (
                'id' => 300,
                'migration' => '2020_10_23_161736_fix_zero_values_for_locations',
                'batch' => 2,
            ),
            300 => 
            array (
                'id' => 301,
                'migration' => '2020_11_18_214827_widen_license_serial_field',
                'batch' => 2,
            ),
            301 => 
            array (
                'id' => 302,
                'migration' => '2020_12_14_233815_add_digit_separator_to_settings',
                'batch' => 2,
            ),
            302 => 
            array (
                'id' => 303,
                'migration' => '2020_12_18_090026_swap_target_type_index_order',
                'batch' => 2,
            ),
            303 => 
            array (
                'id' => 304,
                'migration' => '2020_12_21_153235_update_min_password',
                'batch' => 2,
            ),
            304 => 
            array (
                'id' => 305,
                'migration' => '2020_12_21_210105_fix_bad_ldap_server_url_for_v5',
                'batch' => 2,
            ),
            305 => 
            array (
                'id' => 306,
                'migration' => '2021_02_05_172502_add_provider_to_oauth_table',
                'batch' => 2,
            ),
            306 => 
            array (
                'id' => 307,
                'migration' => '2021_03_18_184102_adds_several_ldap_fields',
                'batch' => 2,
            ),
            307 => 
            array (
                'id' => 308,
                'migration' => '2021_04_07_001811_add_ldap_dept',
                'batch' => 2,
            ),
            308 => 
            array (
                'id' => 309,
                'migration' => '2021_04_14_180125_add_ids_to_tables',
                'batch' => 2,
            ),
            309 => 
            array (
                'id' => 310,
                'migration' => '2021_04_14_180125_add_ids_to_tables',
                'batch' => 3,
            ),
            310 => 
            array (
                'id' => 311,
                'migration' => '2021_06_07_155421_add_serial_number_indexes',
                'batch' => 2,
            ),
            311 => 
            array (
                'id' => 312,
                'migration' => '2021_06_07_155436_add_company_id_indexes',
                'batch' => 2,
            ),
            312 => 
            array (
                'id' => 313,
                'migration' => '2021_11_21_083327_create_accessories_table',
                'batch' => 1,
            ),
            313 => 
            array (
                'id' => 314,
                'migration' => '2021_11_21_083327_create_accessories_users_table',
                'batch' => 1,
            ),
            314 => 
            array (
                'id' => 315,
                'migration' => '2021_11_21_083327_create_action_logs_table',
                'batch' => 1,
            ),
            315 => 
            array (
                'id' => 316,
                'migration' => '2021_11_21_083327_create_asset_logs_table',
                'batch' => 1,
            ),
            316 => 
            array (
                'id' => 317,
                'migration' => '2021_11_21_083327_create_asset_maintenances_table',
                'batch' => 1,
            ),
            317 => 
            array (
                'id' => 318,
                'migration' => '2021_11_21_083327_create_asset_uploads_table',
                'batch' => 1,
            ),
            318 => 
            array (
                'id' => 319,
                'migration' => '2021_11_21_083327_create_assets_table',
                'batch' => 1,
            ),
            319 => 
            array (
                'id' => 320,
                'migration' => '2021_11_21_083327_create_categories_table',
                'batch' => 1,
            ),
            320 => 
            array (
                'id' => 321,
                'migration' => '2021_11_21_083327_create_checkout_acceptances_table',
                'batch' => 1,
            ),
            321 => 
            array (
                'id' => 322,
                'migration' => '2021_11_21_083327_create_checkout_requests_table',
                'batch' => 1,
            ),
            322 => 
            array (
                'id' => 323,
                'migration' => '2021_11_21_083327_create_companies_table',
                'batch' => 1,
            ),
            323 => 
            array (
                'id' => 324,
                'migration' => '2021_11_21_083327_create_components_table',
                'batch' => 1,
            ),
            324 => 
            array (
                'id' => 325,
                'migration' => '2021_11_21_083327_create_components_assets_table',
                'batch' => 1,
            ),
            325 => 
            array (
                'id' => 326,
                'migration' => '2021_11_21_083327_create_consumables_table',
                'batch' => 1,
            ),
            326 => 
            array (
                'id' => 327,
                'migration' => '2021_11_21_083327_create_consumables_users_table',
                'batch' => 1,
            ),
            327 => 
            array (
                'id' => 328,
                'migration' => '2021_11_21_083327_create_custom_field_custom_fieldset_table',
                'batch' => 1,
            ),
            328 => 
            array (
                'id' => 329,
                'migration' => '2021_11_21_083327_create_custom_fields_table',
                'batch' => 1,
            ),
            329 => 
            array (
                'id' => 330,
                'migration' => '2021_11_21_083327_create_custom_fieldsets_table',
                'batch' => 1,
            ),
            330 => 
            array (
                'id' => 331,
                'migration' => '2021_11_21_083327_create_departments_table',
                'batch' => 1,
            ),
            331 => 
            array (
                'id' => 332,
                'migration' => '2021_11_21_083327_create_depreciations_table',
                'batch' => 1,
            ),
            332 => 
            array (
                'id' => 333,
                'migration' => '2021_11_21_083327_create_imports_table',
                'batch' => 1,
            ),
            333 => 
            array (
                'id' => 334,
                'migration' => '2021_11_21_083327_create_kits_table',
                'batch' => 1,
            ),
            334 => 
            array (
                'id' => 335,
                'migration' => '2021_11_21_083327_create_kits_accessories_table',
                'batch' => 1,
            ),
            335 => 
            array (
                'id' => 336,
                'migration' => '2021_11_21_083327_create_kits_consumables_table',
                'batch' => 1,
            ),
            336 => 
            array (
                'id' => 337,
                'migration' => '2021_11_21_083327_create_kits_licenses_table',
                'batch' => 1,
            ),
            337 => 
            array (
                'id' => 338,
                'migration' => '2021_11_21_083327_create_kits_models_table',
                'batch' => 1,
            ),
            338 => 
            array (
                'id' => 339,
                'migration' => '2021_11_21_083327_create_license_seats_table',
                'batch' => 1,
            ),
            339 => 
            array (
                'id' => 340,
                'migration' => '2021_11_21_083327_create_licenses_table',
                'batch' => 1,
            ),
            340 => 
            array (
                'id' => 341,
                'migration' => '2021_11_21_083327_create_locations_table',
                'batch' => 1,
            ),
            341 => 
            array (
                'id' => 342,
                'migration' => '2021_11_21_083327_create_login_attempts_table',
                'batch' => 1,
            ),
            342 => 
            array (
                'id' => 343,
                'migration' => '2021_11_21_083327_create_manufacturers_table',
                'batch' => 1,
            ),
            343 => 
            array (
                'id' => 344,
                'migration' => '2021_11_21_083327_create_models_table',
                'batch' => 1,
            ),
            344 => 
            array (
                'id' => 345,
                'migration' => '2021_11_21_083327_create_models_custom_fields_table',
                'batch' => 1,
            ),
            345 => 
            array (
                'id' => 346,
                'migration' => '2021_11_21_083327_create_oauth_access_tokens_table',
                'batch' => 1,
            ),
            346 => 
            array (
                'id' => 347,
                'migration' => '2021_11_21_083327_create_oauth_auth_codes_table',
                'batch' => 1,
            ),
            347 => 
            array (
                'id' => 348,
                'migration' => '2021_11_21_083327_create_oauth_clients_table',
                'batch' => 1,
            ),
            348 => 
            array (
                'id' => 349,
                'migration' => '2021_11_21_083327_create_oauth_personal_access_clients_table',
                'batch' => 1,
            ),
            349 => 
            array (
                'id' => 350,
                'migration' => '2021_11_21_083327_create_oauth_refresh_tokens_table',
                'batch' => 1,
            ),
            350 => 
            array (
                'id' => 351,
                'migration' => '2021_11_21_083327_create_password_resets_table',
                'batch' => 1,
            ),
            351 => 
            array (
                'id' => 352,
                'migration' => '2021_11_21_083327_create_permission_groups_table',
                'batch' => 1,
            ),
            352 => 
            array (
                'id' => 353,
                'migration' => '2021_11_21_083327_create_requested_assets_table',
                'batch' => 1,
            ),
            353 => 
            array (
                'id' => 354,
                'migration' => '2021_11_21_083327_create_requests_table',
                'batch' => 1,
            ),
            354 => 
            array (
                'id' => 355,
                'migration' => '2021_11_21_083327_create_settings_table',
                'batch' => 1,
            ),
            355 => 
            array (
                'id' => 356,
                'migration' => '2021_11_21_083327_create_status_labels_table',
                'batch' => 1,
            ),
            356 => 
            array (
                'id' => 357,
                'migration' => '2021_11_21_083327_create_suppliers_table',
                'batch' => 1,
            ),
            357 => 
            array (
                'id' => 358,
                'migration' => '2021_11_21_083327_create_throttle_table',
                'batch' => 1,
            ),
            358 => 
            array (
                'id' => 359,
                'migration' => '2021_11_21_083327_create_users_table',
                'batch' => 1,
            ),
            359 => 
            array (
                'id' => 360,
                'migration' => '2021_11_21_083327_create_users_groups_table',
                'batch' => 1,
            ),
        ));
        
        
    }
}