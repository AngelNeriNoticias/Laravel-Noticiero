<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\Show;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ShowTable extends LivewireDatatable
{
    public $model = Show::class;
    public $hideable = "select";

    public function builder()
    {
        return Show::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::callback(['type_id'], function ($type_id) {
                $value = $type_id == 1 ? 'Imagen' : 'Facebook';
                return $value;
            })
                ->label('Tipo anuncio')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            // Column::callback(['photo'], function ($photo) {
            //     if($photo === null) return 'No hay imagen';
                
            //     return view('table-actions.image', [
            //         'photo' => 'storage/gallery/' . $photo,
            //         'name' => $photo
            //     ]);
            // })
            //     ->label('Vista Imagen')
            //     ->unsortable()
            //     ->hideable()
            //     ->excludeFromExport(),

            Column::name('url')
                ->label('Enlace')
                ->hideable()
                ->editable()
                ->filterable(),

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
                    'edit' => 'editShow',
                    'delete' => 'callConfirmationShow'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}