import 'datatables.net-dt';

$(document).ready(function() {
    var stockTable = $('#stocksTable').DataTable({
        ajax: {
            url: '/api/stocks',
            dataSrc: ""
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'color' },
            { data: 'quantity' },
            {
                data: 'actions',
                render: function(data) {
                    return data;
                }
            }
        ]
    });

    // CREATE MODAL
    var createButton = document.getElementById('createJewelryVariantButton');
    createButton.addEventListener('click', function() {
        $.ajax({
            type: "GET",
            url: `/api/stock`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#jewelryDropdown').empty().append('<option value="" disabled selected>Select Jewelry</option>');
                $('#colorDropdown').empty().append('<option value="" disabled selected>Select Color</option>');

                // Populate jewelry dropdown
                data.jewelries.forEach(function(jewelry) {
                    $('#jewelryDropdown').append(new Option(jewelry.name, jewelry.id));
                });
                // Populate color dropdown
                data.colors.forEach(function(color) {
                    $('#colorDropdown').append(new Option(color.color, color.id));
                });

                document.getElementById('createstockmodal').showModal();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });


    // CREATE
    $('#stockForm').validate({
        rules: {
            jewelry: {
                required: true,
                maxlength: 255
            },
            color: {
                required: true,
                maxlength: 255
            },
            quantity: {
                required: true,
                number: true,
                min: 0
            },
            images: { // Update validation rule for images
                required: true,
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            jewelry: {
                required: "Please Choose Jewelry name",
                maxlength: "Name cannot be longer than 255 characters"
            },
            color: {
                required: "Please choose Color variant",
                maxlength: "Description cannot be longer than 255 characters"
            },
            quantity: {
                required: "Please enter the quantity rate",
                number: "Please enter a valid number",
                min: "Quantity is minimum of 0",
            },
            images: { // Update validation message for images
                required: "Please upload at least one image",
                extension: "Please upload a valid image format (jpg, jpeg, png, gif)"
            }
        },
        submitHandler: function(form) {
            var data = $('#stockForm')[0];
            let formData = new FormData(data);

            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                type: 'POST',
                url: '/api/stock',
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(data) {
                    // console.log("Stock response contains: ", data);
                    document.getElementById('createstockmodal').close();
                    stockTable.row.add({
                        'id': data.id,
                        'name': data.name,
                        'color': data.color,
                        'quantity': data.quantity,
                        'actions': '<button class="btn btn-primary stock-edit" data-id="' + data.id + '">Details</button> ' +
                                   '<button class="btn btn-secondary stock-delete" data-id="' + data.id + '">Delete</button> ' 
                    }).draw(false);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    // DETAILS
    $(document).on('click', '.stock-edit', function(e) {
        e.preventDefault();

        var stockid = $(this).data('id');
        console.log(stockid);
        
        // OPENING DETAILS MODAL
        $.ajax({
            type: "GET",
            url: `/api/stock/${stockid}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                console.log(data);

                $('#stockno').val(data.id);
                $('#jewelryedit').val(data.name);
                $('#coloredit').val(data.color);
                $('#stockedit').val(data.quantity);
                $('#createdatedit').val(data.created_at);

                // Handle image paths
                let imagePaths = data.image_path ? data.image_path.split(',') : [];
                let imageContainer = $('#uploadedImagesEdit');
                imageContainer.empty();

                if (imagePaths.length > 0) {
                    imagePaths.forEach(function(imagePath) {
                        let imgElement = $('<img>').attr('src', `/${imagePath}?t=${new Date().getTime()}`).attr('alt', 'Variant Image');
                        imageContainer.append(imgElement);
                    });
                } else {
                    $('#uploadedImagesEdit').html('<p>No images available</p>');
                }

                document.getElementById('editstockmodal').showModal();
            },
            error: function (error) {
                console.log(error);
            }
        });       
    });

    // UPDATE 
    $('#stockeditForm').validate({
        rules: {
            jewelry: {
                required: true,
                maxlength: 255
            },
            color: {
                required: true,
                maxlength: 255
            },
            quantity: {
                required: true,
                number: true,
                min: 0
            },
            images: { // Update validation rule for images
                required: true,
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            jewelry: {
                required: "Please Choose Jewelry name",
                maxlength: "Name cannot be longer than 255 characters"
            },
            color: {
                required: "Please choose Color variant",
                maxlength: "Description cannot be longer than 255 characters"
            },
            quantity: {
                required: "Please enter the quantity rate",
                number: "Please enter a valid number",
                min: "Quantity is minimum of 0",
            },
            images: { // Update validation message for images
                required: "Please upload at least one image",
                extension: "Please upload a valid image format (jpg, jpeg, png, gif)"
            }
        },
        submitHandler: function(form) {
            var stockId = $('#stockno').val();
            var data = $('#stockeditForm')[0];
            let formData = new FormData(data);
            formData.append("_method", "PUT");
    
            $.ajax({
                type: 'POST',
                url: `/api/stock/${stockId}`,
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(response) {
                    // console.log("Response:", response);
                    document.getElementById('editstockmodal').close();
                    stockTable.ajax.reload();
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        }
    });

    // DELETE
    $(document).on('click', '.stock-delete', function() {
        var stockId = $(this).data('id');
        console.log('Delete button : Stock ID:', stockId);
        
        // Confirm deletion
        if (confirm("Are you sure you want to delete this Variant?")) {
            $.ajax({
                type: 'DELETE',
                url: `/api/stock/${stockId}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response.message);
                    // Reload Table
                    stockTable.ajax.reload();
                },
                error: function(error) {
                    console.error("Delete error:", error);
                }
            });
        }
    });

    // ======= IMAGE ========= //

    $('#showFileInput').on('click', function() {
        $('#file_input_edit').click();
    });

    // Handle file selection and preview images
    $('#file_input_edit').on('change', function() {
        var files = $(this).get(0).files;
        var previewContainer = $('#uploadedImagesEdit');
        previewContainer.empty(); // Clear previous images

        if (files.length > 0) {
            $.each(files, function(index, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('<img>').attr('src', e.target.result).addClass('h-auto max-w-lg');
                    previewContainer.append(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });
    
    // Handle single image EDIT
    const fileInputed = document.getElementById('file_input_edit');
    fileInputed.addEventListener('change', handleFileSelect);

    function handleFileSelect() {
        const files = fileInputed.files;

        if (files.length > 0) {
            currentIndex = 0; // Reset index on file change
            showImage(files[currentIndex]);

            // Set image path in the hidden input
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image_pathedit').value = e.target.result;
            };
            reader.readAsDataURL(files[currentIndex]);
        }
    }

    const uploadedImage = document.getElementById('uploadedImage');
    const fileInput = document.getElementById('file_input');
    let currentIndex = 0;
    let intervalId;

    function showImage(file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            uploadedImage.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', () => {
        currentIndex = 0; // Reset index on new file selection
        if (fileInput.files.length > 0) {
            showImage(fileInput.files[currentIndex]); // Show the first image
            if (intervalId) clearInterval(intervalId); // Clear any existing interval
            intervalId = setInterval(() => {
                currentIndex = (currentIndex + 1) % fileInput.files.length;
                showImage(fileInput.files[currentIndex]);
            }, 3000); // Change image every 3 seconds
        }
    });


});
