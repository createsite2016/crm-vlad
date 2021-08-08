<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
        'number',
        'user_id'
    ];

    /**
     * Получить пробег машины.
     */
    public function way($car_id): int
    {
        $ways = DB::table('ways')
            ->select(DB::raw('SUM(finish::int) - SUM(start::int) as all_way'))
            ->where('car_id','=', $car_id)
        ->first();

        if($ways->all_way){
            return $ways->all_way;
        } else {
            return 0;
        }
    }
}
