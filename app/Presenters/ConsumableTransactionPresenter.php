<?php

namespace App\Presenters;

/**
 * Class ComponentPresenter
 */
class ConsumableTransactionPresenter extends Presenter
{
    /**
     * Json Column Layout for bootstrap table
     * @return string
     */
    // field pada layout bisa dilihat melalui consumablecontroller -> consumabletransformer -> consumablepresenter
    // lokasi formatter di bootstrap-table di partial
    public static function dataTableLayout()
    {
        $layout = [
            [
                'field' => 'id',
                'searchable' => false,
                'sortable' => true,
                'switchable' => true,
                'title' => trans('general.id'),
                'visible' => false,
            ],
            [
                'field' => 'company_id',
                'searchable' => true,
                'sortable' => false,
                'title' => trans('general.company'),
                'visible' => true,
                'formatter' => 'companiesLinkObjFormatter',
            ],
            [
                'field' => 'assigned_to',
                'searchable' => true,
                'sortable' => false,
                'title' => 'Pengguna Barang',
                'visible' => true,
            ],
            [
                'field' => 'types',
                'searchable' => true,
                'sortable' => false,
                'title' => 'Jenis Transaksi',
                'visible' => true,
            ],
            [
                'field' => 'state',
                'searchable' => true,
                'sortable' => false,
                'title' => 'Status Transaksi',
                'visible' => true,
            ],
            [
                'field' => 'employee_num',
                'searchable' => true,
                'sortable' => false,
                'title' => 'NIP PJ',
                'visible' => true,
            ],
            [
                'field' => 'purchase_date',
                'searchable' => true,
                'sortable' => false,
                'title' => 'Tanggal Transaksi',
                'visible' => true,
                'formatter' => 'dateDisplayFormatter',
            ],
            [
                'field' => 'notes',
                'searchable' => false,
                'sortable' => false,
                'visible' => false,
                'title' => trans('general.notes'),
                'formatter' => 'notesFormatter',
            ],
            [
                'field' => 'actions',
                'searchable' => false,
                'sortable' => false,
                'title' => trans('table.actions'),
                'visible' => true,
                'formatter' => 'consumablestransactionActionsFormatter',
            ],
        ];
        return json_encode($layout);
    }

    /**
     * Url to view this item.
     * @return string
     */
    public function viewUrl()
    {
        return route('consumablestransaction.show', $this->id);
    }

    /**
     * Generate html link to this items name.
     * @return string
     */
    public function nameUrl()
    {
        return (string) link_to_route('consumablestransaction.show', e($this->name), $this->id);
    }
}
