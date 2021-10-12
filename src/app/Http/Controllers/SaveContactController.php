<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ContactFiles;
use App\Http\Controllers\Auth;
use App\Exceptions\FieldsException;

class SaveContactController extends Controller
{

    private $contact_files;
    private $file_id;

    public function __construct()
    {
        $this->middleware('auth');
        $this->contact_files = new ContactFiles();
    }

    public function save (Request $request) 
    {
        $fields = array_merge($request->all());
        $this->upload_id = $fields['upload_id'];

        try {
            if (is_array($fields)){
                foreach($fields['value_field'] as $k => $contact){
                    foreach($fields['table_column'][$k] as $table_column => $new_value_column){
                        if(is_null($new_value_column)){
                            $errorTableColumns[] = $table_column;
                            continue;
                        }
                        $this->contact_files->{$table_column} = $contact[$new_value_column];
                    }

                    if (is_array($errorTableColumns)) {
                        throw new FieldsException ('', 0, null, $errorTableColumns);
                    }
                    $this->contact_files->user_id = \Auth::user()->id;
                    $this->contact_files->upload_id = $this->upload_id;
                    $this->contact_files->save();
                }
            }
        } catch (FieldsException $e) {
            return redirect("/show_upload/{$this->upload_id}")->with('error', $e->getFields());
        }

        return redirect('/')->with('success', 'Your CSV file was saved');
    }

}
