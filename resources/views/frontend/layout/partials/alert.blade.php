<div class="top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul>
                    <li class="today-text">{{ __('Today') }}: {{ __(Date('F')) }} {{ Date('d, Y') }}</li>
                    <li class="email-text">angelneri22@hotmail.com</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="right">
                    <li class="menu"><a href="{{ route('faq') }}">{{ __('FAQ') }}</a></li>
                    <li class="menu"><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                    <li class="menu"><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>