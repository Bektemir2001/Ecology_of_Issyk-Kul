<div class="tab-pane fade active show" id="location-and-date" role="tabpanel">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Location and Date</h4>
            </div>
        </div>
        <div class="card-body">
                <div class=" row align-items-center">
                    <div class="form-group col-sm-6">
                        <label for="control_point">Control Point</label>
                        <input type="text" class="form-control" id="control_point" value="{{$control_point->name}}" disabled>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="2019-12-18">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="from_starting_point">Distance from the starting point</label>
                        <input type="text" class="form-control" id="from_starting_point" placeholder="0 meter">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="depth">Depth</label>
                        <div class="d-flex justify-content-between">
                            <div class="col-6">
                                <select class="form-control" id="depth">
                                    <option value="from_below">from below</option>
                                    <option value="from_the_surface">from the surface</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <input class="form-control" placeholder="0 meter" id="depth">
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>
