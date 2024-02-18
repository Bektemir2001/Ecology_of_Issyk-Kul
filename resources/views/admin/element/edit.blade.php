@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Элементти өзгөртүү</h4>
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
            <form action="{{route('admin.elements.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="name">Аталышы</label>
                        <input type="text" class="form-control" name="name" value="{{$item->name}}" id="name">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="logo">Сүрөт</label>
                        <input type="file" class="form-control" id="image" name="image" placeholder="Image">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="description">Аныктама</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                    </div>
                </div>
                @if(count($elements))
                    <div class="form-row mb-4">
                        <div class="col">
                            <label for="parent">Parent</label>
                            <select id="parent" name="parent" class="form-control">
                                <option></option>
                                @foreach($elements as $element)
                                    <option value="{{$element->id}}" {{$item->parent === $element->id ? 'selected' : ''}}>{{$element->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                @endif
                <div class="form-row mb-4">
                    <div class="col">

                        <div class="d-flex justify-content">
                            <div class="col-3">
                                <label for="TLI_formula">TLI формула</label>
                                <input type="text" class="form-control" id="TLI_formula" name="TLI_formula">
                            </div>
                            <div class="col-2">
                                <label for="TLI_function">Функция</label>
                                <select id="TLI_function" class="form-control">
                                    <option>Log</option>
                                    <option>Ln</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="TLI_argument">Аргумент</label>
                                <input type="text" class="form-control" id="TLI_argument" name="TLI_argument" value="(item)">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
