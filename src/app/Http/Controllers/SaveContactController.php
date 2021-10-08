<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ContactFiles;
use App\Http\Controllers\Auth;

class SaveContactController extends Controller
{

    private $contract_files;

    public function __construct()
    {
        $this->middleware('auth');
        $this->contract_files = new ContactFiles();
    }

    public function save (Request $request, $upload_id) 
    {

        $fields = array_merge($request->all(), ['upload_id' => $upload_id]);

        foreach($fields['value_field'] as $k => $contact){
            foreach($fields['table_column'][$k] as $i => $table_column){
                $this->contract_files->{$table_column} = $contact[$i];
            }
            $this->contract_files->user_id = \Auth::user()->id;
            $this->contract_files->upload_id = $upload_id;
            $this->contract_files->save();
        }
        return redirect('/')->with('success', 'Your CSV file was saved');
    }
}
