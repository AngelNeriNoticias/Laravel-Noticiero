<?php

namespace App\Http\Livewire\Admin\Catalog;

use Livewire\Component;
use App\Models\SocialMedia;
use App\Constants\SocialMediaConstant;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class SocialMediaCatalog extends Component
{
    protected $listeners = ['editSocialMedia', 'deleteSocialMedia', 'callConfirmationSocialMedia'];
    public $modal = false;
    public $state = ['icon' => ''];
    public $icons = [];

    public function render()
    {
        return view('livewire.admin.catalog.social-media-catalog');
    }

    public function mount()
    {
        $this->icons = SocialMediaConstant::$LOGOS;
    }

    public function clean()
    {
        $this->state = ['icon' => ''];
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        SocialMedia::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editSocialMedia(int $id)
    {
        $this->state = ModelHelper::modelToArray(SocialMedia::class, $id);
        $this->launchModal();
    }

    public function callConfirmationSocialMedia($id)
    {
        $socialMedia = ModelHelper::findModel(SocialMedia::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $socialMedia->title,
            'id' => $socialMedia->id,
            'event' => 'deleteSocialMedia'
        ]);
    }

    public function deleteSocialMedia(int $id)
    {
        ModelHelper::delete(SocialMedia::class, $id);
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
            'message' => "Red social {$message} correctamente",
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
            'url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'icon.required' => GlobalFunctions::requiredMessage('icono'),
            'title.required' => GlobalFunctions::requiredMessage('título'),
            'url.required' => GlobalFunctions::requiredMessage('enlace')
        ];
    }
}
