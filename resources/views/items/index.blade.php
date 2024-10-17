@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="headerCharacter">
            <h1>Items</h1>
            <nav class="navbar navbar-light">
            </nav>
            <div class="d-flex mt-3 justify-content-between">
                <div>
                    <button id="showGrid" class="btn me-2 btn-outline-dark active">
                        <i class="bi bi-card-image"></i>
                    </button>
                    <button id="showTable" class="btn btn-outline-dark me-2">
                        <i class="bi bi-table"></i>
                    </button>
                    <a href="{{ route('items.create') }}" class="btn btn-outline-success me-2">Aggiungi Item</a>
                </div>
                <form action="{{ route('items.index') }}" method="GET" class="w-50">
                    <div class="d-flex">
                        <input name="search" class="form-control me-2 w-100 border-2" type="search" placeholder="Cerca..."
                            aria-label="Search" value="{{ request('search') }}">
                        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Cerca</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Vista a griglia -->
        <div id="gridView" class="row gy-5 gx-0 mt-3 justify-content-center">
            @foreach ($items as $item)
                <div class="col-3 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('items.show', $item->id) }}" class="text-decoration-none text-dark">
                            <h5 class="card-title text-center py-4">{{ $item->name }}</h5>
                            <img class="item_show_img" src="{{ asset('img/Items_icons/' . $item->name . '.png') }}"
                                alt="{{ $item->name }}">
                        </a>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="text-center">
                                <p class="card-text">Peso: {{ $item->weight }}</p>
                                <p class="card-text">Costo: {{ $item->cost }}</p>
                                <p class="card-text">Dadi: {{ $item->dice }}</p>
                            </div>
                            <div class="buttons-card d-flex justify-content-around mt-3">
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-outline-warning m-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger m-1 delete-item"
                                    data-item-id="{{ $item->id }}">
                                    <i class="bi bi-trash2-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="tableView" class="table-responsive py-5" style="display:none;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Peso</th>
                        <th>Costo</th>
                        <th>Dadi</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->weight }}</td>
                            <td>{{ $item->cost }}</td>
                            <td>{{ $item->dice }}</td>
                            <td>
                                <a href="{{ route('items.show', $item->id) }}" class="btn btn-primary">Visualizza</a>
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Modifica</a>

                                <button type="button" class="btn btn-danger m-1 delete-item"
                                    data-item-id="{{ $item->id }}">
                                    Cancella
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('items.partials.modal_items_delete')
@endsection
