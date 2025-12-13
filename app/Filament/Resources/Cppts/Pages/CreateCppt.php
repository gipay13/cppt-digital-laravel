<?php

namespace App\Filament\Resources\Cppts\Pages;

use App\Filament\Resources\Cppts\CpptResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCppt extends CreateRecord
{
    protected static string $resource = CpptResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
