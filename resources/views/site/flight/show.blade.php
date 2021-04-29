@extends('site.template.layout')

@section('content')
<div class="content">

    <section class="container">
        <h1 class="title">Detalhes do voô {{ $obj->id }}</h1>

        @include('admin.includes.alert')
        <ul class="list-group">
            <li class="list-group-item">
                Origem: <strong>{{ $obj->origin->city->state->initials }}/{{ $obj->origin->city->name }} - {{ $obj->origin->name }}</strong>
            </li>
            <li class="list-group-item">
                Destino: <strong>{{ $obj->destination->city->state->initials }}/{{ $obj->destination->city->name }} - {{ $obj->destination->name }}</strong>
            </li>
            <li class="list-group-item">
                Saída: <strong>{{ Str::date($obj->hour_output)->format('H:i')}}</strong>
            </li>
            <li class="list-group-item">
                Chegada: <strong>{{ Str::date($obj->arrival_time)->format('H:i')}}</strong>
            </li>
            <li class="list-group-item">
                Preço: <strong>{{ Str::number_format($obj->price)}}</strong>
            </li>
        </ul>

        {!! Form::open(['site.flight.store', $obj->uuid, 'style' => 'margin-top: 15px;']) !!}
            <button style=' border:0; background: #b28d36;color: #fff;padding: 10px 30px;'>Comprar</button>
        {!! Form::close() !!}

        </form>
    </section><!--Container-->

</div>
@endsection