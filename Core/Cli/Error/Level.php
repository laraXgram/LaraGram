<?php

namespace LaraGram\Core\Cli\Error;

enum Level: string
{
    case Warning = "Warning";
    case Error = "Error";
    case Dangerous = "Dangerous";
    case ENV_Error = "ENV_Error";
}