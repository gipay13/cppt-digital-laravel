<?php

namespace App\Filament\Resources\Cppts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CpptsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('hospital.name')
                    ->label('Layanan kesehatan')
                    ->searchable(),
                TextColumn::make('patient.nomr')
                    ->label('Rekam Medis')
                    ->searchable(),
                TextColumn::make('patient.name')
                    ->label('Nama pasien')
                    ->searchable(),
                TextColumn::make('diagnose')
                    ->label('Diagnosa')
                    ->formatStateUsing(fn($state) => $state->code.' - '.$state->name)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal buat')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
