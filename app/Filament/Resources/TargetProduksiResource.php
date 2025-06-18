<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use App\Models\TargetProduksi;
use Filament\Facades\Filament;
use App\Models\PersediaanBibit;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TargetProduksiResource\Pages;


class TargetProduksiResource extends Resource
{
    protected static ?string $model = TargetProduksi::class;

    protected static ?string $modelLabel = 'Target & Realisasi Produksi';

    protected static ?string $pluralModelLabel = 'Target & Realisasi Produksi';

    protected static ?string $navigationIcon = 'fluentui-target-arrow-20-o';

    protected static ?string $navigationLabel = 'Target & Realisasi Produksi';

    protected static ?string $slug = "target-produksi";

    protected static ?string $breadcrumb = 'Target & Realisasi Produksi';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Kelola Bibit';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bibit_id')
                    ->options(PersediaanBibit::all()->pluck('jenis_bibit', 'id'))
                    ->label('Jenis Bibit')->placeholder('Pilih Jenis Bibit')
                    ->searchable()->searchPrompt('Cari Nama Bibit')
                    ->rules(fn (Get $get, ?Model $record): array => [
                        'required',
                        Rule::unique('target_produksi', 'bibit_id')->ignore($record)
                    ])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'unique' => 'Data sudah ada'
                ])->markAsRequired(),

                TextInput::make('target_produksi')
                    ->numeric()
                    ->label('Target Produksi')->placeholder('Masukkan Target Produksi')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                TextInput::make('sudah_diproduksi')
                    ->numeric()
                    ->label('Sudah Diproduksi')->placeholder('Masukkan Jumlah Bibit Yang Sudah Diproduksi')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),

                TextInput::make('sudah_distribusi')
                    ->live(onBlur:true, debounce:50)
                    ->afterStateUpdated(function (Set $set, Get $get, $state){
                        $sudah_prod = $get('sudah_diproduksi');
                        $set('stok_akhir', $sudah_prod-$state);
                    })
                    ->numeric()
                    ->label('Sudah Distribusi')->placeholder('Masukkan Jumlah Bibit Yang Sudah Distribusi')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired(),


                TextInput::make('stok_akhir')
                    ->numeric()
                    ->label('Stok Akhir')->placeholder('Masukkan Jumlah Stok Akhir')
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

                Textarea::make('keterangan')
                ->label('Keterangan')->placeholder('Tambahkan Keterangan')->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data')->emptyStateDescription('Silahkan tambahkan data terlebih dahulu.')->emptyStateIcon('heroicon-o-exclamation-circle')
            ->recordUrl(false)
            ->columns([
                TextColumn::make("bibit.jenis_bibit")
                    ->label("Jenis Bibit")
                    ->searchable()->sortable(),

                TextColumn::make("target_produksi")
                    ->label("Target Produksi")
                    ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                    ->sortable(),

                TextColumn::make("sudah_diproduksi")->label("Sudah Diproduksi")
                    ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                    ->sortable(),

                TextColumn::make("sudah_distribusi")->label("Sudah Distribusi")
                    ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                    ->sortable(),

                TextColumn::make("stok_akhir")->label("Stok Akhir")
                    ->numeric(thousandsSeparator:'.', decimalSeparator:',', decimalPlaces:0)
                    ->sortable(),

                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('created_at')->label('Dibuat Pada')->dateTime('l, j M Y')
                    ->sortable(),

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
                    Notification::make()
                        ->success()->title('Berhasil Dihapus')
                        ->body('Data Berhasil Dihapus')
                        ->color('success')->seconds(3)
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
            'index' => Pages\ListTargetProduksis::route('/'),
            'create' => Pages\CreateTargetProduksi::route('/create'),
            'edit' => Pages\EditTargetProduksi::route('/{record}/edit'),
        ];
    }

    // app/Filament/Resources/TargetProduksiResource.php
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['bibit']);
    }

}
