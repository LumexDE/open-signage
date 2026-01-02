<?php

namespace App\Filament\Pages;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use App\Models\Playlist;
use App\Settings\RemoteSettings;
use Filament\Forms;
use Filament\Pages\SettingsPage;

class ManageRemote extends SettingsPage
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cloud';

    protected static string $settings = RemoteSettings::class;

    public static function canAccess(): bool
    {
        return (bool) !config('app.online_mode');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('driver')
                    ->label('Driver')
                    ->required()
                    ->options([
                        'mysql' => 'MySQL'
                    ]),
                TextInput::make('url')
                    ->label('URL')
                    ->disabled(),
                TextInput::make('host')
                    ->label('Host')
                    ->required()
                    ->columnSpanFull()
                    ->ip()
                    ->url()
                    ->placeholder('127.0.0.1'),
                TextInput::make('port')
                    ->label('Port')
                    ->required()
                    ->maxValue(100000)
                    ->placeholder('127.0.0.1')
                    ->numeric(),
                TextInput::make('database')
                    ->label('Database')
                    ->required()
                    ->maxLength(1000)
                    ->placeholder('database'),
                TextInput::make('username')
                    ->label('Username')
                    ->required()
                    ->maxLength(1000)
                    ->placeholder('Example name'),
                TextInput::make('password')
                    ->label('Password')
                    ->required()
                    ->password()
                    ->maxLength(1000),
                Select::make('charset')
                    ->label('Charset')
                    ->required()
                    ->options([
                        'utf8mb4' => 'UTF-8'
                    ]),
                Select::make('collation')
                    ->label('Collation')
                    ->required()
                    ->options([
                        'utf8mb4_unicode_ci' => 'utf8mb4_unicode_ci'
                    ]),
                TextInput::make('prefix')
                    ->label('Prefix')
                    ->maxLength(100),
                Select::make('engine')
                    ->label('Engine')
                    ->required()
                    ->options([
                        'InnoDB' => 'InnoDB'
                    ])
                    ->default([
                        'InnoDB' => 'InnoDB'
                    ]),
            ]);
    }
}
