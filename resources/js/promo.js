import 'datatables.net-dt';

$(document).ready(function() {
    var promoTable = $('#promosTable').DataTable({
        ajax: {
            url: 'http://localhost:8000/api/promos',
            dataSrc: ""
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'discountRate' },
            {
                data: 'id',
                render: function(data) {
                    return '<button class="btn btn-primary promo-edit" data-id="' + data + '">Details</button> ' +
                           '<button class="btn btn-secondary promo-delete" data-id="' + data + '">Delete</button>';
                }
            }
        ]
    });

    // CREATE
    $('#promoForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true,
                maxlength: 255
            },
            discountRate: {
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
            name: {
                required: "Please enter the promo name",
                maxlength: "Name cannot be longer than 255 characters"
            },
            description: {
                required: "Please enter description",
                maxlength: "Description cannot be longer than 255 characters"
            },
            discountRate: {
                required: "Please enter the discount rate",
                number: "Please enter a valid number",
                min: "Rate must be a positive number"
            },
            images: { // Update validation message for images
                required: "Please upload at least one image",
                extension: "Please upload a valid image format (jpg, jpeg, png, gif)"
            }
        },
        submitHandler: function(form) {
            var data = $('#promoForm')[0];
            let formData = new FormData(data);

            $.ajax({
                type: 'POST',
                url: '/api/promo',
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(data) {
                    console.log("Promo response contains: ", data);
                    document.getElementById('createpromomodal').close();
                    promoTable.row.add({
                        'id': data.id,
                        'name': data.name,
                        'discountRate': data.discountRate,
                        'actions': '<button class="btn btn-primary promo-edit" data-id="' + data.id + '">Details</button> ' +
                                   '<button class="btn btn-secondary promo-delete" data-id="' + data.id + '">Deactivate</button>'
                    }).draw(false);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    // DETAILS
    $(document).on('click', '.promo-edit', function(e) {
        e.preventDefault();

        var promoid = $(this).data('id');
        console.log(promoid);
        
        // OPENING DETAILS MODAL
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/promo/${promoid}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                console.log(data);

                $('#promono').val(data.id);
                $('#nameedit').val(data.name);
                $('#descriptionedit').val(data.description);
                $('#discountRateedit').val(data.discountRate);
                $('#createdatedit').val(data.created_at);

                // Handle image paths
                if (data.image_path) {
                    $('#image_pathedit').val(data.image_path);
                    let imagePaths = data.image_path.split(',');
                    let imageContainer = $('#uploadedImagesEdit');
                    imageContainer.empty(); // Clear existing images

                    imagePaths.forEach(function(imagePath) {
                    let imgElement = $('<img>').attr('src', `/${imagePath}`).attr('alt', 'Promo Image');
                    imageContainer.append(imgElement);
                    });

                } else {
                    $('#uploadedImageEdit').html('<p>No images available</p>');
                }

                document.getElementById('editpromomodal').showModal();
            },
            error: function (error) {
                console.log(error);
            }
        });       
    });

    // UPDATE 
    $('#promoeditForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true,
                maxlength: 255
            },
            discountRate: {
                required: true,
                number: true,
                min: 0
            },
            images: {
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            name: {
                required: "Please enter the promo name",
                maxlength: "Name can not be longer than 255 characters"
            },
            description: {
                required: "Please enter description",
                maxlength: "Description can not be longer than 255 characters"
            },
            discountRate: {
                required: "Please enter the discount rate",
                number: "Please enter a valid number",
                min: "Rate must be a positive number"
            },
            images: {
                extension: "Please upload a valid image format (jpg, jpeg, png, gif)"
            }
        },
        submitHandler: function(form) {
            var promoId = $('#promono').val();
            var data = $('#promoeditForm')[0];
            let formData = new FormData(data);
            formData.append("_method", "PUT");
    
            $.ajax({
                type: 'POST',
                url: `http://localhost:8000/api/promo/${promoId}`,
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(response) {
                    console.log("Response:", response);
                    document.getElementById('editpromomodal').close();
                    promoTable.ajax.reload();
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        }
    });

    // DELETE
    $(document).on('click', '.promo-delete', function() {
        var promoId = $(this).data('id');
        console.log('Delete button : promo ID:', promoId);
        
        // Confirm deletion
        if (confirm("Are you sure you want to delete this promo?")) {
            $.ajax({
                type: 'DELETE',
                url: `http://localhost:8000/api/promo/${promoId}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response.message);
                    // Reload Table
                    promoTable.ajax.reload();
                },
                error: function(error) {
                    console.error("Delete error:", error);
                }
            });
        }
    });

    const fileInput = document.getElementById('file_input');
    const uploadedImage = document.getElementById('uploadedImage');
    let currentIndex = 0;

    fileInput.addEventListener('change', handleFileSelect);

    function handleFileSelect() {
        const files = fileInput.files;

        if (files.length > 0) {
            currentIndex = 0; // Reset index on file change
            showImage(files[currentIndex]);

            // Set image path in the hidden input
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image_path').value = e.target.result;
            };
            reader.readAsDataURL(files[currentIndex]);
        }
    }

    function showImage(file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            uploadedImage.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }

    // Handle sliding feature for multiple images
    setInterval(() => {
        if (fileInput.files.length > 0) {
            currentIndex = (currentIndex + 1) % fileInput.files.length;
            showImage(fileInput.files[currentIndex]);
        }
    }, 3000); // Change image every 3 seconds

    // Handle image file selection and preview
    $(document).on('change', '#file_input_edit', function() {
        var files = $(this)[0].files;
        var previewContainer = $('#uploadedImagesEdit');
        previewContainer.empty();
        
        if (files.length > 0) {
            Array.from(files).forEach(file => {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('<img>').attr('src', e.target.result).addClass('h-auto max-w-lg');
                    previewContainer.append(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });

});
