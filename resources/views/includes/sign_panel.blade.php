<div >
    @auth
        <a href="{{ url('/logout') }}" class="text-secondary text-decoration-none">
            <button type="button" class="btn btn-sm btn-outline-secondary">
                Logout
            </button>
        </a>
        <button type="button" class="btn btn-sm btn-outline-dark">
            <a href="" class="text-secondary text-decoration-none"></a>
        </button>
    @else
        <a href="{{ route('login') }}" class="text-secondary text-decoration-none">
            <button type="button" class="btn btn-sm btn-outline-secondary">
                Sign In
            </button>
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-secondary text-decoration-none">
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    Sign Up
                </button>
            </a>
        @endif
    @endauth
</div>
