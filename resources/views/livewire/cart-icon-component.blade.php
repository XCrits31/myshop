<div x-data="{ open: false }" @mouseleave="open = false" class="relative">
    <button @mouseenter="open = true" class="flex items-center justify-center w-10 h-10 text-white bg-gray-800 rounded-full hover:bg-gray-600">
        <a href="/cart" class="no-underline text-current"><i class="bi bi-cart-fill"></i> </a>
    </button>

    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-64 bg-white rounded-md shadow-xl z-20">
        <div class="px-4 py-2">
            <h3 class="text-lg font-semibold">Cart</h3>
        </div>
        <ul>
            @forelse($cartItems as $item)
                <li class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                    {{ $item->name }} - {{ $item->qty }}
                    <span class="text-gray-600">${{ $item->price }}</span>
                </li>
            @empty
                <li class="px-4 py-2 text-center text-gray-500">Empty cart</li>
            @endforelse
        </ul>
        @if($cartItems->count())
            <div class="px-4 py-2 flex justify-between items-center">
                <span>total:</span>
                <span class="font-semibold">${{ $total }}</span>
            </div>
        @endif
    </div>
</div>
