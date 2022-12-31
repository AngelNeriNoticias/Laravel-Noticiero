<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\Photo;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PhotoTable extends LivewireDatatable
{
    public $model = Photo::class;
    public $hideable = "select";

    public function builder()
    {
        return Photo::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::callback(['photo'], function ($photo) {
                return view('table-actions.image', [
                    'photo' => 'storage/gallery/' . $photo,
                    'name' => $photo
                ]);
            })
                ->label('Vista Imagen')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            Column::name('caption')
                ->label('Subtítulo')
                ->hideable()
                ->editable()
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
                    'edit' => 'editPhoto',
                    'delete' => 'callConfirmationPhoto'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}