import { isEmptyObject } from "jquery";

export function ModalDisplay(itemId) {
    showLoadingModal();
    $.ajax({
        url: `/api/item/description/${itemId}`,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                const JewelColors = $('#colorsJewel');
                JewelColors.empty();
                $('#jewelryName').text(response.data.name);
                $('#description').text(response.data.description);
                $('#classi').text(response.data.classification.classification);
                $('#salapi').text('₱' + response.data.prices.price);

                // Insert Jewelry Path and Jewelry Variant Paths here
                $('#jewelimage').attr('src', response.data.image_path);

                const jewelVariantsContainer = $('#jewelVariantsContainer');
                jewelVariantsContainer.empty(); // Clear previous images

                response.data.colorjewelries.forEach(jvar => {
                    const imgElement = $('<img>', {
                        src: jvar.image_path,
                        alt: 'Jewelry Variant',
                        class: 'w-16 cursor-pointer rounded-md hover:outline focus:outline'
                    });
                    jewelVariantsContainer.append(imgElement);
                });


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
            hideLoadingModal();
        },
        error: function(xhr) {
            console.error('An error occurred:', xhr);
        }
    });
}

export function AutoDisplay(colId, itemId) {
    $.ajax({
        url: `/api/item/description?col=${colId}&ite=${itemId}`,
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
    showLoadingModal();
    $.ajax({
        url: `/api/user/${itemId}/jewelry`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
        },
        success: function(response) {
            console.log('Success:', response.message);
            hideLoadingModal();
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }

    });
}

    export function addCart(itemId, colId, thiss)
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
                console.log(response);
                if (response.success) {

                    if(response.colorJewelryId)
                    {
                        AddQuan(response.colorJewelryId)
                    }
                } else {
                    console.log('Error attaching item:', response); // Fixed the console message
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            },
            complete: function() {
                // Set button back to normal state
                setButtonLoading(thiss, false);
            }
        });

    }

    export function popCart()
    {
        showLoadingModal();
        $.ajax({
            url: '/api/fetchCart',
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    console.log('Cart data received:', response.data);
                    const cartDom = $('#cartItems');
                    var tot = 0;
                    cartDom.empty();


                    // if (items) {
                    //     alert('The object is empty');
                    // }
                    console.log(response.items);
                    if(response.items)
                    {
                        response.data.forEach(ilagay =>
                            {
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
                                            <p class="shrink-0 w-20 text-base font-semibold text-gray-900 sm:order-2 sm:ml-8 sm:text-right">PHP${parseFloat(ilagay.price).toFixed(2)}</p>
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
                                tot += parseFloat(ilagay.price);
                            });

                            const button = document.getElementById('checkoutButt');

                            button.disabled = false;


                            button.textContent = "Proceed To CheckOut";
                    }
                    else {
                        const button = document.getElementById('checkoutButt');

                        button.disabled = true;


                        button.textContent = "Empty";
                    }
                    tot = tot.toFixed(2);

                    $('#subtot').html('<span class="text-xs font-normal text-gray-400">PHP</span>'+ tot);

                    const button = document.getElementById('checkoutButt');
                    button.setAttribute('data-value', response.items);

                    hideLoadingModal();
                } else {
                    console.log('ERROR', response.message); // Fixed the console message
                }
            },
            error: function(xhr, status, error) {
                console.error('Error Status:', status);
                console.error('Error Thrown:', error);
                console.error('Response Text:', xhr.responseText);
                console.error('Full Error Object:', xhr);
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


export let GlobalCheckResponse = {};
export let selectedCourierId = null;
export let selectedPayId = null;

export function popCheck()
{
    showLoadingModal();
    $.ajax({
        url: '/api/fetchCheck',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + sessionStorage.getItem('auth_token'),
        },
        success: function(response)
        {
            GlobalCheckResponse = response;
            let medjTotal = 0;
            const jewd = $('#JewelsKUH');
            jewd.empty();
            response.data.forEach(Jusq => {
                const jewdHTML = `
                    <tr class="border border-gray-600">
                    <td class="text-left border border-gray-600 px-4 py-2">${Jusq.jewelry} - ${Jusq.color}</td>
                    <td class="text-right border border-gray-600 px-4 py-2">${Jusq.quantity}</td>
                    <td class="text-right border border-gray-600 px-4 py-2">₱${parseFloat(Jusq.price).toFixed(2)}</td>
                    </tr>
                `;
                medjTotal += Jusq.price;
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
            payss.empty();
            response.pay.forEach(pili => {
                const payssHTML = `
                        <option value="${pili.id}">${pili.method}</option>
                `;
                payss.append(payssHTML);
            });

            // =======================================================

            // Listener for select
            let rate = 0;
            document.getElementById('selCour').addEventListener('change', function() {
                const selectedValue = this.value;
                selectedCourierId = selectedValue;
                const targetDiv = document.getElementById('Cour');
                const targetDiv2 = document.getElementById('CourPr');

                // Clear the targetDivs before updating
                targetDiv.innerHTML = '';
                targetDiv2.innerHTML = '';

                // Assuming response.cour is available and contains the necessary data
                response.cour.forEach(laman => {
                  if (selectedValue == laman.id) {
                    targetDiv.textContent = "Courier - " + laman.name;
                    targetDiv2.textContent = "₱" + laman.rate;
                    var tut = medjTotal
                    caolc(tut, laman.rate);
                  }
                });
              });
              document.getElementById('selPay').addEventListener('change', function() {
                const selectedValue = this.value;
                selectedPayId = selectedValue;

              });
            // ========================================================

            function caolc(hihi, rate) {
                // Ensure hihi and rate are numbers
                let hihiNumber = parseFloat(hihi);
                let rateNumber = parseFloat(rate);

                // Ensure response.totD is a number
                let totDNumber = parseFloat(response.totD);

                let OaTot = hihiNumber + rateNumber;
                let overall = OaTot - totDNumber;

                $('#DC').text('₱' + totDNumber.toFixed(2));
                $('#OverallTotal').text('₱' + overall.toFixed(2));
            }

            $('#CusN').val(response.user.name);
            $('#CusA').val(response.user.address);
            if (response.success) {

                console.log('Data received:', response.data);
                console.log('Data received:', response.user);
                console.log('Data received:', response.cour);

            } else {
                console.log('ERROR', response.message); // Fixed the console message
            }
            hideLoadingModal();
        },
        error: function(xhr, status, error) {
            console.error('Error Status:', status);
            console.error('Error Thrown:', error);
            console.error('Response Text:', xhr.responseText);
            console.error('Full Error Object:', xhr);
        }
    });
}

export function CompleteOrder(Cour, Pay, namer, ads, Cartid, pivId)
{
    $.ajax({
        url: '/api/Fin',
        type: 'post',
        data: {
            coJelId: pivId,
            courierId: Cour,
            payId: Pay,
            name: namer,
            address: ads,
            cartId: Cartid,
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

export function popOrder()
{
    $.ajax({
        url: '/api/fetchOrder',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included
        },
        success: function(response) {
            const urdir = $('#urdir');
            urdir.empty();
            console.log(response.orders);

            response.orders.forEach(ord=> {
                const createdAt = new Date(ord.created_at);
                const araw = createdAt.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',  // Use 'short' for abbreviated month names
                    day: 'numeric'
                });
                const urdirHTML = `
                     <div
                        class="box p-8 rounded-3xl bg-gray-300 grid grid-cols-8 mb-7 cursor-pointer transition-all duration-500 hover:bg-yellow-100 max-lg:max-w-xl max-lg:mx-auto modsss"
                        data-id="${ord.id}">


                            <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center ">
                                <p class="font-semibold text-xl leading-8 text-indigo-600 text-center">${ord.id}</p>
                            </div>

                            <div
                                class="col-span-8 sm:col-span-4 lg:col-span-3 flex h-full justify-center pl-4 flex-col max-lg:items-center">
                                <h5 class="font-manrope font-semibold text-2xl leading-9 text-black mb-1 whitespace-nowrap">
                                    ${ord.name}</h5>
                                <p class="font-normal text-base leading-7 text-gray-600 max-md:text-center">${ord.address}</p>
                            </div>

                            <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center">
                                <p class="font-semibold text-xl leading-8 text-black">${araw}</p>
                            </div>
                            <div class="col-span-8 sm:col-span-4 lg:col-span-1 flex items-center justify-center ">
                                <p class="font-semibold text-xl leading-8 text-indigo-600 text-center">${ord.status}</p>
                            </div>
                            <div class="col-span-8 sm:col-span-4 lg:col-span-2 flex items-center justify-center ">
                                <p class="font-semibold text-xl leading-8 text-black">${ord.payment.method}</p>
                            </div>
                `;
                urdir.append(urdirHTML);
            });
            hideLoadingModal();
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', xhr.responseText);
        }
    });



}

export function showLoadingModal() {
    document.getElementById('loading-modal').classList.remove('hidden');
  }

  export function hideLoadingModal() {
    document.getElementById('loading-modal').classList.add('hidden');
  }

  export function setButtonLoading(button, isLoading = true) {
    if (isLoading) {
        // Save the original text
        button.data('original-text', button.text());

        // Set loading text and add loading animation
        button.text('Loading...');
        button.prop('disabled', true);

        // Create and append loading animation
        button.addClass('relative');
        let spinner = $('<div class="absolute inset-0 flex items-center justify-center">' +
                        '<div class="w-6 h-6 border-4 border-t-4 border-white border-solid rounded-full animate-spin"></div>' +
                        '</div>');
        button.append(spinner);
    } else {
        // Restore the original text and remove loading animation
        button.text(button.data('original-text'));
        button.prop('disabled', false);

        // Remove the spinner
        button.find('div.absolute').remove();
        button.removeClass('relative');
    }
}

export function popOrderMod(id)
{
    showLoadingModal();
    $.ajax({
        url: `/api/fetchModCheck?cart=${id}`,
        type: 'GET',
        success: function(response)
        {
            console.log(response);
            const jewer = $('#jewewe');
            jewer.empty();
            let totDD = 0;
            let sum = 0;
            response.order.color_jewelry.forEach(alahas => {
                const jewerHTML =
                `
                    <tr class="border border-gray-600">
                        <td class="text-left px-4 py-2 border border-gray-600">${alahas.jewelry.name} - ${alahas.colors.color}</td>
                        <td class="px-4 py-2 border border-gray-600">${alahas.pivot.quantity}</td>
                        <td class="text-right px-4 py-2 border border-gray-600">₱ ${alahas.jewelry.prices.price * alahas.pivot.quantity} </td>
                    </tr>
                `;
                let dcRate ;
                let PRC = parseFloat(alahas.jewelry.prices.price);
                if(response.perks)
                {
                     dcRate = alahas.jewelry.promos.discountRate ? parseFloat(alahas.jewelry.promos.discountRate) : 0;
                }
                else{
                    dcRate = 0;
                }

                totDD += dcRate * PRC * alahas.pivot.quantity;
                sum += PRC * alahas.pivot.quantity;


                jewer.append(jewerHTML);
            });

            let courierRate = parseFloat(response.order.courier.rate);
            let bawas = parseFloat(totDD);
            let huli = 0;
            if (isNaN(bawas)) {
                bawas = 0;
            }

            if (isNaN(courierRate)) {
                courierRate = 0;
            }


            if (bawas < 1) {
                huli = sum + courierRate;
            } else {
                huli = (sum + courierRate) - bawas;
            }


            if (isNaN(huli)) {
                huli = 0;
            }


            $('#Couri').text('Courier: ' + response.order.courier.name);
            $('#CourPri').text('₱ ' + courierRate.toFixed(2));
            $('#DCI').text('₱ ' + bawas.toFixed(2));
            $('#OverallTotali').text('₱ ' + huli.toFixed(2));
            hideLoadingModal();
            $('#btnn').data('OrderId', id);
            $('#closeModalBtn').data('OrderId', id);
            if(response.order.status === 'Cancelled')
            {
                $('#btnn').prop('disabled', true);
                $('#btnn').text('Cancelled');
            }

            if(response.order.status === 'Completed')
                {
                    $('#btnn').prop('disabled', true);
                    $('#btnn').text('Completed');
                }

            if(response.order.status === 'Shipping')
                {
                    $('#btnn').prop('disabled', true);
                    $('#btnn').text('Shipping');
                }

                if(response.order.status === 'pending')
                    {
                        $('#btnn').prop('disabled', false);
                        $('#btnn').text('Cancel');
                    }


        },
        error: function(xhr, status, error) {
            console.error('Error Status:', status);
            console.error('Error Thrown:', error);
            console.error('Response Text:', xhr.responseText);
            console.error('Full Error Object:', xhr);
        }
    });
}

export function cancelButt(id)
{
    // showLoadingModal();
    $.ajax({
        url: '/api/cancel',
        type: 'PUT',
        data: {
            _token: '{{ csrf_token() }}',
            OrderId: id,
        },
        success: function(response) {
            console.log('Record updated successfully:', response);
            hideLoadingModal();

        },
        error: function(xhr, status, error) {
            console.error('Error updating record:', status, error);
            console.error('Response Text:', xhr.responseText);
        }
    });
}

export function auto(query)
{
    $.ajax({
        url: '/api/AUTOCOM',
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}',
            Querie: query,
        },
        success: function(response) {
            console.log('Record updated successfully:', response);
            if(response.Classi)
            {
                const Djew = $('#jewelries-hits');
                const JEWEHTML = `<li>Jewelries==========</li>`;
                const CLASSHTML = `<li>Classification========</li>`;
                Djew.empty();
                Djew.append(JEWEHTML);
                response.Jewewe.forEach(cls => {


                        // Create the HTML string with the decoded cls value
                        const DjewHTML =
                        `
                            <li><a href="#" class="block py-2 px-4 hover:bg-gray-200 moves" data-serch="${cls}">${cls}</a></li>
                        `;

                        // Append the generated HTML to the Djew element
                        Djew.append(DjewHTML);
                });
                Djew.append(CLASSHTML);
                response.Classi.forEach(cls => {
                    const DjewHTML =
                    `
                        <li><a href="#" class="block py-2 px-4 hover:bg-gray-200 moves"data-serch = ${cls} >${cls}</a></li>
                    `;
                    Djew.append(DjewHTML);
                });
            }

        },
        error: function(xhr, status, error) {
            console.error('Error updating record:', status, error);
            console.error('Response Text:', xhr.responseText);
        }
    });
}

export function promoCarou()
{

    $.ajax({
        url: '/api/carousel',
        type: 'GET',
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //     'Authorization': 'Bearer ' + sessionStorage.getItem('auth_token'),
        // },
        success: function(response) {
            const carouu = $('#carous');
            carouu.empty();

            response.promo.forEach(prom => {
                const carouuHTML = `
                    <div id="slide${prom.id}" class="carousel-item relative w-full flex justify-center items-center p-3 nyaa mr-4" data-id="${prom.id}">
                        <div class="card lg:card-side bg-gradient-to-r from-yellow-200 to-yellow-300 shadow-xl h-96 w-full flex mr-4">
                            <figure class="flex-shrink-0 h-full w-1/2 overflow-hidden relative">
                                <img src="${prom.image_path}" alt="${prom.name}" class="w-full h-full object-cover" />
                            </figure>
                            <div class="card-body w-1/2 p-4 flex flex-col justify-center">
                                <h2 class="card-title text-xl mb-2">${prom.name}</h2>
                                <p>${prom.description}</p>
                            </div>
                        </div>
                    </div>
                `;

                carouu.append(carouuHTML);
            });

            if (response.promo.length > 1) {
                const ButtHTML = `
                    <div class="absolute top-1/2 transform -translate-y-1/2 left-5">
                        <button class="bg-gray-800 text-white px-4 py-2 rounded prev">&lt;</button>
                    </div>
                    <div class="absolute top-1/2 transform -translate-y-1/2 right-5">
                        <button class="bg-gray-800 text-white px-4 py-2 rounded next">&gt;</button>
                    </div>
                `;
                carouu.append(ButtHTML);


                const nextButton = document.querySelector('.next');
                const prevButton = document.querySelector('.prev');

                if (nextButton && prevButton) {
                    nextButton.addEventListener('click', nextSlide);
                    prevButton.addEventListener('click', prevSlide);
                }
            }

            let currentSlideIndex = 0;
            const ids = [];

            response.promo.forEach(promu => {
                ids.push(promu.id);
            });
            const totalSlides = ids.length;

            function showSlide(slideIndex) {
                // Hide all slides
                ids.forEach(id => {
                    const slide = document.getElementById('slide' + id);
                    if (slide) {
                        slide.style.display = 'none';
                    }
                });

                const currentSlideId = ids[slideIndex];
                const currentSlideElem = document.getElementById('slide' + currentSlideId);
                if (currentSlideElem) {
                    currentSlideElem.style.display = 'flex';
                }
            }

            function nextSlide() {
                currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
                showSlide(currentSlideIndex);
            }

            function prevSlide() {
                currentSlideIndex = (currentSlideIndex - 1 + totalSlides) % totalSlides;
                showSlide(currentSlideIndex);
            }

            showSlide(currentSlideIndex);
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error('Error updating record:', status, error);
            console.error('Response Text:', xhr.responseText);
        }


    });
}


