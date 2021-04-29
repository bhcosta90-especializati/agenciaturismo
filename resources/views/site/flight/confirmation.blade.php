@extends('site.template.layout')

@section('content')
<div class='content'>
    <section class="container">
        <h1 class="title">Parabéns</h1>
        Você reservou a sua passagem para o voo com o destino 
        <strong>
            {{ $obj->flight->destination->city->state->initials }}/{{ $obj->flight->destination->city->name }} - {{ $obj->flight->destination->name }}
        </strong>
    </section>
</div>
@endsection