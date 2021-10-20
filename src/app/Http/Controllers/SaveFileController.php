<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Models\Upload;
use League\Csv\Writer;
use App\Helpers\CsvHelper;
use App\Http\Controllers\SaveContactController;
use Exception;

class SaveFileController extends Controller
{
    public function save (Request $request) 
    {
        $file = $request->file('file_uploaded');
        
        if (!isset($file))
            return redirect('/')->with('error', 'Please select a file');

        $file_name = $file->getClientOriginalName();

        if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv')
            return redirect('/')->with('error', 'Extension not supported, only upload CSV files!');

        if ($file->getSize() > 41463) {
            //put to a queue
            return redirect('/')->with('success', 'Your file was received and will be processed soon');;
        }

        $validate_header = CsvHelper::validateHeader($file, $file_name);

        if ($validate_header !== true) {
            return redirect('/')->with('error', 'The '.$validate_header.' is not a valid Header');
        }

        try {
            $upload = new Upload();
            $upload->url = $file_name;
            $upload->user_id = \Auth::user()->id;
            $upload->save();

        } catch (Exception $e) {
            return redirect('/')->with('error', 'Fail to persist file in the database: '.$e->getMessage());
        }

        return redirect()->route('show_upload', ['id'=>$upload->id]);
    }
}