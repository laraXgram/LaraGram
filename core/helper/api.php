<?php

use Bot\App\Controller\Api\Api;

function Api(string $api, ...$parameters): mixed
{
    return (new Api())->api($api, ...$parameters);
}