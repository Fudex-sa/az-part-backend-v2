<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Search;

class SearchHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $search;
    protected $signature = 'search_history:cron';

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
        $this->search = new Search();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->search->update_expired_history();
    }
}
