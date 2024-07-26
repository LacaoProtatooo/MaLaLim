import 'datatables.net-dt';
$(document).ready(function() {
    var materialTable = $('#materialsTable').DataTable({
        ajax: {
            url: '/api/materials',
            dataSrc: ""
        },
        columns: [
            { data: 'material' },
            { data: 'description' },
            {
                data: 'actions',
                render: function(data) {
                    return data;
                }
            }
        ]
    });

    $('#materialForm').validate({
        rules: {
            material: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true,
                maxlength: 255
            }
        },
        messages: {
            material: {
                required: "Please enter the Jewelry name",
                maxlength: "Name can not be longer than 255 characters"
            },
            description: {
                required: "Please enter the Jewelry description",
                maxlength: "Name can not be longer than 255 characters"
            }
        },
        submitHandler: function(form) {
            // Form is valid, proceed with AJAX submission
            var data = $('#materialForm')[0];
            let formData = new FormData(data);

            // console.log(data);

            $.ajax({
                type: 'POST',
                url: '/api/materials/create',
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(response) {
                    console.log("Jewelry response contains: ", response);
                    document.getElementById('creatematerial').close();
                    materialTable.row.add({
                        'material': data.material,
                        'description': data.description,
                        'actions': '<button class="btn btn-primary material-edit" data-id="' + data.id + '">Details</button> ' +
                                   '<button class="btn btn-secondary maerial-delete" data-id="' + data.id + '">Delete</button>'
                    }).draw(false);
                    materialTable.ajax.reload();
                },
                error: function(error) {
                    console.log('Error Status:', error.status);
                    console.log('Status Text:', error.statusText);
                    console.log('Response Text:', error.responseText);
                    console.log('Ready State:', error.readyState);
                    console.log('Response Headers:', error.getAllResponseHeaders());
                }
            });
        }
    });

    $(document).on('click', '.material-edit', function(e) {
        e.preventDefault();

        var materialid = $(this).data('id');
        // console.log(jewelryid);

        // OPENING DETAILS MODAL
        $.ajax({
            type: "GET",
            url: `/api/materials`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            data: {
                matid: materialid
            },
            success: function (data) {
                console.log(data);

                $('#description').val(data.description)
                $('#material').val(data.material)
                $('#materialId').val(data.id)

                document.getElementById('editmaterialmodal').showModal();
            },
            error: function (error) {
                console.log('Error Status:', error.status);
                    console.log('Status Text:', error.statusText);
                    console.log('Response Text:', error.responseText);
                    console.log('Ready State:', error.readyState);
                    console.log('Response Headers:', error.getAllResponseHeaders());
            }
        });
    });

    $('#materialeditform').validate({
        rules: {
            material: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true,
                maxlength: 255
            }
        },
        messages: {
            material: {
                required: "Please enter the Jewelry name",
                maxlength: "Name can not be longer than 255 characters"
            },
            description: {
                required: "Please enter the Jewelry description",
                maxlength: "Name can not be longer than 255 characters"
            }
        },
        submitHandler: function(form) {
            var matid = $('#materialId').val();
            var data = $('#materialeditform')[0];
            let formData = new FormData(data);
            formData.append('matid', matid);

            // Debugging: Log formData entries
            for (var pair of formData.entries()) {
                console.log(pair[0]+ ', ' + pair[1]);
            }

            $.ajax({
                type: 'POST',
                url: `/api/materials/create`,
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(response) {
                    console.log("Jewelry response contains: ", response);
                    document.getElementById('editmaterialmodal').close();
                    materialTable.ajax.reload();
                },
                error: function(error) {
                    console.log('Error Status:', error.status);
                    console.log('Status Text:', error.statusText);
                    console.log('Response Text:', error.responseText);
                    console.log('Ready State:', error.readyState);
                    console.log('Response Headers:', error.getAllResponseHeaders());
                    try {
                        const responseJSON = JSON.parse(error.responseText);
                        console.log('Response JSON:', responseJSON);
                    } catch (e) {
                        console.log('Response is not JSON formatted');
                    }
                }
            });
        }
    });

    $(document).on('click', '.material-delete', function() {
        var materialId = $(this).data('id');
        console.log('Delete button : material ID:', materialId);

        // Confirm deletion
        if (confirm("Are you sure you want to delete this jewelry?")) {
            $.ajax({
                type: 'DELETE',
                url: `/api/materials/${materialId}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response.message);
                    // Reload Table
                    materialTable.ajax.reload();
                },
                error: function(error) {
                    console.error("Delete error:", error);
                }
            });
        }
    });


});
