<?php

namespace Bot\Core\Auth;

use Bot\App\Model\Admin;
use Bot\App\Model\User;
use Bot\Core\Request;

class Role
{
    private static function checkRole(string $role, int|string $user_id, int|string|null $chat_id = null): bool
    {
        if (is_null($chat_id)) { $chat_id = (new Request())->ChatID(); }

        $user = User::where('user_id', $user_id)->where('chat_id', $chat_id)->first();

        if (!is_null($user)){
            if (is_null($user->admin->role)){
                Admin::create([
                    'user' => $user->id,
                    'role' => $role
                ]);
                return true;
            }else{
                Admin::where('user', $user->admin->id)->update([
                    'role' => $role
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
                'role' => $role
            ]);
            return true;
        }
    }

    public static function addBotAdmin(int|string $user_id, int|string|null $chat_id = null): bool
    {
        return self::checkRole('administrator', $user_id, $chat_id);
    }

    public static function addBotOwner(int|string $user_id, int|string|null $chat_id = null): bool
    {
        return self::checkRole('owner', $user_id, $chat_id);
    }

    public static function removeRole(int|string $user_id, int|string|null $chat_id = null): bool
    {
        if (is_null($chat_id)) { $chat_id = (new Request())->ChatID(); }

        $user = User::where('user_id', $user_id)->where('chat_id', $chat_id)->first();
        if (!is_null($user->admin->role)){
            Admin::where('user', $user->admin->id)->delete();
            return true;
        }
        return false;
    }
}