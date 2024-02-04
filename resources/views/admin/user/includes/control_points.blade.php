<div class="tab-pane fade" id="control-points" role="tabpanel">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Control Points</h4>
            </div>
        </div>
        <div>
            @foreach($item->controlPoints as $point)
                <div class="col-sm-6 col-md-6 mt-4 mb-4 mt-lg-0">
                    <div class="inner-shadow p-4 shadow-showcase d-flex justify-content-between">
                        <div>
                            <h6>{{$point->name}}</h6>
                            <h6>{{$point->number}}</h6>
                        </div>
                        <div>
                            <button class="btn btn-danger">delete</button>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        <div class="card-body">
            <form action="{{route('admin.users.add.control_point', $item->id)}}" method="POST">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="lakes">Lake</label>
                    <select class="form-control choicesjs" id="lakes" name="lakes">
                        @foreach($lakes as $lake)
                            <option value="{{$lake->id}}">{{$lake->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="control_points">Control Points</label>
                    <select class="form-control choicesjs" id="control_points" name="control_point">
                        @foreach($control_points as $control_point)
                            <option value="{{$control_point->id}}">{{$control_point->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
