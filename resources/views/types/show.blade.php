@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header bg-black">
                <div class="row">
                    <div class="col-6 py-2 px-5 d-flex align-items-center justify-content-start" style="height: 75px;">
                        <a href="{{ route('types.index') }}">
                            <i class="btn btn-outline-light bi bi-caret-left-fill me-3 p-0 px-1 fw-bolder"></i>
                        </a>
                        <h2 class="card-title m-0 text-light">{{ $type->name }}</h2>
                    </div>
                    <div class="col-6 py-1 px-5 d-flex align-items-center justify-content-end" style="height: 75px;">
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
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <img src="{{ asset($type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                            alt="{{ $type->name }}" class="img-fluid items-char-show">
                    </div>
                    <div class="col-12">
                        <h5 class="mt-5 mb-3">Descrizione:</h5>
                        <p class="card-text">{{ $type->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('types.partials.modal_type_delete')
@endsection
