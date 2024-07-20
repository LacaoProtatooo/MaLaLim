<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Home</title>
    @include('common.links')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/favourite.js',)
</head>
<body>
    @include('common.header')
    @include('common.navbar')

    <section class="py-24 bg-white">
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
            <div class="main-data p-8 sm:p-14 bg-gray-50 rounded-3xl">
                <h2 class="text-center font-manrope font-semibold text-4xl text-black mb-16">Favourites</h2>
                <div class="grid grid-cols-8 pb-9">
                    <div class="col-span-8 lg:col-span-4">
                        <p class="font-medium text-lg leading-8 text-yellow-300">Jewelries: </p>
                    </div>

                </div>
                <div
                    id = "popJEW"
                    >

                </div>


                @include('common.productview');


            </div>
        </div>
    </section>

    @include('common.footer')
</body>
</html>
