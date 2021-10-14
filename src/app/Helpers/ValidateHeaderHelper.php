<?php

namespace App\Helpers;

class ValidateHeaderHelper
{
    public static function validate (array $header)
    {
        foreach ($header as $item){
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