<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenggunaanPupukResource\Pages;
use App\Filament\Resources\PenggunaanPupukResource\RelationManagers;
use App\Models\PenggunaanPupuk;
use App\Models\Pupuk;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenggunaanPupukResource extends Resource
{
    protected static ?string $model = PenggunaanPupuk::class;

    protected static ?string $navigationIcon = 'fluentui-data-usage-20-o';

    protected static ?string $modelLabel = "Penggunaan Pupuk";

    protected static ?string $pluralModelLabel = "Penggunaan Pupuk";

    protected static ?string $navigationLabel = 'Penggunaan Pupuk';

    protected static ?string $breadcrumb = "Penggunaan Pupuk";

    protected static ?string $slug = 'penggunaan-pupuk';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Kelola Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pupuk_id')->options(Pupuk::all()->pluck('nama_pupuk', 'id'))->label('Nama Pupuk')->required()->placeholder('Pilih pupuk')->searchable()->searchPrompt('Cari pupuk'),

                TextInput::make('jumlah_penggunaan')->numeric()->required(),
                DateTimePicker::make('tanggal_penggunaan')->format('d/m/y')->seconds(false)->required(),
                Select::make('user_id')->relationship('pencatat', 'name')->label('Pencatat')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pupuk.nama_pupuk')->label('Nama Pupuk'),
                TextColumn::make('jumlah_penggunaan')->label('Jumlah Penggunaan')->numeric(),
                TextColumn::make('tanggal_penggunaan')->label('Tanggal Penggunaan'),
                TextColumn::make('pencatat.name')->label('Pencatat')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPenggunaanPupuks::route('/'),
            'create' => Pages\CreatePenggunaanPupuk::route('/create'),
            'edit' => Pages\EditPenggunaanPupuk::route('/{record}/edit'),
        ];
    }
}
