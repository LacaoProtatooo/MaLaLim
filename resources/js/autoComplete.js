import {auto} from './exportable.js';

$(document).ready(function() {
   
});

$(document).on('input', '.inpp', function() {
    var query = $(this).val();
    console.log('Current input value:', query);
    if (query) {
        auto(query);
        $('#jewelries-hits').removeClass('hidden');
    } else {
        $('#jewelries-hits').addClass('hidden');
    }
});

$(document).on('click', '.moves', function(event) {

    event.preventDefault(); // Prevent the default action of the link

            // Get the value of the data-serch attribute
            var searchValue = $(this).data('serch');

            console.log(searchValue);

            $('#searchinput').val(searchValue);
            $('#jewelries-hits').addClass('hidden');
});

