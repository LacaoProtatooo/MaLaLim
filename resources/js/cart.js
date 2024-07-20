import { addCart } from './exportable.js';

$(document).ready(function() {


});

$(document).on('click', '.cartcart', function() {
    const itemId = $(this).data('item-id');
    const colId = $(this).data('col-id');
    addCart(itemId, colId);
});

