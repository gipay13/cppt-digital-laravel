<?php

namespace App\Filament\Resources\Diagnoses;

use App\Filament\Resources\Diagnoses\Pages\ManageDiagnoses;
use App\Models\Diagnose;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class DiagnoseResource extends Resource
{
    protected static ?string $model = Diagnose::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLightBulb;

    protected static ?string $label = 'Diagnosa';

    protected static string | UnitEnum | null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Kode')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('code')
                    ->label('Kode')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->modalWidth('sm'),
            ])
            ->toolbarActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageDiagnoses::route('/'),
        ];
    }
}
