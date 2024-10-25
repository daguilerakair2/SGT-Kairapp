<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Store Model.
 *
 * @property int    $rut
 * @property string $checkDigit
 * @property string $companyName
 * @property string $fantasyName
 * @property bool   $itinerant
 * @property bool   $custom
 * @property string $pathProfile
 * @property string $pathBackground
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 *
 * @property \Illuminate\Database\Eloquent\Collection|SubStore[]  $subStores
 * @property int|null                                             $sub_stores_count
 * @property \Illuminate\Database\Eloquent\Collection|UserStore[] $userStore
 * @property int|null                                             $user_store_count
 */
class Store extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stores';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'rut';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rut',
        'checkDigit',
        'companyName',
        'fantasyName',
        'description',
        'itinerant',
        'custom',
        'pathProfile',
        'pathBackground',
        'status',
    ];

    // public function productStore()
    // {
    //     return $this->hasMany(StoreProduct::class, 'store_rut');
    // }

    /**
     * Get the substores associated with the store.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subStores()
    {
        return $this->hasMany(SubStore::class, 'store_rut');
    }

    /**
     * Get the user stores associated with the store.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userStore()
    {
        return $this->hasMany(UserStore::class, 'store_rut');
    }

    /**
     * Search for a specific user's store within this store.
     *
     * @param int $user_id
     *
     * @return \App\Models\UserStore
     */
    public function searchUserStore($user_id)
    {
        return $this->hasMany(UserStore::class, 'store_rut')->where('user_id', $user_id)->first();
    }
}
