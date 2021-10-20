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

    public function list ($user_id)
    {
        try {
            $files_name = Upload::where('user_id','=',$user_id)
                                ->where('processed','=','false')
                                ->get();

            return view('list_files', ['files' => $files_name]);
        
        }
        catch (Exception $e) {
            return redirect('/')->with('error', 'An error in processing your file:'.$e->getMessage());
        }
    }
}
