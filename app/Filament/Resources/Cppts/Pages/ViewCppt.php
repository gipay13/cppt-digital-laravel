<?php

namespace App\Filament\Resources\Cppts\Pages;

use App\Filament\Resources\Cppts\CpptResource;
use App\Models\Cppt;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCppt extends ViewRecord
{
    protected static string $resource = CpptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('pdf')
                    ->label('PDF')
                    ->color('default')
                    ->icon('heroicon-o-document')
                    ->iconSize('sm')
                    ->url(fn (Cppt $record) => route('pdf.cppt', $record->id))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => auth()->user()->can('viewPdf', $record)),
                EditAction::make()
                    ->icon('heroicon-o-pencil-square')
                    ->iconSize('sm'),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->iconSize('sm'),
            ])
            ->label('Aksi')
            ->button()
            ->icon('heroicon-o-ellipsis-vertical')
        ];
    }
}
