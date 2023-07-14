<?php

namespace Bot\Core\Auth;

use Bot\App\Model\User;
use Bot\Core\Request;

class Auth
{
    private static function getStatus(int|string|null $user_id = null, int|string|null $chat_id = null){
        $request = new Request();
        if (is_null($chat_id)) { $chat_id = $request->ChatID(); }
        if (is_null($user_id)) { $user_id = $request->UserID(); }

        $status = $request->getChatMember([
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ]);
        return $status['result']['status'];
    }

    /**
     * Check is chat admin or not
     * @param int|string|null $user_id <p>
     * UserId. if null $userId = Message sender
     * </p>
     * @param int|string|null $chat_id <p>
     * ChatId. if null $chat_id = Current Chat
     * </p>
     * @return bool true if is admin, false
     * otherwise.
     */
    public static function isChatAdmin(int|string|null $user_id = null, int|string|null $chat_id = null): bool
    {
        if (self::getStatus($user_id, $chat_id) === 'administrator') {
            return true;
        }
        return false;
    }

    /**
     * Check is chat owner or not
     * @param int|string|null $user_id <p>
     * UserId. if null $userId = Message sender
     * </p>
     * @param int|string|null $chat_id <p>
     * ChatId. if null $chat_id = Current Chat
     * </p>
     * @return bool true if is owner, false
     * otherwise.
     */
    public static function isChatOwner(int|string|null $user_id = null, int|string|null $chat_id = null): bool
    {
        if (self::getStatus($user_id, $chat_id) === 'owner') {
            return true;
        }
        return false;
    }

    /**
     * Check is bot admin or not
     * @param int|string|null $user_id <p>
     * UserId. if null $userId = Message sender
     * </p>
     * @param int|string|null $chat_id <p>
     * ChatId. if null $chat_id = Current Chat
     * </p>
     * @return bool true if is admin, false
     * otherwise.
     */
    public static function isBotAdmin(int|string|null $user_id = null, int|string|null $chat_id = null): bool
    {
        if (is_null($chat_id)) { $chat_id = (new Request())->ChatID(); }
        if (is_null($user_id)) { $user_id = (new Request())->UserID(); }

        $role = User::where('user_id', $user_id)->where('chat_id', $chat_id)->first()->admin->role;
        if ($role === 'administrator') {
            return true;
        }
        return false;
    }

    /**
     * Check is bot owner or not
     * @param int|string|null $user_id <p>
     * UserId. if null $userId = Message sender
     * </p>
     * @param int|string|null $chat_id <p>
     * ChatId. if null $chat_id = Current Chat
     * </p>
     * @return bool true if is owner, false
     * otherwise.
     */
    public static function isBotOwner(int|string|null $user_id = null, int|string|null $chat_id = null): bool
    {
        if (is_null($chat_id)) { $chat_id = (new Request())->ChatID(); }
        if (is_null($user_id)) { $user_id = (new Request())->UserID(); }

        $role = User::where('user_id', $user_id)->where('chat_id', $chat_id)->first()->admin->role;
        if ($role === 'owner') {
            return true;
        }
        return false;
    }

    /**
     * Check is bot father or not
     * bot father is creator/s
     * @param int|string|null $user_id <p>
     * UserId. if null $userId = Message sender
     * </p>
     * @param int|string|null $chat_id <p>
     * ChatId. if null $chat_id = Current Chat
     * </p>
     * @return bool true if is father, false
     * otherwise.
     */
    public static function isBotFather(int|string|null $user_id = null, int|string|null $chat_id = null): bool
    {
        return false;
    }
}