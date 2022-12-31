<?php

namespace App\Http\Livewire\Tables\Admin\Catalog;

use App\Models\Poll;
use App\Models\Answer;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PollTable extends LivewireDatatable
{
    public $model = Poll::class;
    public $hideable = "select";

    public function builder()
    {
        return Poll::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->hideable()
                ->defaultSort('asc'),

            Column::name('name')
                ->label('Pregunta')
                ->hideable()
                ->filterable(),

            BooleanColumn::name('active')
                ->label('Está activa')
                ->hideable()
                ->filterable(),

            Column::callback('id', function ($id) {
                $answers = Answer::where('poll_id', $id)->get();
                $answersText = "";
                foreach ($answers as $answer) {
                    $answersText .= "*" . $answer->name . "\n";
                }
                return $answersText;
            })
                ->label('Respuestas')
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
                    'edit' => 'editPoll',
                    'delete' => 'callConfirmationPoll'
                ]);
            })
                ->label('Acciones')
                ->unsortable()
                ->hideable()
                ->excludeFromExport(),
        ];
    }
}
