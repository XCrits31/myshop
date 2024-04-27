<div class="container dropdown">
    <a href="#" class="no-underline text-blue-300 text-lg font-semibold" data-bs-toggle="dropdown"><h5>Pages</h5></a>
    <div class="dropdown-menu fade-down m-0">
        @foreach($all as $smth)
            <a href="{{ route('view.second', ['id' => $smth->id]) }}" class="dropdown-item">{{$smth->name}}</a>
        @endforeach
    </div>
</div>
