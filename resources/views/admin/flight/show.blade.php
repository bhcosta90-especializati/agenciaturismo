@extends('admin.template.layout')

@section('content')
    <div class='card'>
        <table class='table table-striped' style='margin-bottom:0'>
            <tbody>
                <tr>
                    <td style='width:50%'>{{ __('Código') }}</td>
                    <td style='width:50%'>{{ $obj->uuid }}</td>
                </tr>
                
                <tr>
                    <td>{{ __('Origem') }}</td>
                    <td>{{ $obj->origin->name }}</td>
                </tr>
                
                <tr>
                    <td>{{ __('Destino') }}</td>
                    <td>{{ $obj->destination->name }}</td>
                </tr>

                <tr>
                    <td>{{  __('Data') }}</td>
                    <td>{{ Str::date($obj->destination->date)->format('d/m/Y') }}</td>
                </tr>

                <tr>
                    <td>{{ __('Duração') }}</td>
                    <td>{{ $obj->time_duration }}</td>
                </tr>

                <tr>
                    <td>{{ __('Horário de saída') }}</td>
                    <td>{{ $obj->hour_output }}</td>
                </tr>

                <tr>
                    <td>{{ __('Hora de chegada') }}</td>
                    <td>{{ $obj->arrival_time }}</td>
                </tr>

                <tr>
                    <td>{{ __('Preço anterior') }}</td>
                    <td>{{ Str::number_format($obj->old_price) }}</td>
                </tr>

                <tr>
                    <td>{{ __('Preço atual') }}</td>
                    <td>{{ Str::number_format($obj->price) }}</td>
                </tr>

                <tr>
                    <td>{{ __('Total máximo de parcelas') }}</td>
                    <td>{{ $obj->total_plots }} parcela(s)</td>
                </tr>

                <tr>
                    <td>{{ __('Preço promocional?') }}</td>
                    <td>{{ $obj->is_promotion ? "Sim" : "Não" }}</td>
                </tr>

                <tr>
                    <td>{{ __('Descrição') }}</td>
                    <td>{{ $obj->description }}</td>
                </tr>

            </tbody> 
        </table>
    </div>
@endsection
