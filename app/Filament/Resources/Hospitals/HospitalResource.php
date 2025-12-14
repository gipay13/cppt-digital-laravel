<?php

namespace App\Filament\Resources\Hospitals;

use App\Filament\Resources\Hospitals\Pages\ManageHospitals;
use App\Models\Hospital;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

class HospitalResource extends Resource
{
    protected static ?string $model = Hospital::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static ?string $label = 'Rumah sakit';

    protected static string | UnitEnum | null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->onColor('success')
                    ->inline(false)
                    ->onColor('success')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif')
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
            'index' => ManageHospitals::route('/'),
        ];
    }
}
