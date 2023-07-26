<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class RoomsChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'roomsChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    // protected static ?string $heading = 'RoomsChart';

    protected static ?string $pollingInterval = '4s';
    protected static ?string $loadingIndicator = 'Loading...';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions() : array
    {
        $room        = \App\Models\Room::find( $this->filterFormData['room_id'] );
        $temperature = $this->randomLegalTemperature();

        $color = null;
        // change color to sync from temperature
        if ( $temperature < 10 ) {
            $color = "#00e1ff";
        } else if ( $temperature < 15 ) {
            $color = "#ffbb00"; // green
        } elseif ( $temperature < 25 ) {
            $color = "#f29011"; // yellow
        } elseif ( $temperature < 35 ) {
            $color = "#ff5900"; // orange
        } else {
            // red
            $color = "#f21111";
        }

        return [
            'chart'       => [
                'type'   => 'radialBar',
                'height' => 300,
            ],
            'series'      => [$temperature],
            'plotOptions' => [
                'radialBar' => [
                    'hollow'     => [
                        'size'       => "70%",
                        'margin'     => 0,
                        'background' => "#293450"
                    ],
                    'dataLabels' => [
                        'show'  => true,
                        'name'  => [
                            'show'       => true,
                            'color'      => '#9ca3af',
                            'fontWeight' => 600,
                            'fontSize'   => '40px',

                        ],
                        'value' => [
                            'show'       => false,
                            'color'      => '#9ca3af',
                            'fontWeight' => 600,
                            'fontSize'   => '20px',
                        ],
                    ],

                ],
            ],
            'stroke'      => [
                'lineCap' => 'round',
            ],
            'labels'      => [$temperature . '°C'],
            'colors'      => [$color]
        ];
    }

    protected function getFormSchema() : array
    {
        $rooms = \App\Models\Room::all();
        return [
            Components\Select::make( 'room_id' )
                ->label( 'Room' )
                ->default( $rooms->first()->id )
                ->searchable()
                ->placeholder( 'Select a room' )
                ->options( $rooms->pluck( 'name', 'id' )->toArray() )
                ->required(),

        ];
    }

    public function getColumnSpan() : int|string|array
    {
        return 2;
    }

    public function getHeading() : ?string
    {
        // get default filter value
        $room_id = $this->filterFormData['room_id'];

        // get room name
        $room = \App\Models\Room::find( $room_id );

        return $room->name;
    }

    public function getFooter() : ?string
    {
        // get default filter value
        $room_id = $this->filterFormData['room_id'];

        // get room name
        $room = \App\Models\Room::find( $room_id );

        if ( $room->description ) {
            return $room->description;
        } else {
            return "This room has no description.";
        }
    }

    protected function randomLegalTemperature()
    {
        $mean   = 16; // mean temperature
        $stddev = 10; // standard deviation

        do {
            $u1          = rand() / getrandmax();
            $u2          = rand() / getrandmax();
            $z           = sqrt( -2 * log( $u1 ) ) * cos( 2 * M_PI * $u2 );
            $temperature = round( $mean + $stddev * $z, 2 );
        } while ( $temperature < 32 || $temperature > 212 ); // ensure temperature is within legal range

        // return $temperature;

        return random_int( 1, 100 );
    }
}