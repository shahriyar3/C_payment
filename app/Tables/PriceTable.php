<?php

namespace App\Tables;

use App\Models\Price;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class PriceTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Price::class)
            ->rowActions(fn(Price $price) => [
//                new EditRowAction(route('price.edit', $price)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('id')->sortable(),
            Column::make('price')->title('Price')->sortable(),
        ];
    }

    protected function results(): array
    {
        return [
            // The table results configuration.
            // As results are optional on tables, you may delete this method if you do not use it.
        ];
    }
}
