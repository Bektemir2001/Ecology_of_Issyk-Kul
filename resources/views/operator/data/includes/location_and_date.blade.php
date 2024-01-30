<div class="tab-pane fade active show" id="location-and-date" role="tabpanel">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Location and Date</h4>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class=" row align-items-center">
                    <div class="form-group col-sm-6">
                        <label for="fname">Control Point</label>
                        <input type="text" class="form-control" id="fname" value="{{$control_point->name}}" disabled>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="lname">Date</label>
                        <input type="date" class="form-control" id="exampleInputdate" name="date" value="2019-12-18">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="uname">User Name:</label>
                        <input type="text" class="form-control" id="uname" value="Barry@01">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="cname">City:</label>
                        <input type="text" class="form-control" id="cname" value="Atlanta">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="d-block">Gender:</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio6" name="customRadio1" class="custom-control-input" checked="">
                            <label class="custom-control-label" for="customRadio6"> Male </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio7" name="customRadio1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio7"> Female </label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="dob">Date Of Birth:</label>
                        <input  class="form-control" id="dob" value="1984-01-24">
                    </div>
                </div>
                <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
