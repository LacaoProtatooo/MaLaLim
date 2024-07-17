@foreach ($data as $jewel)
<form action="your_action_url" method="POST">
        <div class="col-span-1 bg-white p-4">
                <div class="group my-10 flex w-full max-w-md flex-col overflow-hidden border border-gray-100 bg-white shadow-md rounded-lg">
                        <a class="relative flex h-80 overflow-hidden rounded-t-lg" href="#">
                            <img class="absolute top-0 right-0 h-full w-full object-cover" src="{{ $jewel->image_path }}" />
                            <div class="absolute bottom-0 mb-4 flex w-full justify-center space-x-4">
                                <div class="h-3 w-3 rounded-full border-2 border-white bg-white"></div>
                                <div class="h-3 w-3 rounded-full border-2 border-white bg-transparent"></div>
                                <div class="h-3 w-3 rounded-full border-2 border-white bg-transparent"></div>
                            </div>
                        </a>
                        <div class="mt-6 px-6 pb-6">
                            <a href="#">
                                <h5 class="text-2xl tracking-tight text-gray-900" id = "">
                                  {{ $jewel->name }}
                                </h5>
                            </a>
                            <div class="mt-3 mb-6 flex items-center justify-between">
                                <p>

                                    <span class="text-lg text-gray-700 " id = "price">${{ $jewel->prices->price }}</span>
                                </p>
                            </div>
                            <div class="grid grid-cols-4 gap-2">


                                    <button class="col-span-3 items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md" type = "submit">
                                        View item
                                    </button>
                                    <button class="col-span-1 flex items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md" type = "submit">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>

@endforeach
