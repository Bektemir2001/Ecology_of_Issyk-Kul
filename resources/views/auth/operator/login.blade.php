@extends('layouts.auth')
@section('content')
    <section class="login-content">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="auth-logo">
                                <img src="{{asset('admin_files/assets/images/logo.png')}}" class="img-fluid rounded-normal" alt="logo">
                            </div>
                            <h2 class="mb-2 text-center">Sign In</h2>
                            <form action="{{route('auth.operator.login')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="email" id="email" name="email" placeholder="admin@example.com">
                                            @error('email')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" id="password" name="password" placeholder="********">
                                            @error('password')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="lakes">Lake</label>
                                            <select class="form-control choicesjs" id="lakes" name="lakes">
                                                @foreach($lakes as $lake)
                                                    <option value="{{$lake->id}}">{{$lake->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('lakes')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="control_points">Control Points</label>
                                            <select class="form-control choicesjs" id="control_points" name="control_point">
                                                @foreach($control_points as $control_point)
                                                    <option value="{{$control_point->id}}">{{$control_point->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('control_point')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


