<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\Telegram\Bot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class BotController extends Controller
{
    /**
     * Вэб Хук для подключения телеграмм бота
     * @param Request $request
     */
    public function index(Request $request)
    {
        // получаю ответы в боте
        $bot = new Bot($request);
        // если это начало диалога
        if($bot->isStartBot() == true){
            $bot->sendToTelegram('Привет, я Бот 🤖 OZBERG, я буду отправлять тебе уведомления из CRM системы, для этого напиши мне свой логин из CRM');
        }

        $user = false;
        $user = User::where('email', '=', $bot->getMessage() )->first();

        if ($user){
                $user->telegram_chat_id = $bot->getChatId();
                $user->update();
                $bot->sendToTelegram($user->name.', отлично! теперь я смогу отправлять Вам уведомления из CRM 💪🏻');
        } else {
            // говорю о невозможности найти пользователя
            $bot->sendToTelegram('😕 Странно не могу отыскать твой логин: '.$bot->getMessage());
        }
    }

}
