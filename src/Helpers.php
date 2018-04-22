<?php

if (!function_exists('is_mobile')) {
    function is_mobile()
    {
        $session = app()->make('Illuminate\Contracts\Session\Session');
        return $session->get('mobile');
    }
}
