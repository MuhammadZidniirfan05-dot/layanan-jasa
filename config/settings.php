<?php

return [

    'settings' => [
        App\Settings\SiteSettings::class,
    ],

    'setting_model' => \Spatie\LaravelSettings\Models\SettingsProperty::class,

    'migrations_directories' => [
        database_path('settings'),
    ],

    'migration_class_resolver' => \Spatie\LaravelSettings\Support\DefaultSettingsMigrationNameResolver::class,

    'repository' => 'database',

    'repositories' => [
        'database' => [
            'type' => \Spatie\LaravelSettings\SettingsRepositories\DatabaseSettingsRepository::class,
            'connection' => null,
        ],

        'redis' => [
            'type' => \Spatie\LaravelSettings\SettingsRepositories\RedisSettingsRepository::class,
            'connection' => null,
            'prefix' => null,
        ],
    ],

    'cache' => [
        'enabled' => env('SETTINGS_CACHE_ENABLED', false),
        'store' => null,
    ],

    'auto_discover_settings' => [
    ],

    'settings_factory' => \Spatie\LaravelSettings\SettingsFactory::class,

    'settings_caster' => \Spatie\LaravelSettings\SettingsCaster::class,

    'settings_data_transformer' => \Spatie\LaravelSettings\SettingsDataTransformer::class,

    'discover_settings_lock_path' => base_path('bootstrap/cache'),
];