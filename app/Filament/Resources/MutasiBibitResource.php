<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MutasiBibitResource\Pages;
use App\Filament\Resources\MutasiBibitResource\RelationManagers;
use App\Models\MutasiBibit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MutasiBibitResource extends Resource
{
    protected static ?string $model = MutasiBibit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bibit.jenis_bibit')->label('Jenis Bibit'),
                ColumnGroup::make('GHA', [
                    TextColumn::make('gha1')->label('Blok 1'),
                    TextColumn::make('gha2')->label('Blok 2'),
                    TextColumn::make('gha3')->label('Blok 3'),
                    TextColumn::make('gha4')->label('Blok 4')
                ])->alignment(Alignment::Center),
                  ColumnGroup::make('AHA', [
                    TextColumn::make('aha1')->label('Blok 1'),
                    TextColumn::make('aha2')->label('Blok 2'),
                    TextColumn::make('aha3')->label('Blok 3'),
                    TextColumn::make('aha4')->label('Blok 4')
                ])->alignment(Alignment::Center),
                  ColumnGroup::make('OGA', [
                    TextColumn::make('oga1')->label('Blok 1'),
                    TextColumn::make('oga2')->label('Blok 2'),
                    TextColumn::make('oga3')->label('Blok 3'),
                    TextColumn::make('oga4')->label('Blok 4')
                ])->alignment(Alignment::Center),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make()
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
            'index' => Pages\ListMutasiBibits::route('/'),
            'create' => Pages\CreateMutasiBibit::route('/create'),
            'edit' => Pages\EditMutasiBibit::route('/{record}/edit'),
        ];
    }
}
