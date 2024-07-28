<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Payment</title>
    @include('common.links')
    @vite('resources/js/payment.js')
</head>
<body class=" bg-gray-100">
    @include('common.adminheader')
    @vite('resources/js/sidebar.js')
    @include('common.sidebar')

<div class="mt-3 w-full mx-auto max-w-screen-xl p-4 allign-items-center">
    <p class="text-4xl mb-6"> Listed Payment Methods : </p>
    <button class="btn btn-primary mt-4 mb-4" onclick="document.getElementById('createpaymentmodal').showModal()">Create Payment</button>
    <div class="table-responsive">
        <table class="table table-bordered" id="paymentsTable">
            <thead>
                <tr>
                    <th>Identification No.</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="paymentsTable">

            </tbody>
        </table>
    </div>
</div>

@include('modal.paymentdetails')
@include('modal.addpayment')

@include('common.footer')
</body>


</html>
