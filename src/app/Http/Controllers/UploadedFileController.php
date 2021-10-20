<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Upload;
use App\Helpers\CsvHelper;
use Exception;

class UploadedFileController extends Controller
{
    public function show ($id)
    {
        try {
            $file_name = Upload::findOrFail($id)->url;
            
            $file = CsvHelper::getFileFromStorage($file_name);
            $file->setHeaderOffset(0);
            
            return view('validate_file_fields', ['file_lines'=> $file->getRecords(), 'header' => $file->getHeader(), 'url_file' => $file_name, 'upload_id' => $id])->with(['error_message'=>session('error')]);
        } 
        catch (Exception $e) {
            return redirect('/')->with('error', 'An error in processing your file:'.$e->getMessage());
        }

    }
}
