<?php

namespace LaraGram\Core\Http;

use LaraGram\Core\Cli\Error\Logger;

class RegisterApi
{
    public function api(string $api, ...$parameters)
    {
        $division_class_method = explode('@', $api);
        $api_parts = explode('\\', $division_class_method[0]);
        $api_class = "Bot\App\Controller\Api\\" . implode('\\', $api_parts);

        $instance = new $api_class;

        if (method_exists($instance, $division_class_method[1])) {
            return call_user_func([$instance, $division_class_method[1]], ...$parameters);
        } else {
            Logger::failed('API not found!');
        }
    }
}