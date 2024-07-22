import { ModalDisplay, deTach, AutoDisplay } from './exportable.js';

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
                        <div class="grid grid-cols-4 gap-4 mb-7">
                                <!-- Main Content Box -->
                                <div class="box p-8 rounded-3xl bg-gray-100 col-span-3 cursor-pointer transition-all duration-500 hover:bg-yellow-100 max-lg:max-w-xl max-lg:mx-auto faveButt" data-id="${item.id}" tabindex="0">
                                    <div class="flex items-center">
                                        <!-- Image Container -->
                                        <div class="flex-shrink-0 col-span-1">
                                            <img src="${item.image_url}" alt="${item.name}" class="max-lg:w-auto max-sm:mx-auto">
                                        </div>
                                        <!-- Text Container -->
                                        <div class="flex-1 flex flex-col justify-center pl-4">
                                            <div class="flex items-center justify-between">
                                                <h5 id="prodName-${item.id}" class="font-manrope font-semibold text-2xl leading-9 text-black mb-1 whitespace-nowrap">
                                                    ${item.name}
                                                </h5>
                                                <p id="prodPrice" class="font-semibold text-xl leading-8 text-black">
                                                    ${'₱' + item.prices.price}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="col-span-1 flex items-center justify-center">
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

    $(document).on('click', '.delfaveButt', function() {
        const itemId = $(this).data('id');
        deTach(itemId);
        popFave();
    });

    $(document).on('click', '.viewColorBtn', function() {
        const colId = $(this).data('id');
        const itemId = $(this).data('item-id');
        AutoDisplay(colId, itemId);

    });


});
