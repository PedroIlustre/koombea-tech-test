<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ContactFiles;
use App\Http\Controllers\Auth;

class ListContactController extends Controller
{

    private $contract_files;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list () 
    {   
        $contact_files = ContactFiles::all();
        return view('list_contacts', ['contact_files'=> $contact_files->all()]);
    }
}
