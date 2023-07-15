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
            if (is_null($user->admin->level)){
                Admin::create([
                    'user' => $user->id,
                    'level' => $level
                ]);
                return true;
            }else{
                Admin::where('user', $user->admin->id)->update([
                    'level' => $level
                ]);
                return true;
            }
        }else{
            $request = new Request();
            $user = $request->getChatMember([
                'chat_id' => $chat_id,
                'user_id' => $user_id
            ]);

            User::create([
                'first_name' => $user['result']['user']['first_name'],
                'last_name'  => $user['result']['user']['first_name'] ?? null,
                'user_id'    => $user['result']['user']['id'],
                'chat_id'    => $request->ChatID()
            ]);

            Admin::create([
                'user' => $user->id,
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
        if (!is_null($user->admin->level)){
            Admin::where('user', $user->admin->id)->delete();
            return true;
        }
        return false;
    }
}