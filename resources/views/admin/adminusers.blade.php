<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    @include('common.links')
    @vite('resources/js/users.js')
</head>
<body class=" bg-gray-100">
@include('common.adminheader')
@vite('resources/js/sidebar.js')
@include('common.sidebar')

<div class="mt-3 w-full mx-auto max-w-screen-xl p-4 allign-items-center">
    {{-- <button class="btn btn-primary mt-4 mb-4" onclick="document.getElementById('createusermodal').showModal()">Create User</button> --}}
    <p class="text-4xl mb-6"> Listed Users : </p>
    <div class="table-responsive">
        <table class="table table-bordered" id="usersTable">
            <thead>
                <tr>
                    <th>Identification No.</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="usersTable">

            </tbody>
        </table>
    </div>
</div>

@include('modal.userdetails')
@include('modal.adduser')

@include('common.footer')
</body>


</html>
