<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Exports\PaymentExporter;
use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('shop_id')
                    ->label('Shop')
                    ->native(false)
                    ->relationship('shop', 'no')
                    ->default(request()->query('shop_id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('reference_number')->required()->maxLength(255),
                Forms\Components\TextInput::make('amount')->required()->numeric(),
                Forms\Components\DatePicker::make('date')
                    ->native(false)
                    ->placeholder('Y-m-d')
                    ->required(),
                Forms\Components\Textarea::make('notes')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shop.no')->sortable(),
                Tables\Columns\TextColumn::make('reference_number')->searchable(),
                Tables\Columns\TextColumn::make('amount')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('date')->date()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->native(false)
                            ->placeholder('Y-m-d')
                            ->date(),
                        Forms\Components\DatePicker::make('date_to')
                            ->native(false)
                            ->placeholder('Y-m-d')
                            ->date(),
                    ])
                    ->query(function (Builder $builder, array $data): Builder {
                        return $builder->when(
                            count(array_filter($data)) === 2,
                            fn (Builder $builder): Builder => $builder->whereBetween('date', [$data['date_from'], $data['date_to']]),
                        );
                    }),

                Tables\Filters\SelectFilter::make('shop_id')
                    ->label('Shop')
                    ->native(false)
                    ->relationship('shop', 'no')
                    ->default(request()->query('shop_id'))
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportAction::make()->exporter(PaymentExporter::class),
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
