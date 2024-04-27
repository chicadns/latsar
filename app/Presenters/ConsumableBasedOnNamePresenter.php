<?php

namespace App\Presenters;

class ConsumableBasedOnNamePresenter extends Presenter
{
    public static function dataTableLayout()
    {
        $layout = [
            [
                'field' => 'type',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => 'Jenis Transaksi',
                'visible' => true,
                'formatter' => 'consumablestransactionStateObjFormatter',
            ],
            [
                'field' => 'state',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => 'Status',
                'visible' => true,
                'formatter' => 'consumablestransactionStateObjFormatter',
            ],
            [
                'field' => 'qty',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => 'Jumlah',
                'visible' => true,
            ],
            [
                'field' => 'created_at',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => trans('general.date'),
                'visible' => true,
            ],
            [
                'field' => 'name',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => trans('general.user'),
                'visible' => true,
            ],
            [
                'field' => 'company_user',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => 'Satuan/Unit Kerja Penerima',
                'visible' => true,
            ],
            [
                'field' => 'note',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => trans('general.notes'),
                'visible' => true,
            ],
            [
                'field' => 'employee_num',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => 'PJ',
                'visible' => true,
            ],
            [
                'field' => 'admin',
                'searchable' => false,
                'sortable' => false,
                'switchable' => false,
                'title' => trans('general.admin'),
                'visible' => true,
            ],
        ];
        return json_encode($layout);
    }
}