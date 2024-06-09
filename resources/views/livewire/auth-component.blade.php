
<div x-data="{ open: false }" @click.away="open = false" class="relative">
    <div class="container dropdown">
        <a href="#" class="no-underline text-white text-lg font-semibold" data-bs-toggle="dropdown"><h5>{{ Auth::user()->name }}</h5></a>
        <div class="dropdown-menu fade-down m-0">
            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">profile</a>
            <a href="{{route('calc')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">payment sum</a>
            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">logout</button>
            </form>
        </div>
    </div>
</div>
