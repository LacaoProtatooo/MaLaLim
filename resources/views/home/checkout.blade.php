<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Home</title>
    @include('common.links')
    @vite('resources/js/checkout.js')
</head>
<body>
@include('common.header')
@include('common.navbar')

    <div class="font-[sans-serif] bg-white p-4">
      <div class="md:max-w-5xl max-w-xl mx-auto ma">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div class="lg:col-span-2 max-md:order-1">
            <h2 class="text-3xl font-extrabold text-gray-800">Checkout</h2>
            <p class="text-gray-800 text-sm mt-4">Complete your transaction swiftly and securely with our easy-to-use checkout process.</p>

            <form class="mt-8 max-w-lg">
              <div class="grid gap-4">
                <div>
                  <input id = "CusN" type="text" placeholder="Customer Name"
                    class="px-4 py-3.5 bg-gray-100 text-gray-800 w-full text-sm border rounded-md focus:border-purple-500 focus:bg-transparent outline-none" />
                </div>

                <div class="flex bg-gray-100 border rounded-md focus-within:border-purple-500 focus-within:bg-transparent overflow-hidden">
                  <input type="text" placeholder="Address"
                  id = "CusA" class="px-4 py-3.5 text-gray-800 w-full text-sm outline-none bg-transparent" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <select id = "selPay" class="px-4 py-3.5 bg-gray-100 text-gray-800 w-full text-sm border rounded-md focus:border-purple-500 focus:bg-transparent outline-none">
                        {{--  --}}
                    </select>
                  </div>
                    <div>
                    <select id = "selCour" class="px-4 py-3.5 bg-gray-100 text-gray-800 w-full text-sm border rounded-md focus:border-purple-500 focus:bg-transparent outline-none">
                      {{--  --}}
                    </select>
                    </div>
                </div>
              </div>

              <button type="button" class="mt-8 w-full py-3.5 text-sm bg-yellow-400 text-white rounded-md hover:bg-yellow-600 tracking-wide completeButt">Complete Order </button>
            </form>
          </div>

            <div class="bg-yellow-100 p-6 rounded-md w-full">
            <table class="mt-8 w-full text-lg">
              <tbody id="JewelsKUH">
              <!-- Dynamic rows will be appended here -->
              </tbody>
              <tbody>
              <tr class="border border-gray-600">
                <td id = "Cour" class="text-left px-4 py-2"></td>
                <td class="px-4 py-2">-></td>
                <td id = "CourPr" class="text-right px-4 py-2"></td>
              </tr>
              <tr class="border border-gray-600">
                <td class="px-4 py-2">Total Discount</td>
                <td class="px-4 py-2"></td>
                <td id = "DC" class="text-right px-4 py-2"></td>
              </tr>
              <tr class="border border-gray-600">
                <td class="text-left font-bold border-t-2 pt-4 px-4 py-2">Total</td>
                <td class="border-t-2 pt-4 px-4 py-2"></td>
                <td id = "OverallTotal" class="text-right border-t-2 pt-4 px-4 py-2"></td>
              </tr>
              </tbody>
            </table>
            </div>

            </div>
            </div>
            </div>
            
    @include('common.footer')
</body>
</html>
