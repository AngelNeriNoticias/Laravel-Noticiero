<div class="col-lg-4 col-md-6 sidebar-col">
    <div class="sidebar">

        <div class="widget mb-2">
            <div class="h-100">
                @if ($topSideAd != null)
                <a href="{{ $topSideAd->url }}" target="_blank" title="Anuncio">
                    <img class="w-100 h-auto" src="{{ asset('storage/ads/'. $topSideAd->ad) }}" alt="">
                </a>
                @endif
            </div>
        </div>

        @if (count($globalTags)>0)
        <div class="widget">
            <div class="tag-heading">
                <h2>{{ __('Tags') }}</h2>
            </div>
            <div class="tag">
                @foreach ($globalTags as $tag)
                <div class="tag-item">
                    <a href="{{ route('tag', ['id' => $tag->id]) }}">
                        <span class="badge bg-tag">{{ $tag->name }}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- <div class="widget">
            <div class="archive-heading">
                <h2>{{ __('Archive') }}</h2>
            </div>
            <div class="archive">
                <select name="" class="form-select"
                    onchange="window.location.href='{{ route('author', ['id' => event.target.id]) }}'">
                    <option value="">{{ __('Select Month') }}</option>
                    @foreach ($globalArchieves as $archive)
                    <option value="{{ $archive }}">
                        {{ $archive}}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}

        {{-- @if ($streamingVideo)
        <div class="widget">
            <div class="live-channel">
                <div class="live-channel-heading">
                    <h2>{{ $streamingVideo->title }}</h2>
                </div>
                <div class="live-channel-item">
                    {!! $streamingVideo->url !!}
                </div>
            </div>
        </div>
        @endif --}}

        <div class="widget">
            <div class="news">
                <div class="news-heading">
                    <h2>{{ __('Popular News') }}</h2>
                </div>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active btn-custom" id="pills-recent-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-recent" type="button" role="tab" aria-controls="pills-recent"
                            aria-selected="true">{{ __('Recent News') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn-custom" id="pills-popular-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular"
                            aria-selected="false">{{ __('Popular News') }}</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-recent" role="tabpanel"
                        aria-labelledby="pills-recent-tab">
                        @foreach ($recentPosts as $post)
                        <div class="news-item">
                            <div class="left">
                                <img src="{{ asset('storage/posts/' . $post->photo) }}" alt="">
                            </div>
                            <div class="right">
                                <div class="category">
                                    <span class="badge bg-category">
                                        {{ $post->subCategory->name }}
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
                                        <a href="{{ route('date', ['date'=> $post->created_at->format('Y-m-d')]) }}">
                                            {{ $post->created_at->format('d/m/Y') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                        @foreach ($popularPosts as $post)
                        <div class="news-item">
                            <div class="left">
                                <img src="{{ asset('storage/posts/' . $post->photo) }}" alt="">
                            </div>
                            <div class="right">
                                <div class="category">
                                    <span class="badge bg-category">
                                        {{ $post->subCategory->name }}
                                    </span>
                                </div>
                                <h2>
                                    <a href="{{ route('detail', ['id' => $post->id]) }}">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <div class="date-user">
                                    <div class="user">
                                        <a href="">
                                            {{ $post->author->name }}
                                        </a>
                                    </div>
                                    <div class="date">
                                        <a href="{{ route('date', ['date'=> $post->created_at->format('Y-m-d')]) }}">
                                            {{ $post->created_at->format('d/m/Y') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <div class="widget my-4">
            <div class="h-100">
                @if ($belowSideAd != null)
                <a href="{{ $belowSideAd->url }}" target="_blank" title="Anuncio">
                    <img class="w-100 h-auto" src="{{ asset('storage/ads/'. $belowSideAd->ad) }}" alt="">
                </a>
                @endif
            </div>
        </div>

        {{-- <div class="widget">
            <div class="poll-heading">
                <h2>{{ __('Online Poll') }}</h2>
            </div>
            <div class="poll">
                <div class="question">
                    ¿Cree que los productos Apple podrán sobrevivir por 20 años?
                </div>
                <div class="answer-option">
                    <form action="" method="post">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="poll" id="poll_id_1">
                            <label class="form-check-label" for="poll_id_1">Sí</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="poll" id="poll_id_2">
                            <label class="form-check-label" for="poll_id_2">No</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="poll" id="poll_id_3">
                            <label class="form-check-label" for="poll_id_3">No comentario</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            <a href="poll-result.html" class="btn btn-primary old">{{ __('Old Result') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

    </div>
</div>