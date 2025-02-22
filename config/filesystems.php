<?php

return [
    'default' => 'local',

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

    ],

    'links' => [
        public_path('storage') => public_path('app/public'),
    ],

];
