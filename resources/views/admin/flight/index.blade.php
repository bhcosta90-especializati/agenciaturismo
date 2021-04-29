@extends('admin.template.layout')

@section('content')
    <div class='card'>
    <h5 class='card-header'>Filtrar</h5>
    <div class='card-body'>
        {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
            {!! Form::text('code', request('code'), ['class' => 'form-control', 'placeholder' => __('Código')]) !!}
            {!! Form::date('date', request('date'), ['class' => 'form-control', 'placeholder' => __('Data')]) !!}
            {!! Form::time('hour_output', request('hour_output'), ['class' => 'form-control', 'placeholder' => __('Hora da saída')]) !!}
            {!! Form::number('qtd_stops', request('qtd_stops'), ['class' => 'form-control', 'placeholder' => __('Quantidade de paradas')]) !!}
            {!! Form::select('airport_origin_id', $airports, request('airport_origin_id'), ['class' => 'form-control', 'placeholder' => __('Aeroporto de origem')]) !!}
            {!! Form::select('airport_destination_id', $airports, request('airport_destination_id'), ['class' => 'form-control', 'placeholder' => __('Aeroporto de destino')]) !!}

            {!! Form::submit(__('Buscar'), ['class' => 'btn btn-secondary']) !!}
        {!! Form::close() !!}
    </div>
    </div>
    <div class='card'>
        <div class='card-header'>
            <a href="{{ route('admin.flight.create') }}" class='btn btn-outline-secondary'>Cadastrar</a>
        </div>
        <table class='table table-striped' style='margin-bottom:0'>
            <thead>
                <tr>
                    <th style='width:1px;'></th>
                    <th>Origem</a></th>
                    <th>Destino</th>
                    <th style='width:1px;'>Total&nbsp;de&nbsp;paradas</th>
                    <th style='width:1px;'>Data</th>
                    <th style='width:1px;'>Hora&nbsp;de&nbsp;saída</th>
                    <th style='width:1px;'></th>
                    <th style='width:1px;'></th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $rs)
                <tr>
                    <td><pre style='padding:3px 0 0 0; margin:0'>{{ $rs->uuid }}</pre></td>
                    <td><a href="{{ route('admin.airport.edit', $rs->origin->id) }}">{{ $rs->origin->name }}</a></td>
                    <td><a href="{{ route('admin.airport.edit', $rs->destination->id) }}">{{ $rs->destination->name }}</a></td>
                    <td>{{ $rs->qtd_stops }}</td>
                    <td>{{ Str::date($rs->date)->format('d/m/Y') }}</td>
                    <td>{{ $rs->hour_output }}</td>
                    <td style='width:1px'>
                        <a href="{{ route('admin.flight.edit', $rs->uuid) }}" class='btn btn-primary btn-sm'>Editar</a>
                    </td>
                    <td style='width:1px'>
                        {!! btnLinkDelIcon(route('admin.flight.destroy', $rs->id)) !!}
                    </td>
                    <td style='width:1px'>
                        <a href="{{ route('admin.flight.show', $rs->uuid) }}" class='btn btn-outline-secondary btn-sm'>Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody> 
        </table>
        @if($data->total() > $data->perPage())
            <div style='margin-left:20px;margin-top:15px'>{!! $data->appends(request()->except('_token'))->links() !!}</div>
        @endif
    </div>
@endsection
