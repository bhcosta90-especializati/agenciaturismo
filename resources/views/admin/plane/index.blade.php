@extends('admin.template.layout')

@section('content')
    <div class='card'>
    <h5 class='card-header'>Filtrar</h5>
    <div class='card-body'>
        {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
            {!! Form::text('sku', request('sku'), ['class' => 'form-control', 'placeholder' => __('SKU')]) !!}
            {!! Form::select('brand_id', $brands, request('brand_id'), ['class' => 'form-control', 'placeholder' => __('Marca do avião')]) !!}
            {!! Form::select('class', $classess, request('class'), ['class' => 'form-control', 'placeholder' => __('Classe')]) !!}
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
                    <th>{{ __('SKU') }}</th>
                    <th>{{ __('Classe') }}</th>
                    <th>{{ __('Marca') }}</th>
                    <th style='width:170px'>{{ __('Total de passageiros') }}</th>
                    <th style='width:1px'></th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $rs)
                <tr>
                    <td>{{ $rs->sku }}</td>
                    <td>{{ $rs->class($rs->class) }}</td>
                    <td>{{ $rs->brand->name }}</td>
                    <td>{{ $rs->qtd_passengers }}</td>
                    <td style='width:1px'>
                        <a href="{{ route('admin.plane.edit', $rs->id) }}" class='btn btn-primary btn-sm'>Editar</a>
                    </td>
                    <td style='width:1px'>
                        {!! btnLinkDelIcon(route('admin.plane.destroy', $rs->id)) !!}
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
