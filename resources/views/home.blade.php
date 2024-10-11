@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <div class="jumbotron text-center">
            <h1 class="display-4">Benvenuto nella tua Area GDR!</h1>
            <p class="lead">Gestisci personaggi, oggetti e tipi con facilità.</p>
            <a class="btn btn-dark btn-lg" href="{{ route('characters.index') }}" role="button">Vedi i Personaggi</a>
        </div>


        <div class="mt-5">
            <h2>Ultimi Personaggi</h2>
            <div class="row">
                @foreach ($characters as $character)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset($character->type->image ?? 'https://placehold.co/400x400?text=Missing+Img') }}"
                                alt="{{ $character->name }}" class=" img-fluid">
                            <div class="card-body">
                                <h3 class="card-title text-center">{{ $character->name }}</h3>
                                <p class="card-text text-center">{{ $character->description }}</p>
                                <a href="{{ route('characters.show', $character->id) }}"
                                    class="btn btn-dark w-100">Dettagli</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-5">
            <h2>Ultimi Oggetti</h2>
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if ($item->image)
                                <img class="card-img-top" src="{{ asset('item/image.jpg') }}" alt="{{ $item->name }}">
                            @else
                                <img class="card-img-top" src="https://placehold.co/400x400?text=Missing+Img"
                                    alt="{{ $item->name }} Placeholder">
                            @endif
                            <div class="card-body">
                                <h3 class="card-title text-center">{{ $item->name }}</h3>
                                <a href="{{ route('items.show', $item->id) }}" class="btn btn-dark w-100">Dettagli</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
