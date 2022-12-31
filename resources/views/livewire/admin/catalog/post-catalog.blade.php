<div>
    <x-slot name="title">
        Notas
    </x-slot>

    <x-slot name="header">
        Administrar notas
    </x-slot>

    <div class="pb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="row d-flex">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" wire:ignore>
                    <li class="nav-item" role="presentation">
                        <a wire:click="updateTab('pills-table')"
                            class="nav-link {!! $tab == 'pills-table' ? 'active' : '' !!}" id="pills-table-tab"
                            data-toggle="pill" href="#pills-table" role="tab" aria-controls="pills-table"
                            aria-selected="true">TABLA DE NOTAS</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a wire:click="updateTab('pills-post')"
                            class="nav-link {!! $tab == 'pills-post' ? 'active' : '' !!}" id="pills-post-tab"
                            data-toggle="pill" href="#pills-post" role="tab" aria-controls="pills-post"
                            aria-selected="false">AGREGAR NOTA</a>
                    </li>
                </ul>
            </div>


            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade {!! $tab == 'pills-table' ? 'show active' : '' !!} " id="pills-table"
                    role="tabpanel" aria-labelledby="pills-table-tab">
                    <div class="pb-4">
                        <livewire:tables.admin.catalog.post-table />
                    </div>
                </div>

                <div class="tab-pane fade {!! $tab == 'pills-post' ? 'show active' : '' !!}" id="pills-post"
                    role="tabpanel" aria-labelledby="pills-post-tab">
                    <div class="row">
                        <div class="form-group col-12">
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
                            <img src="{{ asset('storage/posts/'.$state['photo'])}}" alt={{ $state['photo'] }}
                                title="Imagen">
                            @endif
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <label for="title">Título de la nota</label>
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
                            <div class="form-group" wire:ignore>
                                <label for="body">Escribir nota</label>
                                <textarea id="body" wire:model="state.body">
                                    @if (array_key_exists('id', $state))
                                    {{ $state['body'] }}  
                                    @endif
                                </textarea>
                            </div>
                            @error('body')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="form-group col-12">
                            <label for="url">Url a video de youtube</label>
                            <input id="url" wire:model.defer="state.url" type="text"
                                class="form-control @error('url') is-invalid @enderror"
                                placeholder="Título de la nota" autocomplete="off">
                            @error('url')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="category_id">Categoría</label>
                                <div class="controls">
                                    <select id="category_id" wire:model.defer="state.category_id" class="form-control"
                                        title="Por favor selecciona la categoría" wire:change.defer="getSubCategory">
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
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="sub_category_id">Sub categoría</label>
                                <div class="controls">
                                    <select id="sub_category_id" wire:model.defer="state.sub_category_id"
                                        class="form-control @error('sub_category_id') is-invalid @enderror"
                                        title="Por favor selecciona la sub categoría">
                                        <option value="" selected="" disabled="">
                                            Selecciona una sub categoría
                                        </option>
                                        @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">
                                            {{ $subcategory->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('sub_category_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input id="share" type="checkbox" class="custom-control-input"
                                        wire:model.defer="state.share">
                                    <label class="custom-control-label" for="share">¿Esta nota se puede
                                        compartir?</label>
                                </div>
                                @error('share')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div> --}}
                        
                        <div class="col-lg-12 col-md-12 col-sm-12" wire:ignore>
                            <div class="form-group">
                                <label for="tagsSelected">Etiquetas</label>
                                <select id="tagsSelected" class="select2-class form-control"
                                    title="Mencione las etiquetas" multiple>
                                    @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-evenly">
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
            $('#body').summernote({
                height: 300,
                lang: 'es-ES',
                placeholder: 'Escribe la nota aquí...',                
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('state.body', contents);
                    }
                },
            });
        });

        $(document.body).on("select2:selecting", "#tagsSelected", (e) => {
            const tagId = e.params.args.data.id;
            Livewire.emit('addTag', tagId)
        });
    
        $(document.body).on("select2:unselecting", "#tagsSelected", (e) => {
            const tagId = e.params.args.data.id;
            Livewire.emit('removeTag', tagId)
        });        
    </script>
    @endsection

</div>