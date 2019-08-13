@extends('layouts.app')

@section('title', 'Broodjesbar - Overzicht')

@section('content')

<h2>Overzicht bestelling</h2>

@if (session('message'))
    <p class="alert alert-success">{{ session('message' )}}</p>
@endif

@if (isset($cart))
    <p>Je hebt vandaag de volgende bestelling geplaatst:</p>
    <ul>
        @foreach ($cart as $sandwich)
            <li>{{ $sandwich }}</li>
        @endforeach
    </ul>
@else
<p> Oeps!!</p>
@endif

@endsection
