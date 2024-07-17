<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Home</title>
    @include('common.links')
</head>
<body>
    @include('common.header')
    @include('common.navbar')

    <section class="py-24 bg-white">
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
            <div class="main-data p-8 sm:p-14 bg-gray-50 rounded-3xl">
                <h2 class="text-center font-manrope font-semibold text-4xl text-black mb-16">Order History</h2>
                <div class="grid grid-cols-8 pb-9">
                    <div class="col-span-8 lg:col-span-4">
                        <p class="font-medium text-lg leading-8 text-yellow-300">Item </p>
                    </div>
                    <div class="col-span-1 max-lg:hidden">
                        <p class="font-medium text-lg leading-8 text-gray-600 text-center">price </p>
                    </div>
                    <div class="col-span-1 max-lg:hidden flex items-center justify-center">
                        <p class="font-medium text-lg leading-8 text-gray-600">Qty </p>
                    </div>
                    <div class="col-span-2 max-lg:hidden">
                        <p class="font-medium text-lg leading-8 text-gray-500"></p>
                    </div>
                </div>
                <div
                    class="box p-8 rounded-3xl bg-gray-100 grid grid-cols-8 mb-7 cursor-pointer transition-all duration-500 hover:bg-yellow-100 max-lg:max-w-xl max-lg:mx-auto">

                    <div class="col-span-8 sm:col-span-4 lg:col-span-1 sm:row-span-4 lg:row-span-1">
                        <img src="https://pagedone.io/asset/uploads/1705474950.png" alt="earbuds image" class="max-lg:w-auto max-sm:mx-auto">
                    </div>
                    <div
                        class="col-span-8 sm:col-span-4 lg:col-span-3 flex h-full justify-center pl-4 flex-col max-lg:items-center">
                        <h5 class="font-manrope font-semibold text-2xl leading-9 text-black mb-1 whitespace-nowrap">
                            Apple Airpods Pro</h5>
                        <p class="font-normal text-base leading-7 text-gray-600 max-md:text-center">White</p>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center">
                        <p class="font-semibold text-xl leading-8 text-black">$249.99</p>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center ">
                        <p class="font-semibold text-xl leading-8 text-indigo-600 text-center">2</p>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2 flex items-center justify-center ">
                    <button class="btn">Buy Again</button>
                    </div>
                </div>

                <div
                    class="box p-8 rounded-3xl bg-gray-100 grid grid-cols-8 mb-7 cursor-pointer transition-all duration-500 hover:bg-yellow-100 max-lg:max-w-xl max-lg:mx-auto">

                    <div class="col-span-8 sm:col-span-4 lg:col-span-1 sm:row-span-4 lg:row-span-1">
                        <img src="https://pagedone.io/asset/uploads/1705474950.png" alt="earbuds image" class="max-lg:w-auto max-sm:mx-auto">
                    </div>
                    <div
                        class="col-span-8 sm:col-span-4 lg:col-span-3 flex h-full justify-center pl-4 flex-col max-lg:items-center">
                        <h5 class="font-manrope font-semibold text-2xl leading-9 text-black mb-1 whitespace-nowrap">
                            Apple Airpods Pro</h5>
                        <p class="font-normal text-base leading-7 text-gray-600 max-md:text-center">White</p>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center">
                        <p class="font-semibold text-xl leading-8 text-black">$249.99</p>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center ">
                        <p class="font-semibold text-xl leading-8 text-indigo-600 text-center">2</p>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2 flex items-center justify-center ">
                    <button class="btn">Buy Again</button>
                    </div>
                </div>

                <div
                    class="box p-8 rounded-3xl bg-gray-100 grid grid-cols-8 mb-7 cursor-pointer transition-all duration-500 hover:bg-yellow-100 max-lg:max-w-xl max-lg:mx-auto">

                    <div class="col-span-8 sm:col-span-4 lg:col-span-1 sm:row-span-4 lg:row-span-1">
                        <img src="https://pagedone.io/asset/uploads/1705474950.png" alt="earbuds image" class="max-lg:w-auto max-sm:mx-auto">
                    </div>
                    <div
                        class="col-span-8 sm:col-span-4 lg:col-span-3 flex h-full justify-center pl-4 flex-col max-lg:items-center">
                        <h5 class="font-manrope font-semibold text-2xl leading-9 text-black mb-1 whitespace-nowrap">
                            Apple Airpods Pro</h5>
                        <p class="font-normal text-base leading-7 text-gray-600 max-md:text-center">White</p>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center">
                        <p class="font-semibold text-xl leading-8 text-black">$249.99</p>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center ">
                        <p class="font-semibold text-xl leading-8 text-indigo-600 text-center">2</p>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2 flex items-center justify-center ">
                    <button class="btn">Buy Again</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('common.footer')
</body>
</html>
