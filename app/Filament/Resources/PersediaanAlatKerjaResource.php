<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersediaanAlatKerjaResource\Pages;
use App\Filament\Resources\PersediaanAlatKerjaResource\RelationManagers;
use App\Models\PersediaanAlatKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersediaanAlatKerjaResource extends Resource
{
    protected static ?string $model = PersediaanAlatKerja::class;

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
                TextColumn::make('nama_barang')->label('Nama Barang'),
                TextColumn::make('kategori.nama_kategori')->label('Kategori'),

                TextColumn::make('jumlah_persediaan')->label('Jumlah Persediaan')
                ->numeric(),

                TextColumn::make('jumlah_dipakai')->label('Jumlah Dipakai')
                ->numeric(),

                TextColumn::make('keterangan')->label('Keterangan'),
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
            'index' => Pages\ListPersediaanAlatKerjas::route('/'),
            'create' => Pages\CreatePersediaanAlatKerja::route('/create'),
            'edit' => Pages\EditPersediaanAlatKerja::route('/{record}/edit'),
        ];
    }
}
