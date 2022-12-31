<footer class="footer">
    <div class="container d-flex flex-wrap">
        <div class="row d-flex justify-content-between w-100">
            <div class="col-md-4">
                <div class="item">
                    <h2 class="heading">{{ __('Acerca de Ángel') }}</h2>
                    <p class="text-justify">
                        {!! $smallAboutUs->content !!}
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="item">
                    <h2 class="heading">{{ __('Useful Links') }}</h2>
                    <ul class="useful-links">
                        <li title="{{ __('FAQ') }}">
                            <a href="{{ route('faq') }}">
                                {{ __('FAQ') }}
                            </a>
                        </li>
                        <li title="{{ __('Terms and Conditions') }}">
                            <a href="{{ route('terms') }}">
                                {{ __('Terms and Conditions')}}
                            </a>
                        </li>
                        <li title="{{ __('Privacy Policy') }}">
                            <a href="{{ route('privacy') }}">
                                {{ __('Privacy Policy') }}
                            </a>
                        </li>
                        <li title="{{ __('Disclaimer') }}">
                            <a href="{{ route('disclaimer') }}">
                                {{ __('Disclaimer')}}
                            </a>
                        </li>
                        {{-- <li title="{{ __('Contact') }}"><a href="{{ route('contact') }}">{{ __('Contact') }}</a>
                        </li> --}}
                    </ul>
                </div>
            </div>


            <div class="col-md-4">
                <div class="item">
                    <h2 class="heading">{{ __('Contact') }}</h2>
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="right">
                            Delicias, Chihuahua
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="left">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="right">
                            negocios@angelneri.com
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="right">
                            {{-- 639-157-0909 --}}
                        </div>
                    </div>
                    {{-- <ul class="social">
                        @if(count($socialMedia) > 0)
                        @foreach ($socialMedia as $social)
                        <li title="{{ $social->title }}">
                            <a href="{{ $social->url }}" target="_blank">
                                <i class="{{ $social->icon }}"></i>
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul> --}}
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="item">
                    <h2 class="heading">{{ __('Newsletter') }}</h2>
                    <p>
                        In order to get the latest news and other great items, please subscribe us here:
                    </p>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" name="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Subscribe Now">
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
        <div class="row w-100 text-center d-flex justify-content-center my-2 pt-5">
            Copyright 2022, Ángel Neri Noticias. {{ __('All Rights Reserved') }}.
        </div>
    </div>
</footer>