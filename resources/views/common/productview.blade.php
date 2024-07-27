<!-- Trigger Button -->

<!-- Modal -->
@vite('resources/js/cart.js')
<div id="myModal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full overflow-hidden relative">
            <!-- Close Button -->
            <button onclick="document.getElementById('myModal').classList.add('hidden'); document.getElementById('colorsJewel').innerHTML = ''; document.getElementById('stonkss').innerHTML = '';" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 focus:outline-none" aria-label="Close">                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-4">
                <!-- Image Section -->
                <div class="flex flex-col items-center">
                    <img src="../storage/r-3-2.png" alt="Product" class="w-full h-auto rounded-md object-cover" />

                    <div class="flex flex-wrap gap-4 justify-center mt-4">
                        <img src="../storage/r-3-2.png" alt="Product1" class="w-16 cursor-pointer rounded-md hover:outline focus:outline" />
                        <img src="../storage/r-3-2.png" alt="Product2" class="w-16 cursor-pointer rounded-md hover:outline focus:outline" />
                        <img src="../storage/r-3-2.png" alt="Product3" class="w-16 cursor-pointer rounded-md hover:outline focus:outline" />
                        <img src="../storage/r-3-2.png" alt="Product4" class="w-16 cursor-pointer rounded-md hover:outline focus:outline" />
                    </div>
                </div>

                <!-- Details Section -->
                <div class="flex flex-col">
                    <div class="flex flex-col mb-8">
                        <h2 id = "jewelryName" class="text-2xl font-bold text-gray-800"></h2>
                        <p id = "classi" class="text-sm text-gray-500 mt-2"></p>
                    </div>

                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex flex-col">
                            <h2 id = "salapi" class="text-gray-800 text-4xl font-bold"></h2>
                            <p id = "stonkss" class="text-sm text-gray-500 mt-2"></p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800">Available Colors:</h3>
                        <div id="colorsJewel" class="flex flex-wrap gap-4 mt-4">

                        </div>
                    </div>
                    @if (Auth::check())
                    <div class="flex gap-4">
                        <button type="button" class="min-w-[200px] px-4 py-3 bg-yellow-300 hover:bg-yellow-400 text-white text-sm font-semibold rounded-md cartcart">
                            Add to cart
                        </button>
                    </div>
                @else
                    <div class="flex gap-4">
                        <button type="button" class="min-w-[200px] px-4 py-3 bg-yellow-300 text-white text-sm font-semibold rounded-md flex items-center" disabled>
                            <!-- SVG Cart Icon -->
                            <div class = "mr-5">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m634-440-81-80h69l110-200H353l-80-80h525q23 0 35.5 19.5t.5 42.5L692-482q-11 20-28 31t-30 11ZM280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm540 52L566-280H304q-44 0-67-37.5t-3-78.5l42-86-72-162L28-820l56-56L876-84l-56 56ZM486-360l-80-80h-62l-40 80h182Zm136-160h-69 69Zm58 440q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80Z"/></svg>

                            </div>
                            Please Log in
                        </button>
                    </div>

                @endif


                </div>
            </div>

            <div class="p-4">
                <ul class="flex border-b">
                    <li class="text-gray-800 font-semibold text-sm bg-gray-100 py-3 px-8 border-b-2 border-gray-800 cursor-pointer transition-all">Description</li>
                </ul>

                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800">About The Product</h3>
                    <p id = "description" class="text-sm text-gray-500 mt-4">Elevate your casual style with our premium men's t-shirt. Crafted for comfort and designed with a modern fit, this versatile shirt is an essential addition to your wardrobe. The soft and breathable fabric ensures all-day comfort, making it perfect for everyday wear. Its classic crew neck and short sleeves offer a timeless look.</p>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800">Where is it made from?</h3>
                    <p id = "materialdesc" class="text-sm text-gray-500 mt-4"></p>
                </div>


            </div>
        </div>
    </div>
</div>
