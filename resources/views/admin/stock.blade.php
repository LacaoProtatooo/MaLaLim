<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Stock</title>
    @include('common.links')
    @vite('resources/js/stock.js')
</head>
<body class=" bg-gray-100">
@include('common.adminheader')
@vite('resources/js/sidebar.js')
    @include('common.sidebar')

<div class="mt-3 w-full mx-auto max-w-screen-xl p-4 allign-items-center">
    <p class="text-4xl mb-6"> Listed Jewelry Variants & Stocks : </p>
    <button id="createJewelryVariantButton" class="btn btn-primary mt-4 mb-4">Create Jewelry Variant</button>
    <div class="table-responsive">
        <table class="table table-bordered" id="stocksTable">
            <thead>
                <tr>
                    <th>Variant No.</th>
                    <th>Jewelry</th>
                    <th>Color</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="stocksTable">

            </tbody>
        </table>
    </div>
</div>

@include('modal.stockdetails')
@include('modal.addstock')

@include('common.footer')
</body>


</html>
