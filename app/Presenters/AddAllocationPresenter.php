<?php

namespace App\Presenters;

/**
 * Class ComponentPresenter
 */
class AddAllocationPresenter extends Presenter
{
    /**
     * Json Column Layout for bootstrap table
     * @return string
     */
    public static function dataTableLayout()
    {
        $layout = [
             [
                'field' => '#',
                'title' => '#',
                'sortable' => true,
                'align' => 'center'
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
