<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Materials</title>
    @include('common.links')
    @vite('resources/js/material.js')
</head>
<body class=" bg-yellow-50">
@include('common.adminheader')

<div class="mt-3 w-full mx-auto max-w-screen-xl p-4 allign-items-center">
    <button class="btn btn-primary mt-4 mb-4" onclick="document.getElementById('creatematerial').showModal()">Create Jewelry</button>
    <div class="table-responsive">
        <table class="table table-bordered" id="materialsTable">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="materialsTable">

            </tbody>
        </table>
    </div>
</div>
@include('modal.materialdetails')
@include('modal.addmaterial')

@include('common.footer')
</body>


</html>
