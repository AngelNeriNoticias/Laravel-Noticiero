<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
use Livewire\Component;
use App\Helpers\ModelHelper;
use App\Constants\PagesConstant;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class PageCatalog extends Component
{
    protected $listeners = ['editPage', 'deletePage', 'callConfirmationPage', 'addTag', 'removeTag'];
    public $modal = false;
    public $state = ['page_id' => ''];
    public $pages = [];

    public function render()
    {
        return view('livewire.admin.page.page-catalog');
    }

    public function mount()
    {
        $this->pages = PagesConstant::$pages;
    }

    public function clean()
    {
        $this->state = ['page_id' => ''];
        $this->dispatchBrowserEvent('clearBody');
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        Page::updateOrCreate(['id' => $idValidator], $validateData);

        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editPage(int $id)
    {
        $this->state = ModelHelper::modelToArray(Page::class, $id);
        $this->dispatchBrowserEvent('setBody', [
            'key' => 'content',
            "body" => $this->state['content']
        ]);
        $this->launchModal();
    }

    public function callConfirmationPage($id)
    {
        $page = ModelHelper::findModel(Page::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $page->title,
            'id' => $page->id,
            'event' => 'deletePage'
        ]);
    }

    public function deletePage(int $id)
    {
        ModelHelper::delete(Page::class, $id);
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
            'message' => "Página {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'page_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => GlobalFunctions::requiredMessage('título'),
            'content.required' => GlobalFunctions::requiredMessage('contenido'),
            'page_id.required' => GlobalFunctions::requiredMessage('página')
        ];
    }
}
