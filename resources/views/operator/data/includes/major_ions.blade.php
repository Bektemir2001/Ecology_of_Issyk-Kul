<div class="tab-pane fade" id="major-ions" role="tabpanel">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Главные ионы</h4>
            </div>
        </div>
        <div class="card-body">
            <div id="ionsContentId">

            </div>
            <div class="form-group">
                <div class="btn-group">
                    <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="width: 300px;">
                        Выберите ион
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" id="ionsSelect" style="max-height: 200px; overflow-y: auto; width: 300px;">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let ions = [];
    let choice_ions = [];
    let not_choice_ions = [];
    function getAllIons()
    {
        let url = "{{route('ions.get.all')}}";
        fetch(url, {
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })
            .then(response => response.json())
            .then(data => {
                ions = data.data;
                not_choice_ions = data.data;
                displayIonsInSelect();
            });
    }
    getAllIons()
    function displayIonsInSelect()
    {
        let select = document.getElementById('ionsSelect');
        while (select.firstChild) {
            select.removeChild(select.firstChild);
        }
        select.appendChild(document.createElement('li'));
        for(let i = 0; i < not_choice_ions.length; i++)
        {
            let li = document.createElement('li');
            li.innerHTML = `<li><button class="dropdown-item" type="button" onclick="chooseIons(${not_choice_ions[i].id})">${not_choice_ions[i].name}</button></li>`
            select.appendChild(li);
        }
    }

    function chooseIons(selectIon)
    {
        let IonsContent = document.getElementById('ionsContentId');
        for (let i = 0; i < not_choice_ions.length; i++)
        {
            if(not_choice_ions[i].id === parseInt(selectIon))
            {
                displayIonToInput(not_choice_ions[i], IonsContent);
                choice_ions.push(not_choice_ions[i]);
                not_choice_ions.splice(i, 1);
                break;
            }
        }
        displayIonsInSelect();
    }

    function displayIonToInput(ion, IonsContent)
    {
        let divElement = document.createElement('div');
        divElement.className = "form-group";
        divElement.innerHTML = `<label for="choiceIon${ion.id}">${ion.name}</label>
                            <input type="text" id="choiceIon${ion.id}" class="form-control"/>`;
        IonsContent.appendChild(divElement);
        checkInputs();
        return 'finish';
    }

    function validate_major_ions()
    {
        let input_ions = {}
        for(let i = 0; i < choice_ions.length; i++)
        {
            input_ions[choice_ions[i].id] = document.getElementById(`choiceIon${choice_ions[i].id}`);
        }
        return validate_and_get_data(input_ions);
    }
</script>
