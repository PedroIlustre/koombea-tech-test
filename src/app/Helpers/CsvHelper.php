<?php

namespace App\Helpers;

use League\Csv\Reader;

class CsvHelper
{

    public static function validateFile (object $file, string $file_name)
    {
        $log_validate['error'] = false;
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        if ($file_extension != 'csv') {
            $log_validate['msg'] = ' Extension not supported (.'.$file_extension.'), only CSV files! ';
            $log_validate['error'] = true;
        }

        $validate_header = CsvHelper::validateHeader($file, $file_name);

        if ($validate_header !== true && $log_validate['error'] === false) {
            $log_validate['msg'] = ' The '.$validate_header.' is not a valid Header ';
            $log_validate['error'] = true;
        }

        return $log_validate;
    }

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