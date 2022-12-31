<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\HomeAdvertisement;
use App\Constants\AdvertisementConstant;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class AdvertisementTable extends LivewireDatatable
{
    public $model = HomeAdvertisement::class;
    public $hideable = "select";

    public function builder()
    {
        return HomeAdvertisement::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::name('ad')
                ->label('Nombre')
                ->hideable()
                ->filterable(),

            Column::callback(['ad'], function ($ad) {
                return view('table-actions.image', [
                    'photo' => 'storage/ads/' . $ad,
                    'name' => $ad
                ]);
            })
                ->label('Vista Imagen')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            Column::name('url')
                ->label('Enlace')
                ->hideable()
                ->editable()
                ->filterable(),

            Column::callback(['typeId'], function ($typeId) {
                return AdvertisementConstant::$ADVERTISE_POSITIONS[$typeId];
            })
                ->label('Tipo de anuncio')
                ->hideable(),

            BooleanColumn::name("status")
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
                    'edit' => 'editAdvertisement',
                    'delete' => 'callConfirmationAdvertisement'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
