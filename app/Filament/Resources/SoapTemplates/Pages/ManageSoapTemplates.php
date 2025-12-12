<?php

namespace App\Filament\Resources\SoapTemplates\Pages;

use App\Filament\Resources\SoapTemplates\SoapTemplateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSoapTemplates extends ManageRecords
{
    protected static string $resource = SoapTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->iconSize('sm')
                ->modalWidth('md'),
        ];
    }
}
