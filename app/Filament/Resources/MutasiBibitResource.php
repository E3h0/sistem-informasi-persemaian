<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MutasiBibitResource\Pages;
use App\Filament\Resources\MutasiBibitResource\RelationManagers;
use App\Models\MutasiBibit;
use App\Models\PersediaanBibit;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\select;

class MutasiBibitResource extends Resource
{
    protected static ?string $model = MutasiBibit::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    protected static ?string $navigationLabel = 'Mutasi Bibit';

    protected static ?string $modelLabel = 'Mutasi Bibit';

    protected static ?string $pluralModelLabel = 'Mutasi Bibit';

    protected static ?string $breadcrumb = 'Mutasi Bibit';

     protected static ?string $slug = 'mutasi-bibit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bibit_id')
                ->options(PersediaanBibit::all()->pluck('jenis_bibit', 'id'))->label('Jenis Bibit')
                ->searchable()->searchPrompt('Cari nama bibit')->placeholder('Pilih Jenis Bibit')->required()
                ->columnSpanFull(),

                Fieldset::make('GHA')
                ->schema([
                    TextInput::make('gha1')->label('Blok 1')->numeric()->columnSpan(1)->required()
                    ->placeholder('Masukkan jumlah bibit'),

                    TextInput::make('gha2')->label('Blok 2')->numeric()->columnSpan(1)->required()
                    ->placeholder('Masukkan jumlah bibit'),

                    TextInput::make('gha3')->label('Blok 3')->numeric()->columnSpan(1)->required()
                    ->placeholder('Masukkan jumlah bibit'),

                    TextInput::make('gha4')->label('Blok 4')->numeric()->columnSpan(1)->required()
                    ->placeholder('Masukkan jumlah bibit'),

                ])->columns(4),

                Fieldset::make('AHA')
                ->schema([
                    TextInput::make('aha1')->label('Blok 1')->numeric()->columnSpan(1)
                    ->required()->placeholder('Masukkan jumlah bibit'),

                    TextInput::make('aha2')->label('Blok 2')->numeric()->columnSpan(1)
                    ->required()->placeholder('Masukkan jumlah bibit'),

                    TextInput::make('aha3')->label('Blok 3')->numeric()->columnSpan(1)
                    ->required()->placeholder('Masukkan jumlah bibit'),

                    TextInput::make('aha4')->label('Blok 4')->numeric()->columnSpan(1)
                    ->required()->placeholder('Masukkan jumlah bibit'),

                ])->columns(4),

                Fieldset::make('OGA')
                ->schema([
                    TextInput::make('oga1')->label('Blok 1')->numeric()->columnSpan(1)
                    ->required()->placeholder('Masukkan jumlah bibit'),

                    TextInput::make('oga2')->label('Blok 2')->numeric()->columnSpan(1)
                    ->required()->placeholder('Masukkan jumlah bibit'),

                    TextInput::make('oga3')->label('Blok 3')->numeric()->columnSpan(1)
                    ->required()->placeholder('Masukkan jumlah bibit'),

                    TextInput::make('oga4')->label('Blok 4')->numeric()->columnSpan(1)
                    ->required()->placeholder('Masukkan jumlah bibit'),

                ])->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bibit.jenis_bibit')->label('Jenis Bibit'),
                ColumnGroup::make('GHA', [
                    TextColumn::make('gha1')->label('Blok 1'),
                    TextColumn::make('gha2')->label('Blok 2'),
                    TextColumn::make('gha3')->label('Blok 3'),
                    TextColumn::make('gha4')->label('Blok 4')
                ])->alignment(Alignment::Center),
                  ColumnGroup::make('AHA', [
                    TextColumn::make('aha1')->label('Blok 1'),
                    TextColumn::make('aha2')->label('Blok 2'),
                    TextColumn::make('aha3')->label('Blok 3'),
                    TextColumn::make('aha4')->label('Blok 4')
                ])->alignment(Alignment::Center),
                  ColumnGroup::make('OGA', [
                    TextColumn::make('oga1')->label('Blok 1'),
                    TextColumn::make('oga2')->label('Blok 2'),
                    TextColumn::make('oga3')->label('Blok 3'),
                    TextColumn::make('oga4')->label('Blok 4')
                ])->alignment(Alignment::Center),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make()
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
            'index' => Pages\ListMutasiBibits::route('/'),
            'create' => Pages\CreateMutasiBibit::route('/create'),
            'edit' => Pages\EditMutasiBibit::route('/{record}/edit'),
        ];
    }
}
