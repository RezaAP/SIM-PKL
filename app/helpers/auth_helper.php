<?php

if(!function_exists('auth'))
{
    function auth()
    {

        $CI =& get_instance();

        $result = new Auth;
        return $result;

    }

}