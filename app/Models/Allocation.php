<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\Acceptable;
use App\Models\Traits\Searchable;
use App\Presenters\Presentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Watson\Validating\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;

class Allocation extends SnipeModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'allocations'; // Replace with your actual table name

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Replace with your actual primary key column name

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // List all fillable columns here
        'user_id',
        'company_id',
        'assets_id',
        'name',
        'bmn',
        'serial',
        'kondisi',
        'os',
        'office',
        'antivirus',
        'request_date',
        'handling_date',
        // Add more columns as needed
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // Specify any columns you want to hide from JSON output
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // Specify any casts for attributes (e.g., 'column' => 'boolean')
    ];

    // Define relationships, if any
}
