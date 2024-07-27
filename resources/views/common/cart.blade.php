@vite('resources/js/cart.js')
<section class="h-screen py-8 sm:py-16 lg:py-20">
  <div class="mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-center">
      <h1 class="text-2xl font-semibold text-gray-900">Your Cart</h1>
    </div>

    <div class="mx-auto mt-8 max-w-md md:mt-12">
      <div class="rounded-3xl bg-white shadow-lg">
        <div class="px-4 py-6 sm:px-8 sm:py-10">
          <div class="flow-root">
            <ul id = "cartItems" class="-my-8 ">
                {{--  --}}
            </ul>
          </div>

          <div class="mt-6 flex items-center justify-between">
            <p class="text-sm font-medium text-gray-900">Sub-Total</p>
            <p id = "subtot" class="text-2xl font-semibold text-gray-900"></p>
          </div>

          <div class="mt-6 text-center">
            <button type="button" onclick="window.location.href='{{ route('checkout') }}'" class="group inline-flex w-full items-center justify-center rounded-md bg-yellow-300 hover:bg-yellow-400 hover:text-white px-6 py-4 text-lg font-semibold CheckCheck">
                Place Order
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
