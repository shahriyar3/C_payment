<?php

namespace App\Tables;

use App\Models\Payment;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class PaymentsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Payment::class);
//            ->rowActions(fn(Payment $payment) => [
//                new EditRowAction(route('upcadmin.payments.edit', $payment)),
//                new DestroyRowAction(),
//            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->sortable(),
//            Column::make('user_id')->searchable()->sortable(),
//            Column::make('user_name')->searchable()->sortable(),
//            Column::make('token')->searchable()->sortable(),
//            Column::make('amount')->searchable()->sortable(),
//            Column::make('payment_id')->searchable()->sortable(),
//            Column::make('transaction_id')->searchable()->sortable(),
//            Column::make('status')->searchable()->sortable(),
//            Column::make('user_ip')->title('ip')->searchable()->sortable(),
//            Column::make('user_agent')->title('agent')->searchable()->sortable(),
            Column::make('created_at')->format(new DateFormatter('d/m/Y H:i', 'Asia/Tehran'))->sortable(),
            Column::make('updated_at')->format(new DateFormatter('d/m/Y H:i', 'Asia/Tehran'))->sortable()->sortByDefault('desc'),
        ];
    }

//    protected function results(): array
//    {
//        return [
            // The table results configuration.
            // As results are optional on tables, you may delete this method if you do not use it.
//        ];
//    }
}
