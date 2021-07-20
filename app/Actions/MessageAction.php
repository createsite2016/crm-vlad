<?php


namespace App\Actions;


use App\Http\Requests\MessageRequest;
use App\Models\Dialog;
use App\Models\Message;

class MessageAction
{
    /**
     * Добавление сообщения
     * @param MessageRequest $request
     */
    static function add(MessageRequest $request)
    {
        if($request->validated()){
            $sender_id = $request->get('sender_id');
            $recipient_id = $request->get('recipient_id');
            $text = $request->get('text');

            $dialog = DialogAction::getDialog($sender_id, $recipient_id);

            $message = new Message;
            $message->dialog_id = $dialog->id;
            $message->recipient_id = $recipient_id;
            $message->sender_id = $sender_id;
            $message->text = $text;
            $message->save();

            $dialog = Dialog::find($dialog->id);
            $dialog->last_message_id = $message->id;
            $dialog->update();
        }
    }
}
