<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $validated)
 * @method static find(int $id)
 * @method static findOrFail(int $id)
 */
class Device extends Model
{
    use HasFactory;

    protected $table = "devices";

    protected $fillable = [
        'name',
        'staff_id',
        'volume',
    ];

    /**
     * Получить город.
     */
    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'id', 'staff_id');
    }
}
