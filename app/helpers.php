<?php

if (!function_exists('get_file_ext')) {
    function get_file_ext(string $filename){
        return pathinfo($filename, PATHINFO_EXTENSION);
    }
}