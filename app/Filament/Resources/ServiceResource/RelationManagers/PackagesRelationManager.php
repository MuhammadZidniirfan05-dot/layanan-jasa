<?php

namespace App\Filament\Resources\ServiceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PackagesRelationManager extends RelationManager
{
    protected static string $relationship = 'packages';
    protected static ?string $title = 'Paket Harga';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Paket')
                ->placeholder('Basic / Standard / Premium')
                ->required(),

            Forms\Components\TextInput::make('price')
                ->label('Harga')
                ->numeric()
                ->prefix('Rp')
                ->required(),

            Forms\Components\TextInput::make('delivery_days')
                ->label('Estimasi Pengerjaan (hari)')
                ->numeric(),

            Forms\Components\Repeater::make('features')
                ->label('Daftar Fitur')
                ->simple(
                    Forms\Components\TextInput::make('feature')
                        ->required()
                        ->placeholder('Misal: Revisi 3x')
                )
                ->columnSpanFull()
                ->defaultItems(1),

            Forms\Components\Toggle::make('is_popular')
                ->label('Tandai sebagai paket populer'),

            Forms\Components\TextInput::make('order')
                ->label('Urutan')
                ->numeric()
                ->default(0),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Paket'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('delivery_days')
                    ->label('Estimasi (hari)'),
                Tables\Columns\IconColumn::make('is_popular')
                    ->label('Populer')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order'),
            ])
            ->defaultSort('order')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}