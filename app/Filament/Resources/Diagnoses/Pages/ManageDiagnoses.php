<?php

namespace App\Filament\Resources\Diagnoses\Pages;

use App\Filament\Resources\Diagnoses\DiagnoseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDiagnoses extends ManageRecords
{
    protected static string $resource = DiagnoseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->iconSize('sm')
                ->modalWidth('sm'),
        ];
    }
}
