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
