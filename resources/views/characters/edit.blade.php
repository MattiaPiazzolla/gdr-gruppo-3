@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Modifica Personaggio</h1>

        <form id="character-form" action="{{ route('characters.update', $character->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" value="{{ $character->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descrizione</label>
                <input type="text" class="form-control" name="description" value="{{ $character->description }}"
                    required>
            </div>

            <div class="form-group">
                <label for="strength">Forza</label>
                <input type="number" class="form-control" name="strength" value="{{ $character->strength }}" required>
            </div>

            <div class="form-group">
                <label for="defence">Difesa</label>
                <input type="number" class="form-control" name="defence" value="{{ $character->defence }}" required>
            </div>

            <div class="form-group">
                <label for="speed">Velocità</label>
                <input type="number" class="form-control" name="speed" value="{{ $character->speed }}" required>
            </div>

            <div class="form-group">
                <label for="intelligence">Intelligenza</label>
                <input type="number" class="form-control" name="intelligence" value="{{ $character->intelligence }}"
                    required>
            </div>

            <div class="form-group">
                <label for="life">Vita</label>
                <input type="number" class="form-control" name="life" value="{{ $character->life }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="type_id">Tipo</label>
                <select class="form-control" name="type_id" required>
                    <option value="">Seleziona un tipo</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $character->type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <h5>Oggetti Disponibili:</h5>
                    <div id="available-items-list" class="row g-3">
                        @foreach ($items as $item)
                            <div class="col-3 me-2 available-item btn btn-dark" data-id="{{ $item->id }}">
                                {{ $item->name }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6">
                    <h5>Oggetti Selezionati:</h5>
                    <ul id="selected-items-list" class="list-group"></ul>
                </div>
            </div>

            <div class="d-flex justify-content-between my-5">
                <button type="submit" class="btn btn-success mt-3">Aggiorna Personaggio</button>
                <a href="{{ route('characters.index') }}" class="btn btn-danger mt-3">Annulla</a>
            </div>
        </form>
    </div>

    <script>
        const selectedItems = {};
        @foreach ($character->items as $item)
            selectedItems['{{ $item->id }}'] = {
                name: '{{ $item->name }}',
                quantity: {{ $item->pivot->quantity }}
            };
        @endforeach
        updateSelectedItemsList();

        document.querySelectorAll('.available-item').forEach(item => {
            item.addEventListener('click', () => {
                const itemId = item.dataset.id;

                if (selectedItems[itemId]) {
                    selectedItems[itemId].quantity += 1;
                } else {
                    selectedItems[itemId] = {
                        name: item.innerText,
                        quantity: 1
                    };
                }

                updateSelectedItemsList();
            });
        });

        function updateSelectedItemsList() {
            const selectedList = document.getElementById('selected-items-list');
            selectedList.innerHTML = '';

            for (const id in selectedItems) {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.textContent = `${selectedItems[id].name} (Quantità: ${selectedItems[id].quantity})`;

                const removeButton = document.createElement('button');
                removeButton.className = 'btn btn-danger btn-sm';
                removeButton.textContent = '✖';
                removeButton.onclick = () => removeItem(id);

                listItem.appendChild(removeButton);
                selectedList.appendChild(listItem);
            }

            updateHiddenInputs();
        }

        function removeItem(id) {
            if (selectedItems[id].quantity > 1) {
                selectedItems[id].quantity -= 1;
            } else {
                delete selectedItems[id];
            }
            updateSelectedItemsList();
        }

        function updateHiddenInputs() {
            const existingInputs = document.querySelectorAll('input[name^="items"]');
            existingInputs.forEach(input => input.remove());

            for (const id in selectedItems) {
                const quantityInput = document.createElement('input');
                quantityInput.type = 'hidden';
                quantityInput.name = `items[${id}][quantity]`;
                quantityInput.value = selectedItems[id].quantity;

                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = `items[${id}][id]`;
                idInput.value = id;

                document.getElementById('character-form').appendChild(quantityInput);
                document.getElementById('character-form').appendChild(idInput);
            }
        }
    </script>
@endsection
