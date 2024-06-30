<?php

namespace App\Presenters;

/**
 * Class ComponentPresenter
 */
class ConsumableDetailsPresenter extends Presenter
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
                'title' => trans('general.id'),
                'visible' => false,
            ],
            [
                'field' => 'types',
                'searchable' => true,
                'sortable' => false,
                'title' => 'Jenis Transaksi',
                'visible' => true,
            ],
            [
                'field' => 'name',
                'searchable' => true,
                'sortable' => false,
                'title' => trans('general.name'),
                'visible' => true,
                'formatter' => 'consumablesLinkFormatter',
            ],
            [
                'field' => 'category_id',
                'searchable' => true,
                'sortable' => false,
                'title' => trans('general.category'),
                'formatter' => 'categoriesLinkObjFormatter',
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
                'field' => 'purchase_cost',
                'searchable' => true,
                'sortable' => false,
                'title' => trans('general.purchase_cost'),
                'visible' => true,
                'footerFormatter' => 'sumFormatterQuantity',
                'class' => 'text-right',
            ],
            [
                'field' => 'qty',
                'searchable' => false,
                'sortable' => false,
                'title' => trans('admin/components/general.total'),
                'visible' => true,
            ],
            [
                'field' => 'employee_num',
                'searchable' => true,
                'sortable' => false,
                'switchable' => true,
                'title' => 'NIP PJ',
                'visible' => true,
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
        return route('consumables.show', $this->id);
    }

    /**
     * Generate html link to this items name.
     * @return string
     */
    public function nameUrl()
    {
        return (string) link_to_route('consumables.show', e($this->name), $this->id);
    }
}
