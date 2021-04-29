@extends('admin.template.layout')

@section('content')
    <div class='card'>
    <h5 class='card-header'>Filtrar</h5>
    <div class='card-body'>
        {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
            {!! Form::text('name', request('name'), ['class' => 'form-control', 'placeholder' => __('Nome')]) !!}
            {!! Form::text('email', request('email'), ['class' => 'form-control', 'placeholder' => __('E-mail')]) !!}
            {!! Form::text('flight_id', request('flight_id'), ['class' => 'form-control', 'placeholder' => __('Código do voo')]) !!}
            {!! Form::date('flight_date', request('flight_date'), ['class' => 'form-control', 'placeholder' => __('Data do voo')]) !!}
            {!! Form::select('status', $status, request('status'), ['class' => 'form-control']) !!}
            {!! Form::submit(__('Buscar'), ['class' => 'btn btn-secondary']) !!}
        {!! Form::close() !!}
    </div>
    </div>
    <div class='card'>
        <div class='card-header'>
            <a href="{{ route('admin.reserve.create') }}" class='btn btn-outline-secondary'>Cadastrar</a>
        </div>
        <table class='table table-striped' style='margin-bottom:0'>
            <thead>
                <tr>
                    <th style='width:1px'>{{ __('Voo') }}</th>
                    <th>{{ __('Nome') }}</th>
                    <th>{{ __('Situação') }}</th>
                    <th style='width:1px'></th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $rs)
                <tr>
                    <td><a href="{{ route('admin.flight.show', $rs->flight->uuid) }}">{{ Str::date($rs->flight->date)->format('d/m/Y') }}</a></td>
                    <td>{{ $rs->user->name }}</td>
                    <td>{{ $rs->status($rs->status) }}</td>
                    <td style='width:1px'>
                        <a href="{{ route('admin.reserve.edit', $rs->uuid) }}" class='btn btn-primary btn-sm'>Editar</a>
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
