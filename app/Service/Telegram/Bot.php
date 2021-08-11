<?php

namespace App\Service\Telegram;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Bot
{
    /**
     * Токен Телеграмм бота берется из конфига
     * @var string
     */
    private $botToken = '1822708372:AAH_es4ZAuMpfDxIAPQjRBWael8L8eBcNVI';

    private $request;

    public function __construct(Request $request = null)
    {
        if($request){
            $this->request = $request->toArray();
        }
    }

    /**
     * Получить сообщение от пользователя
     * @return mixed
     */
    public function getMessage(): string
    {
        return $this->request["message"]["text"];
    }

    public function onChat():bool
    {
        return $this->request["my_chat_member"] != null;
    }

    /**
     * Получить имя пользователя
     * @return mixed
     */
    public function getUserName()
    {
        return $this->request["message"]["from"]["first_name"];
    }

    /**
     * Проверка на начало диалога с ботом
     * @return bool
     */
    public function isStartBot(): bool
    {
        return $this->request['message']['text'] == "/start";
    }

    /**
     * Получить ID чата
     * @return mixed
     */
    public function getChatId()
    {
        return $this->request["message"]["from"]["id"];
    }

    /**
     * Отправить ответ пользователю от Бота
     * @param $message
     * @param bool $chat_id
     */
    public function sendToTelegram($message, $chat_id = null): void
    {
        if(!$chat_id){
            $chat_id = $this->getChatId();
        }
        Http::asForm()->post('https://api.telegram.org/bot'.$this->botToken.'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
        ]);
    }
}
