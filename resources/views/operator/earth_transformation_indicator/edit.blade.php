@extends('layouts.operator')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Жердин Трансформациялоо Көрсөткүчүн Кошуу</h4>
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
            <form action="{{route('operator.earth.transformation.indicators.update', $item->id)}}" method="POST">
                @csrf
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="district_id">Район</label>
                        <select class="form-control" id="district_id" name="district_id" disabled>
                            @foreach($districts as $district)
                                <option value="{{$district->id}}" {{$item->district_id === $district->id ? 'selected': ''}}>{{$district->name}}</option>
                            @endforeach
                        </select>
                        @error('district_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="date">Дата</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{$item->date}}" disabled>
                        @error('date')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="from_the_coast">Жээкке чейинки аралык</label>
                        <input type="number" class="form-control" id="from_the_coast" name="from_the_coast" value="{{$item->from_the_coast}}" disabled>
                        @error('from_the_coast')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="area">Аянт</label>
                        <input type="text" class="form-control" id="area" name="area" value="{{$item->area}}">
                        @error('area')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @error('unique')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary mr-2">Сактоо</button>
                </div>
            </form>
        </div>
    </div>

@endsection
