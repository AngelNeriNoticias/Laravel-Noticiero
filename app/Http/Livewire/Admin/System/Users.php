<?php

namespace App\Http\Livewire\Admin\System;

use Livewire\Component;
use App\Models\User;
use App\Helpers\ModelHelper;
use App\Helpers\GlobalFunctions;
use Illuminate\Support\Facades\Validator;

class Users extends Component
{
    protected $listeners = ['editUser', 'deleteUser', 'callConfirmationUser'];
    public $modal = false;
    public $state = ['role' => 0];

    public function render()
    {
        return view('livewire.admin.system.users');
    }

    public function clean()
    {
        $this->state = ['role' => 0];
    }

    public function save()
    {
        $idValidator = array_key_exists('id', $this->state) ? $this->state['id'] : '';

        $validateData = Validator::make(
            $this->state,
            $this->rules(),
            $this->messages()
        )->validate();

        $validateData['password'] = bcrypt($validateData['password']);

        User::updateOrCreate(['id' => $idValidator], $validateData);
        $this->launchModal();
        $this->sendMessage($idValidator ? 'actualizado' : 'creado');
        $this->clean();
    }

    public function editUser(int $id)
    {
        $this->state = ModelHelper::modelToArray(User::class, $id);
        $this->launchModal();
    }

    public function callConfirmationUser($id)
    {
        $user = ModelHelper::findModel(User::class, $id);
        $this->dispatchBrowserEvent('confirmation', [
            'name' => $user->name,
            'id' => $user->id,
            'event' => 'deleteUser'
        ]);
    }

    public function deleteUser(int $id)
    {
        ModelHelper::delete(User::class, $id);
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
            'message' => "Usuario {$message} correctamente",
            'type' => 'success'
        ]);

        $this->emit('refreshLivewireDatatable');
        $this->state = [];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => GlobalFunctions::requiredMessage('name'),
            'email.required' => GlobalFunctions::requiredMessage('correo'),
            'role.required' => GlobalFunctions::requiredMessage('tipo usuario'),
            'password.required' => GlobalFunctions::requiredMessage('contraseña')
        ];
    }
}
