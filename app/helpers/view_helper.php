<?php

use Jenssegers\Blade\Blade;

if(!function_exists('view'))
{
    function view($view,$data = [],$render = false)
    {
        $path = VIEWPATH;

        $blade = new Blade($path,FCPATH.'storage/views');

        if($render)
        {
            return $blade->make($view,$data)->render();
        }else{
            echo $blade->make($view,$data);
        }

    }
}