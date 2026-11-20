@foreach ($links as $label => $url)
    <a href="{{ $url }}">{{ $label }}</a>
@endforeach