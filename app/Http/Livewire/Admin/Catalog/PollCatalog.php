<?php

namespace App\Http\Livewire\Admin\Catalog;

use App\Models\Poll;
use App\Models\Answer;
use Livewire\Component;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class PollCatalog extends Component
{
    protected $listeners = ['editPoll', 'deletePoll', 'callConfirmationPoll', 'addAnswer', 'removeAnswer'];
    public $modal = false;
    public $state = ['name' => '', 'active' => 0];
    public $answers = [];

    public function render()
    {
        return view('livewire.admin.catalog.poll-catalog');
    }

    public function addAnswer($value)
    {
        $idValidator = array_key_exists($value, $this->answers);
        if (!$idValidator) $this->answers[$value] = $value;
    }

    public function removeAnswer($value)
    {
        unset($this->answers[$value]);
    }

    public function disablePolls(){
        $polls = Poll::all();
        foreach ($polls as $poll) {
            $poll->active = 0;
            $poll->save();
        }
    }

    public function clean()
    {
        $this->state = ['name' => '','active' => 0];
        $this->dispatchBrowserEvent('clearSelect2', [
            'id' => "answers"
        ]);
        $this->answers = [];
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        if($this->state['active'] == 1) $this->disablePolls();

        $poll = Poll::updateOrCreate(['id' => $idValidator], $validateData);

        foreach ($this->answers as $answer) {
            Answer::updateOrCreate(['poll_id' => $poll->id, 'name' => $answer]);
        }

        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editPoll(int $id)
    {
        $this->state = ModelHelper::modelToArray(Poll::class, $id);
        $answers = Answer::where('poll_id', $id)->get();
        foreach ($answers as $answer) {
            $this->answers[$answer->name] = $answer->name;
        }
        $this->launchModal();
    }

    public function callConfirmationPoll($id)
    {
        $poll = ModelHelper::findModel(Poll::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $poll->name,
            'id' => $poll->id,
            'event' => 'deletePoll'
        ]);
    }

    public function deletePoll(int $id)
    {
        ModelHelper::delete(Poll::class, $id);
        $this->sendMessage('eliminada');
    }

    public function launchModal()
    {
        $this->modal = !$this->modal;
        if ($this->modal == false) $this->clean();
        $this->dispatchBrowserEvent('openModal', ['modal' => $this->modal]);
    }

    public function sendMessage(string $message)
    {
        $this->dispatchBrowserEvent('message', [
            'message' => "Encuesta {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => GlobalFunctions::requiredMessage('encuesta'),
            'active.required' => GlobalFunctions::requiredMessage('estado'),
        ];
    }
}
