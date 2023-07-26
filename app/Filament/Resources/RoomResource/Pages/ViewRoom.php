<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRoom extends ViewRecord
{
    protected static string $resource = RoomResource::class;

    protected function getActions() : array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}