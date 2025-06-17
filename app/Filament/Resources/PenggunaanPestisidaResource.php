<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\Pestisida;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use App\Models\PenggunaanPestisida;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Factories\Relationship;
use App\Filament\Resources\PenggunaanPestisidaResource\Pages;
use App\Filament\Resources\PenggunaanPestisidaResource\RelationManagers;

class PenggunaanPestisidaResource extends Resource
{
    protected static ?string $model = PenggunaanPestisida::class;

    protected static ?string $navigationIcon = 'fluentui-data-usage-20-o';

    protected static ?string $modelLabel = "Penggunaan Pestisida";

    protected static ?string $pluralModelLabel = "Penggunaan Pestisida";

    protected static ?string $navigationLabel = 'Penggunaan Pestisida';

    protected static ?string $breadcrumb = "Penggunaan Pestisida";

    protected static ?string $slug = 'penggunaan-pestisida';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Kelola Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pestisida_id')
                    ->live()
                    ->options(Pestisida::all()->pluck('nama_pestisida', 'id'))
                    ->label('Nama Pestisida')->placeholder('Pilih pestisida')->searchable()->searchPrompt('Cari pestisida')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                TextInput::make('jumlah_penggunaan')
                    ->placeholder(function (Get $get) {
                        $pestisidaId = $get('pestisida_id');

                        if (!$pestisidaId) {
                            return 'Masukkan jumlah penggunaan';
                        }

                        $pestisida = PenggunaanPestisida::with('satuanPestisida')->find($pestisidaId);
                        $satuan = $pestisida->satuanPestisida->nama_satuan ?? 'unit yang dipilih';

                        return "Masukkan jumlah penggunaan pupuk dalam satuan $satuan";
                    })
                    ->suffix(function (Get $get) {
                        $pestisidaId = $get('pestisida_id');

                        if (!$pestisidaId) {
                            return '';
                        }

                        $pestisida = PenggunaanPestisida::with('satuanPestisida')->find($pestisidaId);
                        $satuan = $pestisida->satuanPestisida->nama_satuan ?? '';

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
                TextColumn::make('pestisida.nama_pestisida')
                    ->label('Nama Pestisida')
                    ->searchable()->sortable(),

                TextColumn::make('bentukPestisida.nama_bentuk')
                    ->label('Bentuk'),

                TextColumn::make('kategoriPestisida.nama_kategori')
                    ->label('Kategori'),

                TextColumn::make('jumlah_penggunaan')
                    ->label('Jumlah Penggunaan')->numeric()->alignCenter()
                    ->sortable()
                    ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                TextColumn::make('satuanPestisida.nama_satuan')
                    ->label('Satuan'),

                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->sortable()->toggleable(isToggledHiddenByDefault:true),

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
            'index' => Pages\ListPenggunaanPestisidas::route('/'),
            'create' => Pages\CreatePenggunaanPestisida::route('/create'),
            'edit' => Pages\EditPenggunaanPestisida::route('/{record}/edit'),
        ];
    }
}
