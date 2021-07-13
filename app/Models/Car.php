<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($validated)
 * @method static find(int $id)
 * @method static findOrFail(int $id)
 */
class Car extends Model
{
    use HasFactory;

    protected $table = "cars";
    protected $fillable = [
        'name',
        'number'
    ];
}
