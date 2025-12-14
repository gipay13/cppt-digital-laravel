<?php

namespace App\Filament\Resources\Cppts\Schemas;

use App\Filament\Resources\Patients\PatientResource;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CpptForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Select::make('hospital_id')
                            ->extraAttributes([
                                'wire:key' => str()->random(50)
                            ])
                            ->label('Rumah sakit')
                            ->native(false)
                            ->relationship('hospital', 'name', fn(Builder $query) => $query->where('is_active', true))
                            ->required()
                            ->createOptionModalHeading('Tambah rumah sakit')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->required(),
                            ])
                            ->createOptionAction(fn ($action) => $action->modalWidth('sm'))
                            ->editOptionModalHeading('Ubah rumah sakit')
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->required(),
                            ])
                            ->editOptionAction(fn ($action) => $action->modalWidth('sm')),
                        Select::make('patient_id')
                            ->label('Pasien')
                            ->searchable(['nomr', 'name'])
                            ->native(false)
                            ->relationship('patient')
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->nomr} - {$record->name}")
                            ->required()
                            ->createOptionModalHeading('Tambah pasien')
                            ->createOptionForm(fn (Schema $schema) => PatientResource::form($schema))
                            ->createOptionAction(fn ($action) => $action->modalWidth('xl')),
                        Textarea::make('subjective')
                            ->required(),
                        Textarea::make('objective')
                            ->required(),
                        Textarea::make('assessment')
                            ->required(),
                        Textarea::make('plan')
                            ->required(),
                        RichEditor::make('instruction')
                            ->label('Instruksi')
                            ->required()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline',],
                                ['bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ])
                            ->columnSpanFull()
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2
                    ])
                    ->columnSpanFull()
            ]);
    }
}
