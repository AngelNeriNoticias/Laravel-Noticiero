@extends('frontend.layout.app')

@section('content')
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ __('Contact') }}</h2>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('HOME') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{mb_strtoupper(__('Contact'), 'UTF-8') }}
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
            <div class="col-lg-6 col-md-12">
                <form action="" method="post" class="form_contact_ajax">
                    @csrf
                    <div class="contact-form">
                        <div class="mb-3">
                            <label for="" class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">{{ __('Email Address') }}</label>
                            <input type="text" class="form-control" name="email">
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">{{ __('Message') }}</label>
                            <textarea class="form-control" name="message" rows="3"></textarea>
                            <span class="text-danger error-text message_error"></span>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary bg-website">{{ __('Send Message') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14062.921008682675!2d-105.4328049!3d28.215507!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6b86a4d8a78492e2!2sInstituto%20Tecnologico%20De%20Delicias!5e0!3m2!1sen!2smx!4v1669650099847!5m2!1sen!2smx"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection