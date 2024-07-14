<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    @include('common.header')

    <div class="font-[sans-serif] bg-white p-4">
      <div class="md:max-w-5xl max-w-xl mx-auto">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div class="lg:col-span-2 max-md:order-1">
            <h2 class="text-3xl font-extrabold text-gray-800">Checkout</h2>
            <p class="text-gray-800 text-sm mt-4">Complete your transaction swiftly and securely with our easy-to-use payment process.</p>

            <form class="mt-8 max-w-lg">
              <div class="grid gap-4">
                <div>
                  <input type="text" placeholder="Customer Name"
                    class="px-4 py-3.5 bg-gray-100 text-gray-800 w-full text-sm border rounded-md focus:border-purple-500 focus:bg-transparent outline-none" />
                </div>

                <div class="flex bg-gray-100 border rounded-md focus-within:border-purple-500 focus-within:bg-transparent overflow-hidden">
                  <input type="number" placeholder="Card Number"
                    class="px-4 py-3.5 text-gray-800 w-full text-sm outline-none bg-transparent" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <input type="address" placeholder="Address"
                      class="px-4 py-3.5 bg-gray-100 text-gray-800 w-full text-sm border rounded-md focus:border-purple-500 focus:bg-transparent outline-none" />
                  </div>
                  <div>
                    <input type="Courier" placeholder="Courier"
                      class="px-4 py-3.5 bg-gray-100 text-gray-800 w-full text-sm border rounded-md focus:border-purple-500 focus:bg-transparent outline-none" />
                  </div>
                </div>
              </div>

              <button type="button" class="mt-8 w-full py-3.5 text-sm bg-yellow-400 text-white rounded-md hover:bg-yellow-600 tracking-wide">Pay  </button>
            </form>
          </div>

          <div class="bg-yellow-100 p-6 rounded-md">
            <h2 class="text-3xl font-extrabold text-gray-800">$240.00</h2>

            <ul class="text-gray-800 mt-8 space-y-4">
              <li class="flex flex-wrap gap-4 text-sm">Earings<span class="ml-auto font-bold">$150.00</span></li>
              <li class="flex flex-wrap gap-4 text-sm">Ring <span class="ml-auto font-bold">$90.00</span></li>
              <li class="flex flex-wrap gap-4 text-sm">Discount <span class="ml-auto font-bold">$10.00</span></li>
              <li class="flex flex-wrap gap-4 text-sm font-bold border-t-2 pt-4">Total <span class="ml-auto">$240.00</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    @include('common.footer')
</body>
</html>
