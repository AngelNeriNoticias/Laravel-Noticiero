@extends('frontend.layout.app')

@section('content')
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ __('Detalles de Expectáculos') }}</h2>
                <p>
                    <span>Página de Facebook: <a class="text-decoration-none" target="_blank"
                            href="https://www.facebook.com/espectaculosartisticosdelnorte">Espectáculos
                            artísticos</a>
                    </span>
                    <br>
                    <span>Correo de negocios: <a
                            href="mailto:espectaculosadn@gmail.com">espectaculosadn@gmail.com</a></span><br>
                    <span>Teléfono de negocios: 6391570909</span>
                </p>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('HOME') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Detalles de Expectáculos') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="photo-gallery">
            <div class="row">
                @foreach($advices as $advice)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    @if ($advice['type_id']== 1)
                    <div class="photo-thumb">
                        <img src="{{ asset('storage/advice/'.$advice->photo) }}" alt="">
                        <div class="bg"></div>
                        <div class="icon">
                            <a href="{{ asset('storage/advice/'.$advice->photo) }}" class="magnific">
                                <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="photo-caption">
                        <a title="{{ $advice->caption }}" href="{{ $advice->url }}" target="_blank">{{ $advice->caption
                            }}</a>
                    </div>
                    <div class="photo-date">
                        <i class="fas fa-calendar-alt"></i> {{ $advice->updated_at->format('d/m/Y') }}
                    </div>


                    @else
                    <div class="fb-video g" data-href="{{ $advice->url }}" data-width="302" data-height="226"
                        data-show-text="false">
                    </div>
                    <div class="video-caption">
                        <a title="{{ $advice->caption }}" href="{{ $advice->url }}" target="_blank">{{ $advice->caption
                            }}</a>
                    </div>
                    <div class="video-date" style="padding-bottom: 8px;">
                        <i class="fas fa-calendar-alt"></i> {{ $advice->updated_at->format('d/m/Y') }}
                    </div>
                    @endif
                </div>
                @endforeach

                <div class="col-md-12">
                    {{ $advices->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection