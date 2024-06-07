<?php

use LaraGram\Core\Auth\Auth;

/**
 * Check user statis
 * @param int|string|null $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return string|null user status
 */
function getStatus(int|string|null $user_id = null, int|string|null $chat_id = null): string|null
{
    return Auth::getStatus($user_id, $chat_id);
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
function isChatAdmin(int|string|null $user_id = null, int|string|null $chat_id = null): bool
{
    return Auth::isChatAdmin($user_id, $chat_id);
}

/**
 * Check is chat creator or not
 * @param int|string|null $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id <p>
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return bool true if is creator, false
 * otherwise.
 */
function isChatCreator(int|string|null $user_id = null, int|string|null $chat_id = null): bool
{
    return Auth::isChatCreator($user_id, $chat_id);
}

/**
 * Check is chat member or not
 * @param int|string|null $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id <p>
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return bool true if is member, false
 * otherwise.
 */
function isChatMember(int|string|null $user_id = null, int|string|null $chat_id = null): bool
{
    return Auth::isChatMember($user_id, $chat_id);
}

/**
 * Check is kicked member or not
 * @param int|string|null $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id <p>
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return bool true if is member, false
 * otherwise.
 */
function isKicked(int|string|null $user_id = null, int|string|null $chat_id = null): bool
{
    return Auth::isKicked($user_id, $chat_id);
}

/**
 * Check is restricted member or not
 * @param int|string|null $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id <p>
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return bool true if is member, false
 * otherwise.
 */

function isRestricted(int|string|null $user_id = null, int|string|null $chat_id = null): bool
{
    return Auth::isRestricted($user_id, $chat_id);
}

/**
 * Check is left member or not
 * @param int|string|null $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id <p>
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return bool true if is member, false
 * otherwise.
 */
function isLeft(int|string|null $user_id = null, int|string|null $chat_id = null): bool
{
    return Auth::isLeft($user_id, $chat_id);
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
function isBotAdmin(int|string|null $user_id = null, int|string|null $chat_id = null): bool
{
    return Auth::isBotAdmin($user_id, $chat_id);
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
function isBotOwner(int|string|null $user_id = null, int|string|null $chat_id = null): bool
{
    return Auth::isBotOwner($user_id, $chat_id);
}

/**
 * Check is bot father or not ( not available )
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
function isBotFather(int|string|null $user_id = null, int|string|null $chat_id = null): bool
{
    return Auth::isBotFather($user_id, $chat_id);
}

/**
 * get userLevel
 * @param int|string|null $user_id <p>
 * UserId. if null $userId = Message sender
 * </p>
 * @param int|string|null $chat_id <p>
 * ChatId. if null $chat_id = Current Chat
 * </p>
 * @return string|int|null string|int level, null
 * otherwise.
 */
function userLevel(int|string|null $user_id = null, int|string|null $chat_id = null): string|int|null
{
    return Auth::userLevel($user_id, $chat_id);
}