<?php

namespace App\Http\Livewire\Admin\Catalog;

use Carbon\Carbon;
use App\Models\Show;
use Livewire\Component;
use App\Helpers\ModelHelper;
use Livewire\WithFileUploads;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ShowCatalog extends Component
{
    use WithFileUploads;
    protected $listeners = ['editShow', 'deleteShow', 'callConfirmationShow'];
    public $modal = false;
    public $state = ['type_id' => ''];
    public $image;

    public function render()
    {
        return view('livewire.admin.catalog.show-catalog');
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
                File::delete($destinationPath . '/storage/advice/' . $this->state['photo']);
                $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
                $this->image->storeAs('advice', $imageName);
                $this->state['photo'] = $imageName;
            }
            return;
        }

        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('advice', $imageName);
        $this->state['photo'] = $imageName;
    }

    public function clean()
    {
        $this->state = ['type_id' => ''];
        $this->image = null;
    }

    public function save()
    {
        if($this->image != null && $this->state['type_id'] == 1){
            $this->validateImage();
        }
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();
    
        Show::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
        return route('admin.show');
    }

    public function editShow(int $id)
    {
        $this->state = ModelHelper::modelToArray(Show::class, $id);
        $this->launchModal();
    }

    public function callConfirmationShow($id)
    {
        $show = ModelHelper::findModel(Show::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $show->caption,
            'id' => $show->id,
            'event' => 'deleteShow'
        ]);
    }

    public function deleteShow(int $id)
    {
        ModelHelper::delete(Show::class, $id);
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
            'message' => "Anuncio {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'caption' => 'required',
            'photo' => $this->state['type_id'] == 1 ? 'required' : '',
            'url' => 'required',
            'type_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'caption.required' => GlobalFunctions::requiredMessage('subtítulo'),
            'photo.required' => GlobalFunctions::requiredMessage('foto'),
            'url.required' => GlobalFunctions::requiredMessage('enlace'),
            'type_id.required' => GlobalFunctions::requiredMessage('tipo de anuncio'),
        ];
    } 
}
