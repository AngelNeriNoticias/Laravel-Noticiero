<?php

namespace App\Http\Livewire\Admin\Catalog;

use App\Models\Video;
use Livewire\Component;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class VideoCatalog extends Component
{
    protected $listeners = ['editVideo', 'deleteVideo', 'callConfirmationVideo'];
    public $modal = false;
    public $state = [];

    public function render()
    {
        return view('livewire.admin.catalog.video-catalog');
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

        Video::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editVideo(int $id)
    {
        $this->state = ModelHelper::modelToArray(Video::class, $id);
        $this->launchModal();
    }

    public function callConfirmationVideo($id)
    {
        $video = ModelHelper::findModel(Video::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $video->name,
            'id' => $video->id,
            'event' => 'deleteVideo'
        ]);
    }

    public function deleteVideo(int $id)
    {
        ModelHelper::delete(Video::class, $id);
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
            'message' => "Video {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'video' => 'required',
            'caption' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => GlobalFunctions::requiredMessage('id del video'),
            'caption.required' => GlobalFunctions::requiredMessage('subtítulo')
        ];
    }
}
