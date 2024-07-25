<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Jewelry</title>
    @include('common.links')
    @vite('resources/js/jewelry.js')
</head>
<body class=" bg-yellow-50">
@include('common.adminheader')

<div class="mt-3 w-full mx-auto max-w-screen-xl p-4 allign-items-center">
    <button class="btn btn-primary mt-4 mb-4" onclick="document.getElementById('createjewelrymodal').showModal()">Create Jewelry</button>
    <button class="btn btn-primary mt-4 mb-4" onclick="document.getElementById('importjewelrymodal').showModal()">Import Jewelry</button>
    <div class="table-responsive">
        <table class="table table-bordered" id="jewelriesTable">
            <thead>
                <tr>
                    <th>Identification No.</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="jewelriesTable">

            </tbody>
        </table>
    </div>
</div>

@include('modal.jewelrydetails')
@include('modal.addjewelry')
@include('modal.jewelryimport')

@include('common.footer')
</body>


</html>
