<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * CharacteristiCategory Model.
 *
 * @property int    $id
 * @property int    $characteristic_id
 * @property int    $category_id
 * @property string $value
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CharacteristiCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacteristiCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacteristiCategory query()
 */
class CharacteristiCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'characteristic_id',
        'category_id',
        'value',
    ];

    /**
     * Get the characteristic associated category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCharacteristic()
    {
        return $this->belongsTo(Characteristic::class, 'characteristic_id');
    }
}
