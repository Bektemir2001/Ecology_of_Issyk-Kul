@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Update Major Ion</h4>
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
            <form action="{{route('admin.major_ions.update', $item->id)}}" method="POST">
                @csrf
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="ckeditor">Name</label>
                        <textarea style="height: 20px;" name="name" id="ckeditor" required autofocus oninvalid="this.setCostomValidity('пожалуйста, заполните это поле')" oninput="this.setCostomValidity('')">{!! $item->name !!}</textarea>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <textarea class="form-control" name="description" placeholder="Description">{{$item->description}}</textarea>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-6">
                        <label for="pdk_up">ПДК максимум</label>
                        <input type="text" class="form-control" id="pdk_up" name="pdk_up" value="{{$item->pdk_up}}">
                    </div>
                    <div class="col-6">
                        <label for="pdk_dawn">ПДК минимум</label>
                        <input type="text" class="form-control" id="pdk_dawn" name="pdk_dawn" value="{{$item->pdk_dawn}}">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script>
        var editor = CKEDITOR.replace( 'ckeditor',{
            filebrowserUploadMethod: 'form'
        } );
    </script>
@endsection
