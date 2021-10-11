<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Models\Upload;
use League\Csv\Writer;
use App\Http\Controllers\SaveContactController;

class SaveFileController extends Controller
{
    public function save (Request $request) 
    {
        $file = $request->file('file_uploaded');
        $file_name = $file->getClientOriginalName();
        if (!isset($file))
            return redirect('/')->with('error', 'Please select a file');

        if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv')
            return redirect('/')->with('error', 'Extension not supported, only upload CSV files!');

        try {
            $upload = new Upload();
            $upload->url = $file_name;
            $upload->save();
        } catch (Exception $e){
            return redirect('/')->with('error', 'Cannont persist file in the database');
        }

        $file->storeAs('csv', $file_name);
        return redirect()->route('show_upload',['id'=>$upload->id]);

    }
}