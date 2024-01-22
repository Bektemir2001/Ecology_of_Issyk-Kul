<div class="tab-pane fade active show" id="personal-information" role="tabpanel">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Personal Information</h4>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group row align-items-center">
                    <div class="col-md-12">
                        <div class="profile-img-edit">
                            <div class="crm-profile-img-edit">
                                <img class="crm-profile-pic rounded-circle avatar-100" src="{{asset('admin_files/assets/images/user/1.jpg')}}" alt="profile-pic">
                                <div class="crm-p-image bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <input class="file-upload" type="file" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" row align-items-center">
                    <div class="form-group col-sm-6">
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" id="fname" value="Barry">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" id="lname" value="Tech">
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
                    <div class="form-group col-sm-6">
                        <label>Marital Status:</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option selected="">Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                            <option>Divorced</option>
                            <option>Separated </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Age:</label>
                        <select class="form-control" id="exampleFormControlSelect2">
                            <option>12-18</option>
                            <option>19-32</option>
                            <option selected="">33-45</option>
                            <option>46-62</option>
                            <option>63 > </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Country:</label>
                        <select class="form-control" id="exampleFormControlSelect3">
                            <option>Caneda</option>
                            <option>Noida</option>
                            <option selected="">USA</option>
                            <option>India</option>
                            <option>Africa</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>State:</label>
                        <select class="form-control" id="exampleFormControlSelect4">
                            <option>California</option>
                            <option>Florida</option>
                            <option selected="">Georgia</option>
                            <option>Connecticut</option>
                            <option>Louisiana</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Address:</label>
                        <textarea class="form-control" name="address" rows="5" style="line-height: 22px;">37 Cardinal Lane
Petersburg, VA 23803
United States of America
Zip Code: 85001</textarea>
                    </div>
                </div>
                <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
