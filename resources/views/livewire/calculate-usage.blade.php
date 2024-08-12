<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>products</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    @vite('resources/css/app.css')
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css.style.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/tailwind.min.css">
</head>

<body>
<div>
    @livewire('nav-component')

    <div class="container mx-auto p-6 flex">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Date Selection Form for {{ Auth::user()->name }}</h2>
        <form method="post" action = "{{route('calc.post')}}">
            @csrf
            <div class="mb-4">
                <label for="date1" class="block text-sm font-medium text-gray-700">Date start</label>
                <input type="date" id="date1" name="date1" wire:model="date1" class="mt-1 block w-30 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="date2" class="block text-sm font-medium text-gray-700">Date end</label>
                <input type="date" id="date2" name="date2" wire:model="date2" class="mt-1 block w-30 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="text-center">
                <button type="submit" class="l bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">Submit</button>
            </div>
        </form>
        <ul>
            <li><p class="mt-4 text-center text-gray-600">total: {{$totalUsd}} USD</p></li>
            <li><p class="mt-4 text-center text-gray-600">dollar rate: {{$rateUsd}} </p></li>
        </ul>
        <hr>
    </div>


    <div class="w-1/3 ml-6 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">My payments list</h2>
        <ul class="divide-y divide-gray-200">
            @foreach($payments as $payment)
            <li class="py-4 flex items-center">
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">invoice {{$payment->invoice_id}}</h3>
                    <p class="text-gray-500">payment_date: {{ $payment->payment_date }}</p>
                    <p class="text-gray-500">amount: {{$payment->amount}}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

        <div class="w-1/3 ml-6 bg-white p-6 rounded-lg shadow-lg">

                <livewire:main-component :items="$items, $rateUsd" />
    </div>
    </div>


    @livewire('design-component')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    @livewireScripts
</div>
</body>

</html>
