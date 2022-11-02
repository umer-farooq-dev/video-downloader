<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '7.3.0',
    ],
    'requirements' => [
        'php' => [
            'bcmath',
            'ctype',
            'fileinfo',
            'JSON',
            'mbstring',
            'openssl',
            'pdo',
            'tokenizer',
            'cURL'            
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        '.env'               => is_writable(base_path('.env')),
        'storage/framework/' => '755',
        'storage/logs/'      => '755',
        'bootstrap/cache/'   => '755',
    ],

];