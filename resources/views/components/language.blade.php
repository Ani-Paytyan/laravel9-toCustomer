@if(session('applocale') !== null)
    <div>
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="userNavDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ App::getLocale() }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="userNavDropdown">
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <li><a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif
