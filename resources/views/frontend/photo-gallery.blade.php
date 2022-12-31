@extends('frontend.layout.app')

@section('content')
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ __('Photo Gallery') }}</h2>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('HOME') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('PHOTO GALLERY') }}</li>
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
                @foreach($photos as $photo)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="photo-thumb">
                        <img src="{{ asset('storage/gallery/'.$photo->photo) }}" alt="">
                        <div class="bg"></div>
                        <div class="icon">
                            <a href="{{ asset('storage/gallery/'.$photo->photo) }}"
                                class="magnific">
                                <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="photo-caption">
                        <a title="{{ $photo->caption }}" href="javascript:void;">{{ $photo->caption }}</a>
                    </div>
                    <div class="photo-date">
                        <i class="fas fa-calendar-alt"></i> {{ $photo->updated_at->format('d/m/Y') }}
                    </div>
                </div>
                @endforeach
                <div class="col-md-12">
                    {{ $photos->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection