@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Edit Control Point</h4>
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
            <form action="{{route('admin.districts.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$item->name}}" id="name">
                    </div>
                    <div class="col">
                        <label for="name">Name KY</label>
                        <input type="text" class="form-control" name="name_ky" value="{{$item->name_ky}}" id="name">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="X_coordinate">X coordinate</label>
                        <input type="text" class="form-control" name="X_coordinate" value="{{$item->X_coordinate}}" id="X_coordinate" >
                    </div>
                    <div class="col">
                        <label for="Y_coordinate">Y_coordinate</label>
                        <input type="text" class="form-control" name="Y_coordinate" id="Y_coordinate" value="{{$item->Y_coordinate}}">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description">{{$item->description}}</textarea>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="logo">Images</label>
                        <input type="file" class="form-control" id="image" name="images[]" placeholder="Image" multiple>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="lake_id">Lake</label>
                        <select id="lake_id" name="lake_id" class="form-control">
                            @foreach($lakes as $lake)
                                <option value="{{$lake->id}}" {{$item->lake_id == $lake->id ? 'selected' : ''}}>{{$lake->name}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                    <a href="{{route('admin.districts.index')}}" class="btn btn-secondary mr-2">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
