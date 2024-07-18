$(document).ready(function() {
    let page = 1;
    let search = '';

    function popItems(page, search = '') {
        $.ajax({
            url: `/api/item?page=${page}&search=${search}`,
            type: 'GET',
            success: function(response) {
                if (page === 1) {
                    $('#jewelry').empty();
                }
                const jewels = $('#jewelry');
                response.data.forEach(jewel => {
                    jewels.append(`
                        <div class="col-span-1 bg-white p-4">
                            <div class="group my-10 flex w-full max-w-md flex-col overflow-hidden border border-gray-100 bg-white shadow-md rounded-lg">
                                <a class="relative flex h-80 overflow-hidden rounded-t-lg" href="#">
                                    <img class="absolute top-0 right-0 h-full w-full object-cover" src="" />
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
                                        <button class="col-span-3 items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md" type="submit">
                                            View item
                                        </button>
                                        <button class="col-span-1 flex items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md" type="submit">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
        $(window).on('scroll', onScroll);
    }

    // Call the function on document ready or attach it to an event
    popItems(page, search);

    // Optionally, you can attach the function to a button click or scroll event
    $('#searchButton').on('click', function() {
        search = $('#searchinput').val();
        popItems(1, search);
    });

    function onScroll() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
            $(window).off('scroll', onScroll); // Turn off scroll event to prevent multiple calls
            popItems(++page, search); // Fetch next page of products
        }
    }

    $(window).on('scroll', onScroll);
});
