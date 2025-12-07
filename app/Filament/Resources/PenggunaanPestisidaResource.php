<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Infolists;
use Filament\Forms\Form;
use App\Models\Pestisida;
use Filament\Tables\Table;
use Illuminate\Support\Js;
use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Models\PenggunaanPestisida;
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
use Filament\Infolists\Components\Actions\Action;
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

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
         return $record->pestisida->nama_pestisida;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['tanggal_penggunaan', 'pestisida.nama_pestisida'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Tanggal Penggunaan' => Carbon::parse($record->tanggal_penggunaan)->translatedFormat('l, j F Y'),
            'Jumlah Penggunaan' => number_format($record->jumlah_penggunaan, 0, ',', '.') . ' ' . strtolower($record->satuanPestisida->nama_satuan),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['pestisida', 'satuanPestisida']);
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return PenggunaanPestisidaResource::getUrl('view', ['record' => $record]);
    }

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

                        $pestisida = Pestisida::with('satuan')->find($pestisidaId);
                        $satuan = $pestisida->satuan->nama_satuan ?? 'unit yang dipilih';

                        return "Masukkan jumlah penggunaan pupuk dalam satuan $satuan";
                    })
                    ->suffix(function (Get $get) {
                        $pestisidaId = $get('pestisida_id');

                        if (!$pestisidaId) {
                            return '';
                        }

                        $pestisida = Pestisida::with('satuan')->find($pestisidaId);
                        $satuan = $pestisida->satuan->nama_satuan ?? '';

                        return "$satuan";
                    })
                    ->label('Jumlah Penggunaan')
                    ->numeric()
                    ->gte(0)
                    ->rules(['required', 'gte:0', 'integer'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                            'gte' => 'Tidak boleh kurang dari 0.',
                            'integer' => 'Gunakan bilangan bulat.'
                    ])->markAsRequired(),

                DatePicker::make('tanggal_penggunaan')
                    ->native(false)->placeholder('Masukkan tanggal penggunaan')
                    ->displayFormat('l  , j M Y')
                    ->closeOnDateSelection()
                    ->maxDate(now())            
                    ->rules(['required', 'before_or_equal:' . now()->endOfDay()])->validationMessages([
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
                return PenggunaanPestisidaResource::getUrl('view', ['record' => $record]);
            })
            ->columns([
                TextColumn::make('pestisida.nama_pestisida')
                    ->label('Nama Pestisida')
                    ->searchable()->sortable(),

                TextColumn::make('bentukPestisida.nama_bentuk')
                    ->label('Bentuk'),

                TextColumn::make('kategoriPestisida.nama_kategori')
                    ->label('Kategori'),

                TextColumn::make('jumlah_penggunaan')
                    ->label('Jumlah Penggunaan')
                    ->sortable()
                    ->formatStateUsing(fn ($state, $record) =>
                        number_format($state, 0, ',', '.') . ' ' . strtolower($record->satuanPestisida->nama_satuan)
                    ),

                TextColumn::make('satuanPestisida.nama_satuan')
                    ->label('Satuan')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->sortable()->toggleable(isToggledHiddenByDefault:false),

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
                        Infolists\Components\TextEntry::make('pestisida.nama_pestisida')
                            ->label('Nama Pestisida'),

                        Infolists\Components\TextEntry::make('kategoriPestisida.nama_kategori')
                            ->label('Kategori Pestisida'),

                        Infolists\Components\TextEntry::make('BentukPestisida.nama_bentuk')
                            ->label('Bentuk Pestisida'),

                        Infolists\Components\TextEntry::make('jumlah_penggunaan')
                            ->label('Jumlah Penggunaan')
                            ->formatStateUsing(function ($state, $record){
                                return number_format($state, 0, ',', '.')  . ' ' . $record->satuanPestisida->nama_satuan;
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
            'index' => Pages\ListPenggunaanPestisidas::route('/'),
            'create' => Pages\CreatePenggunaanPestisida::route('/create'),
            'edit' => Pages\EditPenggunaanPestisida::route('/{record}/edit'),
            'view' => Pages\ViewPenggunaanPestisida::route('/{record}')
        ];
    }
}
