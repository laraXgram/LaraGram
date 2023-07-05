<?php

namespace Bot\Core;

abstract class Matching
{
    private const REGEX_PATTERN = '/{((?:(?!\d+,?\d?+)\w)+?)}/';

    private array|string|null $pattern;
    private mixed $callable;
    private mixed $request;

    protected function action(array|string $type, array|string|null $pattern, callable $action): void
    {
        $this->pattern = $pattern;
        $this->callable = $action;
        $this->request = new Request();
        if ($type === 'text' && $this->request->Text() !== null) {
            $this->matchText($this->request->Text());
        } elseif ($type === 'command' && $this->request->Text() !== null) {
            $this->matchCommand($this->request->Text());
        } elseif ($type === 'dice' && !is_null($this->request->Dice())) {
            $this->matchDice($this->request->Dice());
        } elseif (in_array($type, ['voice', 'video_note', 'video', 'sticker', 'photo', 'document', 'audio', 'animation'])) {
            $this->matchMedia($type);
        } elseif ($type !== 'dice') {
            $this->match($type);
        }
    }

    private function matchText(string $value): void
    {
        if ($this->request->Text() !== null) {
            if (is_array($this->pattern)) {
                foreach ($this->pattern as $patternItem) {
                    if ($this->executeRegex($patternItem, $value)) {
                        return;
                    }
                }
            } else {
                $this->executeRegex($this->pattern, $value);
            }
        }
    }

    private function matchCommand(string $value): void
    {
        if ($this->request->Entities()[0]['type'] !== 'bot_command') {
            return;
        }

        $atPosition = strpos($value, '@');
        if ($atPosition) {
            $substring = substr($value, $atPosition + 1);
            if (!str_contains($substring, $this->request->BotUsername())) {
                return;
            }
        }

        $result = preg_replace('/@[^ ]+/', '', $value);
        $result = str_replace('/', '', $result);

        if (is_array($this->pattern)) {
            array_reduce($this->pattern, function ($carry, $patternItem) use ($result) {
                return $carry || $this->executeRegex($patternItem, $result);
            }, false);
        } else {
            $this->executeRegex($this->pattern, $result);
        }
    }

    private function matchMedia(string $value): void
    {
        if (isset($this->request->Message()[$value])) {
            $message = $this->request->Message()[$value];
            $value === 'photo' ? $file_id = $message[0]['file_unique_id'] : $file_id = $message['file_unique_id'];
            if (is_array($this->pattern) && in_array($file_id, $this->pattern) || $file_id === $this->pattern || is_null($this->pattern) && isset($file_id)) {
                call_user_func($this->callable, $this->request);
            }
        }
    }

    private function matchDice(array|null $value): void
    {
        if (isset($this->pattern[0]) && isset($this->pattern[1]) && $this->pattern[0] === $value['emoji'] && $this->pattern[1] === $value['value']) {
            call_user_func($this->callable, $this->request);
        } elseif (isset($this->pattern[0]) && !isset($this->pattern[1]) && $this->pattern[0] === $value['emoji']) {
            call_user_func($this->callable, $this->request);
        } elseif (isset($this->pattern[1]) && !isset($this->pattern[0]) && $this->pattern[1] === $value['value']) {
            call_user_func($this->callable, $this->request);
        } elseif (is_null($this->pattern[0])) {
            call_user_func($this->callable, $this->request);
        }
    }

    private function match(string $type): void
    {
        $message = $this->request->Message();
        if (isset($message[$type])) {
            call_user_func($this->callable, $this->request);
        }
    }

    private function executeRegex(string $pattern, string $value): bool
    {
        $regex = '/^' . preg_replace(self::REGEX_PATTERN, '(?<$1>.*)', $pattern) . '?$/mUu';
        if (preg_match($regex, $value, $matches, PREG_UNMATCHED_AS_NULL)) {
            unset($matches[0]);
            $parameters = array_intersect_key($matches, array_flip(array_filter(array_keys($matches), 'is_numeric')));
            call_user_func_array($this->callable, array_merge([$this->request], $parameters));
            return true;
        }

        return false;
    }
}