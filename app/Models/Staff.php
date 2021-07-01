<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create($validated)
 * @method static find(int $staff)
 * @method static findOrFail($id)
 */
class Staff extends Model
{
    use HasFactory;

    protected $table = "staff";

    protected $fillable = [
        'name',
        'timework',
        'address',
        'city_id'
    ];

    /**
     * Получить город.
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
