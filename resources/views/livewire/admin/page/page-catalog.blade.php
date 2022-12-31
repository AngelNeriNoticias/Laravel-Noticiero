<div>
    <x-slot name="title">
        Página
    </x-slot>

    <x-slot name="header">
        Administrar páginas
    </x-slot>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn bg-gradient-success mb-4" wire:click="launchModal">
                    Agregar nueva página
                </button>
            </div>

            <div class="pb-4">
                <livewire:tables.admin.pages.page-table />
            </div>

            <!-- Modal -->
            <div class="modal fade @if($modal)show @endif" tabindex="-1" role="dialog" aria-hidden="true"
                style="@if($modal)display: block; padding-right: 16px; @else display: none; @endif ">
                <div class="modal-dialog" role="document" style="min-width: 800px !important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ isset($state['id']) ? 'Editar' : 'Guardar' }} Página
                            </h5>
                            <button type="button" class="close" wire:click="launchModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="title">Título de página</label>
                                    <input id="title" wire:model.defer="state.title" type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Título de la nota" autocomplete="off">
                                    @error('title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="page_id">Página</label>
                                        <div class="controls">
                                            <select id="page_id" wire:model.defer="state.page_id" class="form-control"
                                                title="Por favor selecciona la categoría">
                                                <option value="" selected="" disabled="">
                                                    Selecciona una página
                                                </option>
                                                @foreach ($pages as $key =>$page)
                                                <option value="{{ $key }}">
                                                    {{ $page }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('page_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group" wire:ignore>
                                        <label for="content">Escribir nota</label>
                                        <textarea id="content" wire:model="state.content">
                                            @if (array_key_exists('id', $state))
                                            {{ $state['content'] }}  
                                            @endif
                                        </textarea>
                                    </div>
                                    @error('content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
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

    @section('scripts')
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300,
                lang: 'es-ES',
                placeholder: 'Escribe la nota aquí...',                
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('state.content', contents);
                    }
                },
            });
        });     
    </script>
    @endsection

</div>