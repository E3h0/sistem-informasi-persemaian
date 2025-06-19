<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KategoriBibit;
use Filament\Facades\Filament;
use App\Models\PersediaanBibit;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersediaanBibitResource\Pages;
use App\Filament\Resources\PersediaanBibitResource\RelationManagers;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class PersediaanBibitResource extends Resource
{
    protected static ?string $model = PersediaanBibit::class;
    protected static ?string $modelLabel = "Persediaan Bibit";
    protected static ?string $pluralModelLabel = "Persediaan Bibit";
    protected static ?string $navigationIcon = 'tabler-seeding';
    protected static ?string $slug = "persediaan-bibit";
    protected static ?string $breadcrumb = "Persediaan Bibit";
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Kelola Bibit';

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
            ->recordUrl(false)
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
                Tables\Actions\DeleteAction::make()->label('Hapus')
                ->modalHeading('Konfirmasi Penghapusan')->modalDescription('Apakah anda yakin ingin menghapus data? Data yang dihapus tidak dapat dikembalikan!')->successNotification(
                    Notification::make()->success()->title('Berhasil Dihapus')->body('Data Berhasil Dihapus')->color('success')->seconds(3)
                ),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
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
        ];
    }
}
