<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class ManageSiteSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Situs';
    protected static ?string $title = 'Pengaturan Situs';
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(SiteSettings::class);
        $this->form->fill($settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Branding')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('Nama Situs')
                            ->required(),
                        Forms\Components\TextInput::make('tagline')
                            ->label('Tagline'),
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('settings'),
                        Forms\Components\FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->directory('settings'),
                    ])->columns(2),

                Forms\Components\Section::make('Warna Tema')
                    ->schema([
                        Forms\Components\ColorPicker::make('primary_color')
                            ->label('Warna Primary'),
                        Forms\Components\ColorPicker::make('secondary_color')
                            ->label('Warna Secondary'),
                        Forms\Components\ColorPicker::make('accent_color')
                            ->label('Warna Accent'),
                    ])->columns(3),

                Forms\Components\Section::make('Kontak & WhatsApp')
                    ->schema([
                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp')
                            ->helperText('Format: 62812xxxxxxx (tanpa spasi, tanpa +)')
                            ->required(),
                        Forms\Components\Textarea::make('whatsapp_message_template')
                            ->label('Template Pesan WhatsApp')
                            ->helperText('Gunakan {service_name} sebagai placeholder nama jasa')
                            ->rows(3),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email(),
                    ]),

                Forms\Components\Section::make('Social Media')
                    ->schema([
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url(),
                        Forms\Components\TextInput::make('tiktok_url')
                            ->label('TikTok URL')
                            ->url(),
                    ])->columns(2),

                Forms\Components\Section::make('Hero Section')
                    ->description('Bagian utama paling atas di landing page')
                    ->schema([
                        Forms\Components\TextInput::make('hero_headline')
                            ->label('Headline')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('hero_subheadline')
                            ->label('Subheadline')
                            ->rows(2)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('hero_cta_text')
                            ->label('Teks Tombol CTA')
                            ->required(),

                        Forms\Components\FileUpload::make('hero_background_images')
                            ->label('Galeri Background Hero (bergantian otomatis)')
                            ->helperText('Upload 2 atau lebih gambar, akan tampil bergantian di halaman utama')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->directory('settings')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('About Section')
                    ->description('Bagian "Tentang Kami" di landing page')
                    ->schema([
                        Forms\Components\TextInput::make('about_title')
                            ->label('Judul')
                            ->required(),

                        Forms\Components\Textarea::make('about_description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('about_photo')
                            ->label('Foto (opsional)')
                            ->image()
                            ->directory('settings'),

                        Forms\Components\TextInput::make('about_years_experience')
                            ->label('Tahun Pengalaman')
                            ->numeric()
                            ->default(1),

                        Forms\Components\TextInput::make('about_total_clients')
                            ->label('Total Klien')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('about_total_projects')
                            ->label('Total Project Selesai')
                            ->numeric()
                            ->default(0),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $settings = app(SiteSettings::class);
        $settings->site_name = $data['site_name'];
        $settings->tagline = $data['tagline'];
        $settings->logo = $data['logo'];
        $settings->favicon = $data['favicon'];
        $settings->primary_color = $data['primary_color'];
        $settings->secondary_color = $data['secondary_color'];
        $settings->accent_color = $data['accent_color'];
        $settings->whatsapp_number = $data['whatsapp_number'];
        $settings->whatsapp_message_template = $data['whatsapp_message_template'];
        $settings->email = $data['email'];
        $settings->instagram_url = $data['instagram_url'];
        $settings->tiktok_url = $data['tiktok_url'];

        $settings->hero_headline = $data['hero_headline'];
        $settings->hero_subheadline = $data['hero_subheadline'];
        $settings->hero_cta_text = $data['hero_cta_text'];
        $settings->hero_background_images = $data['hero_background_images'] ?? [];
        $settings->about_title = $data['about_title'];
        $settings->about_description = $data['about_description'];
        $settings->about_photo = $data['about_photo'];
        $settings->about_years_experience = $data['about_years_experience'];
        $settings->about_total_clients = $data['about_total_clients'];
        $settings->about_total_projects = $data['about_total_projects'];

        $settings->save();

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}