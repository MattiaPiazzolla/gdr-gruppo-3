@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="headerCharacter">
            <h1>Tipologia</h1>
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
                    <a href="{{ route('types.create') }}" class="btn btn-outline-success me-2">Aggiungi Type</a>
                </div>
                <form action="{{ route('types.index') }}" method="GET" class="w-50">
                    <div class="d-flex">
                        <input name="search" class="form-control me-2 w-100 border-2" type="search" placeholder="Cerca..."
                            aria-label="Search" value="{{ request('search') }}">
                        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Cerca</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="gridView" class="row gy-5 gx-0 mt-3 justify-content-center">
            @foreach ($types as $type)
                <div class="col-3 d-flex justify-content-center">
                    <div class="card d-flex flex-column justify-content-between" style="width: 18rem;">
                        <a href="{{ route('types.show', $type->id) }}" class="text-decoration-none text-dark">
                            <h3 class="card-title text-center py-4">{{ $type->name }}</h3>
                            <img class="card-img-top img-type img-fluid"
                                src="{{ asset($type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                                alt="{{ $type->name }}">
                        </a>

                        <div class="buttons-card d-flex justify-content-around mt-4">
                            <a href="{{ route('types.edit', $type->id) }}" class="btn btn-outline-warning m-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button type="button" class="btn btn-outline-danger m-1 delete-type" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-type-id="{{ $type->id }}">
                                <i class="bi bi-trash2-fill"></i>
                            </button>
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
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->name }}</td>
                            <td>
                                <a href="{{ route('types.show', $type->id) }}" class="btn btn-primary">Visualizza</a>
                                <a href="{{ route('types.edit', $type->id) }}" class="btn btn-warning">Modifica</a>

                                <button type="button" class="btn btn-danger m-1 delete-type" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-type-id="{{ $type->id }}">
                                    Cancella
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('types.partials.modal_type_delete')
@endsection
