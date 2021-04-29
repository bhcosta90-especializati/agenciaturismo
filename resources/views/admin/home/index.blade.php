@extends('admin.template.layout')

@section('content')
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>{{ __('Nome') }}</th>
                <th style='width:1px'></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{ __('Nome') }}</td>
                <td style='width:1px'>
                    <a href="" class='btn btn-primary'>Editar 123</a>
                </td>
            </tr>
        </tbody> 
    </table>
@endsection
