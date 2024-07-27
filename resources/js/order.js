import { popOrder, popOrderMod, cancelButt  } from './exportable.js';

$(document).ready(function(){

    popOrder();

});
$(document).on('click', '.modsss', function() {
    const orderid = $(this).data('id');
    console.log(orderid);
    popOrderMod(orderid);
    $('#modalContainer').removeClass('hidden');

});

$(document).on('click', '.kansul', function() {
    const orderid = $(this).data('OrderId');
    cancelButt(orderid);
    popOrderMod(orderid);
    popOrder();
    $('#modalContainer').addClass('hidden');

});

$(document).on('click', '.sara', function() {

    $('#modalContainer').addClass('hidden');

});


$('#modalContainer').on('click', function(e) {

    if ($(e.target).is('#modalContainer')) {

        $(this).addClass('hidden');
    }
});
