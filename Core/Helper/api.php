<?php
namespace Bot\Core\Helper;

use Bot\App\Controller\Api\Api;

/**
 * user api controller
 * @param string $api ApiName@MethdeName
 * @param mixed ...$parameters parameters
 * @return mixed data
 */
function Api(string $api, ...$parameters): mixed
{
    return (new Api())->api($api, ...$parameters);
}