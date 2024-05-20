<?php

use Illuminate\Support\Facades\Route;

if(!function_exists('set_active_url')){
    function set_active_url($routerName){
        return Route::currentRouteName()==$routerName ? 'active':'';
    }
}


if(!function_exists('set_menu_open')){
    function set_menu_open($route_names){
        return in_array(Route::currentRouteName(), $route_names)?'menu-open':'';
    }
}

?>