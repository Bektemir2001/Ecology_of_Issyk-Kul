@extends('layouts.operator')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="iq-edit-list usr-edit">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                            <li class="col-md-3 p-0">
                                <a class="nav-link active" data-toggle="pill" href="#location-and-date">
                                    Location and date
                                </a>
                            </li>
                            <li class="col-md-3 p-0">
                                <a class="nav-link" data-toggle="pill" href="#elements">
                                    Elements
                                </a>
                            </li>
                            <li class="col-md-3 p-0">
                                <a class="nav-link" data-toggle="pill" href="#major-ions">
                                    Major ions
                                </a>
                            </li>
                            <li class="col-md-3 p-0">
                                <a class="nav-link" data-toggle="pill" href="#organic-substances">
                                    Organic substances
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                        @include('operator.data.includes.location_and_date')
                        @include('operator.data.includes.elements')
                        @include('operator.data.includes.major_ions')
                        @include('operator.data.includes.organic_substances')
                </div>
            </div>
        </div>
    </div>
    <div>
        <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
        <button type="submit" class="btn btn-primary" onclick="submit()">Submit</button>
    </div>

    <script>
        function submit()
        {
            let location_and_data = validate_location_and_data();
            let physical_properties_and_gas_composition = validate_Physical_properties_and_gas_composition();
            let elements = validate_elements();
            let major_ions = validate_major_ions();
            let organic_substances = validate_organic_substances();

            console.log(location_and_data);
            console.log(physical_properties_and_gas_composition);
        }
    </script>
@endsection
