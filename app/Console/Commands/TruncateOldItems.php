<?php

namespace App\Console\Commands;

use App\Image;
use Illuminate\Console\Command;

class TruncateOldItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

       // Image::where('datetime', '<', Carbon::now())->each(function ($item) {
         //   $item->delete();
      //  });
    }
}
