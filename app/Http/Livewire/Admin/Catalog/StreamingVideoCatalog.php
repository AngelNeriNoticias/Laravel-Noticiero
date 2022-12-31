<?php

namespace App\Http\Livewire\Admin\Catalog;

use App\Models\StreamingVideo;
use Livewire\Component;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class StreamingVideoCatalog extends Component
{
    protected $listeners = ['editStreamingVideo', 'deleteStreamingVideo', 'callConfirmationStreamingVideo'];
    public $modal = false;
    public $state = ['active' => 0];

    public function render()
    {
        return view('livewire.admin.catalog.streaming-video-catalog');
    }

    public function clean()
    {
        $this->state = ['active' => 0];
    }

    public function desactivate()
    {
        $videos = StreamingVideo::where('active', 1)->get();
        foreach ($videos as $video) {
            $video->active = 0;
            $video->save();
        }
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        if ($validateData['active'] == 1) $this->desactivate();

        StreamingVideo::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editStreamingVideo(int $id)
    {
        $this->state = ModelHelper::modelToArray(StreamingVideo::class, $id);
        $this->launchModal();
    }

    public function callConfirmationStreamingVideo($id)
    {
        $streamingVideo = ModelHelper::findModel(StreamingVideo::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $streamingVideo->title,
            'id' => $streamingVideo->id,
            'event' => 'deleteStreamingVideo'
        ]);
    }

    public function deleteStreamingVideo(int $id)
    {
        ModelHelper::delete(StreamingVideo::class, $id);
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
            'message' => "Streaming video {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'url' => 'required',
            'title' => 'required',
            'active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'url.required' => GlobalFunctions::requiredMessage('enlace'),
            'title.required' => GlobalFunctions::requiredMessage('título'),
            'active.required' => GlobalFunctions::requiredMessage('estado'),
        ];
    }
}
