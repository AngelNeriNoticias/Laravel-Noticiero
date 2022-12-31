@extends('frontend.layout.app')

@section('content')

<div class="page-content">
    @include('frontend.layout.partials.news-ticker-item')

    <div class="home-main">
        <div class="container">
            <div class="row g-2 mb-3">
                <div class="col-lg-12 col-md-12">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @for($i = 0; $i < 7; $i++) <div class="swiper-slide">
                                <div id="{{ 'inner'. $i }}" class="inner">
                                    <div id="{{ 'photo'. $i }}" class="photo">
                                        <div id="{{ 'bg'. $i }}" class="bg"></div>
                                        <img id="{{ 'img'. $i }}" class="img-fluid"
                                            src="{{ asset('storage/posts/' . $featuredPosts[$i]->photo) }}" alt="">
                                        <div class="text">
                                            <div class="text-inner">
                                                <div class="category">
                                                    <span class="badge bg-category badge-sm">
                                                        {{ $featuredPosts[$i]->subCategory->name }}
                                                    </span>
                                                </div>
                                                <h2>
                                                    <a href="{{ route('detail', ['id' => $featuredPosts[$i]->id]) }}">
                                                        {{ $featuredPosts[$i]->title }}
                                                    </a>
                                                </h2>
                                                <div class="date-user">
                                                    <div class="user">
                                                        <a
                                                            href="{{ route('detail', ['id' => $featuredPosts[$i]->id]) }}">
                                                            {{ $featuredPosts[$i]->author->name }}
                                                        </a>
                                                    </div>
                                                    <div class="date">
                                                        <a
                                                            href="{{ route('date', ['date'=> $featuredPosts[$i]->created_at->format('Y-m-d')]) }}">
                                                            {{ $featuredPosts[$i]->created_at->format('d/m/Y') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next" style="z-index: 99"></div>
                                <div class="swiper-button-prev" style="z-index: 99"></div>
                        </div>
                        @endfor

                    </div>
                </div>
            </div>
        </div>

        @if (count($topAds) > 0)

        <div class="ad-section-2 my-4">
            <div class="container h-100">
                <div class="row h-100 d-flex justify-content-center">
                    @if (count($topAds) == 1)
                    <div class="col-lg-12 col-md-12 col-sm-12 h-100 mb-3 mb-sm-3 w-100 p-0">
                        <a href="{{ $topAds[0]->url }}" target="_blank" title="Anuncio">
                            <img class="img-fluid" src="{{ asset('storage/ads/'. $topAds[0]->ad) }}" alt="">
                        </a>
                    </div>

                    @else

                    <div class="col-lg-6 col-md-6 col-sm-12 h-100 mb-3 mb-sm-3">
                        <a href="{{ $topAds[0]->url }}" target="_blank" title="Anuncio">
                            <img class="img-fluid" src="{{ asset('storage/ads/'. $topAds[0]->ad) }}" alt="">
                        </a>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 h-100">
                        <a href="{{ $topAds[1]->url }}" target="_blank" title="Anuncio">
                            <img class="img-fluid" src="{{ asset('storage/ads/'. $topAds[1]->ad) }}" alt="">
                        </a>
                    </div>

                    @endif
                </div>
            </div>
        </div>

        @endif


        <div class="row g-2">
            <div class="col-lg-8 col-md-12 left">
                <div class="inner">
                    <div class="photo">
                        <div class="bg"></div>
                        <img src="{{ asset('storage/posts/' . $featuredPosts[7]->photo) }}" alt="">
                        <div class="text">
                            <div class="text-inner">
                                <div class="category">
                                    <span class="badge bg-category badge-sm">
                                        {{ $featuredPosts[7]->subCategory->name }}
                                    </span>
                                </div>
                                <h2>
                                    <a href="{{ route('detail', ['id' => $featuredPosts[7]->id]) }}">
                                        {{ $featuredPosts[7]->title }}
                                    </a>
                                </h2>
                                <div class="date-user">
                                    <div class="user">
                                        <a href="{{ route('detail', ['id' => $featuredPosts[7]->id]) }}">
                                            {{ $featuredPosts[7]->author->name }}
                                        </a>
                                    </div>
                                    <div class="date">
                                        <a
                                            href="{{ route('date', ['date'=> $featuredPosts[7]->created_at->format('Y-m-d')]) }}">
                                            {{ $featuredPosts[7]->created_at->format('d/m/Y') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="inner inner-right">
                    <div class="photo">
                        <div class="bg"></div>
                        <img src="{{ asset('storage/posts/' . $featuredPosts[8]->photo) }}" alt="">
                        <div class="text">
                            <div class="text-inner">
                                <div class="category">
                                    <span class="badge bg-category badge-sm">
                                        {{ $featuredPosts[8]->subCategory->name }}
                                    </span>
                                </div>
                                <h2>
                                    <a href="{{ route('detail', ['id' => $featuredPosts[8]->id]) }}">
                                        {{ $featuredPosts[8]->title }}
                                    </a>
                                </h2>
                                <div class="date-user">
                                    <div class="user">
                                        <a href="{{ route('detail', ['id' => $featuredPosts[8]->id]) }}">
                                            {{ $featuredPosts[8]->author->name }}
                                        </a>
                                    </div>
                                    <div class="date">
                                        <a
                                            href="{{ route('date', ['date'=> $featuredPosts[8]->created_at->format('Y-m-d')]) }}">
                                            {{ $featuredPosts[8]->created_at->format('d/m/Y') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inner inner-right">
                    <div class="photo">
                        <div class="bg"></div>
                        <img src="{{ asset('storage/posts/' . $featuredPosts[9]->photo) }}" alt="">
                        <div class="text">
                            <div class="text-inner">
                                <div class="category">
                                    <span class="badge bg-category badge-sm">
                                        {{ $featuredPosts[9]->subCategory->name }}
                                    </span>
                                </div>
                                <h2>
                                    <a href="{{ route('detail', ['id' => $featuredPosts[9]->id]) }}">
                                        {{ $featuredPosts[9]->title }}
                                    </a>
                                </h2>
                                <div class="date-user">
                                    <div class="user">
                                        <a href="{{ route('author', ['id' => $featuredPosts[9]->author->id]) }}">
                                            {{ $featuredPosts[9]->author->name }}
                                        </a>
                                    </div>
                                    <div class="date">
                                        <a
                                            href="{{ route('date', ['date'=> $featuredPosts[9]->created_at->format('Y-m-d')]) }}">
                                            {{ $featuredPosts[9]->created_at->format('d/m/Y') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (count($carouselAds) > 0)

<div class="ad-section-2 my-4">
    <div class="container h-100">
        <div class="row h-100 d-flex justify-content-center">
            @if (count($carouselAds) == 1)
            <div class="col-lg-12 col-md-12 col-sm-12 h-100 mb-3 mb-sm-3 w-100 p-0">
                <a href="{{ $carouselAds[0]->url }}" target="_blank" title="Anuncio">
                    <img class="img-fluid" src="{{ asset('storage/ads/'. $carouselAds[0]->ad) }}" alt="">
                </a>
            </div>

            @else

            <div class="col-lg-6 col-md-6 col-sm-12 h-100 mb-3 mb-sm-3">
                <a href="{{ $carouselAds[0]->url }}" target="_blank" title="Anuncio">
                    <img class="img-fluid" src="{{ asset('storage/ads/'. $carouselAds[0]->ad) }}" alt="">
                </a>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 h-100">
                <a href="{{ $carouselAds[1]->url }}" target="_blank" title="Anuncio">
                    <img class="img-fluid" src="{{ asset('storage/ads/'. $carouselAds[1]->ad) }}" alt="">
                </a>
            </div>

            @endif
        </div>
    </div>
</div>

@endif


<div class="home-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 left-col">
                <div class="left">
                    @foreach ($subcategories as $subcategory)
                    <!-- News Of Category -->
                    <div class="news-total-item">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <h2>{{ $subcategory->name }}</h2>
                            </div>
                            <div class="col-lg-6 col-md-12 see-all">
                                <a href="{{ route('sub-category', ['id' => $subcategory->id]) }}"
                                    class="btn btn-primary btn-sm">{{ __('See All News') }}</a>
                            </div>
                            <div class="col-md-12">
                                <div class="bar"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="left-side">
                                    <div class="photo">
                                        <img src="{{ asset('storage/posts/'.$subcategory->posts[0]->photo) }}" alt="">
                                    </div>
                                    <div class="category">
                                        <span class="badge bg-category">{{ $subcategory->name }}</span>
                                    </div>
                                    <h3>
                                        <a href="{{ route('detail', ['id' => $subcategory->posts[0]->id]) }}">
                                            {{ $subcategory->posts[0]->title }}
                                        </a>
                                    </h3>
                                    <div class="date-user">
                                        <div class="user">
                                            <a
                                                href="{{ route('author', ['id' => $subcategory->posts[0]->author->id]) }}">
                                                {{ $subcategory->posts[0]->author->name }}
                                            </a>
                                        </div>
                                        <div class="date">
                                            <a
                                                href="{{ route('date', ['date'=> $subcategory->posts[0]->created_at->format('Y-m-d')]) }}">
                                                {{ $subcategory->posts[0]->created_at->format('d/m/Y') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="sub-category-body">
                                        {!! $subcategory->posts[0]->body !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mt-3 mt-lg-0 mt-sm-3">
                                <div class="right-side">
                                    @foreach ($subcategory->posts as $post)
                                    @if ($loop->index > 0 && $loop->index <= 4) <div class="right-side-item mb-2">
                                        <div class="left">
                                            <img src="{{ asset('storage/posts/'.$post->photo) }}" alt="">
                                        </div>
                                        <div class="right">
                                            <div class="category">
                                                <span class="badge bg-category">
                                                    {{ $subcategory->name }}
                                                </span>
                                            </div>
                                            <h2>
                                                <a href="{{ route('detail', ['id' => $post->id]) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h2>
                                            <div class="date-user">
                                                <div class="user">
                                                    <a href="{{ route('author', ['id' => $post->author->id]) }}">
                                                        {{ $post->author->name }}
                                                    </a>
                                                </div>
                                                <div class="date">
                                                    <a
                                                        href="{{ route('date', ['date'=> $post->created_at->format('Y-m-d')]) }}">
                                                        {{ $post->created_at->format('d/m/Y') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @include('frontend.layout.partials.sidebar')
    </div>
</div>
</div>

{{-- Videos section --}}
@if (count($videos) > 0)
<div class="video-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="video-heading">
                    <h2><a class="text-decoration-none text-white" href="{{ route('videos') }}">Videos</a></h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="video-carousel owl-carousel">
                    @foreach ($videos as $video)
                    <div class="item">
                        <div class="fb-video" data-href="{{ $video->video }}" data-width="302" data-height="226"
                            data-show-text="false">
                        </div>
                        <div class="video-caption">
                            <a target="_blank" href="{{ 'http://www.youtube.com/watch?v=' . $video->video }}">
                                {{ $video->caption }}
                            </a>
                        </div>
                        <div class="video-date">
                            <i class="fas fa-calendar-alt"></i> {{ $video->updated_at->format('d/m/Y') }}
                        </div>
                    </div>

                    @endforeach

                </div>

            </div>
        </div>

    </div>
</div>
@endif

@if ($footerAd)
<div class="my-lg-4 my-sm-2">
    <div class="container h-100">
        <div class="row h-100 d-flex justify-content-center flex-wrap">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <a href="{{ $footerAd->url }}" target="_blank" title="Anuncio">
                    <img class="img-fluid" src="{{ asset('storage/ads/'. $footerAd->ad) }}" alt="">
                </a>
            </div>
        </div>
    </div>
</div>
@endif

</div>

@section('scripts')
<script type="text/javascript">
    const swiper = new Swiper(".mySwiper", {
        autoplay: {
            delay: 5000
        },
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        }
    });
</script>
@endsection

@endsection