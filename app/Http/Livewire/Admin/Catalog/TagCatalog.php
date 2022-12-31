<?php

namespace App\Http\Livewire\Admin\Catalog;

use App\Models\Tag;
use Livewire\Component;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class TagCatalog extends Component
{
    protected $listeners = ['editTag', 'deleteTag', 'callConfirmationTag'];
    public $modal = false;
    public $state = [];

    public function render()
    {
        return view('livewire.admin.catalog.tag-catalog');
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
        
        $validateData['name'] = mb_strtoupper($validateData['name'], 'UTF-8');

        Tag::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editTag(int $id)
    {
        $this->state = ModelHelper::modelToArray(Tag::class, $id);
        $this->launchModal();
    }

    public function callConfirmationTag($id)
    {
        $tag = ModelHelper::findModel(Tag::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $tag->name,
            'id' => $tag->id,
            'event' => 'deleteTag'
        ]);
    }

    public function deleteTag(int $id)
    {
        ModelHelper::delete(Tag::class, $id);
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
            'message' => "Etiqueta {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => GlobalFunctions::requiredMessage('nombre')
        ];
    }
}
