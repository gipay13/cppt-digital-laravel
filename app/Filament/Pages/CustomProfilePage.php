<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\EditProfile;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Arr;

class CustomProfilePage extends EditProfile
{
    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        $this->getFormContentComponent(),
                        ...Arr::wrap($this->getMultiFactorAuthenticationContentComponent()),
                    ])
            ]);
    }
}
