<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KategoriBibit;
use App\Models\PersediaanBibit;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersediaanBibitResource\Pages;
use App\Filament\Resources\PersediaanBibitResource\RelationManagers;

class PersediaanBibitResource extends Resource
{
    protected static ?string $model = PersediaanBibit::class;
    protected static ?string $modelLabel = "Persediaan Bibit";
    protected static ?string $pluralModelLabel = "Persediaan Bibit";
    protected static ?string $navigationIcon = 'tabler-seeding';
    protected static ?string $slug = "persediaan-bibit";
    protected static ?string $breadcrumb = "Persediaan Bibit";
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Kelola Bibit';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make("jenis_bibit")
            ->label("Jenis Bibit")->required()->placeholder("Masukkan Nama Bibit"),

            Select::make("kategori_bibit_id")
                ->relationship('kategori', 'nama_kategori')
                ->createOptionForm([
                    TextInput::make('nama_kategori')->required()
                ])->createOptionModalHeading('inihead'),

            TextInput::make("jumlah_persediaan")
            ->numeric()->required()->placeholder("Masukkan jumlah Persediaan"),

            Textarea::make("keterangan")->placeholder("Tambahkan Keterangan")
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data')->emptyStateDescription('Silahkan tambahkan data terlebih dahulu.')->emptyStateIcon('heroicon-o-exclamation-circle')
            ->recordUrl(false)
            ->columns([
                TextColumn::make('jenis_bibit')->label('Nama Bibit'),
                TextColumn::make('kategori.nama_kategori')->label('Kategori Bibit'),
                TextColumn::make('jumlah_persediaan')
                ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                ->label('Jumlah Stok'),
                TextColumn::make('created_at')->label('Dibuat Pada')->dateTime('l, j M Y')
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
