@extends('site.template.layout')

@section('content')

    <section class="slide"></section><!--Slide-->

    <div class="actions-form">
        <h2>Encontre: </h2>
        {!! Form::open(['route' => 'site.flight.index', 'class' => 'form-home text-center', 'method' => 'get']) !!}
            <div class="form-group">
                {{ Form::text('cities_origin', null, ['class' => 'form-control', 'list' => 'cities_origin', 'required' => true, 'placeholder' => __('Cidade Origem')])}}
                <datalist id="cities_origin">
                    @foreach($airports as $airport)
                        <option value="{{$airport->id}} - {{$airport->city->state->initials}}/{{$airport->city->name}} - {{$airport->name}}">
                    @endforeach
                </datalist>
            </div>
            <div class="form-group">
                {{ Form::text('cities_destination', null, ['class' => 'form-control', 'list' => 'cities_destination', 'required' => true, 'placeholder' => __('Cidade Destino')])}}
                <datalist id="cities_destination">
                    @foreach($airports as $airport)
                        <option value="{{$airport->id}} - {{$airport->city->state->initials}}/{{$airport->city->name}} - {{$airport->name}}">
                    @endforeach
                </datalist>
            </div>
            <div class="form-group">
                {{ Form::date('date', null, ['class' => 'form-control', 'required' => true, 'placeholder' => __('Data')])}}
            </div>
            <button class="btn" type="submit">
                Procurar <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        {!! Form::close() !!}
    </div><!--actions-form-->

    <div class="rectangle"></div><!--rectangle-->

    <div class="clear"></div>

    <section class="banner">
        <div class="container banner-ctc-background-over-white card">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img class="banner-ctc-img" src="{{ asset('images/cards.png') }}">
                </div>
                <div class="col-md-7">
                    
                    <div class="banner-ctc-titulo-contenedor"><span>Que tal assinar na EspecializaTi Academy?</span></div>
                    
                    <div>
                        <p>ASSINE E TENHA ACESSO A TODOS OS NOSOS CURSOS DISPONÍVEL NA ESPECIALIZATI ACADEMY. MAIS BARATO QUE UM CAFÉ POR DIA!</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="https://academy.especializati.com.br" target="_blank" class="btn pull-right btn-flat flat-medium third-level">
                        <span>Saiba Mais</span>
                    </a>
                </div>
            </div>
        </div>
    </section><!--Banner-->
        
@endsection
