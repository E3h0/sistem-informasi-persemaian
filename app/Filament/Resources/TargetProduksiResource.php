<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TargetProduksiResource\Pages;
use App\Filament\Resources\TargetProduksiResource\RelationManagers;
use App\Models\PersediaanBibit;
use App\Models\TargetProduksi;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\textarea;

class TargetProduksiResource extends Resource
{
    protected static ?string $model = TargetProduksi::class;

    protected static ?string $modelLabel = 'Target Produksi';

    protected static ?string $pluralModelLabel = 'Target Produksi';

    protected static ?string $navigationIcon = 'fluentui-target-arrow-20-o';

    protected static ?string $navigationLabel = 'Target Produksi';

    protected static ?string $slug = "target-produksi";

    protected static ?string $breadcrumb = 'Target Produksi';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bibit_id')
                ->options(PersediaanBibit::all()->pluck('jenis_bibit', 'id'))
                ->label('Jenis Bibit')->placeholder('Pilih Jenis Bibit')
                ->required()->searchable()->searchPrompt('Cari Nama Bibit'),

                TextInput::make('target_produksi')->numeric()->required()
                ->label('Target Produksi')->placeholder('Masukkan Target Produksi'),

                TextInput::make('sudah_diproduksi')->numeric()->required()
                ->label('Sudah Diproduksi')->placeholder('Masukkan Jumlah Bibit Yang Sudah Diproduksi'),

                TextInput::make('sudah_distribusi')->numeric()->required()
                ->label('Sudah Distribusi')->placeholder('Masukkan Jumlah Bibit Yang Sudah Distribusi'),

                TextInput::make('stok_akhir')->numeric()->required()
                ->label('Stok Akhir')->placeholder('Masukkan Jumlah Stok Akhir')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("bibit.jenis_bibit")->label("Jenis Bibit"),

                TextColumn::make("target_produksi")->label("Target Produksi")
                ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                TextColumn::make("sudah_diproduksi")->label("Sudah Diproduksi")
                ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                TextColumn::make("sudah_distribusi")->label("Sudah Distribusi")
                ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                TextColumn::make("stok_akhir")->label("Stok Akhir")
                ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label('Hapus')
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
