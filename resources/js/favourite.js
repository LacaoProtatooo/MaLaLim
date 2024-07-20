import { ModalDisplay, AutoDisplay } from './exportable.js';

$(document).ready(function() {
    function popFave() {
        $.ajax({
            url: `api/fetchingFave`,
            type: `GET`,
            success: function(response) {
                console.log('API Response:', response); // Log the entire response for debugging

                const jews = $('#popJEW');
                jews.empty(); // Clear existing content before adding new

                // Check if response.data is an array
                    response.data.forEach(item => {
                        const jewHTML =
                        `
                         <div

                            class="box p-8 rounded-3xl bg-gray-100 grid grid-cols-8 mb-7 cursor-pointer transition-all duration-500 hover:bg-yellow-100 max-lg:max-w-xl max-lg:mx-auto faveButt"
                            data-id="${item.id}"
                            {{-- role="button" --}}
                            tabindex="0">
                            <div class="col-span-8 sm:col-span-4 lg:col-span-1 sm:row-span-4 lg:row-span-1">
                                <img src="${item.image_url}" alt="${item.name}" class="max-lg:w-auto max-sm:mx-auto">
                            </div>
                            <div class="col-span-8 sm:col-span-4 lg:col-span-3 flex h-full justify-center pl-4 flex-col max-lg:items-center">
                                <h5
                                id="prodName-${item.id}"
                                class="font-manrope font-semibold text-2xl leading-9 text-black mb-1 whitespace-nowrap">
                                    ${item.name}</h5>
                            </div>

                            <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center">
                                <p
                                id="prodPrice"
                                class="font-semibold text-xl leading-8 text-black">${'₱' + item.prices.price}</p>
                            </div>

                            <div class="col-span-8 sm:col-span-4 lg:col-span-3 flex items-center justify-center space-x-4">
                                <button class="btn delfaveButt" data-id="${item.id}">Remove</button>
                            </div>
                        </div>
                        `;
                        jews.append(jewHTML);
                    });

            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch data:', error);
            }
        });
    }
    // Populate Fave

    popFave();

    // Modal Display

    $(document).on('click', '.faveButt', function() {
        const itemId = $(this).data('id');
        ModalDisplay(itemId);
    });
});
