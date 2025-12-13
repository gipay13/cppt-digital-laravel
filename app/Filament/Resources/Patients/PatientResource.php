<?php

namespace App\Filament\Resources\Patients;

use App\Filament\Resources\Patients\Pages\ManagePatients;
use App\Filament\Resources\Patients\Pages\ViewPatients;
use App\Models\Patient;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $label = 'Pasien';

    protected static string | UnitEnum | null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'md' => 2
                ])
                ->schema([
                    TextInput::make('nomr')
                        ->label('No. Rekam medis')
                        ->numeric()
                        ->unique(ignoreRecord: true)
                        ->length(8)
                        ->required(),
                    TextInput::make('name')
                        ->label('Nama lengkap')
                        ->required(),
                    Select::make('sex')
                        ->label('Jenis kelamin')
                        ->native(false)
                        ->options([
                            'L' => 'Laki-laki',
                            'P' => 'Perempuan'
                        ])
                        ->required(),
                    DatePicker::make('born_date')
                        ->label('Tanggal lahir')
                        ->native(false)
                        ->closeOnDateSelection()
                        ->required(),
                    Textarea::make('address')
                        ->label('Alamat')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('pic_name')
                        ->label('Nama penanggung jawab')
                        ->required(),
                    TextInput::make('pic_phone')
                        ->label('No. Handphone')
                        ->tel()
                        ->required(),
                ])
                ->columnSpanFull()
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('nomr')
                            ->label('No. Rekam medis')
                            ->inlineLabel(),
                        TextEntry::make('name')
                            ->label('Nama lengkap')
                            ->inlineLabel(),
                        TextEntry::make('sex')
                            ->label('Jenis kelamin')
                            ->inlineLabel()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            }),
                        TextEntry::make('born_date')
                            ->label('Tanggal lahir')
                            ->inlineLabel()
                            ->date(),
                        TextEntry::make('age')
                            ->label('Umur')
                            ->inlineLabel(),
                        TextEntry::make('address')
                            ->label('Alamat')
                            ->inlineLabel(),
                        TextEntry::make('pic_name')
                            ->label('Nama penanggung jawab')
                            ->inlineLabel(),
                        TextEntry::make('pic_phone')
                            ->label('No. Handphone')
                            ->inlineLabel(),
                    ])
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Pasien')
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('nomr')
                    ->label('No. Rekam medis')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama lengkap')
                    ->searchable(),
                TextColumn::make('sex')
                    ->label('Jenis kelamin')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    }),
                TextColumn::make('born_date')
                    ->label('Tanggal lahir')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePatients::route('/'),
            'view' => ViewPatients::route('/{record}'),
        ];
    }
}
