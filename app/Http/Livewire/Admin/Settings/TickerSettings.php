<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Ticker;
use Livewire\Component;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class TickerSettings extends Component
{
    protected $listeners = ['editTicker', 'deleteTicker', 'callConfirmationTicker'];
    public $modal = false;
    public $state = ['show' => 0];

    public function render()
    {
        return view('livewire.admin.settings.ticker-settings');
    }

    public function clean()
    {
        $this->state = ['show' => 0];
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        Ticker::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editTicker(int $id)
    {
        $this->state = ModelHelper::modelToArray(Ticker::class, $id);
        $this->launchModal();
    }

    public function callConfirmationTicker($id)
    {
        $ticker = ModelHelper::findModel(Ticker::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $ticker->name,
            'id' => $ticker->id,
            'event' => 'deleteTicker'
        ]);
    }

    public function deleteTicker(int $id)
    {
        ModelHelper::delete(Ticker::class, $id);
        $this->sendMessage('eliminado');
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
            'message' => "Mensaje anuncio {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'order' => 'required',
            'show' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => GlobalFunctions::requiredMessage('nombre'),
            'order.required' => GlobalFunctions::requiredMessage('orden de aparición'),
            'show.required' => GlobalFunctions::requiredMessage('estado de mostrar')
        ];
    }
}
