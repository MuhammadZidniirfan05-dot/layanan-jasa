<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Branding
        $this->migrator->add('site.site_name', 'Nama Bisnis Kamu');
        $this->migrator->add('site.tagline', 'Solusi Jasa Website, Tugas Kuliah, dan PPT');
        $this->migrator->add('site.logo', null);
        $this->migrator->add('site.favicon', null);

        // Warna tema
        $this->migrator->add('site.primary_color', '#4F46E5');
        $this->migrator->add('site.secondary_color', '#6366F1');
        $this->migrator->add('site.accent_color', '#F59E0B');

        // Kontak & WhatsApp
        $this->migrator->add('site.whatsapp_number', '6281234567890');
        $this->migrator->add('site.whatsapp_message_template', 'Halo, saya tertarik dengan jasa {service_name}. Mohon info lebih lanjut.');
        $this->migrator->add('site.email', null);

        // Social media
        $this->migrator->add('site.instagram_url', null);
        $this->migrator->add('site.tiktok_url', null);
    }

    public function down(): void
    {
        $this->migrator->deleteIfExists('site.site_name');
        $this->migrator->deleteIfExists('site.tagline');
        $this->migrator->deleteIfExists('site.logo');
        $this->migrator->deleteIfExists('site.favicon');
        $this->migrator->deleteIfExists('site.primary_color');
        $this->migrator->deleteIfExists('site.secondary_color');
        $this->migrator->deleteIfExists('site.accent_color');
        $this->migrator->deleteIfExists('site.whatsapp_number');
        $this->migrator->deleteIfExists('site.whatsapp_message_template');
        $this->migrator->deleteIfExists('site.email');
        $this->migrator->deleteIfExists('site.instagram_url');
        $this->migrator->deleteIfExists('site.tiktok_url');
    }
};