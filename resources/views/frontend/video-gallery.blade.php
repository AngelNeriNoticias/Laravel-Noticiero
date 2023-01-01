@extends('frontend.layout.app')

@section('content')
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ __('Video Gallery') }}</h2>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('HOME') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('VIDEO GALLERY') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="video-gallery">
            <div class="row">

                @foreach($videos as $video)
                <div class="col-lg-3 col-md-4">
                    <div class="fb-video g" data-href="{{ $video->video }}"
                        data-width="302" data-height="226" data-show-text="false">
                    </div>
                    <div class="video-caption">
                        <a title="{{ $video->caption }}" href="{{ $video->video }}"
                            target="_blank">{{ $video->caption }}</a>
                    </div>                    
                    <div class="video-date">
                        <i class="fas fa-calendar-alt"></i> {{ $video->updated_at->format('d/m/Y') }}
                    </div>    
                </div> 
                @endforeach

                <div class="col-md-12">
                    {{ $videos->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection