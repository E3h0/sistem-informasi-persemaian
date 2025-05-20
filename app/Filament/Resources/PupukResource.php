<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PupukResource\Pages;
use App\Filament\Resources\PupukResource\RelationManagers;
use App\Models\Pupuk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PupukResource extends Resource
{
    protected static ?string $model = Pupuk::class;

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
                TextColumn::make('nama_pupuk')->label('Nama Pupuk')->alignCenter(),
                TextColumn::make('satuan.nama_satuan')->label('Satuan')->alignCenter(),
                TextColumn::make('bentuk.nama_bentuk')->label('Bentuk')->alignCenter(),
                TextColumn::make('kategori.nama_kategori')->label('Kategori')->alignCenter(),
                TextColumn::make('jumlah_persediaan')->label('Jumlah Persediaan')->alignCenter(),
                TextColumn::make('jumlah_dipakai')->label('Jumlah Dipakai')->alignCenter(),
                TextColumn::make('sisa')->label('Sisa')->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPupuks::route('/'),
            'create' => Pages\CreatePupuk::route('/create'),
            'edit' => Pages\EditPupuk::route('/{record}/edit'),
        ];
    }
}
