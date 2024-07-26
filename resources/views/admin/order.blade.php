<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Orders</title>
    @include('common.links')

</head>
<body class=" bg-yellow-50">
@include('common.adminheader')

<div class="mt-3 w-full mx-auto max-w-screen-xl p-4 allign-items-center">
    <p class="text-4xl mb-6"> Listed Orders : </p>

    <div class="table-responsive">
        <table class="table table-bordered" id="ordersTable">
            <thead>
                <tr>
                    <th>Order No.</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="ordersTable">

            </tbody>
        </table>
    </div>
</div>
{{--
@include('modal.jewelrydetails')
@include('modal.addjewelry') --}}
@include('modal.orderInfoModal')
@vite('resources/js/adminOrder.js')
@include('common.footer')
</body>


</html>
