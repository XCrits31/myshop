<nav class="no-underline bg-gray-400 p-4 text-black flex justify-between items-center w-full ">
    <!-- Левая часть навбара (например, логотип или название сайта) -->
    <div>
        @component('components.application-logo')
        @endcomponent
        <a href="{{url('/index')}}" class="no-underline text-white text-lg font-semibold">Products</a>
    </div>


    <div class="flex items-center">

        @livewire('pages-component')
        @livewire('cart-icon-component')
            @if (Route::has('login'))
                    @auth
                    @livewire('auth-component')
                       @else
                        <a href="{{ route('login') }}" class="font-semibold text-white hover:text-white dark:text-gray-400 dark:hover:text-green-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-green-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">Register</a>
                        @endif
                    @endauth
            @endif


    </div>
</nav>
