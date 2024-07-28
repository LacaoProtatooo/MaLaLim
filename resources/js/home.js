import { ModalDisplay, AutoDisplay, showLoadingModal, hideLoadingModal } from './exportable.js';

$(document).ready(function() {
    let page = 1;
    let search = '';
    showLoadingModal();

    function popItems(page, search = '') {
        $.ajax({
            url: `/api/item?page=${page}&search=${search}`,
            type: 'GET',
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            success: function(response) {
                console.log(response);
                if (page === 1) {
                    $('#jewelry').empty();
                }
                const jewels = $('#jewelry');

                // Add Empty Results here

                response.jewelry.data.forEach(jewel => {

                    let jewelHTML = ``;
                if(response.auth)
                {
                     jewelHTML = `
                        <div class="col-span-1 bg-white p-4">
                            <div class="group my-10 flex w-full max-w-md flex-col overflow-hidden border border-gray-100 bg-white shadow-md rounded-lg">
                                <a class="relative flex h-80 overflow-hidden rounded-t-lg" href="#">
                                    <img class="absolute top-0 right-0 h-full w-full object-cover" src="${jewel.image_path}" alt="${jewel.name}" />
                                    <div class="absolute bottom-0 mb-2 flex w-full justify-center space-x-4">
                                        <div class="h-3 w-3 rounded-full border-2 border-white bg-white"></div>
                                        <div class="h-3 w-3 rounded-full border-2 border-white bg-transparent"></div>
                                        <div class="h-3 w-3 rounded-full border-2 border-white bg-transparent"></div>
                                    </div>
                                </a>
                                <div class="mt-2 px-6 pb-2">
                                    <a href="#">
                                        <h5 class="text-2xl tracking-tight text-gray-900">
                                            ${jewel.name}
                                        </h5>
                                    </a>
                                    <div class="mt-1 mb-2 flex items-center justify-between">
                                        <p>
                                            <span class="text-lg text-gray-700">${jewel.prices.price}</span>
                                        </p>
                                    </div>
                                    <div class="grid grid-cols-4 gap-2">
                                        <button class="viewProductBtn col-span-3 items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md" data-id="${jewel.id}">
                                            View Product
                                        </button>

                                            <button class="add2Fave col-span-1 items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md" data-id="${jewel.id}">
                                                <i class="fas fa-heart"></i>
                                            </button>


                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                }
                else{
                     jewelHTML = `
                    <div class="col-span-1 bg-white p-4">
                        <div class="group my-10 flex w-full max-w-md flex-col overflow-hidden border border-gray-100 bg-white shadow-md rounded-lg">
                            <a class="relative flex h-80 overflow-hidden rounded-t-lg" href="#">
                                <img class="absolute top-0 right-0 h-full w-full object-cover" src="${jewel.image_path}" alt="${jewel.name}" />
                                <div class="absolute bottom-0 mb-4 flex w-full justify-center space-x-4">
                                    <div class="h-3 w-3 rounded-full border-2 border-white bg-white"></div>
                                    <div class="h-3 w-3 rounded-full border-2 border-white bg-transparent"></div>
                                    <div class="h-3 w-3 rounded-full border-2 border-white bg-transparent"></div>
                                </div>
                            </a>
                            <div class="mt-6 px-6 pb-6">
                                <a href="#">
                                    <h5 class="text-2xl tracking-tight text-gray-900">
                                        ${jewel.name}
                                    </h5>
                                </a>
                                <div class="mt-3 mb-6 flex items-center justify-between">
                                    <p>
                                        <span class="text-lg text-gray-700">${jewel.prices.price}</span>
                                    </p>
                                </div>
                                <div class="grid grid-cols-4 gap-2">
                                    <button class="viewProductBtn col-span-3 items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md" data-id="${jewel.id}">
                                        View Product
                                    </button>



                                </div>
                            </div>
                        </div>
                    </div>
                `;

                }
                jewels.append(jewelHTML);
                });
                if (response.jewelry.data.length > 0) {
                    page++;
                    $(window).on('scroll', onScroll);
                }
                hideLoadingModal();
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
    }

    function onScroll() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
            $(window).off('scroll', onScroll);
            popItems(page, search);
        }
    }

    popItems(page, search);

    $('#searchButton').on('click', function() {
        search = $('#searchinput').val();
        popItems(1, search);
    });

    function onScroll() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
            $(window).off('scroll', onScroll);
            popItems(++page, search);
        }
    }

    $(window).on('scroll', onScroll);

    // For modal populate
    $(document).on('click', '.viewProductBtn', function() {
        showLoadingModal();
        const itemId = $(this).data('id');
        ModalDisplay(itemId);

    });

    // For modal item color & stock
    $(document).on('click', '.viewColorBtn', function() {
        const colId = $(this).data('id');
        const itemId = $(this).data('item-id');
        AutoDisplay(colId, itemId);

    });

    // Add to favorite
    $(document).on('click', '.add2Fave', function() {
        showLoadingModal();
        const itemId = $(this).data('id');
        $.ajax({
            url: '/api/user/fave',
            type: 'POST',
            data: {
                item_id: itemId,
                // _token: $('meta[name="csrf-token"]').attr('content')
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + sessionStorage.getItem('auth_token'),
            },
            success: function(response) {
                if (response.success) {
                    console.log(response.message);
                } else {
                    console.log('Error attaching item, ', response.message);
                }
                    hideLoadingModal();
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    });

    // Close modal
    $(window).on('click', function(event) {
        if ($(event.target).is('#myModal')) {
            $('#myModal').addClass('hidden');
            $('#colorsJewel').empty();
        }
    });

    $(document).on('click', '.nyaa', function() {
        var promid = $(this).data('id');
        showLoadingModal();
        popItems(1, promid);
        // console.log('Item ID:', itemId);

    });

});
