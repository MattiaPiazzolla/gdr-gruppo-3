@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="headerCharacter">
            <h1>Items</h1>
            <nav class="navbar navbar-light ">
                <form class="d-flex w-100 justify-content-between">
                    <div class="search_bar_cont d-flex">
                        <input class="form-control mr-sm-2 me-3" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                    </div>
                    <a href="{{ route('items.create') }}" class="btn btn-dark">Aggiungi Item</a>
                </form>
            </nav>
        </div>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row gy-5 gx-0 mt-3 justify-content-center">
            @foreach ($items as $item)
                <div class="col-3 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('items.show', $item->id) }}" class="text-decoration-none text-dark ">
                            <h5 class="card-title text-center py-4">{{ $item->name }}</h5>

                            @if ($item->image)
                                <img class="card-img-top" src="{{ asset('item/image.jpg') }}" alt="{{ $item->name }}">
                            @else
                                <img class="card-img-top" src="https://placehold.co/400x400?text=Missing+Img"
                                    alt="{{ $item->name }} Placeholder">
                            @endif
                        </a>
                        <div class="card-body">
                            <p class="card-text">Slug: {{ $item->slug }}</p>
                            <p class="card-text">Categoria: {{ $item->category }}</p>
                            <p class="card-text">Tipo: {{ $item->type }}</p>
                            <p class="card-text">Peso: {{ $item->weight }}</p>
                            <p class="card-text">Costo: {{ $item->cost }}</p>
                            <p class="card-text">Dadi: {{ $item->dice }}</p>

                            <div class="buttons-card d-flex justify-content-center">
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
    </div>

    <!-- Include la modale -->
    @include('items.partials.modal_items_delete')
@endsection
