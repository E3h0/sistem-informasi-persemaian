<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pupuk;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BentukPupuk;
use App\Models\SatuanPupuk;
use App\Models\KategoriPupuk;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PupukResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PupukResource\RelationManagers;

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

                TextInput::make('jumlah_persediaan')->numeric()->label('Jumlah Persediaan')->placeholder('Masukkan jumlah persediaan')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data')->emptyStateDescription('Silahkan tambahkan data terlebih dahulu.')->emptyStateIcon('heroicon-o-exclamation-circle')
            ->columns([
                TextColumn::make('nama_pupuk')->label('Nama Pupuk')->alignCenter(),
                TextColumn::make('satuan.nama_satuan')->label('Satuan')->alignCenter(),
                TextColumn::make('bentuk.nama_bentuk')->label('Bentuk')->alignCenter(),
                TextColumn::make('kategori.nama_kategori')->label('Kategori')->alignCenter(),
                TextColumn::make('jumlah_persediaan')->label('Jumlah Persediaan')->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label('Hapus')
                ->modalHeading('Konfirmasi Penghapusan')->modalDescription('Apakah anda yakin ingin menghapus data? Data yang dihapus tidak dapat dikembalikan!')->successNotification(
                    Notification::make()->success()->title('Berhasil Dihapus')->body('Data Berhasil Dihapus')->color('success')->seconds(3)
                ),
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
