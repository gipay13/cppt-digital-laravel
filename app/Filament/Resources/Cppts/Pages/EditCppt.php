<?php

namespace App\Filament\Resources\Cppts\Pages;

use App\Filament\Resources\Cppts\CpptResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCppt extends EditRecord
{
    protected static string $resource = CpptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()
                ->icon('heroicon-o-eye')
                ->iconSize('sm'),
            DeleteAction::make()
                ->icon('heroicon-o-trash')
                ->iconSize('sm'),
        ];
    }
}
