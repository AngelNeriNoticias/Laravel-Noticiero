<?php

namespace App\Http\Livewire\Tables\Admin\Sytem;

use App\Models\Button;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ButtonTable extends LivewireDatatable
{
    public $model = Button::class;
    public $hideable = "select";

    public function builder()
    {
        return Button::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::name('title')
                ->label('Título')
                ->hideable()
                ->filterable(),

            Column::callback(['icon'], function ($icon) {
                return view('table-actions.icon', [
                    'icon' => $icon
                ]);
            })
                ->label('Icono')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            BooleanColumn::name('show')
                ->label('¿Se muestra este botón?')
                ->hideable()
                ->filterable(),

            NumberColumn::name('order')
                ->label('Orden')
                ->hideable()
                ->filterable(),

            Column::name('url')
                ->label('Enlace')
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
                    'edit' => 'editButton',
                    'delete' => 'callConfirmationButton'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
