<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ProductImages Model.
 *
 * @property int    $id
 * @property string $path
 * @property string $name
 * @property string $size
 * @property string $extension
 * @property int    $product_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages query()
 */
class ProductImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'name',
        'size',
        'extension',
        'product_id',
    ];
}
