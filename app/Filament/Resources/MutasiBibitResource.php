<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Js;
use App\Models\MutasiBibit;
use Filament\Facades\Filament;
use App\Models\PersediaanBibit;
use Illuminate\Validation\Rule;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ColumnGroup;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Actions;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MutasiBibitResource\Pages;
use Filament\Infolists\Components\Section as InfoSection;
use App\Filament\Resources\MutasiBibitResource\RelationManagers;

class MutasiBibitResource extends Resource
{
    protected static ?string $model = MutasiBibit::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    protected static ?string $navigationLabel = 'Mutasi Bibit';

    protected static ?string $modelLabel = 'Mutasi Bibit';

    protected static ?string $pluralModelLabel = 'Mutasi Bibit';

    protected static ?string $breadcrumb = 'Mutasi Bibit';

    protected static ?string $slug = 'mutasi-bibit';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Kelola Bibit';

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->bibit->jenis_bibit;
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['bibit.jenis_bibit'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Total di GHA' => number_format($record->totalGha(), 0, ',', '.'),
            'Total di AHA' => number_format($record->totalAha(), 0, ',', '.'),
            'Total di OGA' => number_format($record->totalOga(), 0, ',', '.')
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['bibit']);
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return MutasiBibitResource::getUrl('view', ['record' => $record]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bibit_id')
                    ->options(PersediaanBibit::all()->pluck('jenis_bibit', 'id'))
                    ->label('Jenis Bibit')->placeholder('Pilih Jenis Bibit')
                    ->searchable()->searchPrompt('Cari nama bibit')
                    ->rules(fn (Get $get, ?Model $record): array => [
                        'required',
                        Rule::unique('mutasi_bibit', 'bibit_id')->ignore($record)
                    ])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'unique' => 'Data sudah ada'
                    ])->markAsRequired()->columnSpanFull(),

                Section::make('GHA')
                    ->description('Germination House Area')
                    ->schema([
                        TextInput::make('gha1')->label('Blok 1')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired()->default(0),

                        TextInput::make('gha2')->label('Blok 2')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired()->default(0),

                        TextInput::make('gha3')->label('Blok 3')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired()->default(0),

                        TextInput::make('gha4')->label('Blok 4')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired()->default(0),
                ])->columns(4),

                Section::make('AHA')
                    ->description('Aclimatization House Area')
                    ->schema([
                        TextInput::make('aha1')->label('Blok 1')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired()->default(0),

                        TextInput::make('aha2')->label('Blok 2')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired()->default(0),

                        TextInput::make('aha3')->label('Blok 3')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired()->default(0),

                        TextInput::make('aha4')->label('Blok 4')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired()->default(0),
                    ])->columns(4),

                Section::make('OGA')
                    ->description('Open Growth Area')
                    ->schema([
                        TextInput::make('oga1')->label('Blok 1')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                                'required' => 'Tolong isi bagian ini.',
                            ])->markAsRequired()->default(0),

                        TextInput::make('oga2')->label('Blok 2')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                                'required' => 'Tolong isi bagian ini.',
                            ])->markAsRequired()->default(0),

                        TextInput::make('oga3')->label('Blok 3')
                            ->numeric()->columnSpan(1)
                            ->placeholder('Masukkan jumlah bibit')
                            ->rules(['required'])->validationMessages([
                                'required' => 'Tolong isi bagian ini.',
                            ])->markAsRequired()->default(0),

                        TextInput::make('oga4')->label('Blok 4')
                        ->numeric()->columnSpan(1)
                        ->placeholder('Masukkan jumlah bibit')
                        ->rules(['required'])->validationMessages([
                            'required' => 'Tolong isi bagian ini.',
                        ])->markAsRequired()->default(0),
                    ])->columns(4),

                TextInput::make('siap_distribusi')
                    ->numeric()
                    ->label('Siap Distribusi')->placeholder('Masukkan Jumlah Bibit Yang Siap Distribusi (opsional)')
                    ->columnSpan(2),

                TextInput::make('#')
                    ->helperText('Otomatis diambil dari user yang login saat ini.')
                    ->label('Pencatat')->placeholder(Filament::auth()->user()->name)
                    ->dehydrated(false)
                    ->markAsRequired()
                    ->readOnly()->columnSpan(2),

                Hidden::make('user_id')
                    ->default(Filament::auth()->user()->id)
                    ->dehydrated(),

                Textarea::make("keterangan")
                    ->placeholder("Tambahkan Keterangan")->columnSpanFull()
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
         ->emptyStateHeading('Belum ada data')->emptyStateDescription('Silahkan tambahkan data terlebih dahulu.')->emptyStateIcon('heroicon-o-exclamation-circle')
            ->recordUrl( function (Model $record):string {
                return MutasiBibitResource::getUrl('view', ['record' => $record]);
            })
            ->columns([
                TextColumn::make('bibit.jenis_bibit')
                    ->label('Jenis Bibit')->searchable(),
                ColumnGroup::make('GHA', [
                    TextColumn::make('gha1')->label('Blok 1')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                    TextColumn::make('gha2')->label('Blok 2')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                    TextColumn::make('gha3')->label('Blok 3')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                    TextColumn::make('gha4')->label('Blok 4')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                ])->alignment(Alignment::Center),
                ColumnGroup::make('AHA', [
                    TextColumn::make('aha1')->label('Blok 1')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                    TextColumn::make('aha2')->label('Blok 2')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                    TextColumn::make('aha3')->label('Blok 3')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                    TextColumn::make('aha4')->label('Blok 4')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                ])->alignment(Alignment::Center),
                ColumnGroup::make('OGA', [
                    TextColumn::make('oga1')->label('Blok 1')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                    TextColumn::make('oga2')->label('Blok 2')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                    TextColumn::make('oga3')->label('Blok 3')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable(),

                    TextColumn::make('oga4')->label('Blok 4')
                        ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                        ->sortable()

                ])->alignment(Alignment::Center),

                TextColumn::make('siap_distribusi')->label('Siap Distribusi')
                    ->placeholder('Tidak ada data yang ditambahkan.')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')->dateTime('l, j M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')->dateTime('l, j M Y')
                    ->sortable()->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('keterangan')->label('Keterangan')
                    ->placeholder('Tidak ada keterangan yang ditambahkan.')
                    ->toggleable(isToggledHiddenByDefault:true)
            ])->searchPlaceholder('Cari nama bibit')->searchDebounce('300ms')
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
                InfoSection::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('bibit.jenis_bibit')
                            ->label('Jenis Bibit'),

                        Infolists\Components\TextEntry::make('kategori.nama_kategori')
                            ->label('Kategori Bibit'),
                    ])->columns(2),

                InfoSection::make('GHA')
                    ->description('Germination House Area')
                    ->schema([
                        Infolists\Components\TextEntry::make('gha1')
                            ->label('Blok 1')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('gha2')
                            ->label('Blok 2')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('gha3')
                            ->label('Blok 3')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('gha4')
                            ->label('Blok 4')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),
                    ])
                    ->columns(4),

                InfoSection::make('AHA')
                    ->description('Aclimatization House Area')
                    ->schema([
                        Infolists\Components\TextEntry::make('aha1')
                            ->label('Blok 1')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('aha2')
                            ->label('Blok 2')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('aha3')
                            ->label('Blok 3')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('aha4')
                            ->label('Blok 4')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),
                    ])
                    ->columns(4),

                InfoSection::make('OGA')
                    ->description('Open Growth Area')
                    ->schema([
                        Infolists\Components\TextEntry::make('oga1')
                            ->label('Blok 1')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('oga2')
                            ->label('Blok 2')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('oga3')
                            ->label('Blok 3')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

                        Infolists\Components\TextEntry::make('oga4')
                            ->label('Blok 4')
                            ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),
                    ])
                    ->columns(4),

                InfoSection::make()
                    ->schema([

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
                    ])->columns(4),
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
            'index' => Pages\ListMutasiBibits::route('/'),
            'create' => Pages\CreateMutasiBibit::route('/create'),
            'edit' => Pages\EditMutasiBibit::route('/{record}/edit'),
            'view' => Pages\ViewMutasiBibit::route('/{record}')
        ];
    }
}
