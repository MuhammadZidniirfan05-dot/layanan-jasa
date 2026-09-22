<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    public string $site_name;
    public string $tagline;
    public ?string $logo;
    public ?string $favicon;

    public string $primary_color;
    public string $secondary_color;
    public string $accent_color;

    public string $whatsapp_number;
    public string $whatsapp_message_template;
    public ?string $email;

    public ?string $instagram_url;
    public ?string $tiktok_url;

    public string $hero_headline;
    public string $hero_subheadline;
    public string $hero_cta_text;
    public ?string $hero_background_image;
    public array $hero_background_images = [];

    public string $about_title;
    public string $about_description;
    public ?string $about_photo;
    public int $about_years_experience;
    public int $about_total_clients;
    public int $about_total_projects;

    public static function group(): string
    {
        return 'site';
    }

    public function waLink(?string $serviceName = null, ?string $customTemplate = null): string
    {
        $template = $customTemplate ?: $this->whatsapp_message_template;

        $message = $serviceName
            ? str_replace('{service_name}', $serviceName, $template)
            : $template;

        $number = preg_replace('/\D/', '', $this->whatsapp_number);

        return 'https://wa.me/' . $number . '?text=' . urlencode($message);
    }
}
