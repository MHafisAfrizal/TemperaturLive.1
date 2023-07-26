<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register() : void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot() : void
    {
        \Reworck\FilamentSettings\FilamentSettings::setFormFields( [
            \Filament\Forms\Components\TextInput::make( 'app.name' )
                ->label( 'App Name' )
                ->required()
                ->placeholder( 'Your app name' ),

            \Filament\Forms\Components\TextInput::make( 'filament.brand' )
                ->label( 'Dashboard Name' )
                ->required()
                ->placeholder( 'Your dashboard name' ),

            \Filament\Forms\Components\Textarea::make( 'app.description' )
                ->label( 'App Description' )
                ->required()
                ->placeholder( 'Your app description' ),

            \Filament\Forms\Components\Select::make( 'filament-themes.color_public_path' )
                ->label( 'Theme Color' )
                ->options( [
                    'vendor/yepsua-filament-themes/css/slate.css'   => 'Slate',
                    'vendor/yepsua-filament-themes/css/gray.css'    => 'Gray',
                    'vendor/yepsua-filament-themes/css/zinc.css'    => 'Zinc',
                    'vendor/yepsua-filament-themes/css/neutral.css' => 'Neutral',
                    'vendor/yepsua-filament-themes/css/stone.css'   => 'Stone',
                    'vendor/yepsua-filament-themes/css/red.css'     => 'Red',
                    'vendor/yepsua-filament-themes/css/orange.css'  => 'Orange',
                    'vendor/yepsua-filament-themes/css/amber.css'   => 'Amber',
                    'vendor/yepsua-filament-themes/css/yellow.css'  => 'Yellow',
                    'vendor/yepsua-filament-themes/css/lime.css'    => 'Lime',
                    'vendor/yepsua-filament-themes/css/green.css'   => 'Green',
                    'vendor/yepsua-filament-themes/css/emerald.css' => 'Emerald',
                    'vendor/yepsua-filament-themes/css/teal.css'    => 'Teal',
                    'vendor/yepsua-filament-themes/css/cyan.css'    => 'Cyan',
                    'vendor/yepsua-filament-themes/css/sky.css'     => 'Sky',
                    'vendor/yepsua-filament-themes/css/blue.css'    => 'Blue',
                    'vendor/yepsua-filament-themes/css/indigo.css'  => 'Indigo',
                    'vendor/yepsua-filament-themes/css/violet.css'  => 'Violet',
                    'vendor/yepsua-filament-themes/css/purple.css'  => 'Purple',
                    'vendor/yepsua-filament-themes/css/fuchsia.css' => 'Fuchsia',
                    'vendor/yepsua-filament-themes/css/pink.css'    => 'Pink',
                    'vendor/yepsua-filament-themes/css/rose.css'    => 'Rose',
                ] )
                ->searchable()
                ->placeholder( 'Select a color' )
        ] );

        $valuestore = \Spatie\Valuestore\Valuestore::make( config( 'filament-settings.path' ) );

        $conf = \Arr::dot( $valuestore->all() );

        foreach ( $conf as $key => $value ) {
            config()->set( $key, $value );
        }

    }
}