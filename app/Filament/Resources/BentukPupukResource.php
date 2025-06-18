<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\BentukPupuk;
use Filament\Facades\Filament;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use App\Filament\Resources\BentukPupukResource\Pages;

class BentukPupukResource extends Resource
{
    protected static ?string $model = BentukPupuk::class;

    protected static ?string $modelLabel = "Bentuk Pupuk";
    protected static ?string $pluralModelLabel = "Bentuk Pupuk";
    protected static ?string $slug = "bentuk-pupuk";
    protected static ?string $breadcrumb = "Bentuk Pupuk";
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Pengaturan';

    public static function table(Table $table): Table
    {
        return $table
            ->recordAction(null)
            ->recordUrl(false)
            ->emptyStateHeading('Belum ada data')->emptyStateDescription('Silahkan tambahkan data terlebih dahulu.')->emptyStateIcon('heroicon-o-exclamation-circle')
            ->columns([
                TextColumn::make('nama_bentuk')
                    ->label('Nama Bentuk')
                    ->searchable(),

                TextColumn::make('keterangan')->label('Keterangan')
                    ->placeholder('Tidak ada keterangan yang ditambahkan.')
                    ->toggleable(),


                TextColumn::make('pencatat.name')
                    ->label('Pencatat')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')->dateTime('l, j M Y')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')->dateTime('l, j M Y')
                    ->sortable()->toggleable(isToggledHiddenByDefault:true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Edit Data Bentuk Pupuk')
                    ->form([
                        TextInput::make('nama_bentuk')
                            ->label('Nama Bentuk')
                            ->placeholder('Masukkan Nama Bentuk')
                            ->rules(fn (?Model $record): array => [
                                'required','min:3',
                                Rule::unique('bentuk_pupuk', 'nama_bentuk')->ignore($record)])
                            ->validationMessages([
                                'required' => 'Tolong isi bagian ini.',
                                'min' => 'Minimal harus 3 karakter',
                                'unique' => 'Data sudah ada'
                            ])->markAsRequired()
                            ->live(debounce:300)
                            ->afterStateUpdated(function ($state, $set) {
                                $set('nama_bentuk', ucfirst(strtolower($state)));
                            }),

                        Hidden::make('user_id')
                            ->default(Filament::auth()->user()->id)
                            ->dehydrated(),

                        Textarea::make("keterangan")->placeholder("Tambahkan Keterangan")

                    ])->extraModalFooterActions([])
                    ->modalSubmitActionLabel('Simpan Perubahan')->modalCancelActionLabel('Batalkan')
                    ->successNotification(
                        Notification::make()->success()->title('Berhasil Diedit')->body('Data berhasil diedit')->color('success')->seconds(3)
                    ),

                Tables\Actions\DeleteAction::make()
                    ->action(function ($record){
                        if ($record->pupuk()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title('Gagal, Tidak Dapat Menghapus')
                                ->body('Bentuk pupuk ini sedang digunakan di data pupuk')
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
                    ->modalHeading('Konfirmasi Penghapusan')
                    ->modalDescription('Apakah anda yakin ingin menghapus data? Data yang dihapus tidak dapat dikembalikan!')
                    ->successNotification(
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
            'index' => Pages\ListBentukPupuks::route('/'),
        ];
    }
}
