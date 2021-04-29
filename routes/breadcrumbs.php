<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('admin.home'));
});

Breadcrumbs::for('admin.brand.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Marcas de avião'), route('admin.brand.index'));
});

Breadcrumbs::for('admin.brand.create', function ($trail) {
    $trail->parent('admin.brand.index');
    $trail->push(__('Cadastrar marca de avião'), route('admin.brand.index'));
});

Breadcrumbs::for('admin.brand.edit', function ($trail) {
    $trail->parent('admin.brand.index');
    $trail->push(__('Editar marca de avião'), route('admin.brand.index'));
});

Breadcrumbs::for('admin.plane.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Avião'), route('admin.plane.index'));
});

Breadcrumbs::for('admin.plane.create', function ($trail) {
    $trail->parent('admin.plane.index');
    $trail->push(__('Cadastrar avião'), route('admin.plane.index'));
});

Breadcrumbs::for('admin.plane.edit', function ($trail) {
    $trail->parent('admin.plane.index');
    $trail->push(__('Editar avião'), route('admin.plane.index'));
});

Breadcrumbs::for('admin.state.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Estados'), route('admin.state.index'));
});

Breadcrumbs::for('admin.city.index', function ($trail, $breadcumb) {
    $trail->parent('home');
    $trail->push($breadcumb ? __('Cidades do :estado', [
        'estado' => $breadcumb->name
    ]) : __("Cidades"), route('admin.state.index'));
});

Breadcrumbs::for('admin.airport.index', function ($trail, $breadcumb) {
    $trail->parent('home');
    $trail->push(__('Aeroportos na :estado/:cidade', [
        "estado" => $breadcumb->state->initials,
        "cidade" => $breadcumb->name,
    ]), route('admin.airport.index', ['city_id' => $breadcumb->id]));
});

Breadcrumbs::for('admin.airport.create', function ($trail, $breadcumb) {
    $trail->parent('admin.airport.index', $breadcumb);
    $trail->push(__('Cadastrar aeroporto'), route('admin.airport.index', ['city_id' => $breadcumb->city_id]));
});

Breadcrumbs::for('admin.airport.edit', function ($trail, $breadcumb) {
    $trail->parent('admin.airport.index', $breadcumb);
    $trail->push(__('Editar aeroporto'), route('admin.airport.index', ['city_id' => $breadcumb->city_id]));
});

Breadcrumbs::for('admin.flight.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Voos'), route('admin.flight.index'));
});

Breadcrumbs::for('admin.flight.create', function ($trail) {
    $trail->parent('admin.flight.index');
    $trail->push(__('Cadastrar voo'));
});

Breadcrumbs::for('admin.flight.edit', function ($trail, $breadcumb) {
    $trail->parent('admin.flight.index');
    $trail->push(__('Editar voo'), route('admin.flight.edit', $breadcumb->uuid));
});

Breadcrumbs::for('admin.flight.show', function ($trail, $breadcrumb) {
    $trail->parent('admin.flight.edit', $breadcrumb);
    $trail->push(__('Detalhe do voo'));
});