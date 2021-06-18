<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * Название компании.
     *
     * @var string
     */
    public $name;

    /**
     * Телефон компании.
     *
     * @var string
     */
    public $phone;

    /**
     * Адрес компании.
     *
     * @var string
     */
    public $address;

    /**
     * Город офиса компании.
     *
     * @var string
     */
    public $city_id;
}
