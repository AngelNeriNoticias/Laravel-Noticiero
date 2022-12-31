<div>
    <x-slot name="title">
        Sub Categoría
    </x-slot>

    <x-slot name="header">
        Administrar sub categorías
    </x-slot>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn bg-gradient-success mb-4" wire:click="launchModal">
                    Agregar nueva sub categoría
                </button>
            </div>

            <div class="pb-4">
                <livewire:tables.admin.catalog.sub-category-table />
            </div>

            <!-- Modal -->
            <div class="modal fade @if($modal)show @endif" tabindex="-1" role="dialog" aria-hidden="true"
                style="@if($modal)display: block; padding-right: 16px; @else display: none; @endif ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ isset($state['id']) ? 'Editar' : 'Guardar' }} Sub Categoría
                            </h5>
                            <button type="button" class="close" wire:click="launchModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category_id">Categoría</label>
                                <div class="controls">
                                    <select id="category_id" wire:model.defer="state.category_id"
                                        class="form-control @error('category_id') is-invalid @enderror"
                                        title="Por favor selecciona la categoría">
                                        <option value="" selected="" disabled="">
                                            Selecciona una categoría
                                        </option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre sub categoría</label>
                                <input id="name" wire:model.defer="state.name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Nombre sub categoría" autocomplete="off">
                                @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="order">Orden de aparición</label>
                                <input id="order" wire:model.defer="state.order" type="number"
                                    class="form-control @error('order') is-invalid @enderror"
                                    placeholder="Orden de aparición" autocomplete="off">
                                @error('order')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input id="show" type="checkbox" class="custom-control-input"
                                        wire:model.defer="state.show">
                                    <label class="custom-control-label" for="show">¿Se muestra esta sub
                                        categoría?</label>
                                </div>
                                @error('show')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input id="show_menu" type="checkbox" class="custom-control-input"
                                        wire:model.defer="state.show_menu">
                                    <label class="custom-control-label" for="show_menu">¿Se muestra esta sub
                                        categoría en el menú de inicio?</label>
                                </div>
                                @error('show_menu')
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