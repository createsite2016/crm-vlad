<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static create(array $validated)
 * @method static whereNotIn(string $string)
 * @method static whereNotNull(string $string)
 * @method static find(int $id)
 * @method static where(string $string, string $string1, string $string2)
 * @method static findOrFail(int $id)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role_id',
        'city_id',
        'car_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set the user's password.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Получить город.
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    /**
     * Получить город.
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id')->withDefault([
            'role_id' => 1
        ]);
    }

    /**
     * Получить автомобиль.
     */
    public function car(): HasOne
    {
        return $this->hasOne(Car::class, 'id', 'car_id');
    }

    /**
     * Получить все отправленные пользователем сообщения
     */
    public function send()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Получить все входящие пользователем сообщения
     */
    public function recipient()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }
}
