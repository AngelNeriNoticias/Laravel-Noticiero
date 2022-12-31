<div>
    <x-slot name="title">
        Foto
    </x-slot>

    <x-slot name="header">
        Administrar fotos
    </x-slot>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn bg-gradient-success mb-4" wire:click="launchModal">
                    Agregar nueva foto
                </button>
            </div>

            <div class="pb-4">
                <livewire:tables.admin.catalog.photo-table />
            </div>

            <!-- Modal -->
            <div class="modal fade @if($modal)show @endif" tabindex="-1" role="dialog" aria-hidden="true"
                style="@if($modal)display: block; padding-right: 16px; @else display: none; @endif ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ isset($state['id']) ? 'Editar' : 'Guardar' }} Foto
                            </h5>
                            <button type="button" class="close" wire:click="launchModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="image">Seleccione una imagen</label>
                                <input id="image" wire:model.defer="image" type="file"
                                    accept="image/png, image/jpeg, ,image/jpg"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror

                                @if ($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" alt="" width="100%">
                                </div>
                                @else
                                @if (array_key_exists('id', $state) && $image == null)
                                <img src="{{ asset('storage/gallery/'.$state['photo'])}}" alt={{ $state['photo'] }}
                                    title="Imagen">
                                @endif
                                @endif

                                @error('photo')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="caption">Subtítulo</label>
                                <input id="caption" wire:model.defer="state.caption" type="text"
                                    class="form-control @error('caption') is-invalid @enderror" placeholder="Subtítulo">
                                @error('caption')
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