<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\Video;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class VideoTable extends LivewireDatatable
{
    public $model = Video::class;
    public $hideable = "select";

    public function builder()
    {
        return Video::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::callback(['video'], function ($video) {
                return view('table-actions.video-preview', [
                    'video' => $video,
                ]);
            })
                ->label('Video')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            Column::name('caption')
                ->label('Subtítulo')
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
                    'edit' => 'editVideo',
                    'delete' => 'callConfirmationVideo'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
