<?php

namespace App\Http\Livewire\Admin\Catalog;

use Carbon\Carbon;
use Livewire\Component;
use App\Helpers\ModelHelper;
use Livewire\WithFileUploads;
use App\Helpers\GlobalFunctions;
use App\Models\HomeAdvertisement;
use Illuminate\Support\Facades\File;
use App\Constants\AdvertisementConstant;
use Illuminate\Support\Facades\Validator;

class AdvertisementCatalog extends Component
{
    use WithFileUploads;
    protected $listeners = ['editAdvertisement', 'deleteAdvertisement', 'callConfirmationAdvertisement'];
    public $modal = false;
    public $state = ['typeId' => '', 'status' => 0];
    public $image;
    public $advertisements = [];

    public function render()
    {
        return view('livewire.admin.catalog.advertisement-catalog');
    }

    public function mount()
    {
        $this->advertisements = AdvertisementConstant::$ADVERTISE_POSITIONS;
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
                File::delete($destinationPath . '/storage/ads/' . $this->state['ad']);
                $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
                $this->image->storeAs('ads', $imageName);
                $this->state['ad'] = $imageName;
            }
            return;
        }

        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('ads', $imageName);
        $this->state['ad'] = $imageName;
    }

    public function disableAllAds()
    {
        $ads = HomeAdvertisement::where('typeId', $this->state['typeId'])->get();
        foreach ($ads as $ad) {
            $ad->status = 0;
            $ad->save();
        }
    }

    public function clean()
    {
        $this->state = ['typeId' => '', 'status' => 0];
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

        if ($this->state['status'] == 1) {
            $ads = HomeAdvertisement::where([
                ['typeId', $this->state['typeId']],
                ['status', true]
            ])->get();
            if ($this->state['typeId'] == 1 || $this->state['typeId'] == 2) {
                if (count($ads) > 1) {
                    $this->dispatchBrowserEvent('message', [
                        'message' => "Ya existen anuncios activos, por favor desactiva un anuncio para poder activar este",
                        'type' => 'error'
                    ]);
                    return;
                }
            } else {
                if (count($ads) > 0) {
                    $this->dispatchBrowserEvent('message', [
                        'message' => "Ya existe un anuncio activo para esta posición, por favor desactiva el anuncio actual para poder activar este",
                        'type' => 'error'
                    ]);
                    return;
                }
            }
        }

        HomeAdvertisement::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editAdvertisement(int $id)
    {
        $this->state = ModelHelper::modelToArray(HomeAdvertisement::class, $id);
        $this->launchModal();
    }

    public function callConfirmationAdvertisement($id)
    {
        $ad = ModelHelper::findModel(HomeAdvertisement::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $ad->ad,
            'id' => $ad->id,
            'event' => 'deleteAdvertisement'
        ]);
    }

    public function deleteAdvertisement(int $id)
    {
        ModelHelper::delete(HomeAdvertisement::class, $id);
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
            'ad' => 'required',
            'url' => '',
            'typeId' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ad.required' => GlobalFunctions::requiredMessage('image'),
            'typeId.required' => GlobalFunctions::requiredMessage('tipo de anuncio'),
            'status.required' => GlobalFunctions::requiredMessage('estado')
        ];
    }
}
