<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Infolists;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Js;
use Filament\Facades\Filament;
use Illuminate\Validation\Rule;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Models\KategoriAlatKerja;
use App\Models\PersediaanAlatKerja;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersediaanAlatKerjaResource\Pages;
use App\Filament\Resources\PersediaanAlatKerjaResource\RelationManagers;
use App\Models\SatuanAlatKerja;

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

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->nama_barang;
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_barang', 'kategori.nama_kategori'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Kategori' => $record->kategori->nama_kategori,
            'Jumlah Tersedia' => number_format($record->jumlah_persediaan, 0, ',', '.') . ' ' . strtolower($record->satuan->nama_satuan),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['kategori']);
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return PersediaanAlatKerjaResource::getUrl('view', ['record' => $record]);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 TextInput::make("nama_barang")
                    ->label("Nama Barang")->placeholder("Masukkan Nama Barang")
                    ->rules(fn (Get $get, ?Model $record): array => [
                        'required','min:3',
                        Rule::unique('persediaan_alat_kerja', 'nama_barang')->ignore($record)
                    ])
                ->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'min' => 'Minimal Harus 3 karakter',
                        'unique' => 'Data sudah ada'
                ])->markAsRequired(),

                Select::make('satuan_id')->label('Satuan')
                    ->live()
                    ->placeholder('Pilih satuan alat kerja')
                    ->relationship('satuan', 'nama_satuan')
                    ->createOptionForm([
                    TextInput::make('nama_satuan')
                        ->label('Nama Satuan')
                        ->placeholder('Masukkan Nama Satuan')
                        ->rules(fn (?Model $record): array => [
                            'required','min:3',
                            Rule::unique('satuan_alat_kerja', 'nama_satuan')->ignore($record)])
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
                    SatuanAlatKerja::create($data);
                    Notification::make()
                    ->title('Sukses')
                    ->body('Satuan baru berhasil ditambahkan.')
                    ->success()
                    ->seconds(3)
                    ->send();
                })->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                Select::make('kategori_id')
                    ->label('Kategori')->options(KategoriAlatKerja::all()->pluck('nama_kategori', 'id'))
                    ->placeholder('Pilih kategori barang')->createOptionForm([
                    TextInput::make('nama_kategori')
                        ->label('Nama Kategori')
                        ->placeholder('Masukkan Nama Kategori')
                        ->rules(fn (?Model $record): array => [
                            'required','min:3',
                            Rule::unique('kategori_alat_kerja', 'nama_kategori')->ignore($record)])
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

                    ])->createOptionModalHeading('Tambah Kategori Barang')
                    ->createOptionUsing(function (array $data) {
                        $category = KategoriAlatKerja::create($data);
                        Notification::make()
                        ->title('Sukses')
                        ->body('Kategori baru berhasil ditambahkan.')
                        ->success()
                        ->seconds(3)
                        ->send();
                })
                ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                TextInput::make('jumlah_persediaan')
                    ->numeric()->label('Jumlah Persediaan')
                    ->placeholder(function (Get $get) {
                        $satuanId = $get('satuan_id');

                        if (!$satuanId) {
                            return 'Masukkan jumlah persediaan';
                        }

                        $satuanAlatKerja = SatuanAlatKerja::find($satuanId);
                        $satuan = $satuanAlatKerja->nama_satuan ?? 'unit yang dipilih';

                        return "Masukkan jumlah persediaan dalam satuan $satuan";
                    })
                    ->suffix(function (Get $get) {
                        $satuanId = $get('satuan_id');

                        if (!$satuanId) {
                            return '';
                        }

                        $satuanAlatKerja = SatuanAlatKerja::find($satuanId);
                        $satuan = $satuanAlatKerja->nama_satuan ?? '';

                        return $satuan;
                    })
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                TextInput::make('jumlah_dipakai')
                    ->numeric()->label('Jumlah Dipakai')
                    ->placeholder(function (Get $get) {
                        $satuanId = $get('satuan_id');

                        if (!$satuanId) {
                            return 'Masukkan jumlah persediaan';
                        }

                        $satuanAlatKerja = SatuanAlatKerja::find($satuanId);
                        $satuan = $satuanAlatKerja->nama_satuan ?? 'unit yang dipilih';

                        return "Masukkan jumlah persediaan dalam satuan $satuan";
                    })
                    ->suffix(function (Get $get) {
                        $satuanId = $get('satuan_id');

                        if (!$satuanId) {
                            return '';
                        }

                        $satuanAlatKerja = SatuanAlatKerja::find($satuanId);
                        $satuan = $satuanAlatKerja->nama_satuan ?? '';

                        return "$satuan";
                    })
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                Hidden::make('user_id')
                    ->default(Filament::auth()->user()->id)
                    ->dehydrated(),

                Textarea::make('keterangan')
                    ->label('Keterangan')->placeholder('Masukkan keterangan')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data')->emptyStateDescription('Silahkan tambahkan data terlebih dahulu.')->emptyStateIcon('heroicon-o-exclamation-circle')
            ->recordUrl( function (Model $record):string {
                return PersediaanAlatKerjaResource::getUrl('view', ['record' => $record]);
            })
            ->columns([
                TextColumn::make('nama_barang')
                    ->label('Nama Barang')->searchable()
                    ->sortable(),

                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->sortable(),

                TextColumn::make('jumlah_persediaan')
                    ->label('Jumlah Persediaan')
                    ->formatStateUsing(fn ($state, $record) =>
                        number_format($state, 0, ',', '.') . ' ' . strtolower($record->satuan->nama_satuan)
                    )
                    ->sortable(),

                TextColumn::make('jumlah_dipakai')
                    ->label('Jumlah Dipakai')
                    ->sortable()
                    ->formatStateUsing(fn ($state, $record) =>
                        number_format($state, 0, ',', '.') . ' ' . strtolower($record->satuan->nama_satuan)
                    ),

                TextColumn::make('satuan.nama_satuan')
                    ->label('Satuan')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('keterangan')->label('Keterangan')
                    ->placeholder('Tidak ada keterangan yang ditambahkan.')
                    ->toggleable(isToggledHiddenByDefault:false),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')->dateTime('l, j M Y')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')->dateTime('l, j M Y')
                    ->sortable()->toggleable(isToggledHiddenByDefault:true),

            ])->searchPlaceholder('Cari nama barang')->searchDebounce('300ms')
            ->defaultSort('created_at', 'desc')
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('nama_barang')
                            ->label('Nama Barang')->columns(1),

                        Infolists\Components\TextEntry::make('kategori.nama_kategori')
                            ->label('Kategori Barang')->columns(1),

                        Infolists\Components\TextEntry::make('jumlah_persediaan')
                            ->label('Jumlah Tersedia')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('jumlah_dipakai')
                            ->label('Jumlah Dipakai')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('pencatat.name')->label('Pencatat')
                            ->badge()
                            ->color(function ($record): string {
                                $role = $record->pencatat->role;
                                return match ($role){
                                    'Admin' => 'success',
                                    'Editor' => 'warning',
                                    'Viewer' => 'danger',
                                };
                            }),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Dibuat Pada')->dateTime('l, j M Y'),

                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Diperbarui Pada')->dateTime('l, j M Y'),

                        Infolists\Components\TextEntry::make('keterangan')
                            ->label('Keterangan')
                            ->placeholder('Tidak ada keterangan yang ditambahkan')
                            // ->columnSpanFull(),

                    ])->columns(2),
                    Actions::make([
                        Action::make('kembali')
                            ->label('Kembali')
                            // ->alpineClickHandler('window.location.href = ' . Js::from(static::getUrl("index")) . '')
                            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from(static::getUrl()) . ')')
                            ->icon('heroicon-o-arrow-left')
                            ->color('gray')
                            ->button()
                    ])->alignLeft(),
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
            'view' => Pages\ViewPersediaanAlatKerja::route('/{record}')
        ];
    }
}
