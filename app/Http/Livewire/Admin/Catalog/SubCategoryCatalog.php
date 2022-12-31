<?php

namespace App\Http\Livewire\Admin\Catalog;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class SubCategoryCatalog extends Component
{
    protected $listeners = ['editSubCategory', 'deleteSubCategory', 'callConfirmationSubCategory'];
    public $modal = false;
    public $state = ['show' => 0, 'show_menu' => 0, 'category_id' => ''];
    public $categories = [];

    public function render()
    {
        return view('livewire.admin.catalog.sub-category-catalog');
    }

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function clean()
    {
        $this->state = ['show' => 0, 'show_menu' => 0, 'category_id' => ''];
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        if ($validateData['show_menu'] == true) {
            $subcategoriesActive = SubCategory::where('show_menu', true)->get()->count();

            if ($subcategoriesActive >= 4) {
                $this->dispatchBrowserEvent('message', [
                    'message' => "Solo se pueden mostrar 4 subcategorías en el menú, por favor desactiva alguna",
                    'type' => 'error'
                ]);
                return;
            }
        }

        $validateData['name'] = mb_strtoupper($validateData['name'], 'UTF-8');

        SubCategory::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editSubCategory(int $id)
    {
        $this->state = ModelHelper::modelToArray(SubCategory::class, $id);
        $this->launchModal();
    }

    public function callConfirmationSubCategory($id)
    {
        $subCategory = ModelHelper::findModel(SubCategory::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $subCategory->name,
            'id' => $subCategory->id,
            'event' => 'deleteSubCategory'
        ]);
    }

    public function deleteSubCategory(int $id)
    {
        ModelHelper::delete(SubCategory::class, $id);
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
            'message' => "Sub categoría {$message} correctamente",
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
            'category_id' => 'required',
            'show' => 'required',
            'show_menu' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => GlobalFunctions::requiredMessage('nombre'),
            'order.required' => GlobalFunctions::requiredMessage('orden de aparición'),
            'category_id.required' => GlobalFunctions::requiredMessage('categoría'),
            'show.required' => GlobalFunctions::requiredMessage('estado de mostrar'),
            'show_menu.required' => GlobalFunctions::requiredMessage('estado de mostrar en menú')
        ];
    }
}
