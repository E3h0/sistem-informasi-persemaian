<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersediaanBibitResource\Pages;
use App\Filament\Resources\PersediaanBibitResource\RelationManagers;
use App\Models\PersediaanBibit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersediaanBibitResource extends Resource
{
    protected static ?string $model = PersediaanBibit::class;
    protected static ?string $modelLabel = "Persediaan Bibit";
    protected static ?string $pluralModelLabel = "Persediaan Bibit";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            //
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_bibit')->label('Nama Bibit'),
                TextColumn::make('kategori.nama_kategori')->label('Kategori Bibit'),
                TextColumn::make('jumlah_persediaan')->numeric(thousandsSeparator: '.')->label('Jumlah Stok')
            ])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
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
            'index' => Pages\ListPersediaanBibits::route('/'),
            'create' => Pages\CreatePersediaanBibit::route('/create'),
            'edit' => Pages\EditPersediaanBibit::route('/{record}/edit'),
        ];
    }
}
