<?php

namespace App\Filament\Resources\Cppts\Schemas;

use App\Filament\Resources\Patients\PatientResource;
use Filament\Forms\Components\DatePicker;
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
                Section::make('')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Tanggal buat')
                            ->inlineLabel()
                            ->default(today())
                            ->native(false),
                        Select::make('hospital_id')
                            ->extraAttributes([
                                'wire:key' => str()->random(50)
                            ])
                            ->label('Layanan kesehatan')
                            ->inlineLabel()
                            ->native(false)
                            ->relationship('hospital', 'name', fn(Builder $query) => $query->where('is_active', true))
                            ->required()
                            ->createOptionModalHeading('Tambah layanan kesehattan')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->required(),
                            ])
                            ->createOptionAction(fn ($action) => $action->modalWidth('sm'))
                            ->editOptionModalHeading('Ubah layanan kesehatan')
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->required(),
                            ])
                            ->editOptionAction(fn ($action) => $action->modalWidth('sm')),
                        Select::make('patient_id')
                            ->label('Pasien')
                            ->inlineLabel()
                            ->searchable(['nomr', 'name'])
                            ->native(false)
                            ->relationship('patient')
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->nomr} - {$record->name}")
                            ->required()
                            ->createOptionModalHeading('Tambah pasien')
                            ->createOptionForm(fn (Schema $schema) => PatientResource::form($schema))
                            ->createOptionAction(fn ($action) => $action->modalWidth('xl')),
                    ])
                    ->columnSpanFull(),
                Section::make('')
                    ->schema([
                        Textarea::make('subjective')
                            ->required()
                            ->rows(4),
                        Textarea::make('objective')
                            ->required()
                            ->rows(4),
                        Textarea::make('assessment')
                            ->required()
                            ->rows(4),
                        RichEditor::make('plan')
                            ->required()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline',],
                                ['bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 3
                    ])
                    ->columnSpanFull(),
                Section::make('')
                    ->schema([
                        Select::make('diagnose_id')
                            ->label('Diagnosis')
                            ->inlineLabel()
                            ->required()
                            ->searchable(['code', 'name'])
                            ->native(false)
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->code} - {$record->name}")
                            ->relationship('diagnose', 'code'),
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
                    ->columnSpanFull(),
            ]);
    }
}
