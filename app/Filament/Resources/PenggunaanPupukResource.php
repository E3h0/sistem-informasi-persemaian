<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pupuk;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use App\Models\PenggunaanPupuk;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenggunaanPupukResource\Pages;
use App\Filament\Resources\PenggunaanPupukResource\RelationManagers;

class PenggunaanPupukResource extends Resource
{
    protected static ?string $model = PenggunaanPupuk::class;

    protected static ?string $navigationIcon = 'fluentui-data-usage-20-o';

    protected static ?string $modelLabel = "Penggunaan Pupuk";

    protected static ?string $pluralModelLabel = "Penggunaan Pupuk";

    protected static ?string $navigationLabel = 'Penggunaan Pupuk';

    protected static ?string $breadcrumb = "Penggunaan Pupuk";

    protected static ?string $slug = 'penggunaan-pupuk';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Kelola Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pupuk_id')
                    ->live()
                    ->options(Pupuk::all()->pluck('nama_pupuk', 'id'))
                    ->label('Nama Pupuk')->placeholder('Pilih pupuk')->searchable()->searchPrompt('Cari pupuk')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                TextInput::make('jumlah_penggunaan')
                    ->placeholder(function (Get $get) {
                        $pupukId = $get('pupuk_id');

                        if (!$pupukId) {
                            return 'Masukkan jumlah penggunaan';
                        }

                        $pupuk = PenggunaanPupuk::with('satuanPupuk')->find($pupukId);
                        $satuan = $pupuk->satuanPupuk->nama_satuan ?? 'unit yang dipilih';

                        return "Masukkan jumlah penggunaan pupuk dalam satuan $satuan";
                    })
                    ->suffix(function (Get $get) {
                        $pupukId = $get('pupuk_id');

                        if (!$pupukId) {
                            return '';
                        }

                        $pupuk = PenggunaanPupuk::with('satuanPupuk')->find($pupukId);
                        $satuan = $pupuk->satuanPupuk->nama_satuan ?? '';

                        return "$satuan";
                    })
                    ->label('Jumlah Penggunaan')
                    ->numeric()
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                DatePicker::make('tanggal_penggunaan')
                    ->native(false)->placeholder('Masukkan tanggal penggunaan')
                    ->displayFormat('l, j M Y')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                TextInput::make('#')
                    ->helperText('Otomatis diambil dari user yang login saat ini.')
                    ->label('Pencatat')->placeholder(Filament::auth()->user()->name)
                    ->dehydrated(false)
                    ->markAsRequired()
                    ->readOnly(),

                Hidden::make('user_id')
                    ->default(Filament::auth()->user()->id)
                    ->dehydrated(),

                Textarea::make("keterangan")->placeholder("Tambahkan Keterangan")->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data')->emptyStateDescription('Silahkan tambahkan data terlebih dahulu.')->emptyStateIcon('heroicon-o-exclamation-circle')
            ->recordUrl(false)
            ->columns([
                TextColumn::make('pupuk.nama_pupuk')
                    ->label('Nama Pupuk')
                    ->searchable()->sortable(),

                TextColumn::make('bentukPupuk.nama_bentuk')
                    ->label('Bentuk'),

                TextColumn::make('kategoriPupuk.nama_kategori')
                    ->label('Kategori'),

                TextColumn::make('jumlah_penggunaan')
                    ->label('Jumlah Penggunaan')->numeric()->alignCenter()
                    ->sortable()
                    ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                TextColumn::make('satuanPupuk.nama_satuan')
                    ->label('Satuan'),

                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('tanggal_penggunaan')
                    ->label('Tanggal Penggunaan')
                    ->sortable()->dateTime('l, j M Y'),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')->dateTime('l, j M Y')
                    ->sortable()->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')->dateTime('l, j M Y')
                    ->sortable()->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('keterangan')->label('Keterangan')
                    ->placeholder('Tidak ada keterangan yang ditambahkan.')
                    ->toggleable(isToggledHiddenByDefault:true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()->label('Hapus')
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
            'index' => Pages\ListPenggunaanPupuks::route('/'),
            'create' => Pages\CreatePenggunaanPupuk::route('/create'),
            'edit' => Pages\EditPenggunaanPupuk::route('/{record}/edit'),
        ];
    }
}
