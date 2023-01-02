<?php

namespace App\Http\Livewire\Admin\Catalog;

use Carbon\Carbon;
use App\Models\Photo;
use Livewire\Component;
use App\Helpers\ModelHelper;
use Livewire\WithFileUploads;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PhotoCatalog extends Component
{
    use WithFileUploads;
    protected $listeners = ['editPhoto', 'deletePhoto', 'callConfirmationPhoto'];
    public $modal = false;
    public $state = [];
    public $image;

    public function render()
    {
        return view('livewire.admin.catalog.photo-catalog');
    }

    public function validateImage()
    {
        $this->validate([
            'image' => 'max:1024',
        ]);
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';
        if ($idValidator) {
            if ($this->image != null) {
                $destinationPath = public_path();
                File::delete($destinationPath . '/storage/gallery/' . $this->state['photo']);
                $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
                $this->image->storeAs('gallery', $imageName);
                $this->state['photo'] = $imageName;
            }
            return;
        }
      
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('gallery', $imageName);
        $this->state['photo'] = $imageName;

    }

    public function clean(){
        $this->state = [];
        $this->image = null;
    }

    public function save()
    {
        $this->validateImage();
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();
        
        Photo::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editPhoto(int $id)
    {
        $this->state = ModelHelper::modelToArray(Photo::class, $id);
        $this->launchModal();
    }

    public function callConfirmationPhoto($id)
    {
        $photo = ModelHelper::findModel(Photo::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $photo->caption,
            'id' => $photo->id,
            'event' => 'deletePhoto'
        ]);
    }

    public function deletePhoto(int $id)
    {
        $photo = ModelHelper::findModel(Photo::class, $id);
        $destinationPath = public_path();
        File::delete($destinationPath . '/storage/gallery/' . $photo->photo);
        $photo->delete();
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
            'message' => "Foto {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'caption' => 'required',
            'photo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'caption.required' => GlobalFunctions::requiredMessage('subtítulo'),
            'photo.required' => GlobalFunctions::requiredMessage('foto'),
        ];
    }
}
