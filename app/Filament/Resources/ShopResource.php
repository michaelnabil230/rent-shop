<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\ShopStatus;
use App\Filament\Exports\ShopExporter;
use App\Filament\Resources\ShopResource\Pages;
use App\Models\Shop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

final class ShopResource extends Resource
{
    protected static ?string $model = Shop::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code_ar')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code_en')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('water_meter_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('electricity_meter_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('electricity_activation_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('electricity_account_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('rent_due_date')
                    ->required(),
                Forms\Components\Select::make('payment_type')
                    ->options(['cheque', 'cash', 'bank'])
                    ->native(false)
                    ->required(),
                Forms\Components\DatePicker::make('contract_start_date')
                    ->required(),
                Forms\Components\DatePicker::make('contract_end_date')
                    ->required(),
                Forms\Components\TextInput::make('rent_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('contract_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tenant_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tenant_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('activity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options(ShopStatus::class)
                    ->native(false)
                    ->default('pending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')->searchable(),
                Tables\Columns\TextColumn::make('code_ar')->searchable(),
                Tables\Columns\TextColumn::make('code_en')->searchable(),
                Tables\Columns\TextColumn::make('water_meter_no')->searchable(),
                Tables\Columns\TextColumn::make('electricity_meter_no')->searchable(),
                Tables\Columns\TextColumn::make('electricity_activation_no')->searchable(),
                Tables\Columns\TextColumn::make('electricity_account_no')->searchable(),
                Tables\Columns\TextColumn::make('rent_due_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('payment_type'),
                Tables\Columns\TextColumn::make('contract_start_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('contract_end_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('rent_amount')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('contract_no')->searchable(),
                Tables\Columns\TextColumn::make('tenant_no')->searchable(),
                Tables\Columns\TextColumn::make('tenant_name')->searchable(),
                Tables\Columns\TextColumn::make('activity')->searchable(),
                Tables\Columns\TextColumn::make('status')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('View Payments')
                    ->label('View Payments')
                    ->url(fn (Shop $record) => route('filament.admin.resources.payments.index', ['shop_id' => $record->id]))
                    ->color('success'),
                Tables\Actions\Action::make('Create Payment')
                    ->label('Create Payment')
                    ->url(fn (Shop $record) => route('filament.admin.resources.payments.create', ['shop_id' => $record->id]))
                    ->color('primary'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportAction::make()->exporter(ShopExporter::class),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShops::route('/'),
            'create' => Pages\CreateShop::route('/create'),
            'edit' => Pages\EditShop::route('/{record}/edit'),
        ];
    }
}
