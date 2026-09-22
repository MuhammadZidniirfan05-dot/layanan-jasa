<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.hero_background_images', []);
    }

    public function down(): void
    {
        $this->migrator->deleteIfExists('site.hero_background_images');
    }
};