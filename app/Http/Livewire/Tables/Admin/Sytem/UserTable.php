<?php

namespace App\Http\Livewire\Tables\Admin\Sytem;

use App\Models\User;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserTable extends LivewireDatatable
{
    public $model = User::class;
    public $hideable = "select";

    public function builder()
    {
        return User::query();
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

            Column::name('email')
                ->label('Correo Electrónico')
                ->hideable()
                ->filterable(),

            Column::callback(['role'], function ($role) {
                $value = $role == 1 ? 'Administrador' : 'Reportero';
                return $value;
            })
                ->label('Rol')
                ->unsortable()
                ->hideable()
                ->filterable([
                    1=>'Administrador',
                    0=>'Reportero'
                ])
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
                if ($id != 1) {
                    return view('table-actions.actions', [
                        'id' => $id,
                        'edit' => 'editUser',
                        'delete' => 'callConfirmationUser'
                    ]);
                }
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
