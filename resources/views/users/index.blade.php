@extends('layouts.app')
@section('title', 'Manage Users')

@section('content')
<div class="py-5">
    <div class="container py-1">
        @include('response')
    </div>
    <div class="container py-5">
        <button class="btn fs-4" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fa-solid fa-circle-plus"></i>
            <span class="fw-semibold">Add User</span>
        </button>
    </div>
    <div class="container py-2">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Email Address</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <div class=row>
                            <div class="col-md-3" type="button" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $user->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span class="fw-semibold">Edit</span>
                            </div>
                            <div class="col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                <i class="fa-regular fa-trash-can"></i>
                                <span class="fw-semibold">Delete</span>
                            </div>
                            <!-- Edit User Modal -->
                            <div class="modal" id="editModal{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Edit User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                            <div class="modal-body">

                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label class="form-label">Email Address</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ old('email', $user->email) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password">
                                                    <div class="form-text">Password must contain
                                                        at least 8 characters.</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete User Modal -->
                            <div class="modal" id="deleteModal{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Delete User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this user permenantly?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Add User Modal -->
    <div class="modal" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.add') }}">

                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                            <div class="form-text">Password must contain
                                at least 8 characters.</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection