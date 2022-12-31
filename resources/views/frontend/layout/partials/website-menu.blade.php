<div class="website-menu">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">
                                    {{ __('HOME') }}</a>
                            </li>
                            @foreach ($categories as $category)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $category->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($category->subCategories as $subcategory)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('sub-category', ['id' => $subcategory->id]) }}">
                                            {{ $subcategory->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('GALLERY') }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('photos') }}">
                                            {{ __('PHOTO GALLERY')}}
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('videos') }}">
                                            {{ __('VIDEO GALLERY') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('shows') }}">
                                    {{ strtoupper(__('ESPECTÁCULOS')) }}
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">
                                    {{ strtoupper(__('About')) }}
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>