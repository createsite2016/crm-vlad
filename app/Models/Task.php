<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create($validated)
 */

/**
 * @property $id
 * @property $microsoft_id
 * @property $name
 * @property $qualification
 * @property $company
 */
class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";

    protected $fillable = [
        'deadline',
        'company_id',
        'description',
        'status_id',
        'priority_id',
        'user_id',
        'player_id',
        'device_id'
    ];

    /**
     * Получить оборудование.
     */
    public function device(): HasOne
    {
        return $this->hasOne(Device::class, 'id', 'device_id');
    }

    /**
     * Получить пользователя.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Получить исполнителя.
     */
    public function player(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'player_id');
    }

    /**
     * Получить компанию.
     */
    public function company(): HasOne
    {
        if( is_null($this->hasOne(Company::class, 'id', 'company_id')) ){
            return '';
        }
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
