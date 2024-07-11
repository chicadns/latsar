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
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Allocation extends SnipeModel
{
    use HasFactory;

    protected $presenter = \App\Presenters\AllocationPresenter::class;
    use CompanyableTrait;
    use Loggable, Presentable;
    use SoftDeletes;
    use Acceptable;

    protected $table = 'allocations';
    // protected $casts = [
    //     'purchase_date' => 'datetime',
    //     'category_id'    => 'integer',
    //     'company_id'     => 'integer', 
    //  ];

    /**
     * Category validation rules
     */
    public $rules = [
        'name'        => 'required|min:3|max:255',
        // 'category_id' => 'required|integer',
        'company_id'  => 'integer|nullable',
        // 'purchase_cost'   => 'numeric|required|gte:0',
        'purchase_date'   => 'date_format:Y-m-d|nullable',
    ];

    /**
     * Whether the model should inject it's identifier to the unique
     * validation rules before attempting validation. If this property
     * is not set in the model it will default to true.
     *
     * @var bool
     */
    protected $injectUniqueIdentifier = true;
    use ValidatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'user_id',
        'assigned_type',
        'assets_id',
        'category_id',
        'name',
        'bmn',
        'serial',
        'kondisi',
        'supporting_link',
        'os',
        'os2',
        'office',
        'office2',
        'antivirus',
        'status',
        'request_date',
        'handling_date',
        'updated_at',
        'deleted_at',
        'allocation_code',
    ];

    use Searchable;

    /**
     * The attributes that should be included when searching the model.
     *
     * @var array
     */
    protected $searchableAttributes = [
        'name',
        'bmn',
        'serial',
        'kondisi',
        'os',
        'office',
        'antivirus',
        'status',
        'request_date',
        'handling_date',
    ];

    /**
     * The relations and their attributes that should be included when searching the model.
     *
     * @var array
     */
    protected $searchableRelations = [
        'category'     => ['name'],
        'company'      => ['name'],
        'location'     => ['name'],
        'manufacturer' => ['name'],
    ];


    /**
     * Establishes the components -> action logs -> uploads relationship
     *
     * @author A. Gianotto <snipe@snipe.net>
     * @since [v6.1.13]
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    

    /**
     * Establishes the component -> company relationship
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v3.0]
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id');
    }

    /**
     * Establishes the component -> manufacturer relationship
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v3.0]
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function manufacturer()
    {
        return $this->belongsTo(\App\Models\Manufacturer::class, 'manufacturer_id');
    }

    /**
     * Establishes the component -> location relationship
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v3.0]
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class, 'location_id');
    }

    /**
     * Establishes the component -> category relationship
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v3.0]
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }


    /**
     * Establishes the component -> action logs relationship
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v3.0]
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function assetlog()
    {
        return $this->hasMany(\App\Models\Actionlog::class, 'item_id')->where('item_type', self::class)->orderBy('created_at', 'desc')->withTrashed();
    }

    /**
     * Gets the full image url for the consumable
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v3.0]
     * @return string | false
     */
    public function getImageUrl()
    {
        if ($this->image) {
            return Storage::disk('public')->url(app('consumables_upload_path').$this->image);
        }
        return false;

    }

    /**
     * Establishes the component -> users relationship
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v3.0]
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'consumables_users', 'consumable_id', 'assigned_to')->withPivot('user_id')->withTrashed()->withTimestamps();
    }

    /**
     * Establishes the item -> supplier relationship
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v6.1.1]
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id');
    }


    /**
     * Determine whether to send a checkin/checkout email based on
     * asset model category
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @return bool
     */
    public function checkin_email()
    {
        return $this->category->checkin_email;
    }

    /**
     * Determine whether this asset requires acceptance by the assigned user
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @return bool
     */
    public function requireAcceptance()
    {
        return $this->category->require_acceptance;
    }

    /**
     * Checks for a category-specific EULA, and if that doesn't exist,
     * checks for a settings level EULA
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v4.0]
     * @return string | false
     */
    public function getEula()
    {
        if ($this->category->eula_text) {
            return  Helper::parseEscapedMarkedown($this->category->eula_text);
        } elseif ((Setting::getSettings()->default_eula_text) && ($this->category->use_default_eula == '1')) {
            return  Helper::parseEscapedMarkedown(Setting::getSettings()->default_eula_text);
        } else {
            return null;
        }
    }

}
