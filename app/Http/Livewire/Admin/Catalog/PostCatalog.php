<?php

namespace App\Http\Livewire\Admin\Catalog;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\TagPost;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use App\Helpers\ModelHelper;
use Livewire\WithFileUploads;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostCatalog extends Component
{
    use WithFileUploads;
    protected $listeners = ['editPost', 'deletePost', 'callConfirmationPost', 'addTag', 'removeTag'];
    public $modal = false;
    public $state = ['category_id' => '', 'sub_category_id' => '', 'share' => 0];
    public $categories = [];
    public $subcategories = [];
    public $image;
    public $tagsSelected = [];
    public $tags = [];
    public $tab;

    public function render()
    {
        return view('livewire.admin.catalog.post-catalog');
    }

    public function mount()
    {
        $this->tab = 'pills-table';
        $this->tags = Tag::all();
        $this->categories = Category::all();
    }

    public function updateTab($tab) {
        $this->tab = $tab;
    }

    public function addTag($value)
    {
        $idValidator = array_key_exists($value, $this->tagsSelected);
        if (!$idValidator) $this->tagsSelected[$value] = $value;
    }

    public function removeTag($value)
    {
        unset($this->tagsSelected[$value]);
    }

    public function validateImage()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';
        $this->validate([
            'image' => $idValidator ? 'max:1024' : 'required|max:1024',
        ], [
            'image.required' => 'La imagen es requerida.',
            'image.max' => 'La imagen no puede exceder más de 1024 kilobytes.',
        ]);

        if ($idValidator) {
            if ($this->image != null) {
                $destinationPath = public_path();
                File::delete($destinationPath . '/storage/posts/' . $this->state['photo']);
                $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
                $this->image->storeAs('posts', $imageName);
                $this->state['photo'] = $imageName;
            }
            return;
        }

        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('posts', $imageName);
        $this->state['photo'] = $imageName;
    }

    public function getSubCategory()
    {
        $this->subcategories = SubCategory::where('category_id', $this->state['category_id'])->get();
    }

    public function clean()
    {
        $this->state = ['category_id' => '', 'sub_category_id' => '', 'body' => '', 'share' => 0];
        $this->categories = Category::all();
        $this->dispatchBrowserEvent('clearBody');
        $this->image = null;
        $this->dispatchBrowserEvent('clearSelect2', [
            'id' => "tagsSelected"
        ]);
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        $this->validateImage();

        $validateData['photo'] = $this->state['photo'];
        $validateData['user_id'] = Auth::user()->id;
        $validateData['share'] = $this->state['share'];

        $post = Post::updateOrCreate(['id' => $idValidator], $validateData);

        foreach ($this->tagsSelected as $tag) {
            TagPost::updateOrCreate(['post_id' => $post->id, 'tag_id' => $tag]);
        }

        $this->tab = 'pills-table';
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
        
        return redirect()->route('admin.post');
    }

    public function editPost(int $id)
    {
        $this->state = ModelHelper::modelToArray(Post::class, $id);
        $subCategory = SubCategory::find($this->state['sub_category_id']);
        $this->state['category_id'] = $subCategory->category_id;
        $this->getSubCategory();
        $this->dispatchBrowserEvent('setBody', [
            'key' => 'body',
            "body" => $this->state['body']
        ]);
        $this->tab = 'pills-post';
        // $this->launchModal();
    }

    public function callConfirmationPost($id)
    {
        $post = ModelHelper::findModel(Post::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $post->title,
            'id' => $post->id,
            'event' => 'deletePost'
        ]);
    }

    public function deletePost(int $id)
    {
        ModelHelper::delete(Post::class, $id);
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
            'message' => "Noticia {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'sub_category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => GlobalFunctions::requiredMessage('título'),
            'body.required' => GlobalFunctions::requiredMessage('nota'),
            'sub_category_id.required' => GlobalFunctions::requiredMessage('sub categoría')
        ];
    }
}
