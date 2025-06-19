<?php

namespace App\Filament\Resources\SatuanPupukResource\Pages;

use Filament\Actions;
use Filament\Facades\Filament;
use Illuminate\Validation\Rule;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SatuanPupukResource;

class ListSatuanPupuks extends ListRecords
{
    protected static string $resource = SatuanPupukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Data Baru')
                ->modalHeading('Tambah Satuan Pupuk Baru')
                ->form([
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

                    Textarea::make("keterangan")->placeholder("Tambahkan Keterangan")

                ])->extraModalFooterActions([])
                ->modalSubmitActionLabel('Simpan')->modalCancelActionLabel('Batalkan')
                ->successNotification(
                    Notification::make()->success()->title('Berhasil Ditambahkan')->body('Data baru berhasil ditambahkan')->color('success')->seconds(3)
                ),
        ];
    }
}
