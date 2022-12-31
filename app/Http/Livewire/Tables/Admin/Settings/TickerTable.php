<?php

namespace App\Http\Livewire\Tables\Admin\Settings;

use App\Models\Ticker;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TickerTable extends LivewireDatatable
{
    public $model = Ticker::class;
    public $hideable = "select";

    public function builder()
    {
        return Ticker::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::name('name')
                ->label('Título del anuncio')
                ->hideable()
                ->filterable(),

            BooleanColumn::name('show')
                ->label('Está activo')
                ->hideable()
                ->filterable(),

            Column::name('order')
                ->label('Orden de aparición')
                ->hideable()
                ->filterable(),

            DateColumn::name('created_at')
                ->label('Creado')
                ->hideable()
                ->filterable(),

            DateColumn::name('updated_at')
                ->label('Actualización')
                ->hideable()
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('table-actions.actions', [
                    'id' => $id,
                    'edit' => 'editTicker',
                    'delete' => 'callConfirmationTicker'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}