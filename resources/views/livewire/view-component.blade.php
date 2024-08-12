<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>products</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <!-- Template Stylesheet -->
    @vite('resources/css/app.css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css.style.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/tailwind.min.css">
</head>

<body>
<div>
    @livewire('nav-component')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold my-4">{{ $category->name }}</h2>
    @if($category->products != '[]')
    <table class="table-auto w-full mb-4">
        <tbody>
        <tr>
            <td class="border px-4 py-2">name</td>
            <td class="border px-4 py-2">price</td>
            <td class="border px-4 py-2">discount</td>
            <td class="border px-4 py-2">subtotal price</td>
        </tr>

        @foreach ($category->products as $product)
            <tr>
                <td class="border px-4 py-2">{{ $product->name }}</td>
                <td class="border px-4 py-2">{{ $product->price }}</td>
                <td class="border px-4 py-2">{{ $product->discount}}%</td>
                <td class="border px-4 py-2">{{number_format(($product->price - ($product->price * $product->discount / 100.0)), 2)}}</td>
                <td class="border px-2 py-2 text-center">
                    <a href="#" class="no-underline" wire:click.prevent="store({{ $product->id }}, '{{ $product->name}}', {{ $product->price }}, {{$product->discount}}, {{Auth::user()->id }})"> <i class="bi bi-cart" style="font-size: 0.75rem;"></i></a>
                </td>
            </tr>
        @endforeach
            @else
            <p>{{$category->name}} is empty</p>
            @endif
        </tbody>
    </table>
</div>

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Discounts list</h1>
            <ul class="divide-y divide-gray-200">
                @foreach($discount as $disc)
                <li class="py-4 flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="ml-4">
                        <h5 class="text-lg font-medium text-gray-900">Discount  {{$disc->id}}</h5>
                        <p class="text-gray-500">{{$disc->description}}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="@this.on('hide-success-message', () => { setTimeout(() => show = false, 3000); })" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @livewire('design-component')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</div>
</body>

</html>
