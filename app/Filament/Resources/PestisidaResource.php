<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pestisida;
use Filament\Tables\Table;
use App\Models\BentukPestisida;
use App\Models\SatuanPestisida;
use Filament\Resources\Resource;
use App\Models\KategoriPestisida;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PestisidaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PestisidaResource\RelationManagers;

class PestisidaResource extends Resource
{
    protected static ?string $model = Pestisida::class;

    protected static ?string $modelLabel = "Persediaan Pestisida";

    protected static ?string $pluralModelLabel = "Persediaan Pestisida";

    protected static ?string $navigationLabel = 'Pestisida';

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $slug = "persediaan-pestisida";

    protected static ?string $breadcrumb = "Persediaan Pestisida";

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Kelola Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_pestisida')
                    ->label('Nama Pestisida')->placeholder('Masukkan nama pestisida')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                Select::make('satuan_pestisida_id')->label('Satuan')
                    ->placeholder('Pilih satuan pestisida')
                    ->relationship('satuan', 'nama_satuan')
                    ->createOptionForm([
                    TextInput::make('nama_satuan')
                        ->required()
                        ->label('Nama Satuan')->placeholder('Masukkan Nama Satuan')
                        ->rules(['min:3'])->validationMessages([
                            'min' => 'Minimal harus 3 karakter'
                        ])
                ])->createOptionModalHeading('Tambah Satuan')
                ->createOptionUsing(function (array $data) {
                    SatuanPestisida::create($data);
                    Notification::make()
                    ->title('Sukses')
                    ->body('Satuan baru berhasil ditambahkan.')
                    ->success()
                    ->seconds(3)
                    ->send();
                })->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                Select::make('bentuk_pestisida_id')
                    ->label('Bentuk')->placeholder('Pilih bentuk pestisida')
                    ->relationship('bentuk', 'nama_bentuk')
                    ->createOptionForm([
                    TextInput::make('nama_bentuk')
                        ->required()
                        ->label('Nama Bentuk')->placeholder('Masukkan Nama Bentuk')
                        ->rules(['min:3'])->validationMessages([
                            'min' => 'Minimal harus 3 karakter'
                        ])
                ])->createOptionModalHeading('Tambah Bentuk')
                ->createOptionUsing(function (array $data) {
                    BentukPestisida::create($data);
                    Notification::make()
                    ->title('Sukses')
                    ->body('Bentuk baru berhasil ditambahkan.')
                    ->success()
                    ->seconds(3)
                    ->send();
                })->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                Select::make('kategori_pestisida_id')
                    ->label('Kategori')->placeholder('Pilih kategori pestisida')
                    ->relationship('kategori', 'nama_kategori')
                    ->createOptionForm([
                    TextInput::make('nama_kategori')
                        ->required()
                        ->label('Nama Kategori')->placeholder('Masukkan Nama Kategori')
                        ->rules(['min:3'])->validationMessages([
                            'min' => 'Minimal harus 3 karakter'
                        ])
                ])->createOptionModalHeading('Tambah Kategori')
                ->createOptionUsing(function (array $data) {
                    KategoriPestisida::create($data);
                    Notification::make()
                    ->title('Sukses')
                    ->body('Kategori baru berhasil ditambahkan.')
                    ->success()
                    ->seconds(3)
                    ->send();
                })->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                TextInput::make('jumlah_persediaan')
                    ->numeric()->label('Jumlah Persediaan')->placeholder('Masukkan jumlah persediaan')
                    ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired(),

                Textarea::make("keterangan")->placeholder("Tambahkan Keterangan")
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data')->emptyStateDescription('Silahkan tambahkan data terlebih dahulu.')->emptyStateIcon('heroicon-o-exclamation-circle')
            ->recordUrl(false)
            ->columns([
                TextColumn::make('nama_pestisida')
                    ->label('Nama Pestisida')
                    ->searchable()->sortable(),

                TextColumn::make('bentuk.nama_bentuk')
                    ->label('Bentuk')->alignCenter()
                    ->searchable(),

                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')->alignCenter()
                    ->searchable(),

                TextColumn::make('jumlah_persediaan')
                    ->label('Jumlah Persediaan')->alignCenter()
                    ->sortable(),

                TextColumn::make('satuan.nama_satuan')
                    ->label('Satuan')->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')->dateTime('l, j M Y')
                    ->sortable(),

                TextColumn::make('keterangan')->label('Keterangan')
                    ->placeholder('Tidak ada keterangan yang ditambahkan.')
                    ->toggleable(isToggledHiddenByDefault:true)
            ])->searchDebounce('300ms')
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
            'index' => Pages\ListPestisidas::route('/'),
            'create' => Pages\CreatePestisida::route('/create'),
            'edit' => Pages\EditPestisida::route('/{record}/edit'),
        ];
    }
}
