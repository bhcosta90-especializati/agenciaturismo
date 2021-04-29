@extends('site.template.layout')

@section('content')
<div class="content">

    <section class="container">
        <h1 class="title">Resultados Pesquisa:</h1>
        <div class="key-search row">
            <div class="col-lg-2 col-md-2 col-sm-12 col-12 text-center">
                <img src="{{ asset('images/flight.png') }}" alt="Voô">
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                <p>De: <span>{{ $filters['cities_origin'] }}</span></p>
                <p>Para: <span>{{ $filters['cities_destination'] }}</span></p>
                <p>Data: <span>{{ Str::date($filters['date'])->format('d/m/Y') }}</span></p>
            </div>
        </div>


        <div class="row results-search">
            @foreach($data as $rs)
            <article class="result-search col-12">

                <span>Saída: <strong>{{Str::date($rs->hour_output)->format('H:i')}}</strong></span>
                <span>Chegada: <strong>{{Str::date($rs->arrival_time)->format('H:i')}}</strong></span>
                <span>Paradas: <strong>{{$rs->qtd_stops}}</strong></span>
                <a href="{{ route('site.flight.show', $rs->uuid) }}">Detalhes</a>

            </article><!--result-search-->
            @endforeach
        </div><!--Row-->
    </section><!--Container-->

</div>
@endsection