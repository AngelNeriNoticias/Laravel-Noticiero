<?php

namespace App\Http\Livewire\Tables\Admin\Pages;

use App\Models\Page;
use App\Constants\PagesConstant;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PageTable extends LivewireDatatable
{
    public $model = Post::class;
    public $hideable = "select";

    public function builder()
    {
        return Page::query();
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

            Column::callback(['page_id'], function ($page_id) {
                return PagesConstant::$pages[$page_id];
            })
                ->label('Tipo de página')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            Column::callback(['content'], function ($content) {
                return view('table-actions.post', [
                    'body' => $content
                ]);
            })
                ->label('Contenido')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),


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
                    'edit' => 'editPage',
                    'delete' => 'callConfirmationPage'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
