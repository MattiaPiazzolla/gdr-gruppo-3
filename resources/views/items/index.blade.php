@extends('layouts.app')

@section('content')
    <div class="container my-5">

        <div class="headerItems">
            <h1>Oggetti</h1>
            <div class="row">
                <div class="col-12">
                    <div class="row mt-3 justify-content-between">
                        <div class="col-12 col-md-6 my-3">
                            <a href="{{ route('items.create') }}" class="btn btn-outline-success me-2 w-100 ">Aggiungi
                                Oggetto</a>
                        </div>
                        <div class="col-12 col-md-6 my-3">
                            <form action="{{ route('items.index') }}" method="GET" class="w-100">
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





        <!-- Vista a griglia -->
        <div id="gridView" class="row gy-5 gx-0 mt-0 justify-content-center">
            @foreach ($items as $item)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('items.show', $item->id) }}" class="text-decoration-none text-dark">
                            <h5 class="card-title text-center py-4">{{ $item->name }}</h5>
                            @if (file_exists(public_path('img/Items_icons/' . $item->name . '.webp')))
                                <img src="{{ asset('img/Items_icons/' . $item->name . '.webp') }}" class="img-fluid w-100"
                                    alt="{{ $item->name }}">
                            @elseif (file_exists(public_path('img/Items_icons/' . $item->name . '.png')))
                                <img src="{{ asset('img/Items_icons/' . $item->name . '.png') }}" class="img-fluid w-100"
                                    alt="{{ $item->name }}">
                            @else
                                <img src="{{ asset('img/Items_icons/placeholder.png') }}" class="img-fluid w-100"
                                    alt="Immagine non disponibile">
                            @endif
                        </a>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <!-- Pulsanti di azione -->
                            <div class="buttons-card d-flex justify-content-around ">
                                @if ($item->trashed())
                                    <form action="{{ route('items.restore', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success ">Ripristina</button>
                                    </form>
                                @else
                                    <div>
                                        <button href="{{ route('items.edit', $item->id) }}"
                                            class="btn btn-outline-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('items.softDelete', $item->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="bi bi-trash2-fill"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($deletedItems->isNotEmpty())
            <!-- Oggetti Eliminati -->
            <h2>Oggetti Eliminati</h2>
            <div class="row gy-5 gx-0 mt-0 justify-content-center">
                @foreach ($deletedItems as $item)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <a href="{{ route('items.show', $item->id) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title text-center py-4">{{ $item->name }}</h5>
                                @if (file_exists(public_path('img/Items_icons/' . $item->name . '.webp')))
                                    <img src="{{ asset('img/Items_icons/' . $item->name . '.webp') }}"
                                        class="img-fluid w-100" alt="{{ $item->name }}">
                                @elseif (file_exists(public_path('img/Items_icons/' . $item->name . '.png')))
                                    <img src="{{ asset('img/Items_icons/' . $item->name . '.png') }}"
                                        class="img-fluid w-100" alt="{{ $item->name }}">
                                @else
                                    <img src="{{ asset('img/Items_icons/placeholder.png') }}" class="img-fluid w-100"
                                        alt="Immagine non disponibile">
                                @endif
                            </a>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="buttons-card d-flex justify-content-around">
                                    <form action="{{ route('items.restore', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success">Ripristina</button>
                                    </form>
                                    <div>
                                        <button type="button" class="btn btn-outline-danger delete-item"
                                            data-url="{{ route('items.forceDelete', $item->id) }}">
                                            Elimina
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

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

                                <button type="button" class="btn btn-danger  delete-item"
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
