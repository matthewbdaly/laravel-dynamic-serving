<?php

if (!function_exists('is_mobile')) {
    function is_mobile()
    {
        $session = app()->make('Illuminate\Contracts\Session\Session');
        return $session->get('mobile') == true;
    }
}

if (!function_exists('is_desktop')) {
    function is_desktop()
    {
        $session = app()->make('Illuminate\Contracts\Session\Session');
        return $session->get('mobile') == false;
    }
}
