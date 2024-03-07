<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Application</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    {{-- remix icon --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

</head>

<body>
    <nav class="navbar navbar-dark bg-light">
        <a class="nav-link text-dark" href="/logout"><i class="ri-logout-circle-fill"></i>Logout</a>
        <a class="navbar-brand text-dark" href="#"><b>{{ auth()->user()->first_name }}
                {{ auth()->user()->last_name }}</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" style="color: black">
        </button>
    </nav>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-black">Laravel 10 Crud Application </h3>
                <hr>
                <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal"
                    data-target="#addStudentModal">
                    <i class="fas fa-user-plus"></i> Add
                </button>

                <table class="table table-bordered">


                    <thead class="bg-light text-dark">
                        <tr>
                            <th><i class="fas fa-user"></i> ID #</th>
                            <th><i class="fas fa-user"></i> Full Name</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="ri-calendar-fill"></i> Age</th>
                            <th><i class="ri-user-settings-fill"></i> Role</th>
                            <th><i class="fas fa-cog"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['first_name'] }} {{ $user['last_name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['age'] }}</td>
                                <td>
                                    @if ($user['role'] == 1)
                                        Member
                                    @elseif($user['role'] == 2)
                                        Admin
                                    @else
                                        Unkown
                                    @endif

                                </td>
                                @if (auth()->user()->id == $user['id'])
                                @else
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editStudentModal{{ $user['id'] }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deleteStudentModal{{ $user['id'] }}">
                                            <i class="fas fa-trash"></i>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $paginator->links() }}
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/addUser">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel"><i class="fas fa-user-plus"></i> Add User
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="admin_id" value="{{auth()->user()->id}}" >
                            <label for="name"><i class="fas fa-user"></i>First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user"></i>Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user"></i> Birth Date</label>
                            <input type="date" name="birth_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <select name="role" id="role" class="form-control" required>
                                <option value="">Choose Your Role</option>
                                <option value="1">1 as User</option>
                                <option value="2">2 as Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address"><i class="fas fa-address-card"></i> Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal (for each student) -->
    @foreach ($users as $user)
        <div class="modal fade" id="editStudentModal{{ $user['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="editStudentModalLabel{{ $user['id'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="/editUser">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStudentModalLabel{{ $user['id'] }}"><i
                                    class="fas fa-user-plus"></i> Edit User
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $user['id'] }}">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i>First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ $user['first_name'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i>Last Name</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ $user['last_name'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ $user['email'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> Birth Date</label>
                                <input type="date" name="birth_date" class="form-control"
                                    value="{{ $user['birth_date'] }}">
                            </div>
                            <div class="form-group">
                                <select name="role" id="role" class="form-control" required>
                                    <option value="{{ $user['role'] }}">{{ $user['role'] }}</option>
                                    <option value="1">1 as User</option>
                                    <option value="2">2 as Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address"><i class="fas fa-address-card"></i> Password</label>
                                <input type="password" name="password" class="form-control"
                                    value="{{ $user['password'] }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Delete Student Modal -->
    @foreach ($users as $user)
        <div class="modal fade" id="deleteStudentModal{{ $user['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteStudentModalLabel{{ $user['id'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="/deleteUser">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteStudentModalLabel"><i class="fas fa-user-plus"></i> Are
                                you sure you want to delete this user?
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">{{ $user['first_name'] }} {{ $user['last_name'] }}</label>
                                <input type="hidden" name="id" value="{{ $user['id'] }}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-2-fill"></i></i>
                                Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
