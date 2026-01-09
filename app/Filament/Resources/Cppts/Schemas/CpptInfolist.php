<?php

namespace App\Filament\Resources\Cppts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CpptInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pasien')
                    ->description('Informasi biodata pasien')
                    ->schema([
                        TextEntry::make('patient.nomr')
                            ->label('No. Rekam medis')
                            ->inlineLabel(),
                        TextEntry::make('patient.name')
                            ->label('Nama lengkap')
                            ->inlineLabel(),
                        TextEntry::make('patient.sex')
                            ->label('Jenis kelamin')
                            ->inlineLabel()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            }),
                        TextEntry::make('patient.born_date')
                            ->label('Tanggal lahir')
                            ->inlineLabel()
                            ->date(),
                        TextEntry::make('patient.age')
                            ->label('Umur')
                            ->inlineLabel(),
                        TextEntry::make('patient.address')
                            ->label('Alamat')
                            ->inlineLabel(),
                        TextEntry::make('patient.pic_name')
                            ->label('Nama penanggung jawab')
                            ->inlineLabel(),
                        TextEntry::make('patient.pic_phone')
                            ->label('No. Handphone')
                            ->inlineLabel(),
                    ])
                    ->aside()
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
                            ->inlineLabel()
                            ->html(),
                    ])
                    ->aside()
                    ->columnSpanFull(),
                Section::make('Asesmen')
                    ->description('Tanggal buat, layanan kesehatan, diagnosa, dan instruksi')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Tanggal buat')
                            ->date()
                            ->inlineLabel(),
                        TextEntry::make('hospital.name')
                            ->label('Layanan kesehatan')
                            ->inlineLabel(),
                        TextEntry::make('diagnose')
                            ->label('Diagnosis')
                            ->formatStateUsing(fn ($state) => $state->code.' - '.$state->name)
                            ->inlineLabel(),
                        TextEntry::make('instruction')
                            ->label('Instruksi')
                            ->inlineLabel()
                            ->html(),
                    ])
                    ->aside()
                    ->columnSpanFull(),
            ]);
    }
}
