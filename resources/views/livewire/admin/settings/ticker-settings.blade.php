<div>
    <x-slot name="title">
        Anuncio mensaje
    </x-slot>

    <x-slot name="header">
        Administrar anuncios mensajes
    </x-slot>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn bg-gradient-success mb-4" wire:click="launchModal">
                    Agregar nuevo anuncio mensaje
                </button>
            </div>

            <div class="pb-4">
                <livewire:tables.admin.settings.ticker-table />
            </div>

            <!-- Modal -->
            <div class="modal fade @if($modal)show @endif" tabindex="-1" role="dialog" aria-hidden="true"
                style="@if($modal)display: block; padding-right: 16px; @else display: none; @endif ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ isset($state['id']) ? 'Editar' : 'Guardar' }} Categoría
                            </h5>
                            <button type="button" class="close" wire:click="launchModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nombre anuncio</label>
                                <input id="name" wire:model.defer="state.name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Nombre anuncio" autocomplete="off">
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
                                    <label class="custom-control-label" for="show">¿Se muestra este anuncio?</label>
                                </div>
                                @error('show')
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