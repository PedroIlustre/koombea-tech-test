<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Upload;
use League\Csv\Reader;

class UploadedFileController extends Controller
{
    public function show ($file_name)
    {
        
        try {
            $file = Reader::createFromPath('../storage/app/csv/'.$file_name, 'r');
            $file->setHeaderOffset(0);
            // dd($file->getRecords());
            return view('validate_file_fields', ['file_lines'=> $file->getRecords(), 'header' => $file->getHeader(), 'url_file' => $file_name]);
        } 
        catch (Exception $e){
            return redirect('/')->with('error', 'An error in processing your file:'.$e->getMessage());
        }

    }
}
