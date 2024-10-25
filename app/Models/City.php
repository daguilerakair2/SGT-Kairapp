<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * City Model.
 *
 * @property int    $id
 * @property string $name
 * @property int    $state_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state_id',
    ];
}
