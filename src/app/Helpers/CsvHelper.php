<?php

namespace App\Helpers;

use League\Csv\Reader;

class CsvHelper
{
    public static function validateHeader (object $file, string $file_name)
    {
        $file->storeAs('csv', $file_name);
        $file_read = self::getFileFromStorage($file_name);
        $file_read->setHeaderOffset(0);
        return self::validateHeaderString($file_read->getHeader());
    }

    private static function validateHeaderString (array $header)
    {
        foreach ($header as $item){
            switch($item){
                case 'name':
                case 'birth_date':
                case 'phone':
                case 'addres':
                case 'credit_card':
                case 'email':
                    break;
                default:
                    return $item;
                
            }
        }
        return true;
    }

    public static function getFileFromStorage (string $file_name)
    {
        return Reader::createFromPath('../storage/app/csv/'.$file_name, 'r');
    }
}