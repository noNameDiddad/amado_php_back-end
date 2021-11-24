<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="{{ route('main') }}" class="navbar-brand d-flex align-items-center">
                <strong>ArtTradition</strong>
            </a>

            @if(\Illuminate\Support\Facades\Request::path() != 'login' && \Illuminate\Support\Facades\Request::path() != 'register')
                @include('includes.sign_panel')
            @endif
        </div>
    </div>
</header>
