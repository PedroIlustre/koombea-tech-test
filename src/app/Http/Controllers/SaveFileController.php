<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Models\Upload;
use League\Csv\Writer;
use App\Helpers\CsvHelper;
use App\Jobs\StoreCsv;
use App\Http\Controllers\SaveContactController;
use Exception;

class SaveFileController extends Controller
{

    protected $upload;

    public function __construct ()
    {
        $this->upload = new Upload;
    }

    public function save (Request $request) 
    {
        $file = $request->file('file_uploaded');
        
        if (!isset($file))
            return redirect('/')->with('error', 'Please select a file');

        $file_name = $file->getClientOriginalName();

        if ($file->getSize() > 41463) {
            StoreCsv::dispatch($file_name, \Auth::user()->id);
            return redirect('/')->with('success', 'Your file was received and will be processed soon');;
        }

        $validation = CsvHelper::validateFile($file, $file_name);

        if ($validation['error'] === true)
            return redirect('/')->with('error', $validation['msg']);

        try {

            $this->store($file_name);

        } catch (Exception $e) {
            return redirect('/')->with('error', 'Fail to persist file in the database: '.$e->getMessage());
        }

        return redirect()->route('show_upload', ['id'=>$this->upload->id]);
    }

    public function store (string $file_name, $user_id = null)
    {
        $this->upload->url = $file_name;
        $this->upload->processed = false;
        $this->upload->user_id = $user_id ?? \Auth::user()->id;
        $this->upload->save();
    }

    public function processFile (int $upload_id)
    {
        $upload = $this->upload->find($upload_id);
        $upload->processed = true;
        $upload->save();
    }
}