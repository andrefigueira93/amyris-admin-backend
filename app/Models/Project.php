<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Project extends Model
{
    use CrudTrait, SoftDeletes, InteractsWithMedia, HasUuid;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'projects';
     protected $primaryKey = 'id';
     public $timestamps = true;
    protected $guarded = ['id'];
    // protected $fillable = [];
     protected $hidden = [
         'partner_id',
         'technology',
         'repository_url',
         'storefront_api_url'
     ];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function partner(): BelongsTo {
        return $this->belongsTo(Partner::class);
    }

    public function pages(): HasMany {
        return $this->hasMany(LandingPage::class);
    }

    public function topBanner(): HasOne {
        return $this->hasOne(TopBanner::class)
            ->where('active', 1);
    }

    public function socialmedias(): HasMany{
        return $this->hasMany(SocialMedia::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
