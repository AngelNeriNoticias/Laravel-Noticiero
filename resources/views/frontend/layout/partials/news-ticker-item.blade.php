@if (count($tickers) > 0)
<div class="news-ticker-item">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="acme-news-ticker">
                    <div class="acme-news-ticker-label">{{ __('Latest News') }}</div>
                    <div id="ticker-box" class="acme-news-ticker-box d-none">
                        <ul class="my-news-ticker">
                            @foreach ($tickers as $ticker)
                            <li><a href="" class="cursor-none">{{ $ticker->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif