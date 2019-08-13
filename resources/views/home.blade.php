@extends('layouts.app')

@section('content')

<h3>Welkom bij de broodjesbar</h3>
<p>Je kan hier dagelijks de gewenste broodjes bestellen, vóór 10 uur.</p>
<p>Je kan slechts één bestelling per dag plaatsen.</p>

@if (!auth()->user() && date("H") <= 9)
    <p class="text-danger">Opgelet: je hebt een <a href="/register">account</a> nodig een bestelling te plaatsen</p>
@endif

@if (date("H") > 9)
    <p class="text-danger">Het is vandaag niet meer mogelijk om een bestelling te plaatsen</p>
@elseif (auth()->user() && auth()->user()->sandwiches->count())
    <p>Je hebt vandaag reeds een bestelling geplaatst.</p>
    <a href="/overview" class="btn btn-primary">Bekijk je bestelling</a>
@else
    <a href="/order" class="btn btn-primary">Plaats een bestelling</a>
@endif

@endsection
