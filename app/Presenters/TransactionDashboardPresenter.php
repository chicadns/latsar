<?php

namespace App\Presenters;

/**
 * Class ComponentPresenter
 */
class TransactionDashboardPresenter extends Presenter
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
                'field' => 'company_id',
                'searchable' => true,
                'sortable' => false,
                'title' => trans('general.company'),
                'visible' => true,
                'formatter' => 'companiesLinkObjFormatter',
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
                'field' => 'qty',
                'searchable' => false,
                'sortable' => false,
                'title' => trans('admin/components/general.total'),
                'visible' => true,
            ],
            [
                'field' => 'purchase_cost',
                'searchable' => true,
                'sortable' => false,
                'title' => trans('general.purchase_cost'),
                'visible' => true,
                'class' => 'text-right',
            ],
            [
                'field' => 'total_cost',
                'searchable' => true,
                'sortable' => false,
                'title' => 'Total Biaya',
                'visible' => true,
                'footerFormatter' => 'sumFormatterQuantity',
                'class' => 'text-right',
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
