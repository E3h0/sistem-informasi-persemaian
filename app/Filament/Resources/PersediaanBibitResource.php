<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersediaanBibitResource\Pages;
use App\Filament\Resources\PersediaanBibitResource\RelationManagers;
use App\Models\KategoriBibit;
use App\Models\PersediaanBibit;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
    protected static ?string $navigationIcon = 'tabler-seeding';
    protected static ?string $slug = "persediaan-bibit";
    protected static ?string $breadcrumb = "Persediaan Bibit";

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make("jenis_bibit")
            ->label("Jenis Bibit")->required()->placeholder("Masukkan Nama Bibit"),

            Select::make("kategori_bibit_id")
            ->options(KategoriBibit::all()->pluck('nama_kategori', 'id'))
            ->placeholder("Pilih Kategori Bibit")
            ->label("Kategori Bibit")
            ->required(),

            TextInput::make("jumlah_persediaan")
            ->numeric()->required()->placeholder("Masukkan jumlah Persediaan"),

            Textarea::make("keterangan")->placeholder("Tambahkan Keterangan")
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_bibit')->label('Nama Bibit'),
                TextColumn::make('kategori.nama_kategori')->label('Kategori Bibit'),
                TextColumn::make('jumlah_persediaan')
                ->numeric(thousandsSeparator: '.')
                ->label('Jumlah Stok')
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
