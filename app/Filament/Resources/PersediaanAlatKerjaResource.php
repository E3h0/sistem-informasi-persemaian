<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\KategoriAlatKerja;
use App\Models\PersediaanAlatKerja;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersediaanAlatKerjaResource\Pages;
use App\Filament\Resources\PersediaanAlatKerjaResource\RelationManagers;

class PersediaanAlatKerjaResource extends Resource
{
    protected static ?string $model = PersediaanAlatKerja::class;

    protected static ?string $modelLabel = "Persediaan Alat Kerja";

    protected static ?string $pluralModelLabel = "Persediaan Alat Kerja";

    protected static ?string $navigationIcon = 'css-toolbox';

    protected static ?string $slug = "persediaan-alat-kerja";

    protected static ?string $breadcrumb = "Persediaan Alat Kerja";

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Kelola Barang';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_barang')->label('Nama Barang')->required()
                ->placeholder('Masukkan nama barang'),

                Select::make('kategori_id')->label('Kategori')->options(KategoriAlatKerja::all()->pluck('nama_kategori', 'id'))->placeholder('Pilih kategori barang')->required(),

                TextInput::make('jumlah_persediaan')->numeric()->label('Jumlah Persediaan')
                ->placeholder('Masukkan jumlah persediaan')->required(),

                TextInput::make('jumlah_dipakai')->numeric()->label('Jumlah Dipakai')
                ->placeholder('Masukkan jumlah persediaan')->required(),

                Textarea::make('keterangan')->label('Keterangan')->placeholder('Masukkan keterangan')->columnSpanFull()
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
            'index' => Pages\ListPersediaanAlatKerjas::route('/'),
            'create' => Pages\CreatePersediaanAlatKerja::route('/create'),
            'edit' => Pages\EditPersediaanAlatKerja::route('/{record}/edit'),
        ];
    }
}
