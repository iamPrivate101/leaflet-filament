<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FestivalResource\Pages;
use App\Filament\Resources\FestivalResource\RelationManagers;
use App\Models\Festival;
use App\Models\User;
use Dipesh79\LaravelNepalAddressSeeder\Models\District;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FestivalResource extends Resource
{
    protected static ?string $model = Festival::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('district_id')
                    ->label('District')
                    ->options(District::all()->pluck('name', 'id'))
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('district.name')->label('District'), // Display the district name
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
            'index' => Pages\ListFestivals::route('/'),
            'create' => Pages\CreateFestival::route('/create'),
            'edit' => Pages\EditFestival::route('/{record}/edit'),
        ];
    }
}
