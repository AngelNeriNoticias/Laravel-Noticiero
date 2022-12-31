<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Faq;
use Livewire\Component;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class FaqCatalog extends Component
{
    protected $listeners = ['editFaq', 'deleteFaq', 'callConfirmationFaq'];
    public $modal = false;
    public $state = [];

    public function render()
    {
        return view('livewire.admin.page.faq-catalog');
    }
    public function clean()
    {
        $this->state = [];
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        Faq::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editFaq(int $id)
    {
        $this->state = ModelHelper::modelToArray(Faq::class, $id);
        $this->launchModal();
    }

    public function callConfirmationFaq($id)
    {
        $faq = ModelHelper::findModel(Faq::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $faq->question,
            'id' => $faq->id,
            'event' => 'deleteFaq'
        ]);
    }

    public function deleteFaq(int $id)
    {
        ModelHelper::delete(Faq::class, $id);
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
            'message' => "Pregunta {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'question' => 'required',
            'answer' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'question.required' => GlobalFunctions::requiredMessage('pregunta'),
            'answer.required' => GlobalFunctions::requiredMessage('respuesta')
        ];
    }
}
