@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Add User</h4>
            </div>
            <div class="header-action">
                <i data-toggle="collapse" data-target="#form-element-9" aria-expanded="false">
                    <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </i>
            </div>
        </div>
        <div class="card-body">
            <div class="collapse" id="form-element-9">
                <div class="card"></div>
            </div>
            <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required autofocus>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required autofocus>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="inn">INN</label>
                        <input type="text" class="form-control" name="inn" id="inn" placeholder="INN">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autofocus>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" placeholder="Image">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
