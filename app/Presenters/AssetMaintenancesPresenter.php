<?php

namespace App\Presenters;

/**
 * Class AssetModelPresenter
 */
class AssetMaintenancesPresenter extends Presenter
{
    /**
     * Json Column Layout for bootstrap table
     * @return string
     */
    public static function dataTableLayout()
    {
        $layout = [
            [
                'field' => 'id',
                'searchable' => false,
                'sortable' => true,
                'switchable' => true,
                'title' => 'No. Urut',
            ], [
                'field' => 'company',
                'searchable' => true,
                'sortable' => true,
                'switchable' => true,
                'title' => trans('admin/companies/table.title'),
                'visible' => false,
                'formatter' => 'companiesLinkObjFormatter',
            ], [
                'field' => 'asset_name',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('admin/asset_maintenances/table.asset_name'),
                'formatter' => 'assetNameLinkFormatter',
            ], [
                'field' => 'asset_tag',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('admin/hardware/table.asset_tag'),
                'formatter' => 'assetTagLinkFormatter',
                'visible' => false,
            ], [
                "field" => "pemegang",
                "searchable" => true,
                "sortable" => true,
                "title" => "Nama Pemegang Aset",
                "visible" => true,
                "formatter" => "usersLinkObjFormatter"
            ], [
                "field" => "employee_number",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('admin/users/table.employee_num'),
                "visible" => true,
                "formatter" => "employeeLinkFormatter"
            ], [
                "field" => "nip_baru",
                "searchable" => true,
                "sortable" => true,
                "switchable" => true,
                "title" => 'NIP Baru',
                "visible" => false,
                "formatter" => "nipBaruLinkFormatter"
            ], [
                "field" => "bmn",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('admin/hardware/form.bmn'),
                "formatter" => "bmnLinkFormatter"
            ], [
                "field" => "serial",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('admin/hardware/form.serial'),
                "formatter" => "serialLinkFormatter"
            ], [

                'field' => 'model',
                'searchable' => true,
                'sortable' => true,
                'switchable' => true,
                'title' => trans('admin/hardware/form.model'),
                'visible' => false,
                'formatter' => 'modelsLinkObjFormatter',
            ], [
                'field' => 'supplier',
                'searchable' => true,
                'sortable' => true,
                'switchable' => true,
                'title' => trans('general.supplier'),
                'visible' => false,
                'formatter' => 'suppliersLinkObjFormatter',
            ], 
            // [
            //     'field' => 'location',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'title' => trans('general.location'),
            //     'formatter' => 'locationsLinkObjFormatter',
            // ], 
            [
                'field' => 'asset_maintenance_type',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('admin/asset_maintenances/form.asset_maintenance_type'),
            ], [
                'field' => 'title',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('admin/asset_maintenances/form.title'),
            ], [
                'field' => 'start_date',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('admin/asset_maintenances/form.start_date'),
                'formatter' => 'dateDisplayFormatter',
            ], [
                'field' => 'completion_date',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('admin/asset_maintenances/form.completion_date'),
                'formatter' => 'dateDisplayFormatter',
            ], [
                'field' => 'notes',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('admin/asset_maintenances/form.notes'),
            ], [
                "field" => "lokasi_barang",
                "searchable" => true,
                "sortable" => true,
                "title" => 'Lokasi Barang',
            ], [
                "field" => "tiket",
                "searchable" => true,
                "sortable" => true,
                "title" => trans('admin/asset_maintenances/form.tiket'),
            ], 
            // [
            //     'field' => 'is_warranty',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'title' => trans('admin/asset_maintenances/table.is_warranty'),
            //     'formatter' => 'trueFalseFormatter'
            // ], 
            [
                'field' => 'cost',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('admin/asset_maintenances/form.cost'),
                'class' => 'text-right',
                'visible' => false,
            ], [
                'field' => 'user_id',
                'searchable' => true,
                'sortable' => true,
                'title' => trans('general.admin'),
                'formatter' => 'usersLinkObjFormatter',
            ], [
                'field' => 'actions',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => trans('table.actions'),
                'visible' => true,
                'formatter' => 'maintenancesActionsFormatter',
            ],
        ];

        return json_encode($layout);
    }
}
