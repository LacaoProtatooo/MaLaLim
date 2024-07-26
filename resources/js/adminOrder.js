import 'datatables.net-dt';

$(document).ready(function() {
OrderTable;

});

    var OrderTable = $('#ordersTable').DataTable({
        ajax: {
            url: 'http://localhost:8000/api/orders',
            dataSrc: ""
        },
        columns: [
            { data: 'order_no' },
            { data: 'Status' },
            {
                data: 'Actions',
                render: function(data) {
                    return data;
                }
            }
        ]
    });

    $(document).on('click', '.Order-info', function(e) {
        var OrderId = $(this).data('id');
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/InfoOrder?id=${OrderId}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function (response) {
                const orde = $('#OrderInfo');
                orde.empty();
                let over = 0;
                let overD = 0;
                response.order.forEach(items => {
                    let DCsum;
                    let sum;
                    DCsum  = (items.colorJewelry.quantity * items.colorJewelry.jewelry.price.amount) * items.colorJewelry.jewelry.promo.discount;
                    overD += DCsum;
                    sum = (items.colorJewelry.quantity * items.colorJewelry.jewelry.price.amount) - DCsum;
                    over += sum;
                    const ordeHTML = `
                    <tr  class="bg-yellow-100">
                        <td class="border px-4 py-2">${items.colorJewelry.jewelry.name}</td>
                        <td class="border px-4 py-2">${items.colorJewelry.colors.name}</td>
                        <td class="border px-4 py-2">${items.colorJewelry.jewelry.classification.name}</td>
                        <td class="border px-4 py-2">${items.colorJewelry.quantity}</td>
                        <td class="border px-4 py-2">${items.colorJewelry.quantity * items.colorJewelry.jewelry.price.amount}</td>
                        <td class="border px-4 py-2">${items.colorJewelry.jewelry.promo.discount}</td>
                        <td class="border px-4 py-2">${DCsum}</td>
                        <td class="border px-4 py-2">${sum}</td>
                    </tr>
                    `;
                    orde.append(ordeHTML);
                });
                let oover = parseFloat(response.courrier) + over;
                 oover = parseFloat(oover.toFixed(2));
                const con = $('#Summary');
                con.empty()
                const summHTML =
                `
                <tr  class="bg-yellow-200">
                    <th class="px-4 py-2">Courier :${response.courrier}</th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2">Total Discount:</th>
                    <th class="px-4 py-2">${overD}</th>
                    <th class="px-4 py-2">Overall Total:</th>
                    <th class="px-4 py-2">${oover.toFixed(2)}</th>
                </tr>
                `;
                con.append(summHTML);

                // response.order.forEach(element => {
                //     console.log(element.colorJewelry.jewelry.price);
                // });
                // console.log(response.order.colorJewelry);

            },
            error: function (error) {
                console.log(error);
            }
        });
        OrderTable.ajax.reload();
        document.getElementById('orderInfo').showModal();

    });

    $(document).on('click', '.closeModal', function(e) {
        var OrderId = $(this).data('id');
        const emp = $('#OrderInfo');
        const emp2 = $('#Summary');
        emp.empty();
        emp2.empty();

        document.getElementById('orderInfo').close();

    });

    $(document).on('click', '.nyaaa', function() {
        var OrderId = $(this).data('id');
        var OrderStat = $(this).data('stat');
        console.log(OrderStat);
        $.ajax({
            url: `http://localhost:8000/api/Manipulate`,
            type: 'POST',
            data: {
                order: OrderId,
                stat: OrderStat,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // console.log("Response:", response);

                OrderTable.ajax.reload();
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    });

    $(document).on('click', '.order-complete', function(e) {
        var OrderId = $(this).data('id');
        var OrderStat = $(this).data('stat');
        $.ajax({
            url: `http://localhost:8000/api/Manipulate`,
            type: 'POST',
            data: {
                order: OrderId,
                stat: OrderStat,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // console.log("Response:", response);

                OrderTable.ajax.reload();
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    });

    $(document).on('click', '.orderapprove', function(e) {
        var OrderId = $(this).data('id');
        var OrderStat = $(this).data('stat');
        console.log(OrderStat);
        $.ajax({
            url: `http://localhost:8000/api/Manipulate`,
            type: 'POST',
            data: {
                order: OrderId,
                stat: OrderStat,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {


                OrderTable.ajax.reload();
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    });



