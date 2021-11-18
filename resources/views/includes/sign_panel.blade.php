<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
    @auth
        <a href="{{ url('/logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Выйти</a>
    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Войти</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}"
               class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Зарегестрироваться</a>
        @endif
    @endauth
</div>
