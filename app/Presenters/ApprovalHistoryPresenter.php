<?php

namespace App\Presenters;

/**
 * Class ComponentPresenter
 */
class ApprovalHistoryPresenter extends Presenter
{
    /**
     * Json Column Layout for bootstrap table
     * @return string
     */
    public static function dataTableLayout()
    {
        $layout = [
             [
                'field' => 'no',
                'title' => 'No.',
                'sortable' => true,
                'align' => 'center',
                'formatter' => 'counterFormatter'
            ],
            [
                'field' => 'request_date',
                'title' => 'Tanggal Permintaan',
                'sortable' => true,
                // 'formatter' => 'dateFormatter' // Optional: custom formatter for date
            ],
            [
                'field' => 'user_first_name',
                'title' => 'Nama Pegawai',
                'sortable' => true
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
                'align' => 'center'
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
