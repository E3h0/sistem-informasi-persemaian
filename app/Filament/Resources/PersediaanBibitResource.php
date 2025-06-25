<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Js;
use App\Models\KategoriBibit;
use Filament\Facades\Filament;
use App\Models\PersediaanBibit;
use Illuminate\Validation\Rule;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Infolists\Components\TextEntry;
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
use Filament\Infolists\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersediaanBibitResource\Pages;
use Filament\Infolists\Components\TextEntry as ComponentsTextEntry;
use App\Filament\Resources\PersediaanBibitResource\RelationManagers;
use Filament\Tables\Actions\ViewAction;

class PersediaanBibitResource extends Resource
{
    protected static ?string $model = PersediaanBibit::class;
    protected static ?string $recordTitleAttribute = 'jenis_bibit';
    protected static ?string $modelLabel = "Persediaan Bibit";
    protected static ?string $pluralModelLabel = "Persediaan Bibit";
    protected static ?string $navigationIcon = 'tabler-seeding';
    protected static ?string $slug = "persediaan-bibit";
    protected static ?string $breadcrumb = "Persediaan Bibit";
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Kelola Bibit';

    public static function getGloballySearchableAttributes(): array
    {
        return ['jenis_bibit', 'kategori.nama_kategori'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Kategori' => $record->kategori->nama_kategori,
            'Stok' => number_format($record->jumlah_persediaan, 0, ',', '.')
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['kategori']);
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return PersediaanBibitResource::getUrl('view', ['record' => $record]);
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make("jenis_bibit")
                ->label("Jenis Bibit")->placeholder("Masukkan Nama Bibit")
                ->rules(fn (Get $get, ?Model $record): array => [
                    'required','min:3',
                    Rule::unique('persediaan_bibit', 'jenis_bibit')->ignore($record)])
                ->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'min' => 'Minimal Harus 3 karakter',
                        'unique' => 'Data sudah ada'
                ])->markAsRequired(),

            Select::make("kategori_bibit_id")
                ->relationship('kategori', 'nama_kategori')
                ->placeholder('Pilih kategori bibit')
                ->createOptionForm([
                     TextInput::make('nama_kategori')
                        ->label('Nama Kategori')
                        ->placeholder('Masukkan Nama Kategori')
                        ->rules(fn (?Model $record): array => [
                            'required','min:3',
                            Rule::unique('kategori_bibit', 'nama_kategori')->ignore($record)])
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

                ])->createOptionModalHeading('Tambah Kategori Bibit')
                ->createOptionUsing(function (array $data) {
                    $category = KategoriBibit::create($data);
                    Notification::make()
                    ->title('Sukses')
                    ->body('Kategori baru berhasil ditambahkan.')
                    ->success()
                    ->seconds(3)
                    ->send();
                    return $category->id;
                })
                ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

            TextInput::make("jumlah_persediaan")
                ->numeric()->label('Jumlah Persediaan')
                ->placeholder("Masukkan jumlah Persediaan")
                ->rules(['required','min:3'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                            'min' => 'Minimal Harus 3 karakter'
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
            ->recordUrl( fn (Model $record): string => route('filament.admin.resources.persediaan-bibit.view', ['record' => $record]) )
            ->columns([
                TextColumn::make('jenis_bibit')
                    ->label('Nama Bibit')
                    ->searchable()->sortable(),

                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori Bibit'),

                TextColumn::make('jumlah_persediaan')
                    ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                    ->label('Jumlah Stok')->sortable(),

                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')->dateTime('l, j M Y')
                    ->sortable()->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')->dateTime('l, j M Y')
                    ->sortable()->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('keterangan')->label('Keterangan')
                    ->placeholder('Tidak ada keterangan yang ditambahkan.')
                    ->toggleable(isToggledHiddenByDefault:true)

            ])->searchPlaceholder('Cari nama bibit')->searchDebounce('300ms')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function ($record){
                            if ($record->targetProduksi()->count() > 0) {
                                Notification::make()
                                    ->danger()
                                    ->title('Gagal, Tidak Dapat Menghapus')
                                    ->body('Bibit ini sedang digunakan di data Target Produksi')
                                    ->send();
                                return;
                            }
                            elseif ($record->mutasiBibit()->count() > 0) {
                                Notification::make()
                                    ->danger()
                                    ->title('Gagal, Tidak Dapat Menghapus')
                                    ->body('Beibit ini sedang digunakan di data Mutasi Bibit')
                                    ->send();
                                return;
                            }
                            $record->delete();
                            Notification::make()
                                    ->success()
                                    ->title('Berhasil Dihapus')
                                    ->body('Data berhasil dihapus')
                                    ->send();
                    })
                    ->label('Hapus')
                    ->modalHeading('Konfirmasi Penghapusan')->modalDescription('Apakah anda yakin ingin menghapus data? Data yang dihapus tidak dapat dikembalikan!')->successNotification(
                        Notification::make()->success()->title('Berhasil Dihapus')->body('Data Berhasil Dihapus')->color('success')->seconds(3)
                    ),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('jenis_bibit')->label('Jenis Bibit')->columns(1),
                        Infolists\Components\TextEntry::make('kategori.nama_kategori')->label('Kategori Bibit')->columns(1),
                        Infolists\Components\TextEntry::make('jumlah_persediaan')->label('Jumlah Persediaan')->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),
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
                        Infolists\Components\TextEntry::make('created_at')->label('Dibuat Pada')->dateTime('l, j M Y'),
                        Infolists\Components\TextEntry::make('updated_at')->label('Diperbarui Pada')->dateTime('l, j M Y'),
                        Infolists\Components\TextEntry::make('keterangan')->label('Keterangan')->placeholder('Tidak ada keterangan yang ditambahkan')->columnSpanFull(),

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
            'index' => Pages\ListPersediaanBibits::route('/'),
            'create' => Pages\CreatePersediaanBibit::route('/create'),
            'edit' => Pages\EditPersediaanBibit::route('/{record}/edit'),
            'view' => Pages\ViewPersediaanBibit::route('/{record}'),
        ];
    }
}
