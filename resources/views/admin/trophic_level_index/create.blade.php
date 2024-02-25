@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">{{$title}}</h4>
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
            <form action="{{route($create_url)}}" method="POST">
                @csrf
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" id="name" name="name">
                    </div>
                    <div class="col">
                        <label for="item">Item</label>
                        <input class="form-control" type="text" id="item" name="item">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
