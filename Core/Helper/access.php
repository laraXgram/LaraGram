<?php

use Bot\Core\Auth\Level;
use Bot\Core\Auth\Role;

/**
 * add new bot admin
 * @param int|string $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id <p>
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return bool true if admin set, false
 * otherwise.
 */
function addBotAdmin(int|string $user_id, int|string|null $chat_id = null): bool
{
    return Role::addBotAdmin($user_id, $chat_id);
}

/**
 * add new bot owner
 * @param int|string $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id <p>
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return bool true if owner set, false
 * otherwise.
 */
function addBotOwner(int|string $user_id, int|string|null $chat_id = null): bool
{
    return Role::addBotOwner($user_id, $chat_id);
}

/**
 * remove member role
 * @param int|string $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id <p>
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return bool true if role removed, false
 * otherwise.
 */
function removeRole(int|string $user_id, int|string|null $chat_id = null): bool
{
    return Role::removeRole($user_id, $chat_id);
}

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
function setLevel(string|int $level, int|string $user_id, int|string|null $chat_id = null): bool
{
    return Level::setLevel($level, $user_id, $chat_id);
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
function removeLevel(int|string $user_id, int|string|null $chat_id = null): bool
{
    return Level::removeLevel($user_id, $chat_id);
}