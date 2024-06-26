@extends('layouts.operator')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Данные</h4>
                        <a href="{{route('operator.data.create')}}" class="btn btn-outline-primary rounded-pill mt-2">Добавить</a>
                    </div>
                    <div class="header-action">
                        <i data-toggle="collapse" data-target="#datatable-1" aria-expanded="false">
                            <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="collapse" id="datatable-1">

                    </div>
                    <div class="table-responsive">
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Точка контроля</th>
                                <th>Дата отбора</th>
                                <th>Расстояние от начальной точки</th>
                                <th>Глубина</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($points as $point)
                                <tr>
                                    <td>{{$point->id}}</td>
                                    <td>{{$point->controlPoint->name}}</td>
                                    <td>{{$point->date}}</td>
                                    <td>{{$point->distance_from_starting_point." м"}}</td>
                                    <td>{{$point->depth === 'from_below' ? "Придонный"." - ".$point->depth_item.' м' : "от поверхности"." - ".$point->depth_item.' м'}}</td>
                                    <td class="text-right">
                                        <div class="icon-container">
                                            <a href="{{route('operator.data.edit', $point->id)}}" class="svg-icon small-icon">
                                                <i class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </i>
                                            </a>
                                            <a href="{{route('operator.data.delete', $point->id)}}" class="svg-icon small-icon" onclick="return confirmDeletion()">
                                                <i class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Точка контроля</th>
                                <th>Дата отбора</th>
                                <th>Расстояние от начальной точки</th>
                                <th>Глубина</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0">
                            {{$points->links()}}
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
@endsection
