<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create($validated)
 * @method static where(string $string, Company $company)
 * @method static find(Company $company)
 * @method static findOrFail(Company $company)
 */
class Company extends Model
{
    use HasFactory;

    protected $table = "companies";

    protected $fillable = [
        'name',
        'phone',
        'address',
        'city_id'
    ];
    /**
     * @var mixed
     */
    private $id;

    /**
     * Получить город.
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
