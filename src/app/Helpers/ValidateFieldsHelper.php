<?php

namespace App\Helpers;

class ValidateFieldsHelper
{
    public static function validate (array $fields)
    {
        foreach ($header as $item) {
            switch($item){
                case 'name':
                case 'birth_date':
                case 'phone':
                case 'addres':
                case 'credit_card':
                case 'franchise':
                case 'email':
                    break;
                default:
                    return $item;
                
            }
        }
        return true;
    }
}