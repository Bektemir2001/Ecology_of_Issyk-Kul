@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">{{$item->name}}</h4>
            </div>
            <div class="header-action">
                <i data-toggle="collapse" data-target="#form-element-9" aria-expanded="false">
                    <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </i>
            </div>
        </div>
        <div class="card-body">
            <div class="collapse" id="form-element-9">
                <div class="card"></div>
            </div>
            <h5>item: {{$item->item}}</h5>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Elements</h4>
                </div>
            </div>
            <div class="card-body">
                @foreach($item->elementIndeces as $element)
                    <p><b>{{$element->element->name}}: </b>{{$element->from}} - {{$element->to}}</p>
                @endforeach
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
            let choice_element_id = 0;
            function getAllElements()
            {
                let url = "{{route('elements.get.all', [$t_index_id => $item->id])}}";
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
                if(selectElement.value) {

                    let ElementsContent = document.getElementById('elementsContentId');
                    let selectedIndex = selectElement.selectedIndex;
                    let selectedOption = selectElement.options[selectedIndex];
                    for (let i = 0; i < not_choice_elements.length; i++) {
                        if (not_choice_elements[i].id === parseInt(selectedOption.value)) {
                            displayElementToInput(not_choice_elements[i], ElementsContent);
                            choice_elements.push(not_choice_elements[i]);
                            not_choice_elements.splice(i, 1);
                            break;
                        }
                    }
                    document.getElementById('elementsSelect').disabled = true;
                    displayElementsInSelect();
                }
            }

            function displayElementToInput(element, ElementsContent)
            {
                let divElement = document.createElement('div');
                divElement.className = "form-group";
                divElement.innerHTML = `
             <div class="container">
                <div class="card" id="choiceElement${element.id}">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">${element.name}</h4>
                        </div>
                        <div class="header-action">
                            <i data-toggle="collapse" data-target="#form-element-9" aria-expanded="false" onclick="closeForm()">
                                <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>

                            </i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="col">
                                <label for="from">From</label>
                                <input type="number" id="from" class="form-control">
                            </div>
                            <div class="col">
                                <label for="to">To</label>
                                <input type="number" id="to" class="form-control">
                            </div>

                        </div>
                        <button class="btn btn-primary mb-4 mt-4 col-3" onclick="submitElement()">submit</button>
                    </div>

                </div>
            </div>
`;
                ElementsContent.appendChild(divElement)
                choice_element_id = element.id;
                return 'finish';
            }

            function submitElement()
            {
                let from = document.getElementById('from');
                let to = document.getElementById('to');
                if(from.value && to.value)
                {
                    let url = "{{route($add_element_url)}}";
                    let data = new FormData();
                    data.append('from', from.value);
                    data.append('to', to.value);
                    data.append('t_index_id', "{{$item->id}}");
                    data.append('element_id', choice_element_id);

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        },
                        body: data
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            document.getElementById('elementsContentId').innerHTML = '';
                            document.getElementById('elementsSelect').disabled = false;
                        })
                        .catch(error => {
                            console.log(error)
                        });
                }
                else{
                    alert('Баардык талааларды толтуруңуз');
                }
            }

        function closeForm()
        {
            document.getElementById('elementsContentId').innerHTML = '';
            document.getElementById('elementsSelect').disabled = false;
            let element = choice_elements[choice_elements.length - 1];
            choice_elements.splice(choice_elements.length - 1, 1);
            not_choice_elements.push(element);
            displayElementsInSelect();
        }
        </script>
@endsection
