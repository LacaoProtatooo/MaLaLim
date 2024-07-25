import 'datatables.net-dt';

// CREATE
$(document).ready(function() {
    var jewelryTable = $('#jewelriesTable').DataTable({
        ajax: {
            url: 'http://localhost:8000/api/jewelries',
            dataSrc: ""
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            {
                data: 'actions',
                render: function(data) {
                    return data;
                }
            }
        ]
    });

    // Excel Import
    $(document).on('submit', '#importjewelryForm', function (e) {
        e.preventDefault();
    
        var formData = new FormData(this);
        var fileInput = document.querySelector('input[name="jewelry_file"]');
    
        if (!fileInput || !fileInput.files.length) {
            alert('Please select a file to upload.');
            return;
        }

        var file = fileInput.files[0];
        var allowedExtensions = ['xlsx', 'xls', 'csv'];
        var fileExtension = file.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            alert('Please upload a valid Excel file (xlsx, xls, csv).');
            return;
        }
    
        $.ajax({
            type: 'POST',
            url: '/api/import-jewelry',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log('Success:', response);
   
                document.getElementById('importjewelrymodal').close();
                jewelryTable.ajax.reload();
            },
            error: function (xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    });    
    
    // CREATE
    $('#jewelryForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true,
                maxlength: 255
            },
            classification: {
                required: true,
                maxlength: 255
            },
            price: {
                required: true,
                number: true,
                min: 0
            },
            images: { 
                required: true,
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            name: {
                required: "Please enter the Jewelry name",
                maxlength: "Name can not be longer than 255 characters"
            },
            description: {
                required: "Please enter the Jewelry description",
                maxlength: "Name can not be longer than 255 characters"
            },
            classification: {
                required: "Please select the Jewelry Classification",
                maxlength: "Name can not be longer than 255 characters"
            },
            price: {
                required: "Please enter the Price",
                number: "Please enter a valid Price",
            },
            images: {
                extension: "Please upload a valid image format (jpg, jpeg, png, gif)"
            }
        },
        submitHandler: function(form) {
            // Form is valid, proceed with AJAX submission
            var data = $('#jewelryForm')[0];
            let formData = new FormData(data);

            $.ajax({
                type: 'POST',
                url: '/api/jewelry',
                data: formData,
                processData: false,
                contentType: false, 
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(data) {
                    console.log("Jewelry response contains: ", data);
                    document.getElementById('createjewelrymodal').close();
                    jewelryTable.row.add({
                        'id': data.id,
                        'name': data.name,
                        'rate': data.rate,
                        'actions': '<button class="btn btn-primary jewelry-edit" data-id="' + data.id + '">Details</button> ' +
                                   '<button class="btn btn-secondary jewelry-delete" data-id="' + data.id + '">Delete</button>'
                    }).draw(false);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    // DETAILS
    $(document).on('click', '.jewelry-edit', function(e) {
        e.preventDefault();

        var jewelryid = $(this).data('id');
        console.log(jewelryid);
        
        // OPENING DETAILS MODAL
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/jewelry/${jewelryid}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                console.log(data);

                $('#jewelryno').val(data.id)
                $('#nameedit').val(data.name)
                $('#descriptionedit').val(data.description)
                $('#classificationedit').val(data.classification_id)
                $('#priceedit').val(data.price)
                $('#createdatedit').val(data.created_at)

                // Handle image paths
                let imagePaths = data.image_path ? data.image_path.split(',') : [];
                let imageContainer = $('#uploadedImagesEdit');
                imageContainer.empty();

                if (imagePaths.length > 0) {
                    imagePaths.forEach(function(imagePath) {
                        let imgElement = $('<img>').attr('src', `/${imagePath}?t=${new Date().getTime()}`).attr('alt', 'Jewelry Image');
                        imageContainer.append(imgElement);
                    });
                } else {
                    $('#uploadedImagesEdit').html('<p>No images available</p>');
                }

                document.getElementById('editjewelrymodal').showModal();
            },
            error: function (error) {
                console.log(error);
            }
        });       
    });

    // UPDATE 
    $('#jewelryeditForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true,
                maxlength: 255
            },
            classification: {
                required: true,
                maxlength: 255
            },
            price: {
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
                required: "Please enter the Jewelry name",
                maxlength: "Name can not be longer than 255 characters"
            },
            description: {
                required: "Please enter the Jewelry description",
                maxlength: "Name can not be longer than 255 characters"
            },
            classification: {
                required: "Please select the Jewelry Classification",
                maxlength: "Name can not be longer than 255 characters"
            },
            price: {
                required: "Please enter the Price",
                number: "Please enter a valid Price",
            },
            images: {
                extension: "Please upload a valid image format (jpg, jpeg, png, gif)"
            }
        },
        submitHandler: function(form) {
            var jewelryId = $('#jewelryno').val();
            var data = $('#jewelryeditForm')[0];
            let formData = new FormData(data);
            formData.append("_method", "PUT");
    
            $.ajax({
                type: 'POST',
                url: `http://localhost:8000/api/jewelry/${jewelryId}`,
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(response) {
                    // console.log("Response:", response);
                    document.getElementById('editjewelrymodal').close();
                    jewelryTable.ajax.reload();
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        }
    });
    
    // DELETE
    $(document).on('click', '.jewelry-delete', function() {
        var jewelryId = $(this).data('id');
        console.log('Delete button : jewelry ID:', jewelryId);
        
        // Confirm deletion
        if (confirm("Are you sure you want to delete this jewelry?")) {
            $.ajax({
                type: 'DELETE',
                url: `http://localhost:8000/api/jewelry/${jewelryId}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response.message);
                    // Reload Table
                    jewelryTable.ajax.reload();
                },
                error: function(error) {
                    console.error("Delete error:", error);
                }
            });
        }
    });

    // ======= IMAGE ========= //
    // Handle file selection and preview images
    $('#showFileInput').on('click', function() {
        $('#file_input_edit').click();
    });

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

                    // Set image path in the hidden input for the first file
                    if (index === 0) {
                        document.getElementById('image_pathedit').value = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            });
        }
    });


    // CREATE

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
