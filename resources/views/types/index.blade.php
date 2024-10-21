@extends('layouts.app')

@section('content')
    <div class="container my-5">

        <div class="headderTypes">
            <h1>Tipologie</h1>
            <div class="row">
                <div class="col-12">
                    <div class="row mt-3 justify-content-between">
                        <div class="col-12 col-md-6 my-3">
                            <a href="{{ route('types.create') }}" class="btn btn-outline-success me-2 w-100 ">Aggiungi
                                Tipo</a>
                        </div>
                        <div class="col-12 col-md-6 my-3">
                            <form action="{{ route('types.index') }}" method="GET" class="w-100">
                                <div class="d-flex">
                                    <input name="search" class="form-control me-2 w-100 border-2" type="search"
                                        placeholder="Cerca..." aria-label="Search" value="{{ request('search') }}">
                                    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Cerca</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-10 mt-3">
                    <button id="showGrid" class="btn me-2 btn-outline-dark active btn-view-format">
                        <i class="bi bi-card-image"></i>
                    </button>
                    <button id="showTable" class="btn btn-outline-dark me-2 btn-view-format">
                        <i class="bi bi-table"></i>
                    </button>
                </div>
            </div>
        </div>


        @if (session('success'))
            <div class="my-3 alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="my-3 alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Grid View -->
        <div id="gridView" class="row gy-5 gx-0 mt-3 justify-content-center">
            @foreach ($types as $type)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center">
                    <div class="card d-flex flex-column justify-content-between" style="width: 18rem;">
                        <a href="{{ route('types.show', $type->id) }}" class="text-decoration-none text-dark">
                            <h3 class="card-title text-center py-4">{{ $type->name }}</h3>
                            <img class="card-img-top img-type img-fluid"
                                src="{{ asset($type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                                alt="{{ $type->name }}">
                        </a>

                        <div class="buttons-card d-flex justify-content-around my-4">
                            @if ($type->trashed())
                                <form action="{{ route('types.restore', $type->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success m-1">Ripristina</button>
                                </form>
                            @else
                                <a href="{{ route('types.edit', $type->id) }}" class="btn btn-outline-warning ">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('types.softDelete', $type->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger ">
                                        <i class="bi bi-trash2-fill"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Deleted section --}}
        @if ($deletedTypes->isNotEmpty())
            <div id="deletedTypes" class="row gy-5 gx-0 mt-3 justify-content-center">
                <h2>Tipi Eliminati</h2>
                @foreach ($deletedTypes as $type)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center">
                        <div class="card d-flex flex-column justify-content-between" style="width: 18rem;">
                            <a href="{{ route('types.show', $type->id) }}" class="text-decoration-none text-dark">
                                <h3 class="card-title text-center py-4">{{ $type->name }}</h3>
                                <img class="card-img-top img-type img-fluid"
                                    src="{{ asset($type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                                    alt="{{ $type->name }}">
                            </a>
                            <div class="buttons-card d-flex justify-content-around my-4">
                                <form action="{{ route('types.restore', $type->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success">
                                        Ripristina
                                    </button>
                                </form>
                                <!-- Pulsante per aprire il modale di eliminazione -->
                                <button type="button" class="btn btn-outline-danger delete-type"
                                    data-url="{{ route('types.forceDelete', $type->id) }}">
                                    Elimina
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Table View -->
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
                                @if ($type->trashed())
                                    <form action="{{ route('types.restore', $type->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Ripristina</button>
                                    </form>
                                @else
                                    <a href="{{ route('types.edit', $type->id) }}" class="btn btn-warning">Modifica</a>
                                    <button type="button" class="btn btn-danger m-1 delete-type" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-type-id="{{ $type->id }}">
                                        Cancella
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('types.partials.modal_type_delete')
@endsection
