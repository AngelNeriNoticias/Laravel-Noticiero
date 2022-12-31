<div>
    <x-slot name="title">
        Anuncio
    </x-slot>

    <x-slot name="header">
        Administrar anuncios
    </x-slot>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn bg-gradient-success mb-4" wire:click="launchModal">
                    Agregar nuevo anuncio
                </button>
            </div>

            <div class="d-flex flex-wrap">
                <h3 class="w-100 text-center">Recomendaciones para subir anuncios, archivos no mayores a un 1MB</h3>
                <table class="table table-bordered table-striped collapsed">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th>Tipo de Anuncio</th>
                            <th class="text-center">Dimensiones</th>
                            <th class="text-center">Largo</th>
                            <th class="text-center">Alto</th>
                            <th class="text-center">Permitidos</th>
                            <th class="text-center">Extensión Recomendada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Superior Título</td>
                            <td class="text-center">856 × 120 px</td>
                            <td class="text-center">856px</td>
                            <td class="text-center">120px</td>
                            <td class="text-center">2</td>
                            <td class="text-center">PNG, JPG</td>
                        </tr>
                        <tr>
                            <td>Inferior Carrusel</td>
                            <td class="text-center">1170 × 100 px</td>
                            <td class="text-center">1170px</td>
                            <td class="text-center">100px</td>
                            <td class="text-center">2</td>
                            <td class="text-center">PNG, JPG</td>
                        </tr>
                        <tr>
                            <td>Lateral Derecho, Superior</td>
                            <td class="text-center">416 × 221 px</td>
                            <td class="text-center">416px</td>
                            <td class="text-center">221px</td>
                            <td class="text-center">1</td>
                            <td class="text-center">PNG, JPG</td>
                        </tr>
                        <tr>
                            <td>Lateral Derecho, Inferior</td>
                            <td class="text-center">416 × 221 px</td>
                            <td class="text-center">416px</td>
                            <td class="text-center">221px</td>
                            <td class="text-center">1</td>
                            <td class="text-center">PNG, JPG</td>
                        </tr>
                        <tr>
                            <td>Pie de Página</td>
                            <td class="text-center">1170 × 100 px</td>
                            <td class="text-center">1170px</td>
                            <td class="text-center">100px</td>
                            <td class="text-center">1</td>
                            <td class="text-center">PNG, JPG</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pb-4">
                <livewire:tables.admin.catalog.advertisement-table />
            </div>

            <!-- Modal -->
            <div class="modal fade @if($modal)show @endif" tabindex="-1" role="dialog" aria-hidden="true"
                style="@if($modal)display: block; padding-right: 16px; @else display: none; @endif ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ isset($state['id']) ? 'Editar' : 'Guardar' }} Anuncio
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
                                <img src="{{ asset('storage/ads/'.$state['ad'])}}" alt={{ $state['ad'] }}
                                    title="Imagen">
                                @endif
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="url">Enlace Imagen</label>
                                <input id="url" wire:model.defer="state.url" type="text"
                                    class="form-control @error('url') is-invalid @enderror" placeholder="Enlace">
                                @error('url')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="typeId">Tipo Anuncio</label>
                                <div class="controls">
                                    <select id="typeId" wire:model.defer="state.typeId"
                                        class="form-control @error('typeId') is-invalid @enderror"
                                        title="Por favor selecciona el tipo de anuncio">
                                        <option value="" selected="" disabled="">
                                            Selecciona un tipo de anuncio
                                        </option>
                                        @foreach ($advertisements as $key => $ad)
                                        <option value="{{ $key }}">
                                            {{ $ad }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('typeId')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input id="status" type="checkbox" class="custom-control-input"
                                        wire:model.defer="state.status">
                                    <label class="custom-control-label" for="status">
                                        ¿Este anuncio estará activo?
                                    </label>
                                </div>
                                @error('status')
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