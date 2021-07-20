<?php


namespace App\Actions;


use App\Models\Dialog;
use Auth;
use Illuminate\Database\Eloquent\Collection;

class DialogAction
{

    /**
     * Получение ID диалога, иначе создает новый диалог
     * @param int $sender_id
     * @param int $recipient_id
     * @return Dialog | null
     */
    static function getDialog(int $sender_id, int $recipient_id, $chat = false): ?Dialog
    {
        $dialog = Dialog::where([
            ['sender_id', $sender_id],
            ['recipient_id', $recipient_id]
        ])
            ->orWhere([
                ['sender_id', $recipient_id],
                ['recipient_id', $sender_id]
            ])
            ->first();

        if(!$dialog and !$chat){
            return self::createDialog($sender_id, $recipient_id);
        }

        return $dialog;
    }

    /**
     * Создание нового диалога
     * @param int $sender_id
     * @param int $recipient_id
     * @return Dialog
     */
    static function createDialog(int $sender_id, int $recipient_id): Dialog
    {
        $dialog = new Dialog;
        $dialog->sender_id = $sender_id;
        $dialog->recipient_id = $recipient_id;
        $dialog->save();

        return $dialog;
    }

    /**
     * @return Collection
     */
    static function getAll(): Collection
    {
        return Dialog::where([
            ['sender_id', Auth::user()->id]
        ])
            ->orWhere([
                ['recipient_id', Auth::user()->id]
            ])
            ->get();
    }
}
