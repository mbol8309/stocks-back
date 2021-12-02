<?php

namespace App\GraphQL\Exceptions;

use Exception;

class StocksExceptions extends Exception{

    protected $return_code = 401;

    public function __construct($message, $return_code = 401)
    {
        parent::__construct($message,$return_code);
        $this->return_code = $return_code;
    }

    public function code(){ return $this->code;}
};