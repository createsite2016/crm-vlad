<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create($validated)
 */

/**
 * This is the model class for table "{{%messages}}".
 *
 * @property integer $id
 * @property integer $dialog_id диалог
 * @property string $created_at созданно
 * @property integer $recipient_id получатель
 * @property integer $sender_id отправитель
 * @property string $text сообщение
 * @property integer $recipient_hide удалил_получатель
 * @property integer $sender_hide удалил_отправитель
 * @property string $read прочитал
 */

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'sender_id',
        'recipient_id'
    ];
    protected $table = "messages";

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
     * Получить получателя.
     */
    public function recipient(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'recipient_id');
    }

    /**
     * Получить отправителя.
     */
    public function sender(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    /**
     * Человекопонятная русская дата (и время)
     *
     * @param string $date_input Что-то хоть как-то похожее на дату
     * @param bool $time Показывать время
     * @return string
     */
    public function date_smart($date_input, $time=true) {
        $monthes = array(
            '', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
            'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
        );
        $date = strtotime($date_input);

        //Время
        if($time) $time = ' G:i';
        else $time = '';

        //Сегодня, вчера, завтра
        if(date('Y') == date('Y',$date)) {
            if(date('z') == date('z', $date)) {
                $result_date = date('Сегодня'.$time, $date);
            } elseif(date('z') == date('z',mktime(0,0,0,date('n',$date),date('j',$date)+1,date('Y',$date)))) {
                $result_date = date('Вчера'.$time, $date);
            } elseif(date('z') == date('z',mktime(0,0,0,date('n',$date),date('j',$date)-1,date('Y',$date)))) {
                $result_date = date('Завтра'.$time, $date);
            }

            if(isset($result_date)) return $result_date;
        }

        //Месяца
        $month = $monthes[date('n',$date)];

        //Года
        if(date('Y') != date('Y', $date)) $year = 'Y г.';
        else $year = '';

        $result_date = date('j '.$month.' '.$year.$time, $date);
        return $result_date;
    }
}
