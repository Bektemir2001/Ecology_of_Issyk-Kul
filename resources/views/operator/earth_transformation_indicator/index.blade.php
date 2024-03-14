@extends('layouts.operator')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">{{$title}}</h4>
                        <a href="{{route($create_route)}}" class="btn btn-outline-primary rounded-pill mt-2">Add</a>
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
                        <table id="datatable-1" class="table data-table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Район</th>
                                <th>Жыл</th>
                                <th>Жээкке чейинки аралык</th>
                                <th>Аянт</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->district->name}}</td>
                                    <td>{{Carbon\Carbon::parse($item->date)->year}}</td>
                                    <td>{{$item->from_the_coast}}</td>
                                    <td>{{$item->area}}</td>
                                    <td class="text-right">
                                        @include('includes.table.icons')
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Район</th>
                                <th>Жыл</th>
                                <th>Жээкке чейинки аралык</th>
                                <th>Аянт</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

