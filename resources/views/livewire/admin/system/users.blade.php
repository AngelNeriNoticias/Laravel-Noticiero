<div>
    <x-slot name="title">
        Usuarios
    </x-slot>

    <x-slot name="header">
        Administrar usuarios
    </x-slot>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn bg-gradient-success mb-4" wire:click="launchModal">
                    Agregar nuevo usuario
                </button>
            </div>

            <div class="pb-4">
                <livewire:tables.admin.sytem.user-table />
            </div>

            <!-- Modal -->
            <div class="modal fade @if($modal)show @endif" tabindex="-1" role="dialog" aria-hidden="true"
                style="@if($modal)display: block; padding-right: 16px; @else display: none; @endif ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ isset($state['id']) ? 'Editar' : 'Guardar' }} Usuario
                            </h5>
                            <button type="button" class="close" wire:click="launchModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="name" wire:model.defer="state.name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nombre"
                                    autocomplete="off">
                                @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" wire:model.defer="state.email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Correo"
                                    autocomplete="off">
                                @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="role">Tipo de usuario</label>
                                <div class="controls">
                                    <select id="role" wire:model.defer="state.role"
                                        class="form-control @error('role') is-invalid @enderror"
                                        title="Por favor selecciona un role">
                                        <option value="" selected="" disabled="">
                                            Selecciona un tipo de usuario
                                        </option>
                                        <option value="1">Administrador</option>
                                        <option value="0">Reportero</option>
                                    </select>
                                </div>
                                @error('role')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input id="password" wire:model.defer="state.password" type="text"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña"
                                    autocomplete="off">
                                @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>                            

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-primary" wire:click="save">
                                {{ isset($state['id']) ? 'Editar' : 'Guardar' }}
                            </button>
                            <button type="button" class="btn bg-gradient-danger"
                                wire:click="launchModal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>