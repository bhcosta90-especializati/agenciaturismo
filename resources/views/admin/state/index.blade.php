@extends('admin.template.layout')

@section('content')
    <div class='card'>
    <h5 class='card-header'>Filtrar</h5>
    <div class='card-body'>
        {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
            {!! Form::text('name', request('name'), ['class' => 'form-control', 'placeholder' => __('Nome')]) !!}
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
                    <th>{{ __('Estado') }}</th>
                    <th style='width:1px'>{{ __('Sigla') }}</th>
                    <th style='width:1px'></th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $rs)
                <tr>
                    <td>{{ $rs->name }}</td>
                    <td>{{ $rs->initials }}</td>
                    <td style='width:1px'>
                        <a href="{{ route('admin.city.index', ['state_id' => $rs->id]) }}" class='btn btn-secondary btn-sm'>({{$rs->cities->count()}})&nbsp;Cidades</a>
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
