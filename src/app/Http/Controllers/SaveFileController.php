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

        $validation = CsvHelper::validateFile($file, $file_name);

        if ($validation['error'] === true)
            return redirect('/')->with('error', $validation['msg']);

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