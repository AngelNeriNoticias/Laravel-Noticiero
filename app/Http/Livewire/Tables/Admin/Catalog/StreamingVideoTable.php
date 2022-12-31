<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\StreamingVideo;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class StreamingVideoTable extends LivewireDatatable
{
    public $model = StreamingVideo::class;
    public $hideable = "select";

    public function builder()
    {
        return StreamingVideo::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::name('url')
                ->label('Video')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            Column::name('title')
                ->label('Título')
                ->hideable()
                ->filterable(),

            BooleanColumn::name('active')
                ->label('Estado')
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
                    'edit' => 'editStreamingVideo',
                    'delete' => 'callConfirmationStreamingVideo'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
