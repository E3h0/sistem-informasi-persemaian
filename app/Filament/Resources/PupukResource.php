<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pupuk;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BentukPupuk;
use App\Models\SatuanPupuk;
use App\Models\KategoriPupuk;
use Filament\Facades\Filament;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
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
                TextInput::make('nama_pupuk')
                    ->label("Nama Pupuk")->placeholder("Masukkan Nama Pupuk")
                    ->rules(fn (Get $get, ?Model $record): array => [
                        'required','min:3',
                        Rule::unique('pupuk', 'nama_pupuk')->ignore($record)])
                    ->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'min' => 'Minimal Harus 3 karakter',
                        'unique' => 'Data sudah ada'
                ])->markAsRequired(),

                Select::make('satuan_pupuk_id')->label('Satuan')
                    ->live()
                    ->placeholder('Pilih satuan pupuk')
                    ->relationship('satuan', 'nama_satuan')
                    ->createOptionForm([
                    TextInput::make('nama_satuan')
                        ->label('Nama Satuan')
                        ->placeholder('Masukkan Nama Satuan')
                        ->rules(fn (?Model $record): array => [
                            'required','min:3',
                            Rule::unique('satuan_pupuk', 'nama_satuan')->ignore($record)])
                        ->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                            'min' => 'Minimal harus 3 karakter',
                            'unique' => 'Data sudah ada'
                        ])->markAsRequired()
                        ->live(debounce:1000)
                        ->afterStateUpdated(function ($state, $set) {
                            $set('nama_satuan', ucfirst($state));
                        }),

                    Hidden::make('user_id')
                        ->default(Filament::auth()->user()->id)
                        ->dehydrated(),
                        
                ])->createOptionModalHeading('Tambah Satuan')
                ->createOptionUsing(function (array $data) {
                    SatuanPupuk::create($data);
                    Notification::make()
                    ->title('Sukses')
                    ->body('Satuan baru berhasil ditambahkan.')
                    ->success()
                    ->seconds(3)
                    ->send();
                })->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                Select::make('bentuk_pupuk_id')
                    ->label('Bentuk')->placeholder('Pilih bentuk pupuk')
                    ->relationship('bentuk', 'nama_bentuk')
                    ->createOptionForm([
                    TextInput::make('nama_bentuk')
                        ->label('Nama Bentuk')->placeholder('Masukkan Nama Bentuk')
                        ->rules(fn (?Model $record): array => [
                            'required','min:3',
                            Rule::unique('bentuk_pupuk', 'nama_bentuk')->ignore($record)])
                        ->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                            'min' => 'Minimal harus 3 karakter',
                            'unique' => 'Data sudah ada'
                        ])->markAsRequired()
                        ->live(debounce:400)
                        ->afterStateUpdated(function ($state, $set) {
                            $set('nama_bentuk', ucfirst(strtolower($state)));
                        }),

                    Hidden::make('user_id')
                        ->default(Filament::auth()->user()->id)
                        ->dehydrated(),

                ])->createOptionModalHeading('Tambah Bentuk')
                ->createOptionUsing(function (array $data) {
                    BentukPupuk::create($data);
                    Notification::make()
                    ->title('Sukses')
                    ->body('Bentuk baru berhasil ditambahkan.')
                    ->success()
                    ->seconds(3)
                    ->send();
                }),

                Select::make('kategori_pupuk_id')
                    ->label('Kategori')->placeholder('Pilih kategori pupuk')
                    ->relationship('kategori', 'nama_kategori')
                    ->createOptionForm([
                      TextInput::make('nama_kategori')
                        ->label('Nama Kategori')
                        ->placeholder('Masukkan Nama Kategori')
                        ->rules(fn (?Model $record): array => [
                            'required','min:3',
                            Rule::unique('kategori_pupuk', 'nama_kategori')->ignore($record)])
                        ->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                            'min' => 'Minimal harus 3 karakter',
                            'unique' => 'Data sudah ada'
                        ])->markAsRequired()
                        ->live(debounce:1000)
                        ->afterStateUpdated(function ($state, $set) {
                            $set('nama_kategori', ucfirst(strtolower($state)));
                        }),

                    Hidden::make('user_id')
                        ->default(Filament::auth()->user()->id)
                        ->dehydrated(),

                ])->createOptionModalHeading('Tambah Kategori')
                ->createOptionUsing(function (array $data) {
                    KategoriPupuk::create($data);
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
                    ->placeholder(function (Get $get) {
                        $satuanId = $get('satuan_pupuk_id');

                        if (!$satuanId) {
                            return 'Masukkan jumlah persediaan';
                        }

                        $pupuk = SatuanPupuk::find($satuanId);
                        $satuan = $pupuk->nama_satuan ?? 'unit yang dipilih';

                        return "Masukkan jumlah persediaan dalam satuan $satuan";
                    })
                    ->suffix(function (Get $get) {
                        $satuanId = $get('satuan_pupuk_id');

                        if (!$satuanId) {
                            return '';
                        }

                        $pupuk = SatuanPupuk::find($satuanId);
                        $satuan = $pupuk->nama_satuan ?? '';

                        return "$satuan";
                    })
                    ->numeric()->label('Jumlah Persediaan')
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
                TextColumn::make('nama_pupuk')
                    ->label('Nama Pupuk')
                    ->searchable()->sortable(),

                TextColumn::make('bentuk.nama_bentuk')
                    ->label('Bentuk')
                    ->searchable()->sortable(),

                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->searchable()->sortable(),

                TextColumn::make('jumlah_persediaan')
                    ->label('Jumlah Persediaan')
                    ->searchable()->sortable(),

                TextColumn::make('satuan.nama_satuan')
                    ->label('Satuan'),

                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')->dateTime('l, j M Y')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')->dateTime('l, j M Y')
                    ->sortable()->toggleable(isToggledHiddenByDefault:true),

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
            'index' => Pages\ListPupuks::route('/'),
            'create' => Pages\CreatePupuk::route('/create'),
            'edit' => Pages\EditPupuk::route('/{record}/edit'),
        ];
    }
}
