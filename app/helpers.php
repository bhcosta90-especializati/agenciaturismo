<?php

if (!function_exists('btnLinkDelIcon')) {
    function btnLinkDelIcon($url)
    {
        $form_id = uniqid();
        $html = Form::open(['url' => $url, 'id' => $form_id, 'method' => 'DELETE', 'class' => 'form-delete-confirmation']);
        $html .= '<button class="btn btn-danger btn-sm">Excluir</button>';
        $html .= Form::close();
        return $html;
    }
}