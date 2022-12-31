@extends('frontend.layout.app')

@section('content')
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ __('FAQ') }}</h2>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ __('HOME') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{mb_strtoupper(__('FAQ'), 'UTF-8') }}
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
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    @foreach($questions as $question)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $question->id }}">
                            <button class="accordion-button @if($loop->iteration != 1) collapsed @endif" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $question->id }}"
                                aria-expanded="@if($loop->iteration == 1) true @else false @endif"
                                aria-controls="collapse{{ $question->id }}">
                                {{ $question->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $question->id }}"
                            class="accordion-collapse collapse @if($loop->iteration == 1) show @endif"
                            aria-labelledby="heading{{ $question->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {!! $question->answer !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection