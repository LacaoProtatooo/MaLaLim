<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
@include('common.header')
@vite('resources/js/users.js')


<div class=" mt-5 w-full mx-auto max-w-screen-xl p-4 allign-items-center">
        <div class="table-responsive">
            <table class="table table-bordered" id="usersTable">
                <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="usersTable">
                    @foreach($users as $user)
                        <tr id="user-{{ $user->id }}">
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button class="btn btn-primary editUser" data-id="{{ $user->id }}">Edit</button>
                                <button class="btn btn-danger deleteUser" data-id="{{ $user->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>

    
{{-- 
<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <input type="hidden" id="userId">
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Set up CSRF token for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Create user
    $('#createUser').click(function() {
        $('#userForm')[0].reset();
        $('#userId').val('');
        $('#userModal').modal('show');
    });

    // Edit user
    $(document).on('click', '.editUser', function() {
        var id = $(this).data('id');
        $.get('/user/' + id + '/edit', function(user) {
            $('#userId').val(user.id);
            $('#lname').val(user.lname);
            $('#fname').val(user.fname);
            $('#email').val(user.email);
            $('#userModal').modal('show');
        });
    });

    // Save user (create or update)
    $('#userForm').submit(function(e) {
        e.preventDefault();
        var id = $('#userId').val();
        var method = id ? 'PUT' : 'POST';
        var url = id ? '/user/' + id + '/update' : '/user/store';
        $.ajax({
            url: url,
            type: method,
            data: {
                lname: $('#lname').val(),
                fname: $('#fname').val(),
                email: $('#email').val(),
                password: $('#password').val()
            },
            success: function(user) {
                $('#userModal').modal('hide');
                if (id) {
                    $('#user-' + user.id + ' td:nth-child(1)').text(user.lname);
                    $('#user-' + user.id + ' td:nth-child(2)').text(user.fname);
                    $('#user-' + user.id + ' td:nth-child(3)').text(user.email);
                } else {
                    $('#usersTable').append('<tr id="user-' + user.id + '"><td>' + user.lname + '</td><td>' + user.fname + '</td><td>' + user.email + '</td><td><button class="btn btn-primary editUser" data-id="' + user.id + '">Edit</button> <button class="btn btn-danger deleteUser" data-id="' + user.id + '">Delete</button></td></tr>');
                }
            }
        });
    });

    // Delete user
    $(document).on('click', '.deleteUser', function() {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: '/user/' + id + '/delete',
                type: 'DELETE',
                success: function() {
                    $('#user-' + id).remove();
                }
            });
        }
    });
});
</script> --}}

@include('common.footer')
</body>


</html>
