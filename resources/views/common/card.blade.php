@foreach ($jewel as $jew)

        <div class="col-span-1 bg-white p-4">
                <div class="group my-10 flex w-full max-w-md flex-col overflow-hidden border border-gray-100 bg-white shadow-md rounded-lg">
                        <a class="relative flex h-80 overflow-hidden rounded-t-lg" href="#">
                            <img class="absolute top-0 right-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1072&q=80" alt="product image" />
                            <div class="absolute bottom-0 mb-4 flex w-full justify-center space-x-4">
                                <div class="h-3 w-3 rounded-full border-2 border-white bg-white"></div>
                                <div class="h-3 w-3 rounded-full border-2 border-white bg-transparent"></div>
                                <div class="h-3 w-3 rounded-full border-2 border-white bg-transparent"></div>
                            </div>
                            <div class="absolute -right-16 bottom-0 mr-2 mb-4 space-y-2 transition-all duration-300 group-hover:right-0">
                                <button class="flex h-12 w-12 items-center justify-center bg-gray-900 text-white transition hover:bg-gray-700 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </a>
                        <div class="mt-6 px-6 pb-6">
                            <a href="#">
                                <h5 class="text-2xl tracking-tight text-gray-900">{{ $jew->name}} - @foreach ($jew->colors as $color)
                                    {{ $color }}|
                                @endforeach
                                <br> Materials Used:

                                    @foreach ($jew->materials as $mat)
                                        {{$mat->material }} |
                                     @endforeach
                                </h5>
                            </a>
                            <div class="mt-3 mb-6 flex items-center justify-between">
                                <p>
                                    <span class="text-4xl font-bold text-gray-900">$79</span>
                                    <span class="text-lg text-gray-700 line-through">$99</span>
                                </p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="flex-1 items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md">
                                    Buy Now
                                </button>
                                <button class="flex-1 items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md">
                                    View Item
                                </button>
                            </div>
                        </div>
                    </div>
            </div>

@endforeach
