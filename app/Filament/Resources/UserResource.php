<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Livewire\Component as Livewire;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $modelLabel = "Kelola User";

    protected static ?string $pluralModelLabel = "Kelola User";

    protected static ?string $slug = "kelola-user";

    protected static ?string $breadcrumb = "Kelola User";

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                   ->label("Nama")->placeholder("Masukkan Nama User")
                    ->rules(fn (Get $get, ?Model $record): array => [
                        'required','min:3',
                        Rule::unique('users', 'name')->ignore($record)])
                    ->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'min' => 'Minimal Harus 3 karakter',
                        'unique' => 'Data sudah ada'
                ])->markAsRequired(),

                TextInput::make('email')
                    ->label('Email')->placeholder('Masukkan Email')
                    ->email()
                    ->rules(['required','min:3', 'lowercase'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'min' => 'Minimal Harus 3 karakter.',
                        'lowercase' => 'Gunakan huruf kecil semua.'
                    ])->markAsRequired(),

                TextInput::make('password')
                    ->label('Password')->placeholder('Masukkan Password')
                    ->password()
                    ->revealable()
                    ->rules(['required',
                        Password::min(8)
                            ->letters()->numbers()->uncompromised()
                    ])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'min' => 'Minimal Harus 8 karakter',
                        'password.letters' => 'Password harus mengandung huruf',
                        'password.numbers' => 'Password harus mengandung angka',
                        'password.uncompromised' => 'Password ini terlalu lemah, harap buat password lain',
                    ])->markAsRequired(),
                Select::make('role')
                    ->label('Hak Akses')->placeholder('Pilih Hak Akses')
                    ->rules(['required'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                    ])->markAsRequired()
                    ->options(User::ROLES)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(false)
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Admin' => 'success',
                        'Editor' => 'warning',
                        'Viewer' => 'danger',
                    })
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('l, j M Y')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')->dateTime('l, j M Y')
                    ->sortable()->toggleable(isToggledHiddenByDefault:true),
            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
