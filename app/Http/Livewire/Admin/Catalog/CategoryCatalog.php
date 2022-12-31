<?php

namespace App\Http\Livewire\Admin\Catalog;

use App\Models\Category;
use Livewire\Component;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class CategoryCatalog extends Component
{
    protected $listeners = ['editCategory', 'deleteCategory', 'callConfirmationCategory'];
    public $modal = false;
    public $state = ['show' => 0];

    public function render()
    {
        return view('livewire.admin.catalog.category-catalog');
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
        
        $validateData['name'] = mb_strtoupper($validateData['name'], 'UTF-8');

        Category::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editCategory(int $id)
    {
        $this->state = ModelHelper::modelToArray(Category::class, $id);
        $this->launchModal();
    }

    public function callConfirmationCategory($id)
    {
        $category = ModelHelper::findModel(Category::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $category->name,
            'id' => $category->id,
            'event' => 'deleteCategory'
        ]);
    }

    public function deleteCategory(int $id)
    {
        ModelHelper::delete(Category::class, $id);
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
            'message' => "Categoría {$message} correctamente",
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
