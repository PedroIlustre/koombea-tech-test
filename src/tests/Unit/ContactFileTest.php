<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Models\{Upload, ContactFiles};

class ContactFileTest extends TestCase
{
    
    public function testSaveAnUploadFile()
    {
        $upload = new Upload();
        $upload->url = 'https://some-url';
        $upload->save();
        $this->assertTrue($upload->id > 0);

    }

    public function testListAnUploadFile()
    {
        $this->assertTrue(Upload::get('url'));

    }


    public function testShowAnUploadFile()
    {
        $contact_files = new ContactFiles();
        $contact_files->findOrFaill(1);
        $this->assertTrue($contact_files < 0);
    }
}
