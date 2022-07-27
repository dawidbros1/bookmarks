<?php

declare (strict_types = 1);

use App\Model\Config;

return new Config(
    [
        'db' => [
            'host' => 'localhost',
            'database' => '',
            'user' => '',
            'password' => '',
        ],
        'mail' => [
            'email' => 'websideEmail@domaina.com',
        ],
        'upload' => [
            'path' => [
                'avatar' => 'uploads/images/avatar/',
            ],
        ],
        'default' => [
            'path' => [
                'avatar' => 'public/images/avatar.png',
                'medium' => 'public/images/SocialMedia/',
            ],
            'route' => [
                'home' => 'home',
                'logout' => 'auth.login',
            ],
        ],
        'hash' => [
            'method' => 'sha256', // sha25 || md5 ...
        ],
        'reCAPTCHA' => [
            'key' => [
                'side' => '',
                'secret' => '',
            ],
        ],
    ]
);
