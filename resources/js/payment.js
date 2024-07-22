import 'datatables.net-dt';

// CREATE
$(document).ready(function() {
    var paymentTable = $('#paymentsTable').DataTable({
        ajax: {
            url: 'http://localhost:8000/api/payments',
            dataSrc: ""
        },
        columns: [
            { data: 'id' },
            { data: 'method' },
            {
                data: 'actions',
                render: function(data) {
                    return data;
                }
            }
        ]
    });

    
    // CREATE
    $('#paymentForm').validate({
        rules: {
            method: {
                required: true,
                maxlength: 50
            },
        },
        messages: {
            method: {
                required: "Please enter the Payment Method",
                maxlength: "Payment Method can not be longer than 50 characters"
            },
        },
        submitHandler: function(form) {
            // Form is valid, proceed with AJAX submission
            var data = $('#paymentForm')[0];
            let formData = new FormData(data);

            $.ajax({
                type: 'POST',
                url: '/api/payment',
                data: formData,
                processData: false,
                contentType: false, 
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(data) {
                    console.log("Payment response contains: ", data);
                    document.getElementById('createpaymentmodal').close();
                    paymentTable.row.add({
                        'id': data.id,
                        'method': data.method,
                        'actions': '<button class="btn btn-primary payment-edit" data-id="' + data.id + '">Details</button> ' +
                                   '<button class="btn btn-secondary payment-delete" data-id="' + data.id + '">Delete</button>'
                    }).draw(false);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    // DETAILS
    $(document).on('click', '.payment-edit', function(e) {
        e.preventDefault();

        var paymentid = $(this).data('id');
        console.log(paymentid);
        
        // OPENING DETAILS MODAL
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/payment/${paymentid}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                console.log(data);

                $('#paymentno').val(data.id)
                $('#methodedit').val(data.method)
                $('#createdatedit').val(data.created_at)

                document.getElementById('editpaymentmodal').showModal();
            },
            error: function (error) {
                console.log(error);
            }
        });       
    });

    // UPDATE 
    $(document).on('submit', '#paymenteditForm', function (e) {
        e.preventDefault();
    
        var paymentId = $('#paymentno').val();
        var data = $('#paymenteditForm')[0];
        let formData = new FormData(data);
        formData.append("_method", "PUT");
    
        $.ajax({
            type: 'POST',
            url: `http://localhost:8000/api/payment/${paymentId}`,
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",

            success: function(response) {
                console.log("Response:", response);
                document.getElementById('editpaymentmodal').close();
                paymentTable.ajax.reload();
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    });
    
    // DELETE
    $(document).on('click', '.payment-delete', function() {
        var paymentId = $(this).data('id');
        console.log('Delete button : payment ID:', paymentId);
        
        // Confirm deletion
        if (confirm("Are you sure you want to delete this payment?")) {
            $.ajax({
                type: 'DELETE',
                url: `http://localhost:8000/api/payment/${paymentId}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response.message);
                    // Reload Table
                    paymentTable.ajax.reload();
                },
                error: function(error) {
                    console.error("Delete error:", error);
                }
            });
        }
    });


});
