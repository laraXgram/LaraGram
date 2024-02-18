<?php

namespace Bot\Core\Auth;

use Bot\App\Model\Admin;
use Bot\App\Model\User;
use Bot\Core\Request;

class Level
{
    /**
     * set level
     * @param string|int $level <p>
     * level name/number
     * </p>
     * @param int|string $user_id <p>
     * UserId. if null $userId = Message sender
     * </p>
     * @param int|string|null $chat_id <p>
     * ChatId. if null $chat_id = Current Chat
     * </p>
     * @return bool true if role removed, false
     * otherwise.
     */
    public static function setLevel(string|int $level, int|string $user_id, int|string|null $chat_id = null): bool
    {
        if (is_null($chat_id)) { $chat_id = (new Request())->ChatID(); }

        $user = User::where('user_id', $user_id)->where('chat_id', $chat_id)->first();

        if (!is_null($user)){
            if (!isset($user->admin->level)){
                Admin::create([
                    'user_id' => $user->id,
                    'level' => $level
                ]);
                return true;
            }else{
                Admin::where('user_id', $user->id)->update([
                    'level' => $level
                ]);
                return true;
            }
        }else{
            $request = new Request();
            $chatMember = $request->getChatMember([
                'chat_id' => $chat_id,
                'user_id' => $user_id
            ]);

            $user = User::create([
                'first_name' => $chatMember['result']['user']['first_name'],
                'last_name'  => $chatMember['result']['user']['last_name'] ?? null,
                'user_id'    => $chatMember['result']['user']['id'],
                'chat_id'    => $request->ChatID()
            ]);

            Admin::create([
                'user_id' => $user->id,
                'level' => $level
            ]);
            return true;
        }
    }

    /**
     * remove level
     * @param int|string $user_id <p>
     * UserId. if null $userId = Message sender
     * </p>
     * @param int|string|null $chat_id <p>
     * ChatId. if null $chat_id = Current Chat
     * </p>
     * @return bool true if role removed, false
     * otherwise.
     */
    public static function removeLevel(int|string $user_id, int|string|null $chat_id = null): bool
    {
        if (is_null($chat_id)) { $chat_id = (new Request())->ChatID(); }

        $user = User::where('user_id', $user_id)->where('chat_id', $chat_id)->first();
        if (isset($user->admin->level)){
            Admin::where('user_id', $user->id)->delete();
            return true;
        }
        return false;
    }
}