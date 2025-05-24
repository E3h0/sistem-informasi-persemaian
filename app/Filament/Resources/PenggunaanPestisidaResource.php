<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\PenggunaanPestisida;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Factories\Relationship;
use App\Filament\Resources\PenggunaanPestisidaResource\Pages;
use App\Filament\Resources\PenggunaanPestisidaResource\RelationManagers;

class PenggunaanPestisidaResource extends Resource
{
    protected static ?string $model = PenggunaanPestisida::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pestisida_id')
                    ->relationship('pestisida', 'nama_pestisida')
                    ->placeholder('Pilih pestisida')
                    ->required(),
                TextInput::make('jumlah_penggunaan')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_penggunaan')
                    ->required(),
                Select::make('user_id')
                    ->relationship('pencatat', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pestisida.id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jumlah_penggunaan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal_penggunaan')
                    ->date()
                    ->sortable(),
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPenggunaanPestisidas::route('/'),
            'create' => Pages\CreatePenggunaanPestisida::route('/create'),
            'edit' => Pages\EditPenggunaanPestisida::route('/{record}/edit'),
        ];
    }
}
