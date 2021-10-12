<?php

namespace App\Exceptions;

use Exception;

class FieldsException extends Exception
{
    private $_fields;

    public function __construct($message, 
                                $code = 0, 
                                Exception $previous = null, 
                                $fields = array('params')) 
    {
        parent::__construct($message, $code, $previous);

        $this->_fields = $fields; 
    }

    public function getFields() { return $this->_fields; }
}
