<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Upload;
use League\Csv\Reader;

class UploadedFileController extends Controller
{
    public function show ($file_name)
    {
        $file = Reader::createFromPath('../storage/app/csv/'.$file_name);

        try {
            $file_handle = fopen($file, 'r');
            while (!feof($file_handle)) {
                $file_lines[] = fgetcsv($file_handle, 0, ','  );
            }

            $header = $file_lines[0];
            array_shift($file_lines);

            return view('validate_file_fields', ['file_lines'=> $file_lines, 'header' => $header, 'url_file' => $file]);
        } 
        catch (Exception $e){
            return redirect('/')->with('error', 'An error in processing your file:'.$e->getMessage());
        }

    }
}
