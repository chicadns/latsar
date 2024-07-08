<?php

namespace App\Presenters;

/**
 * Class ComponentPresenter
 */
class UserAllocationPresenter extends Presenter
{
    /**
     * Json Column Layout for bootstrap table
     * @return string
     */
    public static function dataTableLayout()
    {
        $layout = [
             [
                'field' => 'icon',
                'title' => '',
                'align' => 'center',
                'formatter' => 'warningFormatter'
            ],
             [
                'field' => 'no',
                'title' => 'No.',
                'sortable' => true,
                'align' => 'center',
                'formatter' => 'counterFormatter'
            ],
            [
                'field' => 'category',
                'title' => 'Kategori',
                'sortable' => true
            ],
            [
                'field' => 'name',
                'title' => 'Nama Perangkat',
                'sortable' => true
            ],
            [
                'field' => 'bmn',
                'title' => 'Nomor BMN',
                'sortable' => true
            ],
            [
                'field' => 'serial',
                'title' => 'Serial Number',
                'sortable' => true
            ],
            [
                'field' => 'status',
                'title' => 'Status Persetujuan',
                'sortable' => true
            ],
            [
                'field' => 'action',
                'title' => 'Tindakan',
                'sortable' => false,
                'align' => 'center',
                'formatter' => 'actionFormatter'
            ]
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
