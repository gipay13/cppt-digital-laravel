<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CpptRelationManager extends RelationManager
{
    protected static string $relationship = 'cppt';

    protected static ?string $label = 'CPPT';

    protected static ?string $title = 'CPPT';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('SOAP')
                    ->description('Subjective, Objective, Assessment, Plan')
                    ->schema([
                        TextEntry::make('subjective')
                            ->inlineLabel(),
                        TextEntry::make('objective')
                            ->inlineLabel(),
                        TextEntry::make('assessment')
                            ->inlineLabel(),
                        TextEntry::make('plan')
                            ->inlineLabel(),
                    ])
                    ->columnSpanFull(),
                Section::make('Data Lainnya')
                    ->description('Tanggal buat, rumah sakit, dan instruksi')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Tanggal buat')
                            ->date()
                            ->inlineLabel(),
                        TextEntry::make('hospital.name')
                            ->label('Rumah sakit')
                            ->inlineLabel(),
                        TextEntry::make('instruction')
                            ->label('Instruksi')
                            ->inlineLabel()
                            ->html(),
                    ])
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('hospital.name')
                    ->label('Rumah sakit')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal buat')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                
            ])
            ->recordActions([
                ViewAction::make()
                    ->slideOver(),
            ])
            ->toolbarActions([
                
            ]);
    }
}
