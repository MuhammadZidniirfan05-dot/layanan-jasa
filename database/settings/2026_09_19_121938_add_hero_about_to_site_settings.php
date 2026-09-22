<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Hero Section
        $this->migrator->add('site.hero_headline', 'Solusi Jasa Website, Tugas Kuliah, dan PPT untuk Kamu');
        $this->migrator->add('site.hero_subheadline', 'Cepat, rapi, dan sesuai kebutuhan. Konsultasi gratis sekarang juga.');
        $this->migrator->add('site.hero_cta_text', 'Konsultasi via WhatsApp');
        $this->migrator->add('site.hero_background_image', null);

        // About Section
        $this->migrator->add('site.about_title', 'Tentang Kami');
        $this->migrator->add('site.about_description', 'Kami membantu kamu menyelesaikan kebutuhan digital, akademik, dan presentasi dengan hasil berkualitas dan tepat waktu.');
        $this->migrator->add('site.about_photo', null);
        $this->migrator->add('site.about_years_experience', 1);
        $this->migrator->add('site.about_total_clients', 0);
        $this->migrator->add('site.about_total_projects', 0);
    }

    public function down(): void
    {
        $this->migrator->deleteIfExists('site.hero_headline');
        $this->migrator->deleteIfExists('site.hero_subheadline');
        $this->migrator->deleteIfExists('site.hero_cta_text');
        $this->migrator->deleteIfExists('site.hero_background_image');
        $this->migrator->deleteIfExists('site.about_title');
        $this->migrator->deleteIfExists('site.about_description');
        $this->migrator->deleteIfExists('site.about_photo');
        $this->migrator->deleteIfExists('site.about_years_experience');
        $this->migrator->deleteIfExists('site.about_total_clients');
        $this->migrator->deleteIfExists('site.about_total_projects');
    }
};