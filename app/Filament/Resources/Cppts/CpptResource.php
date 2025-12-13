<?php

namespace App\Filament\Resources\Cppts;

use App\Filament\Resources\Cppts\Pages\CreateCppt;
use App\Filament\Resources\Cppts\Pages\EditCppt;
use App\Filament\Resources\Cppts\Pages\ListCppts;
use App\Filament\Resources\Cppts\Pages\ViewCppt;
use App\Filament\Resources\Cppts\Schemas\CpptForm;
use App\Filament\Resources\Cppts\Schemas\CpptInfolist;
use App\Filament\Resources\Cppts\Tables\CpptsTable;
use App\Models\Cppt;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CpptResource extends Resource
{
    protected static ?string $model = Cppt::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocument;

    protected static ?string $label = 'CPPT';

    public static function form(Schema $schema): Schema
    {
        return CpptForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CpptInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CpptsTable::configure($table);
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
            'index' => ListCppts::route('/'),
            'create' => CreateCppt::route('/create'),
            'view' => ViewCppt::route('/{record}'),
            'edit' => EditCppt::route('/{record}/edit'),
        ];
    }
}
