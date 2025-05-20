<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PupukResource\Pages;
use App\Filament\Resources\PupukResource\RelationManagers;
use App\Models\BentukPupuk;
use App\Models\KategoriPupuk;
use App\Models\Pupuk;
use App\Models\SatuanPupuk;
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

class PupukResource extends Resource
{
    protected static ?string $model = Pupuk::class;

    protected static ?string $modelLabel = "Persediaan Pupuk";

    protected static ?string $pluralModelLabel = "Persediaan Pupuk";

    protected static ?string $navigationLabel = 'Pupuk';

    protected static ?string $navigationIcon = 'carbon-sprout';

    protected static ?string $slug = "persediaan-pupuk";

    protected static ?string $breadcrumb = "Persediaan Pupuk";

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Kelola Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_pupuk')->label('Nama Pupuk')->placeholder('Masukkan nama pupuk')->required(),

                Select::make('satuan_pupuk_id')->label('Satuan')->placeholder('Pilih satuan pupuk')
                ->options(SatuanPupuk::all()->pluck('nama_satuan', 'id'))->required(),

                Select::make('bentuk_pupuk_id')->label('Bentuk')->placeholder('Pilih bentuk pupuk')
                ->options(BentukPupuk::all()->pluck('nama_bentuk', 'id'))->required(),

                Select::make('kategori_pupuk_id')->label('Kategori')->placeholder('Pilih kategori pupuk')
                ->options(KategoriPupuk::all()->pluck('nama_kategori', 'id'))->required(),

                TextInput::make('jumlah_persediaan')->label('Jumlah Persediaan')->placeholder('Masukkan jumlah persediaan')->required(),

                TextInput::make('jumlah_dipakai')->label('Jumlah dipakai')->placeholder('Masukkan jumlah dipakai')->required(),

                TextInput::make('sisa')->label('Sisa')->placeholder('Masukkan jumlah sisa')->required(),
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
            'index' => Pages\ListPupuks::route('/'),
            'create' => Pages\CreatePupuk::route('/create'),
            'edit' => Pages\EditPupuk::route('/{record}/edit'),
        ];
    }
}
