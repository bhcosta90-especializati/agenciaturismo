@extends('admin.template.layout')

@section('content')
    <div class='card'>
    <h5 class='card-header'>Filtrar</h5>
    <div class='card-body'>
        {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
            {!! Form::text('name', request('name'), ['class' => 'form-control', 'placeholder' => __('Nome da cidade')]) !!}
            {!! Form::select('state_id', $states, request('state_id'), ['class' => 'form-control', 'placeholder' => __('Estados')]) !!}
            {!! Form::submit(__('Buscar'), ['class' => 'btn btn-secondary']) !!}
        {!! Form::close() !!}
    </div>
    </div>
    <div class='card'>
        <div class='card-header'>
            <a href="{{ route('admin.plane.create') }}" class='btn btn-outline-secondary'>Cadastrar</a>
        </div>
        <table class='table table-striped' style='margin-bottom:0'>
            <thead>
                <tr>
                    <th>{{ __('Cidade') }}</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $rs)
                <tr>
                    <td>{{ $rs->name }}</td>
                    <td style='width:1px'>
                        <a href="{{ route('admin.airport.index', ['city_id' => $rs->id]) }}" class='btn btn-secondary btn-sm'>({{$rs->airports->count()}})&nbsp;Aeroportos</a>
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
