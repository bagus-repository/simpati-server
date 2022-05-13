<?php

if (!function_exists('get_file_ext')) {
    function get_file_ext(string $filename){
        return pathinfo($filename, PATHINFO_EXTENSION);
    }
}

if (!function_exists('txtsts_efilling')) {
    function txtsts_efilling(string $status){
        if ($status == 0) {
            return '<span class="badge badge-warning">Pending</span>';
        }elseif ($status == 1) {
            return '<span class="badge badge-success">Disetujui</span>';
        }elseif ($status == 2) {
            return '<span class="badge badge-danger">Ditolak</span>';
        }else{
            return '-';
        }
    }
}
