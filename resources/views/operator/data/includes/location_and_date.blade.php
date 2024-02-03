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
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="from_starting_point">Distance from the starting point</label>
                        <input type="number" class="form-control" id="from_starting_point">
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
                                <input type="number" class="form-control" placeholder="meter" id="depth_item">
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Physical properties and gas composition</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="form-group col-sm-6">
                    <label for="temperature">Water temperature, deg.</label>
                    <input type="number" class="form-control" id="temperature">
                </div>
                <div class="form-group col-sm-6">
                    <label for="transparency">Transparency on the white disk, m</label>
                    <input type="number" class="form-control" id="transparency" name="transparency">
                </div>
                <div class="form-group col-sm-6">
                    <label for="hardness">Total hardness, mmol/l</label>
                    <input type="number" class="form-control" id="hardness">
                </div>
                <div class="form-group col-sm-6">
                    <label for="electrical_conductivity">Electrical conductivity, mS/cm</label>
                    <input type="number" class="form-control" id="electrical_conductivity" name="electrical_conductivity">
                </div>
                <div class="form-group col-sm-6">
                    <label for="pH">рН</label>
                    <input type="number" class="form-control" id="pH">
                </div>

            </div>
            <h4 class="card-title">Oxygen</h4>
            <div class="row align-items-center">
                <div class="form-group col-sm-6">
                    <label for="oxygen_mg">mg/l</label>
                    <input type="number" class="form-control" id="oxygen_mg">
                </div>
                <div class="form-group col-sm-6">
                    <label for="oxygen_saturation"><b>% </b>saturation</label>
                    <input type="number" class="form-control" id="oxygen_saturation" name="oxygen_saturation">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validate_location_and_data()
    {
        let data = {
            date: document.getElementById('date'),
            from_starting_point: document.getElementById('from_starting_point'),
            depth: document.getElementById('depth'),
            depth_item: document.getElementById('depth_item')
        }
        return validate_and_get_data(data);
    }
    function validate_Physical_properties_and_gas_composition()
    {

        let data = {
            temperature: document.getElementById('temperature'),
            transparency: document.getElementById('transparency'),
            hardness: document.getElementById('hardness'),
            electrical_conductivity: document.getElementById('electrical_conductivity'),
            pH: document.getElementById('pH'),
            oxygen_mg: document.getElementById('oxygen_mg'),
            oxygen_saturation: document.getElementById('oxygen_saturation')
        };
        return validate_and_get_data(data);
    }

    function validate_and_get_data(data)
    {
        for (let key in data) {
            if(!validate(data[key]))
            {
                return false;
            }
            data[key] = data[key].value;
        }
        return data;
    }
    function validate(input)
    {
        if(input.value)
        {
            return true;
        }
        input.className = "form-control is-invalid";
        return false;
    }
    function isValidInput(value) {
        return value.trim() !== '';
    }
</script>
