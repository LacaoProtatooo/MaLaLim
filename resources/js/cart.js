import { addCart, popCart, AddQuan, RemoveQuan, MinusQuan, popCheck,setButtonLoading  } from './exportable.js';

$(document).ready(function() {

    popCheck();

});

$(document).on('click', '.cartcart', function() {
    const itemId = $(this).data('item-id');
    const colId = $(this).data('col-id');
    let button = $(this);
    setButtonLoading(button, true);
    addCart(itemId, colId, button);
});

$(document).on('click', '.DeductButt', function() {
    const itemId = $(this).data('id');
    const quant = $(this).data('quan');
    console.log(itemId);
    console.log(quant);

    if(quant === 1)
    {
        RemoveQuan(itemId);
    }
    else{
        MinusQuan(itemId)
        popCart();
    }
    // popCart();
});

$(document).on('click', '.AddButt', function() {
    const itemId = $(this).data('id');
    const quant = $(this).data('quan');
    AddQuan(itemId, quant);
    console.log(itemId);
    
});

$(document).on('click', '.RemoveButt', function() {
    const itemId = $(this).data('id');
    console.log(itemId);
    RemoveQuan(itemId);
});

$(document).on('click', '.openMod', function() {
    popCart();
});

$(document).on('click', '.CheckCheck', function() {

});


