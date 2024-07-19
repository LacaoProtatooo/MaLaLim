<!-- Trigger Button -->

<!-- Modal -->
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

                    <div class="flex gap-4">
                        <button type="button" class="min-w-[200px] px-4 py-3 bg-yellow-300 hover:bg-yellow-400 text-white text-sm font-semibold rounded-md">Buy now</button>
                        <button type="button" class="min-w-[200px] px-4 py-2.5 border border-gray-800 bg-transparent hover:bg-gray-50 text-gray-800 text-sm font-semibold rounded-md">Add to cart</button>
                    </div>
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


            </div>
        </div>
    </div>
</div>
