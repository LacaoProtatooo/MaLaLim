<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Home</title>
    @include('common.links')
    @vite('resources/js/order.js',)
</head>
<body class="bg-gray-100">
    @include('common.header')
    @include('common.navbar')

    <section class="py-24 bg-white">
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
            <div class="main-data p-8 sm:p-14 bg-gray-50 rounded-3xl">
                <h2 class="text-center font-manrope font-semibold text-4xl text-black mb-16">My Orders</h2>
                <div class="grid grid-cols-8 pb-9">
                    <div class="col-span-8 lg:col-span-4">
                        <p class="font-medium text-lg leading-8 text-yellow-300">Order # </p>
                    </div>

                    <div class="col-span-1 max-lg:hidden">
                        <p class="font-medium text-lg leading-8 text-gray-600 text-center">Order Date </p>
                    </div>
                    <div class="col-span-1 max-lg:hidden flex items-center justify-center">
                        <p class="font-medium text-lg leading-8 text-gray-600">Status </p>
                    </div>
                    <div class="col-span-2 max-lg:hidden">
                        <p class="font-medium text-lg leading-8 text-gray-500">Payment Method </p>
                    </div>
                </div>
                    <div id = "urdir">
                        {{--  --}}
                    </div>

            </div>



            </div>
        </div>
    </section>
    @include('common.newmodal');

    @include('common.footer')
</body>
</html>
