<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pupuk;
use Filament\Forms\Get;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Js;
use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use App\Models\PenggunaanPupuk;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components\DateTimePicker;
use Filament\Infolists\Components\Actions\Action;
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

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
         return $record->pupuk->nama_pupuk;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['tanggal_penggunaan', 'pupuk.nama_pupuk'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Tanggal Penggunaan' => Carbon::parse($record->tanggal_penggunaan)->translatedFormat('l, j F Y'),
            'Jumlah Penggunaan' => number_format($record->jumlah_penggunaan, 0, ',', '.') . ' ' . strtolower($record->satuanPupuk->nama_satuan),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['pupuk', 'satuanPupuk']);
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return PenggunaanPupukResource::getUrl('view', ['record' => $record]);
    }

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

                        $pupuk = Pupuk::with('satuan')->find($pupukId);
                        $satuan = $pupuk->satuan->nama_satuan ?? 'unit yang dipilih';

                        return "Masukkan jumlah penggunaan pupuk dalam satuan $satuan";
                    })
                    ->suffix(function (Get $get) {
                        $pupukId = $get('pupuk_id');

                        if (!$pupukId) {
                            return '';
                        }

                        $pupuk = Pupuk::with('satuan')->find($pupukId);
                        $satuan = $pupuk->satuan->nama_satuan ?? '';

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
                    ->closeOnDateSelection()
                    ->maxDate(now())
                    ->rules(['required', 'before_or_equal:'. now()->endOfDay()])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'before_or_equal' => 'Tanggal pembelian tidak boleh melebihi hari ini.'
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
            ->recordUrl( function (Model $record):string {
                return PenggunaanPupukResource::getUrl('view', ['record' => $record]);
            })
            ->columns([
                TextColumn::make('pupuk.nama_pupuk')
                    ->label('Nama Pupuk')
                    ->searchable()->sortable(),

                TextColumn::make('bentukPupuk.nama_bentuk')
                    ->label('Bentuk'),

                TextColumn::make('kategoriPupuk.nama_kategori')
                    ->label('Kategori'),

                TextColumn::make('jumlah_penggunaan')
                    ->label('Jumlah Penggunaan')
                    ->sortable()
                    ->formatStateUsing(fn ($state, $record) =>
                        number_format($state, 0, ',', '.') . ' ' . strtolower($record->satuanPupuk->nama_satuan)
                    ),

                TextColumn::make('satuanPupuk.nama_satuan')
                    ->label('Satuan')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->toggleable(isToggledHiddenByDefault:false),

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
            ])->defaultSort('created_at', 'desc')
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('pupuk.nama_pupuk')
                            ->label('Nama Pupuk'),

                        Infolists\Components\TextEntry::make('kategoriPupuk.nama_kategori')
                            ->label('Kategori Pupuk'),

                        Infolists\Components\TextEntry::make('BentukPupuk.nama_bentuk')
                            ->label('Bentuk Pupuk'),

                        Infolists\Components\TextEntry::make('jumlah_penggunaan')
                            ->label('Jumlah Penggunaan')
                            ->formatStateUsing(function ($state, $record){
                                return number_format($state, 0, ',', '.')  . ' ' . $record->satuanPupuk->nama_satuan;
                            }),

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

                        Infolists\Components\TextEntry::make('tanggal_penggunaan')
                            ->label('Tanggal Penggunaan')->dateTime('l, j M Y'),

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
            'index' => Pages\ListPenggunaanPupuks::route('/'),
            'create' => Pages\CreatePenggunaanPupuk::route('/create'),
            'edit' => Pages\EditPenggunaanPupuk::route('/{record}/edit'),
            'view' => Pages\ViewPenggunaanPupuk::route('/{record}')
        ];
    }
}
