<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\Category;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CategoryTable extends LivewireDatatable
{
    public $model = Category::class;
    public $hideable = "select";

    public function builder()
    {
        return Category::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::name('name')
                ->label('Nombre')
                ->hideable()
                ->filterable(),

            BooleanColumn::name('show')
                ->label('Está activa')
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
                    'edit' => 'editCategory',
                    'delete' => 'callConfirmationCategory'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}