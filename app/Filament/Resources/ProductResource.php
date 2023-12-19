<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                     ->schema([
                         Section::make()
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                                              ->required(),
                                    Forms\Components\TextInput::make('sku_code'),
                                    Forms\Components\Textarea::make('short_description')
                                                             ->columnSpan(2),
                                ])
                                ->columns(2),
                         Section::make('Details')
                                ->schema([
                                    Forms\Components\RichEditor::make('description')
                                                               ->columnSpan(2),
                                    Forms\Components\KeyValue::make('attributes')
                                                             ->reorderable()
                                                             ->columnSpan(2),
                                ]),
                         Section::make('Pricing')
                                ->schema([
                                    Forms\Components\TextInput::make('price')
                                                              ->default(0)
                                                              ->prefix('Rp')
                                                              ->mask(RawJs::make('$money($input, \',\', \'.\')')),
                                ])
                                ->columns(2),
                     ])
                     ->columnSpan(['lg' => 2]),
                Group::make()
                     ->schema([
                         Section::make('Status')
                                ->schema([
                                    Forms\Components\Toggle::make('is_active'),
                                ]),
                         Section::make('Relations')
                                ->schema([
                                    Forms\Components\Select::make('brand_id')
                                                           ->relationship('brand', 'name')
                                                           ->preload()
                                                           ->searchable(),
                                ]),
                     ]),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
