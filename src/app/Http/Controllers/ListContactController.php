<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Contact;
use App\Http\Controllers\Auth;

class ListContactController extends Controller
{

    private $contract_files;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list ($user_id) 
    {   
        $contacts = Contact::where('user_id', '=', $user_id)->get();
        return view('list_contacts', ['contacts'=> $contacts]);
    }
}
