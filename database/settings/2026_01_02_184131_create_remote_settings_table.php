<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('remote.driver', 'mysql');
        $this->migrator->add('remote.url', null);
        $this->migrator->add('remote.host', '127.0.0.1');
        $this->migrator->add('remote.port', 3306);
        $this->migrator->add('remote.database', '');
        $this->migrator->add('remote.username', '', true);
        $this->migrator->add('remote.password', '', true);
        $this->migrator->add('remote.charset', 'utf8mb4');
        $this->migrator->add('remote.collation', 'utf8mb4_unicode_ci');
        $this->migrator->add('remote.prefix', '');
        $this->migrator->add('remote.engine', 'InnoDB');
    }
};
