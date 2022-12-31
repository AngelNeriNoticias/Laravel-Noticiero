@if (count($buttons)> 0)
<div class="fabc-container">
    <div id="fabButton" class="fabc fabc-icon-holder" title="Lo más relevante">
        <i class="fas fa-question" title="Lo más relevante"></i>
    </div>

    <ul class="fabc-options">

        @foreach ($buttons as $button)
        <li>
            <a href="{{ $button->url }}" title="{{ $button->title }}" target="_blank">
                <span class="fabc-label">{{ $button->title }}</span>
                <div class="fabc-icon-holder">
                    <i class="{{ $button->icon }}"></i>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>

@endif