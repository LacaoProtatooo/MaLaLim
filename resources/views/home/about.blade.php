<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaLaLim</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @include('common.links')
</head>
<body class="bg-yellow-50">
@include('common.header')

<!-- <button class="btn" onclick="my_modal_10.showModal()">open modal</button>
<dialog id="my_modal_10" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    @include('common.newmodal')
  </div>
</dialog>  -->


<div class="card lg:card-side shadow-xl rounded-md bg-base-100">
  <figure><img src="../storage/jewelryabt.jpg" alt="Album"/></figure>
  <div class="card-body rounded">
  <section class="">
        <div class="py-12 bg-white rounded-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="font-heading mb-4 bg-orange-100 px-4 py-2 rounded-lg md:w-64 md:mx-auto text-xs font-semibold tracking-widest text-black uppercase title-font">
                        Choose MaLaLim
                    </h2>
                    <p class="font-heading mt-2 text-3xl leading-8 font-semibold tracking-tight text-gray-900 sm:text-4xl">
                        Jewelry with deep passion, care, and effort. MaLaLim Jewelry
                    </p>
                    <p class="mt-4 max-w-2xl text-lg text-gray-500 lg:mx-auto text-justify">
                        MaLaLim Jewelry is a jewelry store that offers a wide range of jewelry products. We are committed to providing our customers with the best quality jewelry products.
                    </p>
                </div>
                <div class="mt-10">
                    <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                                </div>
                                <p class="font-heading ml-16 text-lg leading-6 font-bold text-gray-700">Made with Care</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500 text-justify">
                            Each piece of MaLaLim Jewelry is meticulously crafted with attention to detail and passion. Our artisans pour their heart and soul into every design, ensuring you receive jewelry that's not only beautiful but also made with the utmost care.
                            </dd>
                        </div>
                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                                </div>
                                <p class="font-heading ml-16 text-lg leading-6 font-bold text-gray-700">Looks expensive, but affordable</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500 text-justify">
                            Discover exquisite jewelry that exudes luxury without breaking the bank. At MaLaLim Jewelry, we believe everyone deserves to shine with elegance, offering you premium pieces at accessible prices.
                            </dd>
                        </div>
                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                                </div>
                                <p class="font-heading ml-16 text-lg leading-6 font-bold text-gray-700">Wide Selections</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500 text-justify">
                            Explore a vast array of jewelry that caters to every taste and occasion. From classic to contemporary, MaLaLim Jewelry offers a wide selection of designs, ensuring you'll find the perfect piece to complement your style.                            </dd>
                        </div>
                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                                </div>
                                <p class="font-heading ml-16 text-lg leading-6 font-bold text-gray-700">Shipping anytime, anywhere</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500 text-justify">
                            No matter where you are in the world, MaLaLim Jewelry brings elegance to your doorstep. Enjoy reliable and timely shipping to any location, making it easy for you to adorn yourself with our stunning pieces anytime you desire.
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>
  </div>
</div>

    @include('common.footer')
</body>
</html>