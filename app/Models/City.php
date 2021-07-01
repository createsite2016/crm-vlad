<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static where(string $string, int $id)
 * @method static findOrFail(int $id)
 * @method static find(int $id)
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = "cities";
}
