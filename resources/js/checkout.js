import { popCheck, GlobalCheckResponse,  selectedCourierId, selectedPayId, CompleteOrder } from './exportable.js';

$(document).on('click', '.refresher', function() {

    popCheck();

});

$(document).on('click', '.completeButt', function() {

                console.log('res:', GlobalCheckResponse.data);
                console.log('c:', selectedCourierId);
                console.log('p:', selectedPayId);
    var courrierId = selectedCourierId;
    var paymId = selectedPayId;
    var namee = GlobalCheckResponse.user.name;
    var addd = GlobalCheckResponse.user.address;
    var carTT = GlobalCheckResponse.cartID;
    var coljel = GlobalCheckResponse.data;

    if (!namee || !addd || !courrierId || !paymId) {
        alert('Please fill in all required fields: name, address, courier, and payment method.');
        return;
    }

    CompleteOrder(courrierId, paymId, namee, addd, carTT, coljel);

});
