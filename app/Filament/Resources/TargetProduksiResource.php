<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TargetProduksiResource\Pages;
use App\Filament\Resources\TargetProduksiResource\RelationManagers;
use App\Models\TargetProduksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TargetProduksiResource extends Resource
{
    protected static ?string $model = TargetProduksi::class;

    protected static ?string $modelLabel = 'Target Produksi';

    protected static ?string $pluralModelLabel = 'Target Produksi';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Target Produksi';

    protected static ?string $slug = "target-produksi";

    protected static ?string $breadcrumb = 'Target Produksi';


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
                TextColumn::make("bibit.jenis_bibit")->label("Jenis Bibit"),
                TextColumn::make("target_produksi")->label("Target Produksi"),
                TextColumn::make("sudah_diproduksi")->label("Sudah Diproduksi"),
                TextColumn::make("sudah_distribusi")->label("Sudah Distribusi"),
                TextColumn::make("stok_akhir")->label("Stok Akhir")
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
            'index' => Pages\ListTargetProduksis::route('/'),
            'create' => Pages\CreateTargetProduksi::route('/create'),
            'edit' => Pages\EditTargetProduksi::route('/{record}/edit'),
        ];
    }

    // app/Filament/Resources/TargetProduksiResource.php
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['bibit']);
    }

}
