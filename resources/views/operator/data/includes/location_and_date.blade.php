<div class="tab-pane fade active show" id="location-and-date" role="tabpanel">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Место и дата</h4>
            </div>
        </div>
        <div class="card-body">
                <div class=" row align-items-center">
                    <div class="form-group col-sm-6">
                        <label for="lake">Озеро</label>
                        <select class="form-control" id="lake" onclick="getDistricts()">
                            @foreach($lakes as $lake)
                                <option value="{{$lake->id}}">{{$lake->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6" id="districtsBlock"></div>
                    <div class="form-group col-sm-6" id="controlPointBlock"></div>
                    <div class="form-group col-sm-6">
                        <label for="date">Дата</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="from_starting_point">Расстояние от начальной точки</label>
                        <input type="number" class="form-control" id="from_starting_point">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="depth">Глубина</label>
                        <div class="d-flex justify-content-between">
                            <div class="col-6">
                                <select class="form-control" id="depth">
                                    <option value="from_below">придонный</option>
                                    <option value="from_the_surface">от поверхности</option>
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
                <h4 class="card-title">Физические свойства и состав газа</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="form-group col-sm-6">
                    <label for="temperature">Температура воды, град.</label>
                    <input type="number" class="form-control" id="temperature">
                </div>
                <div class="form-group col-sm-6">
                    <label for="transparency">Прозрачность белого диска, м</label>
                    <input type="number" class="form-control" id="transparency" name="transparency">
                </div>
                <div class="form-group col-sm-6">
                    <label for="hardness">Общая жесткость, ммоль/л</label>
                    <input type="number" class="form-control" id="hardness">
                </div>
                <div class="form-group col-sm-6">
                    <label for="electrical_conductivity">Электропроводность, мС/см</label>
                    <input type="number" class="form-control" id="electrical_conductivity" name="electrical_conductivity">
                </div>
                <div class="form-group col-sm-6">
                    <label for="pH">рН</label>
                    <input type="number" class="form-control" id="pH">
                </div>

            </div>
            <h4 class="card-title">Кислород</h4>
            <div class="row align-items-center">
                <div class="form-group col-sm-6">
                    <label for="oxygen_mg">mg/l</label>
                    <input type="number" class="form-control" id="oxygen_mg">
                </div>
                <div class="form-group col-sm-6">
                    <label for="oxygen_saturation"><b>% </b>насыщение</label>
                    <input type="number" class="form-control" id="oxygen_saturation" name="oxygen_saturation">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkInputs()
    {
        let inputElements = document.querySelectorAll('.form-control');
        inputElements.forEach(function (inputElement) {
            inputElement.addEventListener('input', function () {
                if (isValidInput(inputElement.value)) {
                    inputElement.classList.remove('is-invalid');
                }
            });
        });
    }
    function validate_location_and_data()
    {
        let data = {
            date: document.getElementById('date'),
            distance_from_starting_point: document.getElementById('from_starting_point'),
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

    function getDistricts()
    {
        let lake_id = document.getElementById('lake').value;
        let url = `/districts/get/${lake_id}`

        fetch(url, {
            headers : {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })
            .then(response => response.json())
            .then(data => {
                let districtsBlock = document.getElementById('districtsBlock');
                let content = `<label for="district">Район</label> <select class="form-control" id="district" onclick="getControlPoints()">`
                data = data.data;
                data.forEach(function (item){
                    content += `<option value="${item.id}">${item.name}</option>`;
                });
                content += `</select>`;
                districtsBlock.innerHTML = content;
                getControlPoints();
            });
    }

    function getControlPoints()
    {
        let district_id = document.getElementById('district').value;
        let url = `/control_points/get/${district_id}`;
        fetch(url, {
            headers : {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })
            .then(response => response.json())
            .then(data => {
                let controlPointsBlock = document.getElementById('controlPointBlock');
                let content = `<label for="control_point">Контрольная точка</label> <select class="form-control" id="control_point">`
                data = data.data;
                data.forEach(function (item){
                    content += `<option value="${item.id}">${item.name}</option>`;
                });
                content += `</select>`;
                controlPointsBlock.innerHTML = content;
            });
    }

    getDistricts()

    function validateControlPoint()
    {
        let control_point = document.getElementById('control_point');
        if(control_point.value)
        {
            return control_point.value;
        }
        control_point.className = "form-control is-invalid";
        return false;

    }
</script>
