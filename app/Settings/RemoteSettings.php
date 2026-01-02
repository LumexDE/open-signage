<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class RemoteSettings extends Settings
{
    public string $driver;
    public ?string $url;
    public string $host;
    public int $port;
    public string $database;
    public string $username;
    public string $password;
    public string $charset;
    public string $collation;
    public ?string $prefix;
    public ?string $engine;

    public static function group(): string
    {
        return 'remote';
    }
}
