<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Upload;
use League\Csv\Reader;
use App\Helpers\ValidateHeaderHelper;
use App\Helpers\ValidateFieldsHelper;
use Exception;

class UploadedFileController extends Controller
{
    public function show ($id)
    {
        try {
            $file_name = Upload::findOrFail($id)->url;
            $file = Reader::createFromPath('../storage/app/csv/'.$file_name, 'r');
            $file->setHeaderOffset(0);
            $validate_header = ValidateHeaderHelper::validate($file->getHeader());

            if ($validate_header !== true){
                throw new Exception ('Error: the '.$validate_header.' is not a valid Header');
            }
            return view('validate_file_fields', ['file_lines'=> $file->getRecords(), 'header' => $file->getHeader(), 'url_file' => $file_name, 'upload_id' => $id])->with(['error_message'=>session('error')]);
        } 
        catch (Exception $e){
            return redirect('/')->with('error', 'An error in processing your file:'.$e->getMessage());
        }

    }
}
