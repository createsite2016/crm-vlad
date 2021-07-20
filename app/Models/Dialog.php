<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static where(array[] $array)
 */

/**
 * This is the model class for table "{{%dialogs}}".
 *
 * @property integer $id
 * @property integer $recipient_id получатель
 * @property integer $sender_id отправитель
 * @property integer $recipient_hide удалил_получатель
 * @property integer $sender_hide удалил_отправитель
 * @property integer $last_message_id последнее сообщение
 * @method static find(int $id)
 * @method static where(array[] $array)
 */
class Dialog extends Model
{
    use HasFactory;

    protected $table = "dialogs";

    /**
     * Получить пользователя с которым открыт диалог.
     */
    public function user(): HasOne
    {
        if($this->sender_id == \Auth::user()->id){
            return $this->hasOne(User::class, 'id', 'recipient_id');
        } else {
            return $this->hasOne(User::class, 'id', 'sender_id');
        }
    }

    /**
     * Получить последнее сообщение диалога.
     */
    public function message(): HasOne
    {
        return $this->hasOne(Message::class, 'id', 'last_message_id');
    }
}
