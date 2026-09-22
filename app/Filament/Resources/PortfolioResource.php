<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Portfolio';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('service_id')
                ->relationship('service', 'title')
                ->label('Terkait Layanan (opsional)')
                ->searchable(),

            Forms\Components\TextInput::make('title')
                ->label('Judul Project')
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->rows(4)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('client_name')
                ->label('Nama Klien (opsional)'),

            Forms\Components\FileUpload::make('thumbnail')
                ->label('Thumbnail Utama')
                ->image()
                ->directory('portfolios'),

            Forms\Components\FileUpload::make('images')
                ->label('Galeri Tambahan')
                ->image()
                ->multiple()
                ->directory('portfolios/gallery')
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_featured')
                ->label('Tampilkan sebagai unggulan'),

            Forms\Components\TextInput::make('order')
                ->label('Urutan')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service.title')
                    ->label('Layanan')
                    ->badge(),
                Tables\Columns\TextColumn::make('client_name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}