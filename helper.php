<?php

if (!function_exists('dd')) {
    /**
     * Dump and die. Faster and easier alternative to var_dump().
     * Supports multiple variables.
     * @param mixed ...$vars
     * @return never
     */
    function dd(...$vars) {
        if (empty($vars)) {
            echo "Variable does not exist!\n";
            die();
        }
    
        echo "<pre>";
        foreach ($vars as $var) {
            var_dump($var);
        }
        echo "</pre>";
        die();
    }
}
if(!function_exists('dump')){
    /**
     * Dump only. Faster and easier alternative to var_dump().
     * Supports multiple variables.
     * @param mixed ...$vars
     * @return void
     */
    function dump(...$vars) {
        if (empty($vars)) {
            echo "Variable does not exist!\n";
        }
    
        echo "<pre>";
        foreach ($vars as $var) {
            var_dump($var);
        }
        echo "</pre>";
    }
}