@vite('resources/js/cart.js')
<div class="navbar flex justify-between items-center p-4">

    <div class="flex">
        <button class="btn mr-3 openMod" onclick="my_modal_3.showModal()">
            <img src="../storage/cart.png" alt="Shopping Cart" style="width: 20px; height: 20px;" />
        </button>

        {{-- SHOPPING CARD MODAL --}}
        <dialog id="my_modal_3" class="modal">
            <div class="modal-box">
                <form method="dialog" class="">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                @include('common.cart')
            </div>
        </dialog>

        <button class="btn mr-3" onclick="window.location.href='{{ url('favorites') }}'">Favorites</button>
    </div>

    <div class="relative p-3 border border-white rounded-lg w-full max-w-lg">
        <input type="text" id="searchinput" class="rounded-md p-3 w-full" placeholder="Search Jewelry | Categories | Brand">

        <button type="submit" id="searchButton" class="absolute right-6 top-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </button>
    </div>

</div>
