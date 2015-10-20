<?php
/*
 * This file allows you auto load classes
 * without having to include them on the page. 
 */
function load_lib($base) {
    var_dump($base);
    $basename = explode('\\', $base);
    $class = end($baseName);
    
    include 'models/'.$class . '.php';
    
    var_dump($class);
};
spl_autoload_register('load_lib');
