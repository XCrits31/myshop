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

    @vite('resources/css/app.css')
    <!-- Customized Bootstrap Stylesheet -->

    <!-- Template Stylesheet -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css.style.css" rel="stylesheet">
    @livewireStyles
</head>

<body>
<div>
    @livewire('nav-component')

<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold my-4">Cart</h2>
    @if(Cart::count()>0)
    <table class="table-auto w-full mb-4">
        <tbody>
        @foreach (Cart::content() as $product)
            <tr>
                <td class="border px-4 py-2">{{ $product->model->id }}</td>
                <td class="border px-4 py-2">{{ $product->model->name }}</td>
                <td class="border px-4 py-2">{{ $product->model->price }}</td>
                <td class="border px-4 py-2">
                        <div class="flex items-center space-x-2">
                            <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2.5 rounded focus:outline-none " wire:click.prevent="qtydown('{{$product->rowId}}')">-</a>
                            <span class="font-bold text-xl"> {{$product->qty}}</span>
                            <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2.5 rounded focus:outline-none "  wire:click.prevent="qtyup('{{$product->rowId}}')">+</a>
                        </div>
                </td>
                <td class="border px-4 py-2">{{ $product->subtotal }}</td>
                <td class="border px-2 py-2 text-center">
                    <a href="#" class="no-underline" wire:click.prevent="delete('{{ $product->rowId }}')"> <i class="bi bi-trash" style="font-size: 0.75rem;"></i></a>
                </td>

            </tr>

        @endforeach
        <tr>
            <td class="border px-4 py-2">Total : {{ Cart::total() }}</td>
            <td class="border px-2 py-2 text-center">
                <form action="{{ route('cart.destroy',$product->rowId ) }}" method="POST">
                    @csrf
                    <button type="submit">Empty Cart</button>
                </form>
            </td>
        </tr>
        </tbody>

    </table>
    @else
    <p>No item in Cart</p>
    @endif
</div>
    @if (session('success'))
            <div id="myModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Done</h3>
                        <div class="mt-2 px-7 py-3">
                            <p class="text-sm text-gray-500"> {{ session('success') }}</p>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button id="okBtn" onclick="closeModal()" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                                ОК
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    @endif



<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                        <h5 class="mb-3">Skilled Instructors</h5>
                        <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                        <h5 class="mb-3">Online Classes</h5>
                        <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-home text-primary mb-4"></i>
                        <h5 class="mb-3">Home Projects</h5>
                        <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                        <h5 class="mb-3">Book Library</h5>
                        <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="img/about.jpg" alt="" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                <h1 class="mb-4">Welcome to eLEARNING</h1>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onload = function() {
            const flashMessage = document.getElementById('myModal');
            flashMessage.classList.remove('hidden');

            setTimeout(() => {
                flashMessage.classList.add('hidden')
            }, 2000);
        };
        function closeModal() {
            document.getElementById("myModal").classList.add("hidden");
        }

        function openModal() {
            document.getElementById("myModal").classList.remove("hidden");
        }

    </script>

</div>
</body>

</html>
