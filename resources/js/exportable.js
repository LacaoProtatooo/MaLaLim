export function ModalDisplay(itemId) {
    $.ajax({
        url: `api/item/description/${itemId}`,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                const JewelColors = $('#colorsJewel');
                JewelColors.empty();
                $('#jewelryName').text(response.data.name);
                $('#description').text(response.data.description);
                $('#classi').text(response.data.classification.classification);
                $('#salapi').text('₱' + response.data.prices.price);
                // console.log(response.data);
                response.data.materials.forEach(mat=>{
                    $('#materialdesc').html(mat.material + ':' + '<br>' + mat.description + '<br>');
                });

                response.data.colors.forEach(col => {
                    const colHTML = `
                        <button class="viewColorBtn col-span-3 flex items-center justify-center px-4 py-2 text-lg border-black text-black bg-gray-100 transition hover:bg-yellow-200 hover:text-black rounded-md"
                            data-id="${col.id}"
                            data-item-id="${itemId}">
                            ${col.color}
                        </button>
                    `;
                    JewelColors.append(colHTML);
                });
                if (response.data.colors.length === 1) {
                    const colId = response.data.colors[0].id;
                    AutoDisplay(colId, itemId);
                }
                const modal = $('#myModal');
                modal.removeClass('hidden');
            } else {
                console.error('Item not found:', response.message);
            }
        },
        error: function(xhr) {
            console.error('An error occurred:', xhr);
        }
    });
}

export function AutoDisplay(colId, itemId) {
    $.ajax({
        url: `api/item/description?col=${colId}&ite=${itemId}`,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                $('#stonkss').text('Stocks: ' + response.data.quantity);
                $('.cartcart').data('item-id', itemId);
                $('.cartcart').data('col-id', colId);
            } else {
                $('#stonkss').text('Stocks: Data not available');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
            $('#stonkss').text('Stocks: Error occurred');
        }
    });
}

export function deTach(itemId) {
    $.ajax({
        url: `api/user/${itemId}/jewelry`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
        },
        success: function(response) {
            console.log('Success:', response.message);

        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }
    });
}

    export function addCart(itemId, colId)
    {
        $.ajax({
            url: '/api/item/cartz',
            type: 'POST',
            data: {
                item_id: itemId,
                col_id: colId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // console.log(response);
                    if(response.colorJewelryId)
                    {
                        AddQuan(response.colorJewelryId)
                    }
                } else {
                    console.log('Error attaching item:', response.message); // Fixed the console message
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });

    }

    export function popCart()
    {
        $.ajax({
            url: 'api/fetchCart',
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    console.log('Cart data received:', response.data);
                    const cartDom = $('#cartItems');
                    var tot = 0;
                    cartDom.empty();
                    response.data.forEach(ilagay =>{
                        const cartHTML =
                        `
                            <li class="flex flex-col space-y-3 py-6 text-left sm:flex-row sm:space-x-5 sm:space-y-0">
                                <div class="shrink-0 relative">
                                <span class="absolute top-1 left-1 flex h-6 w-6 items-center justify-center rounded-full border bg-white text-sm font-medium text-gray-500 shadow sm:-top-2 sm:-right-2">1</span>
                                <img class="h-24 w-24 max-w-full rounded-lg object-cover" src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8c25lYWtlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=150&q=60" alt="Product Image 2" />
                                </div>

                                <div class="relative flex flex-1 flex-col justify-between">
                                <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
                                    <div class="pr-8 sm:pr-5">
                                    <p class="text-base font-semibold text-gray-900">${ilagay.jewelry}</p>
                                    <p class="mx-0 mt-1 mb-0 text-sm text-gray-400">${ilagay.color} | ${ilagay.quantity} pc(s)</p>
                                    </div>

                                    <div class="mt-4 flex items-end justify-between sm:mt-0 sm:items-start sm:justify-end">
                                    <p class="shrink-0 w-20 text-base font-semibold text-gray-900 sm:order-2 sm:ml-8 sm:text-right">PHP${ilagay.price}</p>
                                    </div>
                                </div>

                                <div class="absolute top-0 right-0 flex sm:bottom-0 sm:top-auto">
                                    <button type="button" id = ""  class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900 DeductButt" data-id = ${ilagay.pivotId} data-quan = ${ilagay.quantity}>
                                        <svg class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <button type="button" id = "" class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900 AddButt"data-id = ${ilagay.pivotId} >
                                        <svg class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>

                                    <button type="button" id = "" class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900 RemoveButt" data-id = ${ilagay.pivotId}>
                                        <svg class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                </div>
                            </li>
                        `;
                        cartDom.append(cartHTML);
                        tot += ilagay.price;
                    });
                    $('#subtot').html('<span class="text-xs font-normal text-gray-400">PHP</span>'+ tot);

                } else {
                    console.log('ERROR', response.message); // Fixed the console message
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

export function AddQuan(id)
{
    $.ajax({
        url: '/api/add/jewel2Cart',
        type: 'POST',
        data: {
            item_id: id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                console.log(response.message);
            } else {
                console.log('Error attaching item:', response.message); // Fixed the console message
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
}

export function MinusQuan(id)
{
    $.ajax({
        url: '/api/decrease/jewel2Cart',
        type: 'POST',
        data: {
            item_id: id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                // console.log(response);
            } else {
                console.log('Error attaching item:', response.message); // Fixed the console message
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
}

export function RemoveQuan(id)
{
    $.ajax({
        url: '/api/delete/jewel2Cart',
        type: 'POST',
        data: {
            item_id: id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                // console.log(response);
            } else {
                console.log('Error attaching item:', response.message); // Fixed the console message
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
    popCart();
}

export function popCheck()
{
    $.ajax({
        url: 'api/fetchCheck',
        type: 'GET',
        success: function(response)
        {
            const jewd = $('#JewelsKUH');
            jewd.empty();
            response.data.forEach(Jusq => {
                const jewdHTML = `
                    <tr class="border border-gray-600">
                    <td class="text-left border border-gray-600 px-4 py-2">${Jusq.jewelry} - ${Jusq.color}</td>
                    <td class="text-right border border-gray-600 px-4 py-2">${Jusq.quantity}</td>
                    <td class="text-right border border-gray-600 px-4 py-2">₱${Jusq.price}</td>
                    </tr>
                `;
                jewd.append(jewdHTML);
            });

            // COURRIER OPTIONS
            const courr = $('#selCour');
            courr.empty();
            response.cour.forEach(pili => {
                const courrHTML = `
                        <option value="${pili.id}">${pili.name}</option>
                `;
                courr.append(courrHTML);
            });
            // =======================================================

            // PAYMENT OPTIONS
            const payss = $('#selPay');
            courr.empty();
            response.pay.forEach(pili => {
                const payssHTML = `
                        <option value="${pili.id}">${pili.method}</option>
                `;
                payss.append(payssHTML);
            });
            // =======================================================
            if (response.success) {

                console.log('Data received:', response.data);
                console.log('Data received:', response.user);
                console.log('Data received:', response.cour);

            } else {
                console.log('ERROR', response.message); // Fixed the console message
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
}
