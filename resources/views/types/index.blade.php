@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="headerCharacter">
            <h1>Tipologia</h1>
            <nav class="navbar navbar-light ">
                <form class="d-flex w-100 justify-content-between">
                    <div class="search_bar_cont d-flex">
                        <input class="form-control mr-sm-2 me-3" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                    </div>
                    <a href="{{ route('types.create') }}" class="btn btn-dark">Aggiungi Type</a>
                </form>
            </nav>
        </div>

        <div class="row gy-5 gx-0 mt-3 justify-content-center">
            @foreach ($types as $type)
                <div class="col-3 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('types.show', $type->id) }}" class="text-decoration-none text-dark">
                            <h3 class="card-title text-center py-4">{{ $type->name }}</h3>
                            <img class="card-img-top img-type img-fluid"
                                src="{{ asset($type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                                alt="{{ $type->name }}">
                        </a>

                        <div class="buttons-card d-flex justify-content-center mt-4">
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
    </div>
    @include('types.partials.modal_type_delete')
@endsection
