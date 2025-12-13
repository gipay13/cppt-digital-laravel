<?php

namespace App\Filament\Resources\Cppts\Pages;

use App\Filament\Resources\Cppts\CpptResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCppt extends ViewRecord
{
    protected static string $resource = CpptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->icon('heroicon-o-pencil-square')
                ->iconSize('sm'),
        ];
    }
}
