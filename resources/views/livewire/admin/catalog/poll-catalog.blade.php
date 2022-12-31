<div>
    <x-slot name="title">
        Encuestas
    </x-slot>

    <x-slot name="header">
        Administrar encuestas
    </x-slot>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn bg-gradient-success mb-4" wire:click="launchModal">
                    Agregar nueva encuesta
                </button>
            </div>

            <div class="pb-4">
                <livewire:tables.admin.catalog.poll-table />
            </div>

            <!-- Modal -->
            <div class="modal fade @if($modal)show @endif" tabindex="-1" role="dialog" aria-hidden="true"
                style="@if($modal)display: block; padding-right: 16px; @else display: none; @endif ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ isset($state['id']) ? 'Editar' : 'Guardar' }} Encuesta
                            </h5>
                            <button type="button" class="close" wire:click="launchModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="name">Escriba la pregunta aquí</label>
                                    <input id="name" wire:model.defer="state.name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Ejemplo: ¿Quién ganará el mundial?" autocomplete="off">
                                    @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12" wire:ignore>
                                    <div class="form-group">
                                        <label for="answers">Respuestas</label>
                                        <select id="answers" class="select2-class form-control"
                                            title="Mencione las respuestas" multiple>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input id="active" type="checkbox" class="custom-control-input"
                                                wire:model.defer="state.active">
                                            <label class="custom-control-label" for="active">¿Esta encuesta está activa?</label>
                                        </div>
                                        @error('active')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
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
        $(document.body).on("select2:select", "#answers", (e) => {
            const answerId = e.params.data.id;
            @this.addAnswer(answerId);
        });
    
        $(document.body).on("select2:unselecting", "#answers", (e) => {
            const answerId = e.params.args.data.id;
            @this.removeAnswer(answerId);
        });
            
    </script>
    @endsection

</div>