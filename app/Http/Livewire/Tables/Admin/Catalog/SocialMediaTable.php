<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\SocialMedia;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SocialMediaTable extends LivewireDatatable
{
    public $model = SocialMedia::class;
    public $hideable = "select";

    public function builder()
    {
        return SocialMedia::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::callback(['icon'], function ($icon) {
                return view('table-actions.icon', [
                    'icon' => $icon
                ]);
            })
                ->label('Icono')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            Column::name('title')
                ->label('Título')
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
                    'edit' => 'editSocialMedia',
                    'delete' => 'callConfirmationSocialMedia'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
