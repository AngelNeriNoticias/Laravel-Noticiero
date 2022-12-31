<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\Category;
use App\Models\SubCategory;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SubCategoryTable extends LivewireDatatable
{
    public $model = SubCategory::class;
    public $hideable = "select";

    public function builder()
    {
        return SubCategory::query()
            ->join('categories', 'categories.id', 'sub_categories.category_id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('sub_categories.id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::name('categories.name')
                ->label('Categoría')
                ->hideable()
                ->filterable(Category::pluck('name')),

            Column::name('sub_categories.name')
                ->label('Nombre')
                ->hideable()
                ->filterable(),

            BooleanColumn::name('sub_categories.show')
                ->label('Está activa')
                ->hideable()
                ->filterable(),

            BooleanColumn::name('sub_categories.show_menu')
                ->label('Está activo en el menú')
                ->hideable()
                ->filterable(),                

            Column::name('sub_categories.order')
                ->label('Orden de aparición')
                ->hideable()
                ->filterable(),

            DateColumn::name('sub_categories.created_at')
                ->label('Creado')
                ->hideable()
                ->filterable(),

            DateColumn::name('sub_categories.updated_at')
                ->label('Actualización')
                ->hideable()
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('table-actions.actions', [
                    'id' => $id,
                    'edit' => 'editSubCategory',
                    'delete' => 'callConfirmationSubCategory'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
