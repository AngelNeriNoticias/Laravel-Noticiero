@extends('frontend.layout.app')

@section('content')

<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ ucwords($post->title, 'UTF-8') }}</h2>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" title={{ __('HOME') }}><a href="{{ route('welcome') }}">{{
                                __('HOME') }}</a></li>
                        <li class="breadcrumb-item" title={{ $post->subCategory->category->name }}><a>{{
                                $post->subCategory->category->name }}</a>
                        </li>
                        <li class="breadcrumb-item" title={{ $post->subCategory->name }}>
                            <a href="{{ route('sub-category', ['id' =>$post->subCategory->id]) }}">{{
                                $post->subCategory->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ ucwords($post->title,'UTF-8') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="featured-photo">
                    <img src="{{ asset('storage/posts/'.$post->photo)}}" alt="">
                </div>
                <div class="sub">
                    <div class="item">
                        <b><i class="fas fa-user"></i></b>
                        <a href="{{ route('author', ['id', $post->author->id]) }}">
                            {{ $post->author->name }}
                        </a>
                    </div>
                    <div class="item">
                        <b><i class="fas fa-clock"></i></b>
                        {{ $post->created_at->format('d/m/Y') }}
                    </div>
                    <div class="item">
                        <b><i class="fas fa-eye"></i></b>
                        {{ $post->visitors }}
                    </div>
                </div>
                <div class="main-text">
                    {!! $post->body !!}
                </div>

                @if (count($tags) > 0)
                <div class="tag-section">
                    <h2>{{ __('Tags') }}</h2>
                    <div class="tag-section-content">
                        @foreach ($tags as $tag)
                        <a href="{{ route('tag', ['id' => $tag->tag->id]) }}" title="{{ $tag->tag->name }}">
                            <span class="badge bg-category">
                                {{ $tag->tag->name }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>                    
                @endif

                <div class="related-news">
                    <div class="related-news-heading">
                        <h2>{{ __('Related News') }}</h2>
                    </div>
                    <div class="related-post-carousel owl-carousel owl-theme">
                        @foreach ($postsRelated as $postRelated)
                        <div class="item">
                            <div class="photo">
                                <img src="{{ asset('storage/posts/' . $postRelated->photo) }}" alt="">
                            </div>
                            <div class="category">
                                <span class="badge bg-category">{{ $postRelated->subCategory->name }}</span>
                            </div>
                            <h3>
                                <a href="{{ route('detail', ['id' => $postRelated->id]) }}">
                                    {{ $postRelated->title }}
                                </a>
                            </h3>
                            <div class="date-user">
                                <div class="user">
                                    <a href="{{ route('detail', ['id' => $postRelated->id]) }}">
                                        {{ $postRelated->author->name }}
                                    </a>
                                </div>
                                <div class="date">
                                    <a href="{{ route('date', ['date'=> $postRelated->created_at->format('Y-m-d')]) }}">
                                        {{ $postRelated->created_at->format('d/m/Y') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @include('frontend.layout.partials.sidebar')
        </div>
    </div>
</div>

@endsection