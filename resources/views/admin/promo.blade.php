<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Promo</title>
    @include('common.links')
    @vite('resources/js/promo.js')
</head>
<body class=" bg-yellow-50">
@include('common.adminheader')

<div class="mt-3 w-full mx-auto max-w-screen-xl p-4 allign-items-center">
    <button class="btn btn-primary mt-4 mb-4" onclick="document.getElementById('createpromomodal').showModal()">Create Promo</button>
    <button class="btn btn-primary mt-4 mb-4" onclick="document.getElementById('importpromomodal').showModal()">Import Promo</button>
    <div class="table-responsive">
        <table class="table table-bordered" id="promosTable">
            <thead>
                <tr>
                    <th>Promo No.</th>
                    <th>Name</th>
                    <th>Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="promosTable">

            </tbody>
        </table>
    </div>
</div>

@include('modal.promodetails')
@include('modal.addpromo')
@include('modal.promoimport')
@include('modal.jewelrypromo')

@include('common.footer')
</body>


</html>
