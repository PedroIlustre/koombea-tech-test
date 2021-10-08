<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Models\Upload;
use App\Http\Controllers\SaveContactController;

class SaveFileController extends Controller
{
    public function save (Request $request) 
    {
        $file = $request->all()['url_file'];
        $upload = new Upload();
        $upload->url = $file;
        $upload->save();

        $contract = new SaveContactController();
        return $contract->save($request, $upload->id);

    }
}