<div class="heading-area">
    <div class="container">
        <div class="row logo-heading-section">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <div class="logo w-75">
                    <a href="{{ route('welcome') }}">
                        <img class="w-100 h-auto img-fluid" src="{{ asset('image/angelneri.png') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-md-8 social-header-section">
                <ul class="social-header">
                    @if(count($socialMedia) > 0)
                    @foreach ($socialMedia as $social)
                    <li title="{{ $social->title }}">
                        <a href="{{ $social->url }}" target="_blank">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
                <div class="weather-section d-flex justify-content-center align-items-center">
                    <div class="weather-section-icon d-flex justify-content-center">
                        <i class="fas fa-cloud-sun"></i>
                    </div>
                    <div class="weather-section-text d-flex justify-content-center align-items-center flex-wrap w-75">
                        <span class="w-100">{{ $temperature }}°C</span>
                        <span class="weather-section-text-date w-100">{{ __(Date('F')) }} {{ Date('d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>