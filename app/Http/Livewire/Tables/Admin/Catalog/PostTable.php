<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PostTable extends LivewireDatatable
{
    public $model = Post::class;
    public $hideable = "select";

    public function builder()
    {
        return Post::query()
            ->join('sub_categories', 'sub_categories.id', 'posts.sub_category_id')
            ->join('users', 'users.id', 'posts.user_id')
            ->join('categories', 'categories.id', 'sub_categories.category_id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('posts.id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::name('categories.name')
                ->label('Categoría')
                ->hideable()
                ->filterable(Category::pluck('name')),

            Column::name('sub_categories.name')
                ->label('Sub categoría')
                ->hideable()
                ->filterable(SubCategory::pluck('name')),

            Column::name('users.name')
                ->label('Autor')
                ->hideable()
                ->filterable(),

            Column::callback(['photo'], function ($photo) {
                return view('table-actions.image', [
                    'photo' => 'storage/posts/' . $photo,
                    'name'=> $photo
                ]);
            })
                ->label('Vista Imagen')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            Column::name('posts.title')
                ->label('Título')
                ->hideable()
                ->filterable(),

            Column::callback(['posts.body'], function ($body) {
                return view('table-actions.post', [
                    'body' => $body
                ]);
            })
                ->label('Nota')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),

            NumberColumn::name('posts.visitors')
                ->label('Visitas')
                ->hideable()
                ->filterable(),

            // BooleanColumn::name('posts.share')
            //     ->label('Compartir')
            //     ->hideable()
            //     ->filterable(),

            DateColumn::name('posts.created_at')
                ->label('Creado')
                ->hideable()
                ->filterable(),

            DateColumn::name('posts.updated_at')
                ->label('Actualización')
                ->hideable()
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('table-actions.actions', [
                    'id' => $id,
                    'edit' => 'editPost',
                    'delete' => 'callConfirmationPost'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
