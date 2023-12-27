@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Add Control Point</h4>
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
            <form action="{{route('admin.control_points.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" id="name">
                    </div>
                    <div class="col">
                        <label for="name">Name KY</label>
                        <input type="text" class="form-control" name="name_ky" placeholder="Name" id="name">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="X_coordinate">X coordinate</label>
                        <input type="text" class="form-control" name="X_coordinate" id="X_coordinate" placeholder="X coordinate">
                    </div>
                    <div class="col">
                        <label for="Y_coordinate">Y_coordinate</label>
                        <input type="text" class="form-control" name="Y_coordinate" id="Y_coordinate" placeholder="Y coordinate">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="number">Number</label>
                        <input type="text" class="form-control" name="number" id="number" placeholder="Number">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        <label for="lake_id">Lake</label>
                        <select id="lake_id" name="lake_id" class="form-control">
                            @foreach($lakes as $lake)
                                <option value="{{$lake->id}}">{{$lake->name}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
        </div>
    </div>

{{--    <script>--}}
{{--        let url = "https://api.anthropic.com/v1/complete";--}}
{{--        let token = "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"--}}
{{--        let headers = {--}}
{{--            "anthropic-version": "2023-06-01",--}}
{{--            "x-api-key": token,--}}
{{--            "Content-Type": "application/json",--}}
{{--            "Access-Control-Allow-Origin": "http://127.0.0.1:8000"--}}
{{--        };--}}
{{--        let data = {--}}
{{--            "model": "claude-2",--}}
{{--            "prompt": "\n\nHuman: Жашоонун маңызы эмне!\n\nAssistant:",--}}
{{--            "max_tokens_to_sample": 512,--}}
{{--            "stream": true--}}
{{--        }--}}
{{--        fetch(url, {--}}
{{--            method: "POST",--}}
{{--            headers: headers,--}}
{{--            body: data--}}
{{--        })--}}
{{--            .then(response => response.json())--}}
{{--            .then(data => {--}}
{{--                console.log(data)--}}
{{--            });--}}
{{--    </script>--}}
@endsection
