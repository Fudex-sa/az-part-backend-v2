<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\ElecEngine;
 
class NextRound extends Command
{
    protected $engine;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_round:cron';

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
        
        $this->engine = new ElecEngine();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {         
        $this->engine->run_next_round();
    }
}
