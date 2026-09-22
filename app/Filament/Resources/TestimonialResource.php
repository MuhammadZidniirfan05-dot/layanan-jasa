<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Testimoni';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama')
                ->required(),

            Forms\Components\TextInput::make('role')
                ->label('Peran/Institusi')
                ->placeholder('Misal: Mahasiswa Teknik Informatika'),

            Forms\Components\FileUpload::make('photo')
                ->label('Foto')
                ->image()
                ->directory('testimonials'),

            Forms\Components\Textarea::make('message')
                ->label('Pesan/Review')
                ->rows(4)
                ->required()
                ->columnSpanFull(),

            Forms\Components\Select::make('rating')
                ->label('Rating')
                ->options([
                    1 => '1 Bintang',
                    2 => '2 Bintang',
                    3 => '3 Bintang',
                    4 => '4 Bintang',
                    5 => '5 Bintang',
                ])
                ->default(5)
                ->required(),

            Forms\Components\Toggle::make('is_active')
                ->label('Tampilkan di landing page')
                ->default(true),

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
                Tables\Columns\ImageColumn::make('photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\TextColumn::make('rating')
                    ->badge(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->filters([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}