<?php

function assets($path): string|null
{
    $part = explode('.', $path);
    $fileName = array_pop($part);
    $path = implode(DIRECTORY_SEPARATOR, $part);
    $absolutePath = '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Assets' . DIRECTORY_SEPARATOR . $path;
    $folder = scandir($absolutePath);
    foreach ($folder as $file) {
        if (pathinfo($file, PATHINFO_FILENAME) === $fileName) {
            $fullPath = $absolutePath . DIRECTORY_SEPARATOR . $file;
        } else {
            $fullPath = null;
        }
    }
    return $fullPath;
}

function mentionUserById($user_id, $text, $parse_mode = 'markdown')
{
    if (strtolower($parse_mode) === 'markdown') {
        return "[{$text}](tg://user?id={$user_id})";
    } elseif (strtolower($parse_mode) === 'html') {
        return "<a href='tg://user?id={$user_id}'>{$text}</a>";
    }
}

function bold($text, $parse_mode = 'markdown')
{
    if (strtolower($parse_mode) === 'markdown') {
        return "**{$text}**";
    } elseif (strtolower($parse_mode) === 'html') {
        return "<b>{$text}</b>";
    }
}

function italic($text, $parse_mode = 'markdown')
{
    if (strtolower($parse_mode) === 'markdown') {
        return "__{$text}__";
    } elseif (strtolower($parse_mode) === 'html') {
        return "<i>{$text}</i>";
    }
}

function underline($text): string
{
    return "<u>{$text}</u>";
}

function strikethrough($text, $parse_mode = 'markdown')
{
    if (strtolower($parse_mode) === 'markdown') {
        return "~~{$text}~~";
    } elseif (strtolower($parse_mode) === 'html') {
        return "<s>{$text}</s>";
    }
}

function spoiler($text): string
{
    return "||{$text}||";
}

function pre($text, $lang = '', $parse_mode = 'markdown')
{
    if (strtolower($parse_mode) === 'markdown') {
        return "```{$lang}
{$text}
```";
    } elseif (strtolower($parse_mode) === 'html') {
        return "<pre lang='{$lang}'>{$text}</pre>";
    }
}

function code($text, $parse_mode = 'markdown'){
    if (strtolower($parse_mode) === 'markdown') {
        return "`{$text}`";
    } elseif (strtolower($parse_mode) === 'html') {
        return "<code>{$text}</code>";
    }
}

function inlineurl($text, $url, $parse_mode = 'markdown')
{
    if (strtolower($parse_mode) === 'markdown') {
        return "[{$text}](tg://{$url})";
    } elseif (strtolower($parse_mode) === 'html') {
        return "<a href='{$url}'>{$text}</a>";
    }
}