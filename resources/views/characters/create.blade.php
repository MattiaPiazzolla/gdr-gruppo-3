@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Crea Personaggio</h1>

        <!-- Mostra gli errori generali -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="character-form" action="{{ route('characters.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descrizione</label>
                <input type="text" class="form-control" name="description" required value="{{ old('description') }}">
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="strength">Forza</label>
                <input type="number" class="form-control" name="strength" required value="{{ old('strength') }}">
                @error('strength')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="defence">Difesa</label>
                <input type="number" class="form-control" name="defence" required value="{{ old('defence') }}">
                @error('defence')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="speed">Velocità</label>
                <input type="number" class="form-control" name="speed" required value="{{ old('speed') }}">
                @error('speed')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="intelligence">Intelligenza</label>
                <input type="number" class="form-control" name="intelligence" required value="{{ old('intelligence') }}">
                @error('intelligence')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="life">Vita</label>
                <input type="number" class="form-control" name="life" required value="{{ old('life') }}">
                @error('life')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Immagine -->
            <div class="form-group">
                <label for="image">Immagine del personaggio</label>
                <input type="file" name="image" class="form-control" accept=".png, .webp">
                <small class="form-text text-muted">Carica un'immagine in formato .png o .webp</small>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="type_id">Tipo</label>
                <select class="form-control" name="type_id" required>
                    <option value="">Seleziona un tipo</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
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
                <button type="submit" class="btn btn-success mt-3">Crea Personaggio</button>
                <a href="{{ route('characters.index') }}" class="btn btn-danger mt-3">Annulla</a>
            </div>
        </form>
    </div>

    <script>
        const selectedItems = {};

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
