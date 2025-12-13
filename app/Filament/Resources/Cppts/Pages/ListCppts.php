<?php

namespace App\Filament\Resources\Cppts\Pages;

use App\Filament\Resources\Cppts\CpptResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCppts extends ListRecords
{
    protected static string $resource = CpptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->iconSize('sm'),
        ];
    }
}
