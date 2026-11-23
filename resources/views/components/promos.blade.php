@foreach ($promos as $promo)
    <div class="rail {{ $loop->first ? 'rail-left' : 'rail-right' }}">
        <svg class="rail-icon" viewBox="0 0 64 24" aria-hidden="true">
            <rect x="0" y="6" width="6" height="12" rx="1" />
            <rect x="7" y="2" width="7" height="20" rx="1" />
            <rect x="14" y="10" width="36" height="4" />
            <rect x="50" y="2" width="7" height="20" rx="1" />
            <rect x="58" y="6" width="6" height="12" rx="1" />
        </svg>

        <p class="rail-words">{!! $loop->first ? 'Log<br>every<br>rep.' : 'No<br>days<br>off.' !!}</p>

        <a href="{{ route($promo['route']) }}" class="promo">
            <img src="{{ asset($promo['image']) }}" alt="">
            <div>
                <p class="promo-label">Gymlogger tip</p>
                <strong>{{ $promo['title'] }}</strong>
                <p>{{ $promo['text'] }}</p>
                <span class="promo-button">{{ $promo['button'] }}</span>
            </div>
        </a>
    </div>
@endforeach