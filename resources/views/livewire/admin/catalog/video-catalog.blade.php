<div>
    <x-slot name="title">
        Video
    </x-slot>

    <x-slot name="header">
        Administrar videos
    </x-slot>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn bg-gradient-success mb-4" wire:click="launchModal">
                    Agregar nuevo video
                </button>
            </div>

            <div id="fb-root"></div>
            <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>

            <div class="pb-4">
                <livewire:tables.admin.catalog.video-table />
            </div>

            <!-- Modal -->
            <div class="modal fade @if($modal)show @endif" tabindex="-1" role="dialog" aria-hidden="true"
                style="@if($modal)display: block; padding-right: 16px; @else display: none; @endif ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ isset($state['id']) ? 'Editar' : 'Guardar' }} Video
                            </h5>
                            <button type="button" class="close" wire:click="launchModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p>
                                    Solamente se aceptan videos de facebook.
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="video">Enlace del video de facebook</label>
                                <input id="video" wire:model.defer="state.video" type="text"
                                    class="form-control @error('video') is-invalid @enderror"
                                    placeholder="Enlace del video de facebook" autocomplete="off">
                                @error('video')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="caption">Subtítulo</label>
                                <input id="caption" wire:model.defer="state.caption" type="text"
                                    class="form-control @error('caption') is-invalid @enderror" placeholder="Subtítulo"
                                    autocomplete="off">
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