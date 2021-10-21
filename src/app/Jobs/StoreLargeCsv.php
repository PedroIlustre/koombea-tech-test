<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\SaveFileController;

class StoreLargeCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file_name;
    public $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_name, $user_id)
    {
        $this->file_name = $file_name;
        $this->user_id   = $user_id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = new SaveFileController();
        $file->store($this->file_name, $this->user_id);
    }
}
