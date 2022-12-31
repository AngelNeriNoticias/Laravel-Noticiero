@extends('frontend.layout.app')

@section('content')

<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ __('Date') }}: {{ $posts[0]->created_at->format('d/m/Y') }}</h2>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('HOME') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ ucwords($posts[0]->author->name) }}
                        </li>
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
                <div class="category-page">
                    <div class="row">
                        @if(count($posts) > 0)
                        @foreach ($posts as $post)
                        <div class="col-lg-6 col-md-12">
                            <div class="category-page-post-item">
                                <div class="photo">
                                    <img src="{{ asset('storage/posts/' . $post->photo) }}" alt="">
                                </div>
                                <div class="category">
                                    <span class="badge bg-category">{{ $post->subCategory->name }}</span>
                                </div>
                                <h3><a href="{{ route('detail', ['id' => $post->id]) }}">{{ $post->title }}</a></h3>
                                <div class="date-user">
                                    <div class="user">
                                        <a href="{{ route('author', ['id' => $post->author->id]) }}">
                                            {{ $post->author->name }}
                                        </a>
                                    </div>
                                    <div class="date">
                                        <a href="{{ route('date', ['date'=> $post->created_at->format('Y-m-d')]) }}">
                                            {{ $post->updated_at->format('d/m/Y') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-md-12">
                            {{ $posts->links() }}
                        </div>

                        @else
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                {{ __('No posts found') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            @include('frontend.layout.partials.sidebar')
        </div>
    </div>
</div>

@endsection