<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-s-hashtag';

    public static function form(Form $form) : Form
    {
        return $form
            ->schema( [
                Forms\Components\TextInput::make( 'name' )
                    ->columnSpanFull()
                    ->unique( 'rooms', 'name', ignoreRecord: true )
                    ->required(),
                Forms\Components\Textarea::make( 'description' )
                    ->columnSpanFull(),
            ] );
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns( [
                Tables\Columns\TextColumn::make( 'name' )
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make( 'description' )
                    ->searchable()
                    ->sortable()
                    ->limit( 50 ),
                Tables\Columns\TextColumn::make( 'deleted_at' )
                    ->dateTime(),
                Tables\Columns\TextColumn::make( 'created_at' )
                    ->dateTime(),
                Tables\Columns\TextColumn::make( 'updated_at' )
                    ->dateTime(),
            ] )
            ->filters( [
                Tables\Filters\TrashedFilter::make(),
            ] )
            ->actions( [
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),

            ] )
            ->bulkActions( [
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ] )
            ->defaultSort( 'created_at', 'desc' );
    }

    public static function getRelations() : array
    {
        return [
            //
        ];
    }

    public static function getPages() : array
    {
        return [
            'index'  => Pages\ListRooms::route( '/' ),
            'create' => Pages\CreateRoom::route( '/create' ),
            'view'   => Pages\ViewRoom::route( '/{record}' ),
            'edit'   => Pages\EditRoom::route( '/{record}/edit' ),
        ];
    }

    public static function getEloquentQuery() : Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes( [
                SoftDeletingScope::class,
            ] );
    }
}