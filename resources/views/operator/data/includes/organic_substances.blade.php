<div class="tab-pane fade" id="organic-substances" role="tabpanel">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Organic Substances</h4>
            </div>
        </div>
        <div class="card-body">
            <div id="organicSubstancesContentId">

            </div>
            <div class="form-group">
                <label for="organicSubstancesSelect">Choose organic substance</label>
                <select id="organicSubstancesSelect" class="form-control" onclick="chooseOrganicSubstance(this)">

                </select>
            </div>
        </div>
    </div>
</div>

<script>
    let organic_substances = [];
    let choice_organic_substances = [];
    let not_choice_organic_substances = [];
    function getAllOrganicSubstances()
    {
        let url = "{{route('organic_substances.get.all')}}";
        fetch(url, {
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })
            .then(response => response.json())
            .then(data => {
                organic_substances = data.data;
                not_choice_organic_substances = data.data;
                displayOrganicSubstanceInSelect();
            });
    }
    getAllOrganicSubstances();

    function displayOrganicSubstanceInSelect()
    {
        let select = document.getElementById('organicSubstancesSelect');
        while (select.firstChild) {
            select.removeChild(select.firstChild);
        }
        select.add(document.createElement('option'));
        for(let i = 0; i < not_choice_organic_substances.length; i++)
        {
            let option = document.createElement('option');
            option.text = not_choice_organic_substances[i].name;
            option.value = not_choice_organic_substances[i].id;
            select.add(option);
        }
    }

    function chooseOrganicSubstance(selectElement)
    {
        let OrganicSubstancesContent = document.getElementById('organicSubstancesContentId');
        let selectedIndex = selectElement.selectedIndex;
        let selectedOption = selectElement.options[selectedIndex];
        for (let i = 0; i < not_choice_organic_substances.length; i++)
        {
            if(not_choice_organic_substances[i].id === parseInt(selectedOption.value))
            {
                displayOrganicSubstanceToInput(not_choice_organic_substances[i], OrganicSubstancesContent);
                choice_organic_substances.push(not_choice_organic_substances[i]);
                not_choice_organic_substances.splice(i, 1);
                break;
            }
        }
        displayOrganicSubstanceInSelect();
    }

    function displayOrganicSubstanceToInput(element, OrganicSubstancesContent)
    {
        let divElement = document.createElement('div');
        divElement.className = "form-group";
        divElement.innerHTML = `<label for="choiceOrganicSubstance${element.id}">${element.name}</label>
                            <input type="number" id="choiceOrganicSubstance${element.id}" class="form-control"/>`;
        OrganicSubstancesContent.appendChild(divElement);
        checkInputs();
        return 'finish';
    }

    function validate_organic_substances()
    {
        let input_organic_sentences = {}
        for(let i = 0; i < choice_organic_substances.length; i++)
        {
            input_organic_sentences[choice_organic_substances[i].id] = document.getElementById(`choiceOrganicSubstance${choice_organic_substances[i].id}`);
        }
        return validate_and_get_data(input_organic_sentences);
    }
</script>
