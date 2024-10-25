<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * SubStore Model.
 *
 * @property int    $id
 * @property string $name
 * @property string $address
 * @property float  $latitude
 * @property float  $longitude
 * @property int    $phone
 * @property bool   $status
 * @property int    $city_id
 * @property int    $store_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SubStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStore query()
 *
 * @property \Illuminate\Database\Eloquent\Collection|StoreProduct[] $productStore
 * @property int|null                                                $product_store_count
 */
class SubStore extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'phone',
        'status',
        'city_id',
        'store_rut',
        'subStoreMobileId',
    ];

    /**
     * Get the products associated with the substore.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productStore()
    {
        return $this->hasMany(SubStoreProduct::class, 'sub_store_id')->where('delete', false);
    }

    /**
     * Get the all products that owns the substore.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productStoreTest()
    {
        return $this->hasMany(SubStoreProduct::class, 'sub_store_id')->where('delete', false)->paginate(1);
    }

    /**
     * Get the schedules associated with the substore.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedulesSubstore()
    {
        return $this->hasMany(Schedule::class, 'substore_id');
    }
}
