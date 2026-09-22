<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers\PackagesRelationManager;
use App\Models\Service;
use App\Models\ServiceCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Layanan';
    protected static ?string $navigationLabel = 'Daftar Layanan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Layanan')
                ->schema([
                    Forms\Components\Select::make('service_category_id')
                        ->label('Kategori')
                        ->options(ServiceCategory::pluck('name', 'id'))
                        ->searchable()
                        ->required(),

                    Forms\Components\TextInput::make('title')
                        ->label('Nama Layanan')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $state, Forms\Set $set) => $set('slug', Str::slug($state))),

                    Forms\Components\TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(4)
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('services')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('starting_price')
                        ->label('Harga Mulai Dari')
                        ->numeric()
                        ->prefix('Rp'),
                ])->columns(2),

            Forms\Components\Section::make('WhatsApp')
                ->schema([
                    Forms\Components\Textarea::make('whatsapp_message_template')
                        ->label('Template Pesan WA Khusus (opsional)')
                        ->helperText('Kosongkan jika ingin pakai template default dari Pengaturan Situs. Placeholder: {service_name}')
                        ->rows(3),
                ]),

            Forms\Components\Section::make('Status')
                ->schema([
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif (tampil di landing page)')
                        ->default(true),

                    Forms\Components\TextInput::make('order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge(),
                Tables\Columns\TextColumn::make('starting_price')
                    ->label('Harga Mulai')
                    ->money('IDR'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->filters([
                Tables\Filters\SelectFilter::make('service_category_id')
                    ->label('Kategori')
                    ->options(ServiceCategory::pluck('name', 'id')),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PackagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}