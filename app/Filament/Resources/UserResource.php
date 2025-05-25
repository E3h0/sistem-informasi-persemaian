<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rules\Password;
use Livewire\Component as Livewire;

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
                    ->label('Nama')->placeholder('Masukkan Nama')->label('Nama')
                    ->rules(['required','min:3'])->validationMessages([
                        'required' => 'Tolong isi bagian ini.',
                        'min' => 'Minimal Harus 3 karakter'
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
