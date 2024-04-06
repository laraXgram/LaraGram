<?php

namespace LaraGram\Core\Cli\Error;

use Bramus\Ansi\Ansi;
use Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR;
use Bramus\Ansi\Writers\StreamWriter;

class Logger
{
    public static function success($message, bool $exit = false): void
    {
        $ansi = new Ansi(new StreamWriter('php://stdout'));
        $ansi->color([SGR::COLOR_BG_GREEN, SGR::COLOR_FG_GREEN_BRIGHT])
            ->bold()
            ->tab()
            ->text("    {$message}    ")
            ->nostyle()
            ->bell();
        echo PHP_EOL;

        if ($exit){
            exit();
        }
    }

    public static function failed($message, bool $exit = false): void
    {
        $ansi = new Ansi(new StreamWriter('php://stdout'));
        $ansi->color([SGR::COLOR_BG_RED, SGR::COLOR_FG_RED_BRIGHT])
            ->bold()
            ->tab()
            ->text("    {$message}    ")
            ->nostyle()
            ->bell();
        echo PHP_EOL;

        if ($exit){
            exit();
        }
    }

    public static function warning($message, bool $exit = false): void
    {
        $ansi = new Ansi(new StreamWriter('php://stdout'));
        $ansi->color([SGR::COLOR_BG_YELLOW, SGR::COLOR_FG_YELLOW_BRIGHT])
            ->bold()
            ->tab()
            ->text("    {$message}    ")
            ->nostyle()
            ->bell();
        echo PHP_EOL;

        if ($exit){
            exit();
        }
    }

    public static function message($message, bool $exit = false): void
    {
        $ansi = new Ansi(new StreamWriter('php://stdout'));
        $ansi->color([SGR::COLOR_BG_BLUE, SGR::COLOR_FG_BLUE_BRIGHT])
            ->bold()
            ->tab()
            ->text("    {$message}    ")
            ->nostyle()
            ->bell();
        echo PHP_EOL;

        if ($exit){
            exit();
        }
    }

    public static function title($message, bool $exit = false): void
    {
        $ansi = new Ansi(new StreamWriter('php://stdout'));
        $ansi->color([SGR::COLOR_BG_PURPLE, SGR::COLOR_FG_PURPLE_BRIGHT])
            ->bold()
            ->tab()
            ->text("    {$message}    ")
            ->nostyle()
            ->bell();
        echo PHP_EOL;

        if ($exit){
            exit();
        }
    }

    public static function status(string $title, string|null $message = null, $type = 'success', bool $exit = false): void
    {
        if ($type === 'failed'){
            self::failed($title);
        }elseif ($type === 'warning'){
            self::warning($type);
        }else{
            self::success($title);
        }

        if(!is_null($message)){
            self::message($message);
        }

        if ($exit){
            exit();
        }
    }

    public static function blinker(string $message, SGR|string $color = SGR::COLOR_FG_CYAN, SGR|string $bg_color = SGR::COLOR_BG_CYAN_BRIGHT): void
    {
        $ansi = new Ansi(new StreamWriter('php://stdout'));
        $ansi->color([$bg_color, $color])
            ->blink()
            ->bold()
            ->tab()
            ->text("    {$message}    ")
            ->nostyle();
        echo PHP_EOL;
    }
}