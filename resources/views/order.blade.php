@extends('layouts.app')

@section('title', 'Broodjesbar - Bestellen')

@section('content')

<div class="row">
    <section class="col-sm">
        <h2>Broodjes bestellen</h3>      
        <form action="/order" method="POST">
            @csrf

            <label for="type">Kies het gewenste type broodje: </label>
            <br>
            <select name="type" id="type" required>
                @foreach ($sandwichTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }} (&euro; {{ $type->price }})</option>
                @endforeach
            </select>
            <br>
            <br>
            Kies uw beleg:
            <br>
            @foreach ($sandwichFillings as $filling)
                <input type="checkbox" name="filling[]" value="{{ $filling->id }}"> {{ $filling->name }} (+ &euro; {{ $filling->price }})
                <br>
            @endforeach
            @include ('errors')
            <br>
            <button type="submit" class="btn btn-primary">Toevoegen aan winkelmandje</button>
        </form>
    </section>

    <section class="col-sm">
        <h2>Winkelmandje</h2>
        @if ($cart)
            <ul>
                @foreach ($cart as $sandwich)
                    <li>{{ $sandwich }}</li>
                @endforeach
            </ul>
            <form action="/overview" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Plaats bestelling</button>
            </form>
            <p><a href="/clear" class="btn btn-secondary"></a>Winkelmandje legen</p>
        @else
            <p>Je winkelmandje is leeg.</p>
        @endif
    </section>
</div>
@endsection
