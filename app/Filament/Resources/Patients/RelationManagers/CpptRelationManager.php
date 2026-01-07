<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use App\Models\Cppt;
use Filament\Actions\Action;
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
use Filament\Support\Icons\Heroicon;
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
                Section::make('Asesmen')
                    ->description('Tanggal buat, Layanan kesehatan, diagnosa, dan instruksi')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Tanggal buat')
                            ->date()
                            ->inlineLabel(),
                        TextEntry::make('hospital.name')
                            ->label('Layanan kesehatan')
                            ->inlineLabel(),
                        TextEntry::make('diagnose')
                            ->label('Diagnosa Awal')
                            ->formatStateUsing(fn ($state) => $state->code.' - '.$state->name)
                            ->inlineLabel(),
                        TextEntry::make('instruction')
                            ->label('Instruksi')
                            ->inlineLabel()
                            ->html(),
                    ])
                    ->columnSpanFull(),
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
                            ->html()
                            ->inlineLabel(),
                    ])
                    ->columnSpanFull(),
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
                    ->label('Layanan kesehatan')
                    ->searchable(),
                TextColumn::make('diagnose')
                    ->label('Diagnosa Awal')
                    ->formatStateUsing(fn($state) => $state->code.' - '.$state->name)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal buat')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('create')
                    ->label('Buat CPPT')
                    ->icon(Heroicon::Plus)
                    ->iconSize('sm')
                    ->url(route('filament.dashboard.resources.cppts.create'))
                    ->openUrlInNewTab()
            ])
            ->recordActions([
                ViewAction::make()
                    ->slideOver(),
                Action::make('pdf')
                    ->label('PDF')
                    ->color('default')
                    ->icon('heroicon-o-document')
                    ->iconSize('sm')
                    ->url(fn (Cppt $record) => route('pdf.cppt', $record->id))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => auth()->user()->can('viewPdf', $record)),
            ])
            ->toolbarActions([

            ]);
    }
}
