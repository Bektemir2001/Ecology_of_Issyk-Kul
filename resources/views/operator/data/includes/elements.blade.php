<div class="tab-pane fade" id="elements" role="tabpanel">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Elements</h4>
            </div>
        </div>
        <div class="card-body">
            <div id="elementsContentId">

            </div>
            <div class="form-group">
                <label for="elementsSelect">Choose element</label>
                <select id="elementsSelect" class="form-control" onclick="chooseElement(this)">

                </select>
            </div>
        </div>
    </div>
</div>

<script>
    let elements = [];
    let choice_elements = [];
    let not_choice_elements = [];
    function getAllElements()
    {
        let url = "{{route('elements.get.all')}}";
        fetch(url, {
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })
            .then(response => response.json())
            .then(data => {
                elements = data.data;
                not_choice_elements = data.data;
                displayElementsInSelect();
            });
    }
    getAllElements();

    function displayElementsInSelect()
    {
        let select = document.getElementById('elementsSelect');
        while (select.firstChild) {
            select.removeChild(select.firstChild);
        }
        select.add(document.createElement('option'));
        for(let i = 0; i < not_choice_elements.length; i++)
        {
            let option = document.createElement('option');
            option.text = not_choice_elements[i].name;
            option.value = not_choice_elements[i].id;
            select.add(option);
        }
    }

    function chooseElement(selectElement)
    {
        let ElementsContent = document.getElementById('elementsContentId');
        let selectedIndex = selectElement.selectedIndex;
        let selectedOption = selectElement.options[selectedIndex];
        for (let i = 0; i < not_choice_elements.length; i++)
        {
            if(not_choice_elements[i].id === parseInt(selectedOption.value))
            {
                displayElementToInput(not_choice_elements[i], ElementsContent);
                choice_elements.push(not_choice_elements[i]);
                not_choice_elements.splice(i, 1);
                break;
            }
        }
        displayElementsInSelect();
    }

    function displayElementToInput(element, ElementsContent)
    {
        if(element.children.length > 0)
        {
            let childrenElements = element.children;
            for(let i = 0; i < childrenElements.length; i++)
            {
                let divElement = document.createElement('div');
                divElement.className = "form-group";
                divElement.innerHTML = `<label for="choiceElement${childrenElements[i].id}">${element.name}(${childrenElements[i].name})</label>
                            <input type="number" id="choiceElement${childrenElements[i].id}" class="form-control"/>`
                ElementsContent.appendChild(divElement)
            }
            checkInputs();
            return 'finish';
        }
        let divElement = document.createElement('div');
        divElement.className = "form-group";
        divElement.innerHTML = `<label for="choiceElement${element.id}">${element.name}</label>
                            <input type="number" id="choiceElement${element.id}" class="form-control"/>`;
        ElementsContent.appendChild(divElement)
        checkInputs();
        return 'finish';
    }
    function validate_elements()
    {
        let input_elements = {};
        for(let i = 0; i < choice_elements.length; i++)
        {
            if(choice_elements[i].children.length > 0)
            {
                let children = choice_elements[i].children;
                for(let k = 0; k < children.length; k++)
                {
                    input_elements[children[i].id] = document.getElementById(`choiceElement${children[i].id}`);
                }
            }
            else{
                input_elements[choice_elements[i].id] = document.getElementById(`choiceElement${choice_elements[i].id}`);
            }
        }
        return validate_and_get_data(input_elements);
    }
</script>
