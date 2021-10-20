<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Contact;
use App\Http\Controllers\Auth;
use App\Exceptions\FieldsException;
use App\Helpers\CreditCardHelper;
use App\Helpers\ContactInfoHelper;

class SaveContactController extends Controller
{

    private $contact;
    private $upload_id;

    public function __construct()
    {
        $this->middleware('auth');
        $this->contact = new Contact();
    }

    public function save (Request $request) 
    {
        $fields = array_merge($request->all());
        $this->upload_id = $fields['upload_id'];
        $error_table_columns = [];
        $credit_card = '';

        try {
            if (is_array($fields)) {
                foreach ($fields['value_field'] as $k => $contact) {
                    foreach ($fields['table_column'][$k] as $table_column => $new_value_column){
                        if (is_null($new_value_column)) {
                            $error_table_columns[] = $table_column . ' is required';
                            continue;
                        }
                        $this->contact->{$table_column} = $contact[$new_value_column];

                        if($table_column == 'credit_card') {
                            $credit_card = $contact[$new_value_column];
                        }
                    }
                    
                    // validations
                    if (count($error_table_columns) > 0) {
                        throw new FieldsException ('', 0, null, $error_table_columns);
                    }
                    
                    $validate_fields = ContactInfoHelper::validateFields($this->contact->getAttributes());
                    
                    if ($validate_fields['status'] == 'error') {
                         throw new FieldsException ('', 0, null, $validate_fields);
                    }
                    
                    $this->contact->franchise = CreditCardHelper::franchise($credit_card);
                    $this->contact->user_id = \Auth::user()->id;
                    $this->contact->upload_id = $this->upload_id;
                    $this->contact->save();
                    
                    try {

                        $file = new SaveFileController();
                        $file->processFile($this->upload_id);

                    }  catch (Exception $e) {
                        throw new FieldsException('', 0, null, $e->getMessage());
                    }

                }
            }
        } catch (FieldsException $e) {
            return redirect("/show_upload/{$this->upload_id}")->with('error', $e->getFields());
        }

        return redirect('/')->with('success', 'Your CSV file was saved');
    }

}
