<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $task)
 */
class Way extends Model
{
    use HasFactory;

    protected $table = "ways";
}
