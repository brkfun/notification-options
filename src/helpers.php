<?php
if (!function_exists('tokenSetter')){
    function tokenSetter()
    {
        return uniqid(config('app.name','Laravel').'_TOKEN_');
    }
}
