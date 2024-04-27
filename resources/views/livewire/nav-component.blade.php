<nav class="no-underline bg-gray-400 p-4 text-black flex justify-between items-center w-full ">
    <!-- Левая часть навбара (например, логотип или название сайта) -->
    <div>

        <a href="{{route('view.first')}}" class="no-underline text-white text-lg font-semibold">
            @component('components.application-logo')
                @endcomponent
                Products</a>
    </div>


    <div class="flex items-center">

        @livewire('pages-component')
        @livewire('cart-icon-component')
        @livewire('auth-component')


    </div>
</nav>
