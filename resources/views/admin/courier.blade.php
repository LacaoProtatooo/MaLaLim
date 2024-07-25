<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Courier</title>
    @include('common.links')
    @vite('resources/js/courier.js')
</head>
<body class=" bg-yellow-50">
@include('common.adminheader')

<div class="mt-3 w-full mx-auto max-w-screen-xl p-4 allign-items-center">
    <button class="btn btn-primary mt-4 mb-4" onclick="document.getElementById('createcouriermodal').showModal()">Create Courier</button>
    <button class="btn btn-primary mt-4 mb-4" onclick="document.getElementById('importcouriermodal').showModal()">Import Courier</button>
    <div class="table-responsive">
        <table class="table table-bordered" id="couriersTable">
            <thead>
                <tr>
                    <th>Identification No.</th>
                    <th>Name</th>
                    <th>Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="couriersTable">

            </tbody>
        </table>
    </div>
</div>

@include('modal.courierdetails')
@include('modal.courierimport')
@include('modal.addcourier')

@include('common.footer')
</body>


</html>
