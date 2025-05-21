<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pestisida;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PestisidaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PestisidaResource\RelationManagers;
use App\Models\BentukPestisida;
use App\Models\KategoriPestisida;
use App\Models\SatuanPestisida;

class PestisidaResource extends Resource
{
    protected static ?string $model = Pestisida::class;

    protected static ?string $modelLabel = "Persediaan Pestisida";

    protected static ?string $pluralModelLabel = "Persediaan Pestisida";

    protected static ?string $navigationLabel = 'Pestisida';

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $slug = "persediaan-pestisida";

    protected static ?string $breadcrumb = "Persediaan Pestisida";

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Kelola Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_pestisida')->label('Nama Pestisida')->placeholder('Masukkan nama pestisida')->required(),

                Select::make('bentuk_pestisida_id')->label('Bentuk')->placeholder('Pilih bentuk pestisida')
                ->options(BentukPestisida::all()->pluck('nama_bentuk', 'id'))->required(),

                Select::make('kategori_pestisida_id')->label('Kategori')->placeholder('Pilih kategori pestisida')
                ->options(KategoriPestisida::all()->pluck('nama_kategori', 'id'))->required(),

                TextInput::make('jumlah_persediaan')->numeric()->label('Jumlah Persediaan')->placeholder('Masukkan jumlah persediaan')->required(),

                Select::make('satuan_pestisida_id')->label('Satuan')->placeholder('Pilih satuan pestisida')
                ->options(SatuanPestisida::all()->pluck('nama_satuan', 'id'))->required(),

                TextInput::make('jumlah_dipakai')->numeric()->label('Jumlah dipakai')->placeholder('Masukkan jumlah dipakai')->required(),

                TextInput::make('sisa')->label('Sisa')->numeric()->placeholder('Masukkan jumlah sisa')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pestisida')->label('Nama Pestisida'),
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
            'index' => Pages\ListPestisidas::route('/'),
            'create' => Pages\CreatePestisida::route('/create'),
            'edit' => Pages\EditPestisida::route('/{record}/edit'),
        ];
    }
}
