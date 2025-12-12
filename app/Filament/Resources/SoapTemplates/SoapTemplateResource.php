<?php

namespace App\Filament\Resources\SoapTemplates;

use App\Filament\Resources\SoapTemplates\Pages\ManageSoapTemplates;
use App\Models\SoapTemplate;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SoapTemplateResource extends Resource
{
    protected static ?string $model = SoapTemplate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquare2Stack;

    protected static ?string $label = 'Template SOAP';

    protected static string | UnitEnum | null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama template')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('subjective')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('objecttive')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('assessment')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('plan')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('subjective')
                    ->columnSpanFull(),
                TextEntry::make('objecttive')
                    ->columnSpanFull(),
                TextEntry::make('assessment')
                    ->columnSpanFull(),
                TextEntry::make('plan')
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
                TextColumn::make('title')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->modalWidth('md'),
                EditAction::make()
                    ->modalWidth('md'),
                DeleteAction::make(),
            ])
            ->toolbarActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSoapTemplates::route('/'),
        ];
    }
}
