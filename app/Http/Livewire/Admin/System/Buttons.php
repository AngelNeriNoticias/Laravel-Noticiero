<?php

namespace App\Http\Livewire\Admin\System;

use Livewire\Component;
use App\Models\Button;
use App\Constants\SocialMediaConstant;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class Buttons extends Component
{
    protected $listeners = ['editButton', 'deleteButton', 'callConfirmationButton'];
    public $modal = false;
    public $state = ['icon' => '', 'show' => 0];
    public $icons = [];

    public function render()
    {
        return view('livewire.admin.system.buttons');
    }

    public function mount()
    {
        $this->icons = SocialMediaConstant::$MEDIA_ICONS;
    }

    public function clean()
    {
        $this->state = ['icon' => '', 'show' => 0];
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        Button::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editButton(int $id)
    {
        $this->state = ModelHelper::modelToArray(Button::class, $id);
        $this->launchModal();
    }

    public function callConfirmationButton($id)
    {
        $button = ModelHelper::findModel(Button::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $button->title,
            'id' => $button->id,
            'event' => 'deleteButton'
        ]);
    }

    public function deleteButton(int $id)
    {
        ModelHelper::delete(Button::class, $id);
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
            'message' => "Botón {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'icon' => 'required',
            'title' => 'required',
            'show' => 'required',
            'url' => 'required',
            'order' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'icon.required' => GlobalFunctions::requiredMessage('icono'),
            'title.required' => GlobalFunctions::requiredMessage('título'),
            'show.required' => GlobalFunctions::requiredMessage('mostrar'),
            'url.required' => GlobalFunctions::requiredMessage('enlace'),
            'order.required' => GlobalFunctions::requiredMessage('orden')
        ];
    }
}
