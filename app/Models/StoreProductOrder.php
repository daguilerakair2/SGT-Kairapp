<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * StoreProductOrder Model.
 *
 * @property int    $id
 * @property int    $quantity
 * @property int    $buyPrice
 * @property string $note
 * @property int    $order_id
 * @property int    $productMobile_id
 * @property int    $store_product_id
 * @property int    $sub_store_product_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|StoreProductOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreProductOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreProductOrder query()
 */
class StoreProductOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quantity',
        'buyPrice',
        'note',
        'productMobile_id',
        'store_order_id',
        'sub_store_product_id',
    ];

    /**
     * Get the store product that owns the store product order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subStoreProductDates()
    {
        return $this->belongsTo(SubStoreProduct::class, 'sub_store_product_id');
    }
}
