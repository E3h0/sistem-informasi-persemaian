<?php

namespace App\Filament\Resources\KategoriBibitResource\Pages;

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
use App\Filament\Resources\KategoriBibitResource;

class ListKategoriBibits extends ListRecords
{
    protected static string $resource = KategoriBibitResource::class;

    protected function getHeaderActions(): array
    {
        return [
              CreateAction::make()
                ->label('Tambah Data Baru')
                ->modalHeading('Tambah Kategori Bibit Baru')
                ->form([
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

                    Textarea::make("keterangan")->placeholder("Tambahkan Keterangan")

                ])->extraModalFooterActions([])
                ->modalSubmitActionLabel('Simpan')->modalCancelActionLabel('Batalkan')
                ->successNotification(
                    Notification::make()->success()->title('Berhasil Ditambahkan')->body('Data baru berhasil ditambahkan')->color('success')->seconds(3)
                ),
        ];
    }
}
