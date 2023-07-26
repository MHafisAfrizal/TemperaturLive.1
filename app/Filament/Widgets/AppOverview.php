<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Nette\Utils\Html;

class AppOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getCards() : array
    {
        $appName = config( 'app.name' );
        $rooms   = \App\Models\Room::all();
        return [
            Card::make( "", 'Welcome to ' . config( 'app.name' ) )
                ->description( config( 'app.description' ) ),
        ];
    }

}