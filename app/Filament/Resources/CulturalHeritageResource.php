<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CulturalHeritageResource\Pages;
use App\Filament\Resources\CulturalHeritageResource\RelationManagers;
use App\Models\CulturalHeritage;
use Dipesh79\LaravelNepalAddressSeeder\Models\District;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;


class CulturalHeritageResource extends Resource
{
    protected static ?string $model = CulturalHeritage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('indigenous_nationalities'),
                TextInput::make('event_name'),
                TextInput::make('cultural_property'),
                TextInput::make('event_time'),
                Select::make('district_id')
                ->label('District')
                ->options(District::all()->pluck('name', 'id'))
                ->searchable(),
                TextInput::make('conservator'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('indigenous_nationalities'),
                TextColumn::make('event_name'),
                TextColumn::make('cultural_property'),
                TextColumn::make('event_time'),
                TextColumn::make('district.name')->label('District'), 
                TextColumn::make('conservator'),

                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCulturalHeritages::route('/'),
            'create' => Pages\CreateCulturalHeritage::route('/create'),
            'edit' => Pages\EditCulturalHeritage::route('/{record}/edit'),
        ];
    }
}
