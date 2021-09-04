<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UploadFileController extends Controller
{
    public function uploadFile (Request $request) 
    {
        $file = $request->file('file_uploaded');

        try {
            if(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) != 'csv')
                return redirect('/home')->with('status', 'Extension not supported, only upload CSV files!');

            
                dd('d');
        } 
        catch (Exception $e){

        }
        dd($_POST['file']);
    }
}
