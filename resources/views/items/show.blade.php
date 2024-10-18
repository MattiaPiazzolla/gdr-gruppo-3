@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header bg-black">
                <div class="row">
                    <div class="col-6 py-2 px-5 d-flex align-items-center justify-content-start" style="height: 75px;">
                        <a href="{{ route('items.index') }}">
                            <i class="btn btn-outline-light bi bi-caret-left-fill me-3 p-0 px-1 fw-bolder"></i>
                        </a>
                        <h2 class="card-title m-0 text-light">{{ $item->name }}</h2>
                    </div>
                    <div class="col-6 py-1 px-5 d-flex align-items-center justify-content-end" style="height: 75px;">
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
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-5">
                        <h5 class="mt-5 mb-3">Descrizione:</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <div class="row">
                            <h5 class="mt-5 mb-3">Dettagli</h5>
                            <div class="col-6">
                                <p class="fw-bold">Slug</p>
                                <p class="fw-bold">Tipo</p>
                                <p class="fw-bold">Categoria</p>
                                <p class="fw-bold">Peso</p>
                                <p class="fw-bold">Costo</p>
                                <p class="fw-bold">Dadi</p>
                            </div>
                            <div class="col-6">
                                <p>{{ $item->name }}</p>
                                <p>{{ $item->type }}</p>
                                <p>{{ $item->category }}</p>
                                <p>{{ $item->weight }}</p>
                                <p>{{ $item->cost }}</p>
                                <p>{{ $item->dice }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <img class="item_show_img items-char-show"
                            src="{{ asset('img/Items_icons/' . $item->name . '.png') }}" alt="{{ $item->name }}">
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('items.partials.modal_items_delete')
@endsection
