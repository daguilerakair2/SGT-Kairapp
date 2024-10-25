<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * SubStoreProduct Model.
 *
 * @property int                         $id
 * @property int                         $stock
 * @property int                         $price
 * @property bool                        $status
 * @property bool                        $delete
 * @property int                         $substore_id
 * @property int                         $product_id
 * @property \App\Models\Product         $productDates
 * @property \App\Models\ProductCategory $categoryDates
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SubStoreProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStoreProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStoreProduct query()
 */
class SubStoreProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock',
        'price',
        'status',
        'delete',
        'sub_store_id',
        'product_id',
    ];

    /**
     * Get the product that owns the SubStoreProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productDates()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the category that owns the SubStoreProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryDates()
    {
        return $this->belongsTo(ProductCategory::class, 'product_id');
    }

    /**
     * Get the substore that owns the SubStoreProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subStoreDates()
    {
        return $this->belongsTo(SubStore::class, 'sub_store_id');
    }
}
