@extends('admin.template.layout')

@section('content')
    <div class='card'>
        <div class='card-header'>
            <h5>Editar avião</h5>
        </div>
        <div class='card-body'>
            {!! form($form) !!}
        </div>
    </div>
@endsection
