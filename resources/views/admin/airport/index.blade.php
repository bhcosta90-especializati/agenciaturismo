@extends('admin.template.layout')

@section('content')
    <div class='card'>
    <h5 class='card-header'>Filtrar 
        <a class='btn btn-sm btn-outline-secondary' href="{{ route('admin.city.index', ['state_id' => $city->state_id]) }}">Voltar para as cidades</a>
    </h5>
    <div class='card-body'>
        {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
            {!! Form::text('name', request('name'), ['class' => 'form-control', 'placeholder' => __('Nome')]) !!}
            {!! Form::hidden('city_id', request('city_id')) !!}
            {!! Form::submit(__('Buscar'), ['class' => 'btn btn-secondary']) !!}
        {!! Form::close() !!}
    </div>
    </div>
    <div class='card'>
        <div class='card-header'>
        
            <a href="{{ route('admin.airport.create', ['city_id' => request('city_id')]) }}" class='btn btn-outline-secondary'>Cadastrar</a>
        </div>
        <table class='table table-striped' style='margin-bottom:0'>
            <thead>
                <tr>
                    <th>{{ __('Nome') }}</th>
                    <th style='width:1px'></th>
                    <th style='width:1px'></th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $rs)
                <tr>
                    <td>{{ $rs->name }}</td>
                    <td style='width:1px'>
                        <a href="{{ route('admin.airport.edit', $rs->id) }}" class='btn btn-primary btn-sm'>Editar</a>
                    </td>
                    <td style='width:1px'>
                        {!! btnLinkDelIcon(route('admin.airport.destroy', $rs->id)) !!}
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
