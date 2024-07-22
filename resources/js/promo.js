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
                data: 'actions',
                render: function(data) {
                    return data;
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
                min: 0.1,
                max: 0.9
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
                min: "Rate must be a ranging from 0.1 to 0.9",
                max: "Rate must be a ranging from 0.1 to 0.9"
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
                    // console.log("Promo response contains: ", data);
                    document.getElementById('createpromomodal').close();
                    promoTable.row.add({
                        'id': data.id,
                        'name': data.name,
                        'discountRate': data.discountRate,
                        'actions': '<button class="btn btn-primary promo-edit" data-id="' + data.id + '">Details</button> ' +
                                   '<button class="btn btn-secondary promo-delete" data-id="' + data.id + '">Delete</button> ' +
                                   '<button class="btn btn-success promo-jewelry" data-id="' + data.id + '">Assign Jewelry</button>'
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
                // console.log(data);

                $('#promono').val(data.id);
                $('#nameedit').val(data.name);
                $('#descriptionedit').val(data.description);
                $('#discountRateedit').val(data.discountRate);
                $('#createdatedit').val(data.created_at);

                // Handle image paths
                let imagePaths = data.image_path ? data.image_path.split(',') : [];
                let imageContainer = $('#uploadedImagesEdit');
                imageContainer.empty();

                if (imagePaths.length > 0) {
                    imagePaths.forEach(function(imagePath) {
                        let imgElement = $('<img>').attr('src', `/${imagePath}?t=${new Date().getTime()}`).attr('alt', 'Promo Image');
                        imageContainer.append(imgElement);
                    });
                } else {
                    $('#uploadedImagesEdit').html('<p>No images available</p>');
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
                min: 0.1,
                max: 0.9
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
                min: "Rate must be a ranging from 0.1 to 0.9",
                max: "Rate must be a ranging from 0.1 to 0.9"
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
                    // console.log("Response:", response);
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

    let initialCheckboxStates = {};

    // Function to capture the initial state of the checkboxes
    function captureInitialStates() {
        initialCheckboxStates = {};
        $('#jewelryContainer input[type="checkbox"]').each(function() {
            initialCheckboxStates[$(this).data('id')] = $(this).prop('checked');
        });
    }

    // Function to get the changed states
    function getChangedStates() {
        let changedStates = {
            checked: [],
            unchecked: []
        };

        $('#jewelryContainer input[type="checkbox"]').each(function() {
            let id = $(this).data('id');
            let isChecked = $(this).prop('checked');
            if (initialCheckboxStates[id] !== isChecked) {
                if (isChecked) {
                    changedStates.checked.push(id);
                } else {
                    changedStates.unchecked.push(id);
                }
            }
        });

        return changedStates;
    }

    // Assign Jewelry
    $(document).on('click', '.promo-jewelry', function(e) {
        e.preventDefault();

        var promoid = $(this).data('id');
        console.log(promoid);

        // OPENING JEWELRY WITH PROMO MODAL
        $.ajax({
            type: "GET",
            url: `/api/admin/getJewelries/${promoid}`, // Assuming this is the correct URL
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function(data) {
                // console.log(data);
                $('#jewelryContainer').empty();

                data.forEach(function(jewelry) {
                    var promoStatus = jewelry.hasPromo ? 'checked="checked"' : '';

                    var jewelryElement = `
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">${jewelry.id}</span>
                                <span class="label-text">${jewelry.name}</span>
                                <input type="checkbox" ${promoStatus} class="checkbox checkbox-primary" data-id="${jewelry.id}" />
                            </label>
                        </div>`;

                    $('#jewelryContainer').append(jewelryElement);
                });

                $('#saveJewelryPromo').data('id', promoid);
                document.getElementById('jewelrypromomodal').showModal();
                
                // Capture the initial states of checkboxes
                captureInitialStates();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Save button click event
    $(document).on('click', '#saveJewelryPromo', function() {
        var promoid = $(this).data('id'); // Ensure promoId is correctly set
        var changedStates = getChangedStates();

        var formData = new FormData();
        changedStates.checked.forEach(function(id) {
            formData.append('checkedJewelryIds[]', id);
        });
        changedStates.unchecked.forEach(function(id) {
            formData.append('uncheckedJewelryIds[]', id);
        });

        $.ajax({
            type: 'POST',
            url: `http://localhost:8000/api/admin/jewelrypromosave/${promoid}`,
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function(response) {
                console.log("Response:", response);
                document.getElementById('jewelrypromomodal').close();
                promoTable.ajax.reload();
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
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
