<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Illuminate\Validation\Rule;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersediaanAlatKerjaResource\Pages;
use App\Filament\Resources\PersediaanAlatKerjaResource\RelationManagers;

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

                Select::make('kategori_id')
                    ->label('Kategori')->options(KategoriAlatKerja::all()->pluck('nama_kategori', 'id'))
                    ->placeholder('Pilih kategori barang')->createOptionForm([
                    TextInput::make('nama_kategori')
                        ->required()
                        ->label('Nama Kategori')->placeholder('Masukkan Nama Kategori')
                        ->rules(['min:3'])->validationMessages([
                            'min' => 'Minimal harus 3 karakter'
                        ])
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
                    ->placeholder('Masukkan jumlah persediaan')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                TextInput::make('jumlah_dipakai')
                    ->numeric()->label('Jumlah Dipakai')
                    ->placeholder('Masukkan jumlah persediaan')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                Hidden::make('user_id')
                    ->default(Filament::auth()->user()->id)
                    ->dehydrated(),

                Textarea::make('keterangan')
                    ->label('Keterangan')->placeholder('Masukkan keterangan')->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data')->emptyStateDescription('Silahkan tambahkan data terlebih dahulu.')->emptyStateIcon('heroicon-o-exclamation-circle')
            ->recordUrl(false)
            ->columns([
                TextColumn::make('nama_barang')
                    ->label('Nama Barang')->searchable()
                    ->sortable(),

                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->sortable(),

                TextColumn::make('jumlah_persediaan')
                    ->label('Jumlah Persediaan')
                    ->numeric()->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                    ->sortable(),

                TextColumn::make('jumlah_dipakai')
                    ->label('Jumlah Dipakai')
                    ->sortable()
                    ->numeric()->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0),

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
            'index' => Pages\ListPersediaanAlatKerjas::route('/'),
            'create' => Pages\CreatePersediaanAlatKerja::route('/create'),
            'edit' => Pages\EditPersediaanAlatKerja::route('/{record}/edit'),
        ];
    }
}
