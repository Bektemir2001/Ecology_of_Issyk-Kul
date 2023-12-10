@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Add Lake</h4>
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
            <form action="{{route('admin.lakes.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-4">
                    <div class="col">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="name_ky" placeholder="Name ky">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <input type="text" class="form-control" name="X_coordinate" placeholder="X coordinate">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="Y_coordinate" placeholder="X coordinate">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo" placeholder="Logo">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <textarea class="form-control" name="description" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
