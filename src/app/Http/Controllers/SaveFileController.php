<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Models\Upload;
use League\Csv\Writer;
use App\Helpers\CsvHelper;
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

        $validation = CsvHelper::validateFile($file, $file_name);

        if ($file->getSize() > 41463) {
            //put to a queue
            return redirect('/')->with('success', 'Your file was received and will be processed soon');;
        }

        if ($validation['error'] === true)
            return redirect('/')->with('error', $validation['msg']);

        try {

            $this->store($file_name, false);

        } catch (Exception $e) {
            return redirect('/')->with('error', 'Fail to persist file in the database: '.$e->getMessage());
        }

        return redirect()->route('show_upload', ['id'=>$this->upload->id]);
    }

    public function store (string $file_name, bool $processed)
    {
        $this->upload->url = $file_name;
        $this->upload->processed = $processed;
        $this->upload->user_id = \Auth::user()->id;
        $this->upload->save();
    }

    public function updateFileStatus (int $upload_id)
    {
        $upload = $this->upload->find($upload_id);
        $upload->processed = true;
        $upload->save();
    }
}