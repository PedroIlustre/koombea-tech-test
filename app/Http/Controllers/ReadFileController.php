<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReadFileController extends Controller
{
    public function uploadFile () 
    {
        try {
            $file = $_POST['file'];
            if(pathinfo($file, PATHINFO_EXTENSION) != 'csv'){
                // return Response::json([
                //     'message' => 'Extension not supported, only upload CSV files',
                //     'error'   => true
                // ]);
                return redirect('/home')->with('status', 'Extension not supported, only upload CSV files!');

                // return response('Extension not supported, only upload CSV files', 500)
                //   ->header('Content-Type', 'text/plain')
                //   ->redirect('/home');
            }

            dd($file['size']);
        } 
        catch (Exception $e){

        }
        dd($_POST['file']);
    }
}
