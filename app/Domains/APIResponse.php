<?php

namespace App\Domains;

class APIResponse
{
    public $status = self::SUCCESS;
    public $msg = '';
    public $data = null;
    public const SUCCESS = 'success';
    public const ERROR = 'error';
}